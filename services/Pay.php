<?php
/**
 * User: hechen
 * Date: 15/10/9
 * Time: 上午9:50
 */
namespace app\services;

use app\models\Cart as CartModel;
use app\models\CurrentPeriod;
use app\models\CodeDistribution;
use app\models\Period;
use app\models\Product as ProductModel;
use app\models\PaymentOrderDistribution;
use app\models\PaymentOrderItemDistribution;
use app\models\PeriodBuylistDistribution;
use app\models\UserBuylistDistribution;
use app\models\Invite;
use app\models\Fund;
use app\models\User as UserModel;
use app\services\User;
use app\services\Member;
use app\services\Product;
use app\helpers\MyRedis;
use app\helpers\DateFormat;

/**
* 支付
*/
class Pay
{
	public $userId;
	public $total;
	public $userHomeId;
	public $cart;
	public $buyNums = 0;
	public $realMoney = 0;
	public $realPoint = 0;
	public $userInfo;
	public $orderInfo;
	public $orderItems;
	public $order;
	public $redis;
	public $codes;

	const PERIOD_ALL_CODE_KEY = 'PERIOD_ALL_CODE_';  // set 码表  _periodid
	const PERIOD_SALED_KEY = 'PERIOD_SALED_';  //set 已售出码 _period	
	const PERIOD_BUY_LIST_KEY = 'PERIOD_BUY_LIST_'; //hash 期数购买记录 _period  orderid->信息
	const USER_BUY_LIST_KEY = 'USER_BUY_LIST_';    // hash period_id->codes _orderid  每个订单一条
	const USER_PERIOD_BUY_LIST_KEY = 'USER_PERIOD_BUY_LIST_'; // set  _uid_periodId  用户某期购买记录 内容为订单号
	const GET_CODE_LIST_KEY = 'GET_CODE_LIST_';  //list  _periodid
	const ORDER_HAND_LIST_KEY = 'ORDER_HAND_LIST'; //set
	const ORDER_LIST_KEY = 'ORDER_LIST';  //hash类型，order->orderinfo
	const ORDER_ITEMS_KEY = 'ORDER_ITEMS_';  //hash 订单详情 period_id->info _orderid
	const LAST_BUY_LIST_KEY = 'LAST_BUY_LIST'; //list 最后购买记录
	const NEW_PERIOD_KEY = 'NEW_PERIOD';//set 开始新一期
	const PERIOD_ORDERS_KEY = 'PERIOD_ORDERS_'; //hash  _period  期数订单，用于数据同步
	const POINT_USE_KEY = 'POINT_USE_'; //hash _order  period_id => money,point

	public function __construct($uid){
		$this->redis = new MyRedis();
		$this->userId = $uid;
	}

	/**
	 * 创建支付订单
	 * @return [type] [description]
	 */
	public function createPayOrder($source,$point,$payType='1',$bank='',$recharge_orderid=''){
		$userInfo = User::baseInfo($this->userId);
		$time = microtime(time());

		$orderNum = PaymentOrderDistribution::generateOrderId($userInfo['home_id']);

		$cartInfo = $this->_getCartInfo();

		if ($cartInfo) {
			$orderInfo = array(
					'id' => $orderNum,
					'user_id' => $this->userId,
					'status' => 0,
					'payment' => $payType,
					'bank' => $bank,
					'money' => 0,
					'point' => 0,
					'total' => $this->_getTotal(),
					'user_point' => $point,
					'ip' => ip2long(\Yii::$app->request->userIP),
					'source' => $source,
					'create_time' => $time,
					'buy_time' => $time,
					'recharge_orderid' => $recharge_orderid
				);
			$order = $this->redis->hset(self::ORDER_LIST_KEY,array($orderNum=>json_encode($orderInfo)));
			if ($order) {
				$itmes = array();
				foreach ($cartInfo as $key => $value) {
					$itmes[$value['period_id']] = json_encode(array(
							'payment_order_id' => $orderNum,
							'product_id' => $value['product_id'],
							'period_id' => $value['period_id'],
							'period_number' => $value['period_number'],
							'post_nums' => $value['nums'],
							'nums' => 0,
							'codes'=>'',
							'item_buy_time'=>''
						));
				}
				$this->redis->hset(self::ORDER_ITEMS_KEY.$orderNum,$itmes);
			}
		}
		return $orderNum;
	}

	/**
	 * 支付
	 * @param  int $uid 用户ID
	 * @return bool      [description]
	 */
	public function payByBalance($order){
		$this->order = $order;
		$this->userInfo = User::baseInfo($this->userId);
		// 获取订单信息
		$this->orderInfo = json_decode($this->redis->hget(self::ORDER_LIST_KEY,$this->order),true);

		if (!$this->orderInfo) {
			$data['code'] = 201;
			$data['message'] = '订单不存在';
			return $data;
		}

		$isexist = $this->redis->sset(self::ORDER_HAND_LIST_KEY,$this->order);
		if ($isexist == 0) {
			return false;
		}

		if ($this->orderInfo['status'] == '1') {
			$items = $this->redis->hget(self::ORDER_ITEMS_KEY.$order,'all');
			return $this->buyResult($items);
		}
		
		if ($this->orderInfo && $this->orderInfo['total'] > 0) {
			// 计算需要的金额
			$usermoney = $this->userInfo['money'];
			$userPoint = $this->userInfo['point'];
			$pointMoney = 0; //积分转换成的金额
			if ($this->orderInfo['user_point'] > 0 && $this->orderInfo['user_point'] % 100 == 0 && $this->orderInfo['user_point'] <= $userPoint) {
				$pointMoney = $this->orderInfo['user_point']/100;
			}
			// 余额+积分>订单总额
			if (($usermoney+$pointMoney) >= $this->orderInfo['total']) {
				$needMoney = $this->orderInfo['total'];
				$needPoint = 0;
				if ($pointMoney > 0) {
					$needMoney = $this->orderInfo['total']-$pointMoney;
					$needPoint = $pointMoney*100;
				}
				
				//扣除用户余额及积分
				$userMoneyPoint = ['point'=>$this->userInfo['point'],'money'=>$this->userInfo['money']];
				$rs = $this->_deduction($userMoneyPoint,$needMoney,$needPoint);
				//扣除成功
				if ($rs) {
					$this->codes = $this->redis->hget(self::USER_BUY_LIST_KEY.$this->order,'all');
					if (!$this->codes) {
						$this->_getCodes();	
					}else{
						foreach ($this->codes as $key => &$value) {
							$value = json_decode($value,true);
						}
					}

					$confirm = $this->_confirmMoney($needMoney,$needPoint);

					if ($confirm) {
						$this->updateUserBuy($this->order);
						$this->addPointLog($this->userId,$pointMoney);
						$this->payOffCommission($pointMoney);//发放佣金
						Fund::addFund($this->realMoney*0.01+($this->realPoint)/100*0.01);
						$this->redis->sdel(self::ORDER_HAND_LIST_KEY,$this->order);
						// $orderItems = PaymentOrderItemDistribution::findByTableId($tableId)->select('product_id,period_id,period_number,post_nums,nums,item_buy_time')->where(['payment_order_id'=>$this->order])->asArray()->all();
						$orderItems = $this->redis->hget(self::ORDER_ITEMS_KEY.$this->order,'all');
						return $this->buyResult($orderItems);
					}else{
						foreach ($this->codes as $key => $value) {
							$this->rollBack($value['period_id']);
						}
						$this->orderInfo['status'] = 2;
						$this->orderInfo['buy_time'] = microtime(time());
						$this->redis->hset(self::ORDER_LIST_KEY,array($this->order=>json_encode($this->orderInfo)));
					}
				}else{
					$this->orderInfo['status'] = 2;
					$this->orderInfo['buy_time'] = microtime(time());
					$this->redis->hset(self::ORDER_LIST_KEY,array($this->order=>json_encode($this->orderInfo)));
				}
			}else{
				$this->orderInfo['status'] = 2;
				$this->orderInfo['buy_time'] = microtime(time());
				$this->redis->hset(self::ORDER_LIST_KEY,array($this->order=>json_encode($this->orderInfo)));
			}
		}
	}

	/**
	 * 获取伙购码
	 * @return [type] [description]
	 */
	private function _getCodes(){
		set_time_limit(0);
		$userBuy = array();
		//订单详情
		$this->orderItems = $this->redis->hget(self::ORDER_ITEMS_KEY.$this->order,'all');
		foreach ($this->orderItems as $key => $value) {
			$value = json_decode($value,true);
			$this->orderItems[$key] = $value;
			$periodId[] = $value['period_id'];
		}
		//当期期数信息
		$_periodInfo = CurrentPeriod::find()->where(['in','id',$periodId])->asArray()->all();
		$periodInfo = array();
		foreach ($_periodInfo as $key => $value) {
			$periodInfo[$value['id']] = $value;
		}
		foreach ($this->orderItems as $key => $value) {
			$codes = array();
			$userBuy[$key] = array(
					'period_id' => $key,
					'period_number' => $value['period_number'],
					'product_id' => $value['product_id'],
					'count' => 0,
					'left_num' => 0,
					'codes' => $codes
				);
			if (isset($periodInfo[$key])) {
				$userBuy[$key]['table_id'] = $periodInfo[$key]['table_id'];
				$saledNumsKey = self::PERIOD_SALED_KEY.$key;
				$codeKey = self::PERIOD_ALL_CODE_KEY.$key;
				if ($this->redis->slen($codeKey) > 0) {
					$listKey = self::GET_CODE_LIST_KEY.$value['period_id'];
					$this->redis->lset($listKey,$this->userId,'false');

					$canGetCode = $this->beginGetCode($key,$value['post_nums']);
					while (!$canGetCode) {
						if ($this->redis->slen($codeKey) == 0) {
							$this->redis->del(self::GET_CODE_LIST_KEY.$key);
							break;
						}
						usleep(50);
						$canGetCode = $this->beginGetCode($key,$value['post_nums']);
					}

					$codes = array_filter($this->redis->sget(self::PERIOD_ALL_CODE_KEY.$key,$value['post_nums']));
					$left_num = $this->redis->slen($codeKey);
					$this->redis->lmdel(self::GET_CODE_LIST_KEY.$key,$this->userId,1);
					$this->redis->sset($saledNumsKey,$codes);
					$userBuy[$key]['count'] = count($codes);
					$userBuy[$key]['codes'] = $codes;
					$userBuy[$key]['left_num'] = $left_num;
					$db = \Yii::$app->db;
					if (count($codes) > 0) {
						$codeModel = new CodeDistribution($value['product_id']);
						$result = $db->createCommand("update ".$codeModel::tableName()." set status = 1 where product_id = '".$value['product_id']."' and code in (".implode(',',$codes).")")->execute();	
					}
					CurrentPeriod::updateAll(
						[
							'sales_num'=>$this->redis->slen($saledNumsKey),
							'left_num'=>$left_num,
							'progress'=>round($this->redis->slen($saledNumsKey)/$periodInfo[$key]['price'],6)*100000
						],[
							'id'=>$key
						]
					);
				}else{
					$this->redis->del(self::GET_CODE_LIST_KEY.$key);
				}
			}else{
				$this->redis->del(self::GET_CODE_LIST_KEY.$key);
				$completePeriodInfo = Period::find()->where(['id'=>$key])->asArray()->one();
				$userBuy[$key]['table_id'] = $completePeriodInfo['table_id'];
			}
		}
		$data = array();
		foreach ($userBuy as $key => $value) {
			$data[$key] = json_encode($value);
		}
		$this->redis->hset(self::USER_BUY_LIST_KEY.$this->order,$data);
		// $this->codes = $userBuy;
	}

	/**
	 * 更新购买
	 * @param  array $codes [description]
	 * @return [type]        [description]
	 */
	private function updateUserBuy()
	{
		//用户购买记录
		$userBuyField = ['user_id','product_id','period_id','buy_num','buy_time'];
		$db = \Yii::$app->db;
		$userBuyList = new UserBuylistDistribution($this->userInfo['home_id']);

		$this->codes = $this->redis->hget(self::USER_BUY_LIST_KEY.$this->order,'all');
		foreach ($this->codes as $key => &$value) {
			$value = json_decode($value,true);
		}

		$status = 2;
		foreach ($this->codes as $key => $v) {
			$_time = explode('.',microtime(time()));
			$time = $_time['0'].'.'.str_pad($_time[1], 3,0,STR_PAD_RIGHT);
			$codesStr = $v['codes'] ? implode(',',$v['codes']) : '';
			$newItem = $this->orderItems[$v['period_id']];
			$newItem['nums'] = $v['count'];
			$newItem['codes'] = $codesStr;
			$newItem['item_buy_time'] = $time;
			$updateOrderItem = $this->redis->hset(self::ORDER_ITEMS_KEY.$this->order,array($v['period_id']=>json_encode($newItem)));
			if (!empty($v['codes']) && $v['table_id']) {
				//更新用户购买记录
				$exist = UserBuylistDistribution::findByUserHomeId($this->userInfo['home_id'])->where(['user_id'=>$this->userId,'period_id'=>$v['period_id']])->asArray()->one();
				if (empty($exist)) {
					$userBuyValue = [];
					$userBuyValue[] = [$this->userId,$v['product_id'],$v['period_id'],$v['count'],$time];
					$userBuy = $db->createCommand()->batchInsert($userBuyList::tableName(),$userBuyField,$userBuyValue)->execute();
				}else{
					$buy_num = $exist['buy_num']+$v['count'];
					$userBuy = $db->createCommand()->update($userBuyList::tableName(),['buy_num'=>$buy_num,'buy_time'=>$time],['user_id'=>$this->userId,'period_id'=>$v['period_id']])->execute();
				}
				$periodBuyList['product_id'] = $v['product_id'];
				$periodBuyList['period_id'] = $v['period_id'];
				$periodBuyList['user_id'] = $this->userId;
				$periodBuyList['buy_num'] = $v['count'];
				$periodBuyList['codes'] = $codesStr;
				$periodBuyList['ip'] = ip2long(\Yii::$app->request->userIP);
				$periodBuyList['source'] = $this->orderInfo['source'];
				$periodBuyList['time'] = $time;
				$periodBuy = $this->redis->hset(self::PERIOD_BUY_LIST_KEY.$v['period_id'],array($this->order=>json_encode($periodBuyList)));
				if (!$userBuy || !$periodBuy) {
					$this->rollBack($v['period_id'],$v['code']);
				}
				// $this->redis->hmset(self::);
			}

			if ($v['left_num'] <= 0 && $v['count'] > 0) {
				$period = CurrentPeriod::find()->where(['product_id'=>$v['product_id'],'id'=>$v['period_id']])->asArray()->one();
				$this->_newPeriod($period,$time);
			}
			
			if (!$updateOrderItem) {
				$this->rollBack($v['period_id'],$v['code']);
			}

			$status = 1;

			$this->redis->sset(self::USER_PERIOD_BUY_LIST_KEY.$this->userId.'_'.$v['period_id'],$this->order);
		}

		CartModel::deleteAll(['user_id'=>$this->userId,'is_buy'=>1]);

		//更新订单状态
		$this->orderInfo['status'] = $status;
		$this->orderInfo['buy_time'] = $time;
		$this->orderInfo['money'] = $this->realMoney;
		$this->orderInfo['point'] = $this->realPoint;
		$this->redis->hset(self::ORDER_LIST_KEY,array($this->order=>json_encode($this->orderInfo)));

		// $this->redis->del(self::USER_BUY_LIST_KEY.$this->order);
	}

	/**
	 * 扣费
	 * @param  array $source 现有余额及积分
	 * @param  int $money  扣除的金额
	 * @param  int $point  扣除的积分
	 * @return [type]         [description]
	 */
	private function _deduction($userMoneyPoint,$money,$point){
		$surplusMoney = $userMoneyPoint['money']-$money;
		$surplusPoint = $userMoneyPoint['point']-$point;
		return UserModel::updateAll(['money'=>$surplusMoney,'point'=>$surplusPoint],['id'=>$this->userId]);
	}

	private function _confirmMoney($money,$point){
		$userMoneyPoint = $this->_getUserMoneyPoint();
		$buyNums = 0;
		$codes = $this->redis->hget(self::USER_BUY_LIST_KEY.$this->order,'all');
		foreach ($codes as $key => $value) {
			$v = json_decode($value,true);
			$buyNums += $v['count'];
		}
		if ($buyNums <= ($money+$point/100)) {
			if ($buyNums < intval($point/100)) {
				$this->realPoint = $buyNums*100;
				$this->realMoney = 0;
			}else{
				$this->realPoint = $point;
				$this->realMoney = $buyNums-($point/100);
			}
			$addPoint = $point-$this->realPoint;
			$addMoney = $money-$this->realMoney;
			$surplusMoney = $userMoneyPoint['money']+$addMoney;
			$surplusPoint = $userMoneyPoint['point']+$addPoint;
			UserModel::updateAll(['money'=>$surplusMoney,'point'=>$surplusPoint],['id'=>$this->userId]);
			return true;
		}else{
			return false;
		}
	}

	/**
	 * 添加佣金
	 * @param  array $codes      码
	 * @param  int $pointMoney 积分/100
	 * @return [type]             [description]
	 */
	private function payOffCommission($pointMoney)
	{
		foreach ($this->codes as $key => $value) {
			$count = $value['count'];
			if ($pointMoney > 0) {
				if ($pointMoney >= $count) {
					$pointMoney = $pointMoney - $count;
					$count = 0;
				}else{
					$count = $count-$pointMoney;
					$pointMoney = 0;
				}
			}
			if ($count > 0) {
				Invite::commissionPayoff($this->userId, $count, $key);
			}
		}
	}

	/**
	 * 添加福分记录
	 * @param array $codes      码
	 * @param int $pointMoney 积分/100
	 */
	private function addPointLog($uid,$pointMoney){
		$exp = 0;
		$pointLog = new Member(['id' => $uid]);
		$productIds = array();
		foreach ($this->codes as $key => $value) {
			$productIds[] = $value['product_id'];
		}
		$productInfo = Product::info($productIds);

		foreach ($this->codes as $key => $value) {
			$count = $value['count'];
			$usePoint = 0;
			if ($pointMoney > 0) {
				if ($pointMoney >= $count) {
					$pointMoney = $pointMoney - $count;
					$usePoint = $count;
					$count = 0;
				}else{
					$count = $count-$pointMoney;
					$usePoint = $pointMoney;
					$pointMoney = 0;
				}
				$pointLog->editPoint((0-$usePoint*100), 1, '伙购商品编码('.$productInfo[$value['product_id']]['bn'].')福分抵扣','buy');
			}
			$exp += $count;
			if ($count > 0) {
				$pointLog->editPoint($count, 1, '伙购商品编码('.$productInfo[$value['product_id']]['bn'].')支付'.$count.'元获得'.$count.'福分');
			}
			$this->redis->hset(self::POINT_USE_KEY.$this->order,array($key=>json_encode(array('money'=>$count,'point'=>$usePoint*100))));
		}	
		$pointLog->editExperience($exp*10,'1','购买商品');
	}
	/**
	 * 开始新一期
	 * @param  array $period 当期数据
	 * @return [type]         [description]
	 */
	private function _newPeriod($period,$time){
		if (!$period) {
			return false;
		}
		$exist = $this->redis->sset(self::NEW_PERIOD_KEY,$period['id']);

		if ($exist) {
			$productInfo = ProductModel::find()->where(['id'=>$period['product_id'],'marketable'=>1])->asArray()->one();
	
			$completePeriod = new Period();

			$completePeriod->id = $period['id'];
			$completePeriod->table_id = $period['table_id'];
			$completePeriod->product_id = $period['product_id'];
			$completePeriod->limit_num = $period['limit_num'];
			$completePeriod->cat_id = $productInfo['cat_id'];
			$completePeriod->period_number = $period['period_number'];
			$completePeriod->lucky_code = 0;
			$completePeriod->user_id = 0;
			$completePeriod->price = $period['price'];
			$completePeriod->start_time = (string)$period['start_time'];
			$completePeriod->end_time = $time;
			$completePeriod->exciting_time = '0';
			
			$result = $completePeriod->save(false);

			if ($result) {
				$del = CurrentPeriod::deleteAll(['id'=>$period['id']]);
				if (!$productInfo) {
					return false;
				}

				if (($period['period_number']+1) > $productInfo['store'] ) {
					ProductModel::updateAll(['marketable'=>0],['id'=>$productInfo['id']]);
					return false;
				}

				if ($del) {
					$newPeriod = new CurrentPeriod();
					$newPeriod->product_id = $period['product_id'];
					$newPeriod->table_id = rand(100,109);
					$newPeriod->limit_num = $productInfo['limit_num'];
					$newPeriod->period_number = $period['period_number']+1;
					$newPeriod->price = $productInfo['price'];
					$newPeriod->sales_num = 0;
					$newPeriod->left_num = $productInfo['price'];
					$newPeriod->start_time = (string)microtime(time());

					$newPeriod->save(false);
					$newPeriodId = $newPeriod->attributes['id'];
					
					if ($newPeriodId) {
						$this->initCodes($productInfo,$newPeriodId);
					}
				}
			}	
		}		
	}
	/**
	 * 初始化code
	 * @param  [type] $product  [description]
	 * @param  [type] $periodId [description]
	 * @return [type]           [description]
	 */
	private function initCodes($product,$periodId){
		$codeModel = new CodeDistribution($product['id']);
		$db = \Yii::$app->db;
		// 确认码数量
		$sourceCodesNum = $db->createCommand("select count(1) as count,max(code) as max from ".$codeModel::tableName()." where product_id = '".$product['id']."'")->queryOne();
		if ($sourceCodesNum['count'] > $product['price']) {
			$db->createCommand("delete from ".$codeModel::tableName()." where code > '".($sourceCodesNum['max']-($sourceCodesNum['count']-$product['price']))."'")->execute();
		}else if($sourceCodesNum['count'] < $product['price']){
			$sql = "insert into ".$codeModel::tableName()." (code,product_id,status) values ";
			for ($i=1; $i <= $product['price']-$sourceCodesNum['count']; $i++) { 
				$sql .= "('".($sourceCodesNum['max']+$i)."','".$product['id']."',0),";
			}
			$sql = substr($sql,0,-1);
			$rs = $db->createCommand($sql)->execute();
		}
		$rs = $db->createCommand("update ".$codeModel::tableName()." set status = 0 where product_id='".$product['id']."'")->execute();
		$_codes = CodeDistribution::findByProductId($product['id'])->select('code')->where(['product_id'=>$product['id']])->asArray()->all();
		$codeKey = self::PERIOD_ALL_CODE_KEY.$periodId;
		$codes = array();
		foreach ($_codes as $key => $value) {
			$codes[] = $value['code'];
		}
		$this->redis->sset($codeKey,$codes);
		$this->redis->del(self::PERIOD_SALED_KEY.$periodId);
		if ($this->redis->slen($codeKey) != $product['price']) {
			$this->initCodes($product,$periodId);
		}
	}
	/**
	 * 回滚
	 * @param  int $periodId 期数id
	 * @return [type]           [description]
	 */
	private function rollBack($periodId){
		$this->redis->sset(self::PERIOD_ALL_CODE_KEY.$periodId,$this->codes[$periodId]['codes']);
		$this->redis->sdel(self::PERIOD_SALED_KEY.$periodId,$this->codes[$periodId]['codes']);
		$this->redis->sdel(self::GET_CODE_LIST_.$periodId,$this->userId);
		$this->redis->del(self::USER_BUY_LIST_KEY.$this->userId);
		$this->redis->sdel(self::ORDER_HAND_LIST,$this->order);
	}

	/**
	 * 开始取码
	 * @param  int $productId 期数id
	 * @return [type]            [description]
	 */
	private function beginGetCode($periodId){
		$listKey = self::GET_CODE_LIST_KEY.$periodId;
		if ($this->redis->isexist($listKey)) {
			$uid = $this->redis->lget($listKey,0,0);
			if ($uid[0] == $this->userId || !$uid) {
				return 1;
			}else{
				return 0;
			}
		}
		return 1;
	}
	/**
	 * 订单详情
	 * @param  [type] $orderItems [description]
	 * @return [type]             [description]
	 */
	private function buyResult($orderItems){
		$productIds = $success = $fail = $some = array();
		foreach ($orderItems as $key => &$value) {
			$value = json_decode($value,true);
			$productIds[] = $value['product_id'];
		}
		$productInfo = Product::info($productIds);
		foreach ($orderItems as $key => $value) {
			$value['name'] = $productInfo[$value['product_id']]['name'];
			$value['buy_time'] = DateFormat::microDate($value['item_buy_time']);
			if ($value['nums'] > 0) {
				if ($value['post_nums'] > $value['nums']) {
					$some[] = $value;
				}else{
					$success[] = $value;
				}
			}else {
				$value['nums'] = $value['post_nums'];
				$fail[] = $value;
			}
		}
		
		$data['code'] = 100;
		$data['success'] = $success;
		$data['fail'] = $fail;
		$data['some'] = $some;
		return $data;
	}

	/**
	 * 获取用户支付总额
	 * @return int      [description]
	 */
	private function _getTotal(){
		$total = CartModel::find()->select("sum(nums) as total")->where(['user_id'=>$this->userId,'is_buy'=>1])->asArray()->one();
		return $total['total'];
	}

	/**
     * 获取用户余额
     * @return int      [description]
     */
    private function _getUserMoneyPoint(){
            return UserModel::find()->select('point,money')->where(['id'=>$this->userId])->one();
    }

    /**
     * 获取购物车内容
     * @return [type] [description]
     */
	private function _getCartInfo(){
		return CartModel::find()->where(['user_id'=>$this->userId,'is_buy'=>1])->asArray()->all();
	}
}
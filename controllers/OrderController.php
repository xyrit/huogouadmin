<?php
/**
 * Created by PhpStorm.
 * User: zhangjicheng
 * Date: 15/9/19
 * Time: 16:58
 */

namespace app\controllers;

use app\helpers\Excel;
use app\helpers\MyRedis;
use app\models\Banner;
use app\models\PaymentOrderDistribution;
use app\models\VirtualProductInfo;
use app\models\Admin;
use app\models\BackstageLog;
use app\models\ExchangeOrder;
use app\services\Brand;
use app\services\Category;
use yii;
use app\services\Product;
use app\helpers\DateFormat;
use app\models\ProductCategory;
use yii\helpers\ArrayHelper;
use app\models\RechargeOrderDistribution;
use app\models\PaymentOrderItemDistribution;
use app\models\Order;
use app\models\Period;
use app\models\Deliver;
use app\models\User;
use app\models\ShareTopic;
use app\models\ShareTopicImage;
use app\models\Image;

use app\helpers\Message;
use app\helpers\Ex;
use app\models\Product as ModelProduct;
use app\models\DuibaOrderDistribution;

class OrderController extends BaseController
{
	public function actionIndex()
	{
		$request = \Yii::$app->request;
		$catlist = Category::getList(0);
		$count = Order::orderStatusCount();
		$status = $request->get('status', 'all');
		if ($request->isAjax || $request->get('excel') == 'order') {
			$get = $request->get();
			if (isset($get['sub']) && $get['sub'] == 'sub') {
				$where['order'] = $get['order'];
				$deliver = Deliver::find()->select('id');
				if ($get['startTime'] || $get['endTime']) {
					if ($get['time'] == 2) {
						$get['startTime'] && $deliver->andWhere(['>=', 'prepare_time', strtotime($get['startTime'])]);
						$get['endTime'] && $deliver->andWhere(['<', 'prepare_time', strtotime($get['endTime'])]);
					} elseif ($get['time'] == 3) {
						$get['startTime'] && $deliver->andWhere(['>=', 'deliver_time', strtotime($get['startTime'])]);
						$get['endTime'] && $deliver->andWhere(['<', 'deliver_time', strtotime($get['endTime'])]);
					} elseif ($get['time'] == 4) {
						$get['startTime'] && $deliver->andWhere(['>=', 'unix_timestamp(bill_time)', strtotime($get['startTime'])]);
						$get['endTime'] && $deliver->andWhere(['<', 'unix_timestamp(bill_time)', strtotime($get['endTime'])]);
					} else {
						$where['startTime'] = $get['startTime'];
						$where['endTime'] = $get['endTime'];
					}
				}
				if ($get['prepare_userid']) {
					$admin = Admin::findOne(['real_name' => $get['prepare_userid']]);
					$deliver->andWhere(['prepare_userid' => $admin['id']]);
					
				}
				if (!empty($deliver->where)) {
					$ids = $deliver->all();
					//echo $deliver->createCommand()->getRawSql();die;
					$ids && $where['ids'] = ArrayHelper::getColumn($ids, 'id');
					
				}
				$where['from'] = $get['from'];
				$where['time'] = $get['time'];
				if ($get['name']) {
					$userQuery = User::find()->where(['or', 'email="' . $get['name'] . '"', 'phone="' . $get['name'] . '"', 'nickname="' . $get['name'] . '"']);
					if ($where['from']) {
						$user = $userQuery->andWhere(['from' => $where['from']])->one();
						$where['name'] = $user['id'];
					} else {
						$users = $userQuery->all();
						$userIds = ArrayHelper::getColumn($users, 'id');
						$where['name'] = $userIds;
					}
				}
				if ($get['period_no']) {//期号
					$where['period_no'] = $get['period_no'];
				}
				if ($get['product_name'] || $get['cat_id']) {
					if ($get['product_name'] && $get['cat_id']) {
						$product = ModelProduct::find()->where(['like', 'name', $get['product_name']])->andwhere
						(['cat_id' => $get['cat_id']])->all();
					} elseif ($get['product_name']) {
						$product = ModelProduct::find()->where(['like', 'name', $get['product_name']])->all();
					} elseif ($get['cat_id']) {
						if ($get['cat_id2'] && intval($get['cat_id2']) > 0) {
							$product = ModelProduct::find()->where('cat_id="' . $get['cat_id2'] . '"')->all();
							
						} else {
							$catids = ProductCategory::children($get['cat_id']);
							$catids = ArrayHelper::getColumn($catids, 'id');
							array_push($catids, $get['cat_id']);
							$product = ModelProduct::find()->where(['in', 'cat_id', $catids])->all();
						}
						
					}
					$where['product_ids'] = empty(ArrayHelper::getColumn($product, 'id')) ? array("-1") : ArrayHelper::getColumn($product, 'id');
				}
				
				
				if (isset($get['types']) && $get['types']) {
					if ($get['types'] == 1) {
						$product = ModelProduct::find()->where(['in', 'delivery_id', [1, 2, 4]])->all();
					} elseif ($get['types'] == 2) {
						$product = ModelProduct::find()->where(['not in', 'delivery_id', [1, 2, 4]])->all();
					}
					
					foreach ($product as $key => $val) {
						$proArr[$key] = $val['id'];
					}
					$where['types'] = isset($proArr) ? $proArr : [0];
					if (isset($where['product_ids']) && !empty($where['product_ids'])) {
						$newarr = array_intersect($where['product_ids'], $where['types']);
						$where['product_ids'] = (!empty($newarr)) ? $newarr : '-1';
					} else {
						$where['product_ids'] = $where['types'];
					};
				}
				
				if ($get['deliver']) {
					$product = ModelProduct::find()->select('id')->where(['delivery_id' => $get['deliver']])->all();
					foreach ($product as $key => $val) {
						$arr[$key] = $val['id'];
					}
					$where['deliver'] = isset($arr) ? $arr : '';
				}
			}
			
			$where['status'] = $request->get('status', 'all');
			
			$person = Deliver::getEmployeeName();
			if (isset($get['excel']) && $get['excel'] == 'order') {
				ini_set('memory_limit', '1000M');
				//$list = Order::orderList($where, PHP_INT_MAX);
				$perpage = 5000;
				$list = Order::orderList($where);//获取总条数
				$maxPage = ceil($list['total'] / $perpage);//获取最大页数
				$newData = [];
				$where['excel'] = 1;
				for ($i = 0; $i < $maxPage; $i++) {
					$where['page'] = $i;
					$result = Order::orderList($where, $perpage);
					foreach ($result['list'] as $k => &$v) {
						$newData[] = $v;
					}
				}
				$list['list'] = $newData;
				$data[0] = ['id' => '订单号', 'from' => '站点来源', 'name' => '商品名称', 'catone' => '分类', 'phone' => '手机',
					'email' => '邮箱', 'period_number' => '第几期', 'period_no' => '当前期号', 'code' => '伙购码', 'status' => '状态', 'deliver' => '发货方式', 'time' => '中奖时间', 'ship_name' => '收货人', 'ship_area' => '收货地址', 'confirm_userid' => '确认人', 'prepare_userid' => '备货人', 'price' => '成本', 'goodprice' => '伙购价格', 'platform' => '平台', 'third_order' => '第三方订单号', 'payment' => '支付方式', 'bill' => '发票', 'bill_time' => '发票时间', 'bill_num' => '发票号', 'deliver_userid' => '发货人', 'deliver_company' => '快递公司', 'deliver_order' => '快递单号', 'prepare_time' => '备货时间', 'deliver_time' => '发货时间', 'total_point' => '福分总额'];
				$person = Deliver::getEmployeeName();
				$productName = Product::getProductName();
				$productDeliver = Product::getProductDeliver();
				$productCat = Product::getProductCate();
				$catArr = Category::getCateList();
				$periodArr = '';
				foreach ($list['list'] as $key => $val) {
					$key = $key + 1;
					$periodArr .= $val['period_id'] . ',';
					$data[$key]['id'] = $val['id'];
					$data[$key]['from'] = ($val['from'] == 2) ? '滴滴夺宝' : '伙购网';
					$data[$key]['name'] = $productName[$val['product_id']];
					$data[$key]['catone'] = $catArr[$productCat[$val['product_id']]];
					$data[$key]['phone'] = $val['phone'];
					$data[$key]['email'] = $val['email'];
					$data[$key]['period_number'] = $val['period_number'];
					$data[$key]['period_no'] = $val['period_no'];
					$data[$key]['period'] = $val['period_id'];
					$data[$key]['code'] = $val['lucky_code'];
					$status = Order::getStatus($val['status']);
					$data[$key]['status'] = $status['name'];
					$deliver = Order::getDeliver($productDeliver[$val['product_id']]);
					$data[$key]['deliver'] = $deliver['name'];
					$data[$key]['time'] = DateFormat::microDate($val['end_time']);
					$data[$key]['ship_name'] = $val['ship_name'];
					$data[$key]['ship_area'] = $val['ship_area'] . $val['ship_addr'];
					if ($val['confirm_userid']) $data[$key]['confirm_userid'] = $person[$val['confirm_userid']];
					else $data[$key]['confirm_userid'] = '';
					if ($val['prepare_userid']) $data[$key]['prepare_userid'] = $person[$val['prepare_userid']];
					else $data[$key]['prepare_userid'] = '';
					$data[$key]['price'] = $val['deliver_price'];
					$data[$key]['ship_name'] = $val['ship_name'];
					$data[$key]['goodprice'] = $val['goodprice'];
					$data[$key]['platform'] = $val['platform'];
					$data[$key]['third_order'] = $val['third_order'];
					$data[$key]['payment'] = $val['payment'];
					$data[$key]['bill'] = $val['bill'];
					$data[$key]['bill_time'] = $val['bill_time'];
					$data[$key]['bill_num'] = $val['bill_num'];
					if ($val['deliver_userid']) $data[$key]['deliver_userid'] = $person[$val['deliver_userid']];
					else $data[$key]['deliver_userid'] = '';
					$data[$key]['deliver_company'] = $val['deliver_company'];
					$data[$key]['deliver_order'] = $val['deliver_order'];
					if ($val['prepare_time']) $data[$key]['prepare_time'] = DateFormat::microDate($val['prepare_time']);
					else $data[$key]['prepare_time'] = '';
					if ($val['deliver_time']) $data[$key]['deliver_time'] = DateFormat::microDate($val['deliver_time']);
					else $data[$key]['deliver_time'] = '';
				}
				
				$totalPoint = PaymentOrderItemDistribution::getOrderTotalPoint(substr($periodArr, 0, -1));
				$pointArr = [];
				foreach ($totalPoint as $val) {
					$pointArr[$val['period_id']] = $val['totalPoint'];
				}
				
				foreach ($data as $key => $val) {
					if ($key != 0) $data[$key]['total_point'] = isset($pointArr[$val['period']]) ? $pointArr[$val['period']] : '';
					unset($data[$key]['period']);
				}
				$excel = new Ex();
				$excel->download($data, '中奖数据' . date('Y-m-d H:i:s') . '.xls');
				unset($data);
			}
			
			$pageSize = $request->get('rows', 25);
			$list = Order::orderList($where, $pageSize);
			
			$arr = [];
			foreach ($list['list'] as $key => $val) {
				$goodInfo = Product::info($val['product_id']);
				$arr[$key]['id'] = $val['id'];
				$buyBack = \app\models\JdcardBuybackList::findOne(['order_id' => $val['id']]);
				$arr[$key]['name'] = isset($buyBack) ? '【回购】' . $goodInfo['name'] : $goodInfo['name'];
				$arr[$key]['cat_id'] = Category::getCatName($val['cat_id'], 1);
				$arr[$key]['code'] = $val['lucky_code'];
				$arr[$key]['period_id'] = $val['period_id'];
				$arr[$key]['period_number'] = $val['period_number'];
				$arr[$key]['period_no'] = $val['period_no'];
				$status = Order::getStatus($val['status']);
				$arr[$key]['fail'] = $val['fail_type'];
				$arr[$key]['fail_remark'] = $val['fail_id'];
				$arr[$key]['status'] = $status['name'];
				$arr[$key]['delay'] = DateFormat::microDate($val['delay']);
				$arr[$key]['is_exchange'] = $val['is_exchange'];
				$user = User::findOne($val['user_id']);
				$arr[$key]['from'] = $user['from'];
				$arr[$key]['phone'] = $user['phone'];
				$arr[$key]['email'] = $user['email'];
				$deliver = Order::getDeliver($goodInfo['delivery_id']);
				$arr[$key]['delivery'] = $deliver['name'];
				if ($val['confirm_addr_time']) $arr[$key]['confirm_addr_time'] = DateFormat::microDate($val['confirm_addr_time']);
				$arr[$key]['create_time'] = DateFormat::microDate($val['end_time']);
				$arr[$key]['last_modified'] = DateFormat::microDate($val['last_modified']);
				$deliverModel = Deliver::findOne($val['id']);
				if ($deliverModel && $deliverModel['select_prepare']) $arr[$key]['select_prepare'] = $person[$deliverModel['select_prepare']];
				else $arr[$key]['select_prepare'] = '';
			}
			
			$data['rows'] = $arr;
			$data['total'] = $list['total'];
			$data['status'] = $where['status'];
			return $data;
		}
		
		return $this->render('index', [
			'count' => $count,
			'status' => $status,
			'catlist' => $catlist,
			'deliveryItems' => ModelProduct::$deliveries,
		]);
	}
	
	/**
	 * @pass
	 * 订单管理模块商品二级分类搜索
	 * @param  int
	 * @return string
	 */
	public function actionCategory()
	{
		$request = \Yii::$app->request;
		$pid = $request->get('pid', 0);
		$currCat = Category::getList($pid);
		foreach ($currCat["son"] as $k => &$v) {
			$v["text"] = $v["name"];
			$v["value"] = $v["id"];
			unset($v["name"]);
			unset($v["id"]);
			unset($v["parent_id"]);
			unset($v["top_id"]);
			unset($v["product_num"]);
			unset($v["list_order"]);
			unset($v["updated_at"]);
			unset($v["level"]);
		}
		Array_unshift($currCat["son"], array("value" => "", "text" => "全部"));
		return $currCat["son"];
	}
	
	public function actionView()
	{
		$request = \Yii::$app->request;
		$id = $request->get('id');
		$detail = Order::findOne($id);
		$remark = json_decode($detail['remark'], true);
		if (json_last_error() != JSON_ERROR_NONE) {
			$remark[] = [
				'op_user' => \Yii::$app->admin->id,
				'op_content' => $detail['remark'],
				'op_time' => date('Y-m-d H:i:s'),
			];
		}
		
		
		$status = Order::getStatus($detail['status']);
		$user = User::findOne($detail['user_id']);
		$tableId = substr($user['home_id'], 0, 3);
		$goodInfo = Product::info($detail['product_id']);
		$periodInfo = Period::find()->where(['product_id' => $detail['product_id'], 'id' => $detail['period_id']])->one();
		$periodInfo['end_time'] = DateFormat::microDate($periodInfo['end_time']);
		$deliverInfo = Deliver::findOne($id);
		$change = '';
		if ($deliverInfo['is_exchange'] != 0) {
			$exchange = ExchangeOrder::find()->where(['id' => $deliverInfo['is_exchange']])->one();
			$change = $deliverInfo;
			$deliver = $exchange;
		} else {
			$deliver = $deliverInfo;
			if (in_array($goodInfo['delivery_id'], [5, 6, 7])) {
				$orderList = DuibaOrderDistribution::findByTableId($tableId)->where(['order_no' => $id, 'user_id' => $detail['user_id']])->orderBy('id desc')->asArray()->all();
				$orders = '';
				foreach ($orderList as $key => $value) {
					if ($value['status']==1) {
						$errMsg = '成功';
					} else {
						$errMsg = $value['error_msg'];
					}
					$orders .= $value['order_num'] . ' (' . ($value['credits'] / 100) . '元)' . '  (' . $errMsg . ')<br>';
				}
				if($orders)$deliver['third_order'] = '<br>' . $orders;
			}
		}
		
		//虚拟平台
		$virtual = [];
		if (in_array($goodInfo['delivery_id'], array(5, 6, 7, 9, 10))) {
			$virtual = VirtualProductInfo::findOne(['order_id' => $detail['id']]);
			$virtual['name']=isset($virtual['name'])?$virtual['name']:'空';
			if(isset($virtual['type'])){
				if ($virtual['type'] == 'tb') {
					$virtual['type'] = '淘宝充值卡';
				}elseif ($virtual['type'] == 'qb') {
					$virtual['type'] = 'Q币直充';
				}elseif($virtual['type'] == 'dh'){
					$virtual['type'] = '话费';
				}
			}

		}
		$goodInfo['picture'] = Image::getProductUrl($goodInfo['picture'], 58, 58);
		
		//来源
		$conn = Yii::$app->db;
		$sql = $conn->createCommand('select source,buy_time from period_buylist_' . $periodInfo['table_id'] . ' where period_id = ' . $periodInfo['id'] . ' and FIND_IN_SET(' . $periodInfo['lucky_code'] . ', codes)');
		$periodTable = $sql->queryOne();
		$periodTable['source'] = Order::getSource($periodTable['source']);
		$periodTable['buy_time'] = DateFormat::microDate($periodTable['buy_time']);
		
		$person = Admin::getEmployeeName();
		$detail['user_id'] = User::userName($detail['user_id']);
		
		//获取晒单信息
		$shareTopic = ShareTopic::find()->where(['period_id' => $detail['period_id']])->one();
		$shareImg = ShareTopicImage::find()->where(['share_topic_id' => $shareTopic['id']])->all();
		foreach ($shareImg as $key => $val) {
			$shareImg[$key]['basename'] = Image::getShareInfoUrl($val['basename'], 'small');
		}
		
		$csql = "select sum(b.money) as totalMoney, sum(b.point) as totalPoint, sum(b.total) as total from payment_order_items_" . $tableId . " as a left join payment_orders_" . $tableId . " as b on a.payment_order_id = b.id where b.user_id = " . $periodInfo['user_id'] . " and a.period_id = " . $detail['period_id'] . "";
		
		$con = $conn->createCommand($csql);
		$result = $con->queryOne();
		//异常订单用户提交的信息
		if ($detail['status'] == 6) {
			$con_db = Yii::$app->db;
			$sql = "select type,account,name,created_at,created_at,updated_at from user_virtual_address where user_id = 
" . $detail['user_id']['id'];
			$sql = $con_db->createCommand($sql);
			$unusual = $sql->queryOne();
			if ($unusual) {
				$unusual['nickname'] = $detail['user_id']['nickname'];
				$unusual['phone'] = $detail['user_id']['phone'];
				$unusual['created_at'] = date('Y-m-d H:i:s', $unusual['created_at']);
				$unusual['updated_at'] = date('Y-m-d H:i:s', $unusual['updated_at']);
				if(isset($unusual['type'])){
					if ($unusual['type'] == 'tb') {
						$unusual['type'] = '支付宝';
					} else if ($unusual['type'] == 'qb') {
						$unusual['type'] = 'QQ';
					} else if ($unusual['type'] == 'dh') {
						$unusual['type'] = '话费';
					} else {
						$unusual['type'] = '其他充值';
					}
				}

			}
			
		}
		$unusual = isset($unusual) ? $unusual : '';
		$consume['money'] = $result['totalMoney'];//实际购买金额
		$consume['point'] = $result['totalPoint'];//福分抵扣
		$consume['total'] = $result['total'];//购买总人次
		
		$consume['red_packet'] = ($consume['money'] > 0) ? ($consume['total'] - $consume['point'] / 100 - $consume['money']) : 0;
		$params['confirm'] = $this->checkPrivilege($this->getUniqueId() . '/confirm-order');
		$params['refuse'] = $this->checkPrivilege('win/refuse');
		$params['address'] = $this->checkPrivilege('win/ship-info');
		$params['deliver'] = $this->checkPrivilege('win/deliver');
		$params['send'] = $this->checkPrivilege('win/send');
		$params['modify'] = $this->checkPrivilege('win/modify');
		$params['exchange'] = $this->checkPrivilege('win/change-status');
		$params['unusual'] = $this->checkPrivilege('win/unusual');
		$buyBack = \app\models\JdcardBuybackList::findOne(['order_id' => $id]);
		$params['buyback']=isset($buyBack)?1:0;
		return $this->render('view', [
			'detail' => $detail,
			'goodInfo' => $goodInfo,
			'periodInfo' => $periodInfo,
			'deliverInfo' => $deliver,
			'person' => $person,
			'periodTable' => $periodTable,
			'shareTopic' => $shareTopic,
			'shareImg' => $shareImg,
			'exchange' => $change,
			'virtual' => $virtual,
			'consume' => $consume,
			'status' => $status,
			'priv' => $params,
			'remarkArr' => $remark,
			'unusual' => $unusual,
		]);
	}
	
	public function actionAllOrder()
	{
		$request = \Yii::$app->request;
		
		if ($request->isAjax || $request->get('excel') == 'allorder') {
			$page = $request->get('page', 1);
			$perpage = $request->get('rows', 25);
			$where = [];
			$get = $request->get();
			$where['orderId'] = $request->get('orderId', '');
			if (isset($get['content']) && $get['content']) {
				$user = User::find()->where(['or', 'email="' . $get['content'] . '"', 'phone="' . $get['content'] . '"'])->one();
			}
			$where['user_id'] = isset($user['id']) ? $user['id'] : '';
			$where['starttime'] = isset($get['start_time']) ? strtotime($get['start_time']) : '';
			$where['endtime'] = isset($get['end_time']) ? strtotime($get['end_time']) : '';
			
			$cats = ProductCategory::find()->all();
			$cat_ids = ArrayHelper::map($cats, 'id', 'name');
			
			if (isset($get['excel']) && $get['excel'] == 'allorder') {
				$data = [];
				$list = PaymentOrderItemDistribution::newList($where, $page, PHP_INT_MAX);
				$data[0] = ['id' => '订单号', 'name' => '商品名称', 'cat' => '分类', 'price' => '价格', 'phone' => '手机', 'email' => '邮箱', 'num' => '次数', 'money' => '金额', 'point' => '福分', 'period' => '第几期', 'period_no' => '期号', 'source' => '来源', 'time' => '中奖时间'];
				foreach ($list['list'] as $key => $val) {
					$key = $key + 1;
					$admin = User::findOne($val['user_id']);
					$goodInfo = Product::info($val['product_id']);
					$data[$key]['id'] = $val['id'];
					$data[$key]['name'] = $goodInfo['name'];
					$data[$key]['cat'] = isset($cat_ids[$goodInfo['cat_id']]) ? $cat_ids[$goodInfo['cat_id']] : '';
					$data[$key]['price'] = $goodInfo['price'];
					$data[$key]['phone'] = $admin['phone'];
					$data[$key]['email'] = $admin['email'];
					$data[$key]['num'] = $val['nums'];
					$data[$key]['money'] = $val['money'];
					$data[$key]['point'] = $val['point'];
					$data[$key]['period'] = $val['period_number'];
					$data[$key]['period_no'] = isset(Period::findOne($val['period_id'])['period_no'])
						? Period::findOne($val['period_id'])['period_no'] : '无';
					$source = Order::getSource($val['source']);
					$data[$key]['source'] = $source['name'];
					$data[$key]['time'] = DateFormat::microDate($val['item_buy_time']);
				}
				$excel = new Ex();
				$excel->download($data, '伙购订单-' . date('Y-m-d H:i:s') . '.xls');
			}
			
			$list = PaymentOrderItemDistribution::newList($where, $page, $perpage);
			
			$returnData = [];
			foreach ($list['list'] as $key => $val) {
				$goodInfo = Product::info($val['product_id']);
				$returnData[$key]['id'] = $val['payment_order_id'];
				$returnData[$key]['name'] = $goodInfo['name'];
				$returnData[$key]['cat'] = isset($cat_ids[$goodInfo['cat_id']]) ? $cat_ids[$goodInfo['cat_id']] : '';
				$returnData[$key]['price'] = $goodInfo['price'];
				$name = User::findOne($val['user_id']);
				$returnData[$key]['phone'] = $name['phone'];
				$returnData[$key]['email'] = isset($name['email']) ? $name['email'] : '无';;
				$returnData[$key]['product_id'] = $val['product_id'];
				$returnData[$key]['nums'] = $val['nums'];
				$returnData[$key]['period_number'] = $val['period_number'];
				$returnData[$key]['period_no'] = isset(Period::findOne($val['period_id'])['period_no'])
					? Period::findOne($val['period_id'])['period_no'] : '无';
				$returnData[$key]['money'] = $val['money'];
				$returnData[$key]['point'] = $val['point'];
				$source = Order::getSource($val['source']);
				$returnData[$key]['source'] = $source['name'];
				$returnData[$key]['created_at'] = DateFormat::microDate($val['item_buy_time']);
			}
			
			$data['rows'] = $returnData;
			$data['total'] = $list['total'];
			return $data;
		}
		
		return $this->render('order');
	}
	
	//订单详情页
	public function actionOrderDetail()
	{
		$orderId = \Yii::$app->request->get('id');
		$productId = \Yii::$app->request->get('productId');
		$detail = PaymentOrderItemDistribution::getOrderDetail($orderId, $productId);
		$user = User::findOne($detail['user_id']);
		$detail['created_at'] = DateFormat::microDate($detail['item_buy_time']);
		$detail['user_id'] = User::userName($detail['user_id']);
		$detail['source'] = Order::getSource($detail['source']);
		$goodInfo = Product::info($detail['product_id']);
		
		$cats = ProductCategory::find()->all();
		$cat_name = ArrayHelper::map($cats, 'id', 'name');
		
		return $this->render('detail', [
			'cat_name' => $cat_name,
			'detail' => $detail,
			'goodInfo' => $goodInfo,
		]);
	}
	
	//充值订单列表
	public function actionRecharge()
	{
		$request = \Yii::$app->request;
		if ($request->isAjax || $request->get('excel') == 'recharge') {
			$status = Yii::$app->request->get('status', '-1');
			$start_time = Yii::$app->request->get('start_time', '');
			$end_time = Yii::$app->request->get('end_time', '');
			$account = Yii::$app->request->get('account', '');
			$payment = Yii::$app->request->get('payment', '-1');
			$source = Yii::$app->request->get('source', '0');
			$excel = Yii::$app->request->get('excel', '');
			$id = Yii::$app->request->get('id', '');
			
			if ($account) {
				$user = User::find()->where('phone="' . $account . '" or email="' . $account . '"')->one();
				$account = $user['id'];
			}
			
			if ($start_time != '') {
				$start_time = strtotime($start_time);
			}
			if ($end_time != '') {
				$end_time = strtotime($end_time);
			}
			
			$where = ['status' => $status, 'startTime' => $start_time, 'endTime' => $end_time, 'payment' => $payment, 'account' => $account, 'source' => $source, 'id' => $id];
			
			$page = $request->get('page', 1);
			$perpage = $request->get('rows', 25);
			
			if (isset($excel) && $excel == 'recharge') {
				$data = [];
				ini_set('memory_limit', '1500M');
				$list = RechargeOrderDistribution::rechargeOrderList($where, $page, PHP_INT_MAX);
				$data[0] = ['id' => '订单号', 'result' => '流水号', 'phone' => '手机', 'email' => '邮箱', 'money' => '金额', 'payment' => '支付方式', 'source' => '来源', 'status' => '', 'time' => '充值时间'];
				foreach ($list['list'] as $key => $val) {
					$key = $key + 1;
					//$user = User::findOne($val['user_id']);
					$data[$key]['id'] = $val['id'];
					if ($val['result'] && $val['bank']) {
						$data[$key]['result'] = RechargeOrderDistribution::getThirdPaymentOrder($val['bank'], $val['result']);
					} else {
						$data[$key]['result'] = '';
					}
					$data[$key]['phone'] = $val['phone'];
					$data[$key]['email'] = $val['email'];
					$data[$key]['money'] = $val['post_money'];
					$type = RechargeOrderDistribution::getType($val['payment']);
					if ($type['name'] == '充值平台') {
						$name = RechargeOrderDistribution::getPaymentBank($val['bank']);
					} else {
						$name = '';
					}
					$data[$key]['payment'] = isset($type['name']) ? $type['name'] : '' . $name;
					$source = Order::getSource($val['source']);
					$data[$key]['source'] = $source['name'];
					if ($val['status'] == 1) {
						$status = '已支付';
					} else {
						$status = '未支付';
					}
					$data[$key]['status'] = $status;
					$data[$key]['time'] = DateFormat::microDate($val['pay_time']);
				}
				
				$excel = new Ex();
				$excel->download($data, '充值订单-' . date('Y-m-d H:i:s') . '.xls');
			}
			$list = RechargeOrderDistribution::rechargeOrderList($where, $page, $perpage);
			foreach ($list['list'] as $key => $val) {
				$list['list'][$key]['user_id'] = User::findOne($val['user_id']);
				$list['list'][$key]['pay_time'] = DateFormat::microDate($val['pay_time']);
				$sourceName = Order::getSource($val['source']);
				$list['list'][$key]['source'] = $sourceName['name'];
				if ($val['payment'] == 3) {
					$list['list'][$key]['payment'] = RechargeOrderDistribution::getPaymentBank($val['bank']);
				} else {
					$paymentName = RechargeOrderDistribution::getType($val['payment']);
					$list['list'][$key]['payment'] = $paymentName['name'];
				}
				if ($val['result'] && $val['bank']) {
					$list['list'][$key]['result'] = RechargeOrderDistribution::getThirdPaymentOrder($val['bank'], $val['result']);
				} else {
					$list['list'][$key]['result'] = '';
				}
			}
			$data['rows'] = $list['list'];
			$data['total'] = $list['total'];
			$data['money'] = $list['money'];
			
			return $data;
		}
		
		return $this->render('recharge');
	}
	
	//充值订单详情
	public function actionRechargeDetail()
	{
		$orderId = \Yii::$app->request->get('id');
		$detail = RechargeOrderDistribution::rechargeOrderDetail($orderId);
		$detail['user_id'] = User::userName($detail['user_id']);
		$detail['source'] = Order::getSource($detail['source']);
		$detail['pay_time'] = DateFormat::microDate($detail['pay_time']);
		
		return $this->render('recharge-detail', [
			'detail' => $detail,
		]);
	}
	
	
	// 确认收货地址
	public function actionConfirmOrder()
	{
		$request = \Yii::$app->request;
		if ($request->isPost) {
			$id = $request->post('id');
			$model = Order::findOne($id);
			$product = Product::Info($model['product_id']);
			if ($model) {
				if ($product['delivery_id'] == 1) {
					$model->status = 2;
				} elseif ($product['delivery_id'] == 2) {
					$model->status = 3;
				} else {
					$model->status = 2;
				}
				$model->confirm = 1;
				$model->last_modified = time();
				$trans = Yii::$app->db->beginTransaction();
				$user = User::userName($model['user_id']);
				try {
					if (!$model->save(false)) {
						$trans->rollBack();
						return 5;
					}
					if (in_array($product['delivery_id'], array(1, 3, 4, 5, 6, 7, 8,10))) {
						$deliverModel = Deliver::findOne($id);
						if (!$deliverModel) {
							$deliverModel = new Deliver();
							$deliverModel->id = $id;
						}
						$deliverModel->confirm_userid = \Yii::$app->admin->id;
						$deliverModel->confirm_time = time();
						$deliverModel->status = 2;
						if (!$deliverModel->save()) {
							$trans->rollBack();
							return 7;
						}
						$this->addLog('中奖订单收货地址确认' . $model['id']);
					}
					$trans->commit();
					Message::send(15, $model['user_id'], ['nickname' => $user['username'], 'goodsName' => $product['name'], 'orderNo' => $model['id'], 'time' => date('Y-m-d H:i:s')]);
					return 0;
				} catch (\Exception $e) {
					$trans->rollBack();
					return 3;
				}
			}
		}
	}
	
	public function actionChange()
	{
		$redis = new MyRedis();
		$all = $redis->keys('POINT_USE_*');
		
		foreach ($all as $val) {
			$one = $redis->hget($val, 'all');
			$tableId = substr($val, 10, 3);
			$orderId = substr($val, 10);
			if (!empty($all)) {
				$conn = Yii::$app->db;
				foreach ($one as $key => $value) {
					$arr = json_decode($value);
					$sql = $conn->createCommand('update payment_order_items_' . $tableId . ' set money=' . $arr->money . ',point=' . $arr->point . ' where payment_order_id = "' . $orderId . '"  and period_id = ' . $key . '');
					$sql->query();
				}
			}
			$redis->del($val);
		}
		return 1;
	}
	
	public function actionRemark()
	{
		$get = Yii::$app->request->post();
		
		$model = Order::findOne($get['id']);
		if ($model) {
			
			$remarkArr = json_decode($model->remark, true);
			if (json_last_error() != JSON_ERROR_NONE) {
				$remarkArr[] = [
					'op_user' => \Yii::$app->admin->id,
					'op_content' => $model->remark,
					'op_time' => date('Y-m-d H:i:s'),
				];
			}
			$remarkArr[] = [
				'op_user' => \Yii::$app->admin->id,
				'op_content' => $get['remark'],
				'op_time' => date('Y-m-d H:i:s'),
			];
			$model->remark = yii\helpers\Json::encode($remarkArr);
			
			if ($model->save()) {
				$this->addLog('中奖订单备注添加' . $model['id']);
				return 1;
			} else {
				return 0;
			}
		} else {
			return 2;
		}
	}
	
	public function actionCount()
	{
		$request = \Yii::$app->request;
		if ($request->isAjax || $request->get('excel')) {
			$get = $request->get();
			$id = $request->get('id', '');
			$username = $request->get('content', '');
			$start = $request->get('start_time', '');
			$end = $request->get('end_time', '');
			$status = $request->get('status', '0');
			$perpage = $request->get('rows', 25);
			if ($username) {
				$user = User::find()->where(['or', 'email="' . $username . '"', 'phone="' . $username . '"'])->one();
			}
			$where = ['start' => $start, 'end' => $end, 'id' => $id, 'status' => $status];
			if (isset($user) && $user) {
				$where['user_id'] = $user['id'];
			}
			$page = $request->get('page', 1);
			
			if (isset($get['excel']) && $get['excel'] == 'count') {
				$data = [];
				$list = PaymentOrderDistribution::getOrder($where, $page, $perpage = PHP_INT_MAX);
				$data[0] = ['id' => 'id', 'phone' => '手机', 'email' => '邮箱', 'total' => '总金额', 'money' => '实际金额', 'point' => '福分', 'type' => '支付方式', 'source' => '支付来源', 'time' => '伙购时间'];
				foreach ($list['list'] as $key => $val) {
					$key = $key + 1;
					$user = User::findOne($val['user_id']);
					$data[$key]['id'] = $val['id'];
					$data[$key]['phone'] = $user['phone'];
					$data[$key]['email'] = $user['email'];
					$data[$key]['total'] = $val['total'];
					$data[$key]['money'] = $val['money'];
					$data[$key]['point'] = $val['point'];
					$type = RechargeOrderDistribution::getType($val['payment']);
					$data[$key]['type'] = $type['name'];
					$source = Order::getSource($val['source']);
					$data[$key]['source'] = $source['name'];
					$data[$key]['time'] = DateFormat::microDate($val['buy_time']);
				}
				$excel = new Ex();
				$excel->download($data, '支付订单-' . date('Y-m-d H:i:s') . '.xls');
			}
			
			$list = PaymentOrderDistribution::getOrder($where, $page, $perpage);
			$data = [];
			foreach ($list['list'] as $key => $val) {
				$user = User::findOne($val['user_id']);
				$data[$key]['phone'] = $user['phone'];
				$data[$key]['email'] = $user['email'];
				$data[$key]['buy_time'] = DateFormat::microDate($val['buy_time']);
				$source = Order::getSource($val['source']);
				$data[$key]['source'] = $source['name'];
				$payment = RechargeOrderDistribution::getType($val['payment']);
				$data[$key]['payment'] = $payment['name'];
				$data[$key]['id'] = $val['id'];
				$data[$key]['total'] = $val['total'];
				$data[$key]['money'] = $val['money'];
				$data[$key]['point'] = $val['point'];
			}
			
			return ['rows' => $data, 'total' => $list['total'], 'count' => $list['count']];
		}
		return $this->render('count');
	}
}
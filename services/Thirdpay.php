<?php

/**
 * User: hechen
 * Date: 15/10/14
 * Time: 下午9:08
 */

namespace app\services;

use app\models\Invite;
use yii;
use app\models\User;
use app\models\RechargeOrderDistribution;
use app\components\Chatpay;
use app\components\Chinabank;

/**
* 第三方支付
*/
class Thirdpay
{
	public function pay($no,$paytype,$data=[])
	{
		$orderInfo = $this->getOrderByNo($no);
		if ($paytype == 'chat') {
			$data = array(
					'product' => '伙购网',
					'attach' => '',
					'no' => $orderInfo['id'],
					'money' => $orderInfo['post_money'],
					'tag' => '',
					'productId' => 1
				);
			return $this->payByChat($data,$orderInfo['source']);
		} elseif($paytype == 'brandchat') {
			$data = array(
				'product' => '伙购网',
				'attach' => '',
				'no' => $orderInfo['id'],
				'money' => $orderInfo['post_money'],
				'tag' => '',
				'productId' => 1
			);
			return $this->payByBrandChat($data);
		} elseif($paytype == 'commission') {
			$data = array(
				'no' => $orderInfo['id'],
				'money' => $orderInfo['post_money'],
				'uid' => $orderInfo['user_id'],
			);
			return $this->payByCommission($data);
		} elseif ($paytype == 'chinaBank') {
			$data = array(
				'no' => $orderInfo['id'],
				'money' => $orderInfo['post_money'],
				'bank' => $orderInfo['bank']
			);
			return $this->payByBank($data);
		} elseif ($paytype == 'iapp') {
			$payData = array(
				'product' => '伙购网',
				'userId' => $orderInfo['user_id'] + 10000,
				'custom' => md5("{$orderInfo['user_id']}" . '_' . "{$orderInfo['id']}"),
				'no' => $orderInfo['id'],
				'money' => $orderInfo['post_money'],
				'productId' => 1,
				'notifyUrl' => '',//通知url
				'redirectUrl' => '',//支付完跳转url
				'returnUrl' => '',//返回商铺url
			);
			$data = array_merge($payData, $data);

			return $this->payByIapp($data,$orderInfo['source']);
		}
		return false;
	}

	/**
	 * 创建充值订单
	 * @param  int $uid      用户id
	 * @param  int $payMoney 金额
	 * @param  var $payType  类型
	 * @param  var $payName  充值方式
	 * @param  var $payBank  银行
	 * @return [type]           [description]
	 */
	public function createRechargeOrder($uid,$payMoney,$payType,$payName,$payBank,$source,$point){
		$userInfo = User::find()->select('id,home_id')->where(['id'=>$uid])->asArray()->one();

		$order = new RechargeOrderDistribution($userInfo['home_id']);
		$orderNum = $order->generateOrderId($userInfo['home_id']);

		$order->id = $orderNum;
		$order->user_id = $uid;
		$order->status = 0;
		$order->type = $payType;
		$order->post_money = $payMoney;
		$order->money = 0;
		$order->payment = $payName;
		$order->bank = $payBank;
		$order->source = $source;
		$order->point = $point;
		$order->create_time = time();
		$order->pay_time = time();
		$rs = $order->save();

		if ($rs) {
			return $orderNum;
		}

	}

	/**
	 * 获取订单信息
	 * @param  string $no 订单号
	 * @return [type]     [description]
	 */
	public static function getOrderByNo($no){
		$tableId = RechargeOrderDistribution::getTableIdByOrderId($no);
		$orderInfo = RechargeOrderDistribution::findByTableId($tableId)->where(['id'=>$no])->asArray()->one();
		return $orderInfo;
	}

	/**
	 * 微信支付
	 * @param  array $data 数据
	 * @return [type]       [description]
	 */
	public function payByChat($data,$source){
		$time_start = date("YmdHis",time());
		$time_expire = date("YmdHis",time()+3600);
		$notify = 'http://www.'.DOMAIN.'/chatpay/notify.html';
		if ($source == 1) {
			return Yii::$app->chatpay->pay($data['product'],$data['attach'],$data['no'],$data['money']*100,$time_start,$time_expire,$data['tag'],$notify,$data['productId']);	
		}else if ($source == 2) {
			return Yii::$app->chatpay->jsPay($data['product'],$data['attach'],$data['no'],$data['money']*100,$time_start,$time_expire,$data['tag'],$notify,$data['productId']);
		}else if ($source == 3 || $source == 4) {
			return Yii::$app->chatpay->payForApp($data['product'],$data['attach'],$data['no'],$data['money']*100,$time_start,$time_expire,$data['tag'],$notify,$data['productId']);
		}
	}

	public function payByBrandChat($data)
	{
		$time_start = date("YmdHis",time());
		$time_expire = date("YmdHis",time()+3600);
		$notify = 'http://www.'.DOMAIN.'/chatpay/notify.html';
		return Yii::$app->chatpay->jsPay($data['product'],$data['attach'],$data['no'],$data['money']*100,$time_start,$time_expire,$data['tag'],$notify,$data['productId']);
	}

	/**
	 * 佣金充值
	 * @param  array $data 用户信息
	 * @return [type]       [description]
	 */
	public function payByCommission($data)
	{
		$money = (int)$data['money'];
		$chargeUserId = $data['uid'];
		$no = $data['no'];

		$save = Invite::commissionRecharge($chargeUserId, $money);
		if ($save) {
			$this->updateOrder($no, [
				'status'=>1,
				'money'=>$money,
				'pay_time'=>time(),
			]);
			return $save;
		}
		return false;
	}

	/**
	 * 网银在线
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function payByBank($data){
		return Yii::$app->chinabank->pay($data['no'],$data['money'],$data['bank']);
	}

	/** 爱贝支付
	 * @param $data
	 * @return mixed
	 */
	public function payByIapp($data,$source)
	{
		$iapppay = Yii::$app->iapppay;
		$data['notifyUrl'] = 'http://www.'.DOMAIN.'/iapppay/notify.html';
		$iappOrderId = $iapppay->createOrder($data['userId'],$data['product'],$data['productId'],$data['no'],$data['money'],$data['custom'],$data['notifyUrl']);
		if ($source==1 || $source==2 || $source==5) {
			if ($source==1) {
				$data['redirectUrl'] = 'http://wwww.'.DOMAIN.'/iapppay/redirect.html';
				$data['returnUrl'] = 'http://wwww.'.DOMAIN;
			}elseif($source==2) {
				$data['redirectUrl'] = 'http://weixin.'.DOMAIN.'/cart/iapppayok.html';
				$data['returnUrl'] = 'http://weixin.'.DOMAIN;
			}elseif($source==5) {
				$data['redirectUrl'] = 'http://m.'.DOMAIN.'/cart/iapppayok.html';
				$data['returnUrl'] = 'http://m.'.DOMAIN;
			}
			$url =  $iapppay->h5PayUrl($iappOrderId,$data['redirectUrl'],$data['returnUrl']);
			Yii::$app->response->redirect($url);
			Yii::$app->end();
		}elseif($source==3 || $source==4) {
			return $iapppay->h5PayUrl($iappOrderId,$data['redirectUrl'],$data['returnUrl']);
		}
	}

	/**
	 * 更新订单情况
	 * @param  str $no   订单号
	 * @param  array $data 字段
	 * @return [type]       [description]
	 */
	public function updateOrder($no,$data)
	{
		$tableId = RechargeOrderDistribution::getTableIdByOrderId($no);
		$recharge = new RechargeOrderDistribution($tableId);
		$db = \Yii::$app->db;
		$result = $db->createCommand()->update($recharge::tableName(),$data,['id'=>$no])->execute();
		return $result;
	}
}

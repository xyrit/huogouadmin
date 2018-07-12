<?php
/**
 * 特殊商品订单
 * @authors Your Name (you@example.org)
 * @date    2016-06-12 09:35:55
 * @version $Id$
 */

namespace app\controllers;

use Yii;
use app\models\Order;
use app\services\Product;
use app\models\Product as ModelProduct;
use app\services\Category;
use app\helpers\DateFormat;
use app\models\User;
use app\models\Deliver;
use app\models\Period;
use app\models\DuibaOrderDistribution;
use app\models\VirtualProductInfo;
use app\models\Image;
use app\models\Admin;
use app\models\ShareTopic;
use app\models\ShareTopicImage;

class SpecialOrdersController extends BaseController {

	private $productId = array(222);
	private $prepare = array('15','112','164','111','168','169');

    public function actionList()
    {
    	$request = \Yii::$app->request;
    	if ($request->isAjax) {
			$condition = [
	 			'product_ids' => $this->productId,
	 			'status' => $request->get('status','1')
	 		];
	 		$person = Deliver::getEmployeeName();
	 		$list = Order::orderList($condition);
	 		$arr = [];
	 		foreach ($list['list'] as $key => $val) {
				$goodInfo = Product::info($val['product_id']);
				$arr[$key]['id'] = $val['id'];
				$arr[$key]['name'] = $goodInfo['name'];
				$arr[$key]['cat_id'] = Category::getCatName($val['cat_id'], 1);
				$arr[$key]['code'] = $val['lucky_code'];
				$arr[$key]['period_id'] = $val['period_id'];
				$arr[$key]['period_number'] = $val['period_number'];
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
	 		return $data;
    	}
 		return $this->render('list',[
 				'type' => 'confirm'
 			]);
    }

    public function actionView()
    {
    	$request = \Yii::$app->request;
		$id = $request->get('id');

		$detail = Order::findOne($id);
		$remark = [];
		if ($detail['remark'] != '') {
			$remark = explode('  ', $detail['remark']);
			array_pop($remark);
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
			if ($goodInfo['delivery_id'] == 4 || $goodInfo['delivery_id'] == 5 || $goodInfo['delivery_id'] == 6) {
				$orderList = DuibaOrderDistribution::findByTableId($tableId)->where(['order_no' => $id, 'user_id' => $detail['user_id']])->asArray()->all();
				$orders = '';
				foreach ($orderList as $key => $value) {
					$orders .= $value['order_num'] . '(' . ($value['credits'] / 100) . '元)' . '  ';
				}
				$deliver['third_order'] = $orders;
			}
		}

		//自动添加备货人(临时)
		if (!$deliverInfo['select_prepare'] && $detail['status'] == 2) {
			echo \Yii::$app->admin->id;
			if (in_array(\Yii::$app->admin->id,$this->prepare)) {
				echo 11;
				$deliverInfo->select_prepare = \Yii::$app->admin->id;
				$deliverInfo->save();
			}
		}

		//虚拟平台
		$virtual = [];
		if (in_array($goodInfo['delivery_id'],array(5,6,7,9,10))) {
			$virtual = VirtualProductInfo::findOne(['order_id' => $detail['id']]);
			if ($virtual['type'] == 'tb') {
				$virtual['type'] = '淘宝充值卡';
			}elseif ($virtual['type'] == 'db') {
				$virtual['type'] = '电话直充';
			}elseif ($virtual['type'] == 'qb') {
				$virtual['type'] = 'Q币直充';
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

		$csql = "select sum(a.money) as totalMoney, sum(a.point) as totalPoint, sum(a.nums) as total from payment_order_items_" . $tableId . " as a left join payment_orders_" . $tableId . " as b on a.payment_order_id = b.id where b.user_id = " . $periodInfo['user_id'] . " and a.period_id = " . $detail['period_id'] . "";

		$con = $conn->createCommand($csql);
		$result = $con->queryOne();
		$consume['money'] = $result['totalMoney'];
		$consume['point'] = $result['totalPoint'];
		$consume['total'] = $result['total'];

		$params['confirm'] = $this->checkPrivilege($this->getUniqueId() . '/confirm-order');
		$params['refuse'] = $this->checkPrivilege('win/refuse');
		$params['address'] = $this->checkPrivilege('win/ship-info');
		$params['deliver'] = $this->checkPrivilege('win/deliver');
		$params['send'] = $this->checkPrivilege('win/send');
		$params['modify'] = $this->checkPrivilege('win/modify');
		$params['exchange'] = $this->checkPrivilege('win/change-status');
		$params['unusual'] = $this->checkPrivilege('win/unusual');

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
			'remarkArr' => $remark
		]);
    }
    //确认收货地址
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
				} elseif ($product['delivery_id'] == 4 || $product['delivery_id'] == 5 || $product['delivery_id'] == 6) {
					$model->status = 2;
				}
				$model->confirm = 1;
				$model->last_modified = time();
				$trans = Yii::$app->db->beginTransaction();
				$user = User::userName($model['user_id']);
				try {
					if (!$model->save()) {
						$trans->rollBack();
						return 5;
					}
					if ($product['delivery_id'] == 1 || $product['delivery_id'] == 4 || $product['delivery_id'] == 5 || $product['delivery_id'] == 6) {
						$deliverModel = new Deliver();
						$deliverModel->id = $id;
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
				} catch (Exception $e) {
					$trans->rollBack();
					return 3;
				}
			}
		}
	}

	public function actionUndeliver()
	{
		$request = \Yii::$app->request;
		if ($request->isAjax) {
			$condition = [
	 			'product_ids' => $this->productId,
	 			'status' => $request->get('status','2')
	 		];

	 		$person = Deliver::getEmployeeName();
	 		$list = Order::orderList($condition);
	 		$arr = [];
	 		foreach ($list['list'] as $key => $val) {
				$goodInfo = Product::info($val['product_id']);
				$arr[$key]['id'] = $val['id'];
				$arr[$key]['name'] = $goodInfo['name'];
				$arr[$key]['cat_id'] = Category::getCatName($val['cat_id'], 1);
				$arr[$key]['code'] = $val['lucky_code'];
				$arr[$key]['period_id'] = $val['period_id'];
				$arr[$key]['period_number'] = $val['period_number'];
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
	 		return $data;
    	}
 		return $this->render('list',[
 				'type' => 'deliver'
 			]);
	}
}
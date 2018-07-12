<?php
/**
 * Created by PhpStorm.
 * User: zhangjicheng
 * Date: 15/9/19
 * Time: 16:58
 */

namespace app\controllers;

use app\helpers\Express;
use app\helpers\Message;
use app\models\Admin;
use app\models\Area;
use app\models\Deliver;
use app\models\ExchangeOrder;
use app\models\Order;
use app\models\Product;
use app\models\Period;
use app\models\VirtualDepotJd;
use app\models\ProductStoreLog;
use app\models\User;
use app\models\SendMessage;
use app\models\VirtualDepotJdcard;
use yii;
use app\models\UserVirtualHand;
use app\models\DuibaOrderDistribution;
use app\models\VirtualDepotLog;

class WinController extends BaseController
{
	public function actionAreaList()
	{
		$pid = Yii::$app->request->get('pid');
		$areaList = Area::findAll(['pid' => $pid]);
		$response = Yii::$app->response;
		$response->format = \yii\web\Response::FORMAT_JSON;
		return $areaList;
	}
	
	public function actionRefuse()
	{
		$request = Yii::$app->request;
		$response = Yii::$app->response;
		$response->format = \yii\web\Response::FORMAT_JSON;
		$id = $request->get('id');
		$model = Order::findOne($id);
		if (!$model) {
			return ['error' => 1, 'message' => '该订单不存在'];
		}
		if ($request->isPost) {
			$model->fail_type = 1;
			$model->fail_id = $request->post('confirm_reason');
			$model->status = 6;
			if (!$model->save()) {
				$this->addLog('中奖订单收货地址驳回失败-' . $model['id']);
				return ['error' => 2, 'message' => '驳回失败'];
			} else {
				$this->addLog('中奖订单收货地址驳回成功-' . $model['id']);
				return ['error' => 0, 'message' => '驳回成功'];
			}
		}
	}
	
	/*public function actionAddress()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		$model = Order::findOne($id);
		if(!$model) return ['error' => 1,'message' => '该订单不存在'];

		if($request->isPost){
			$data = $request->post();
			if($model['status'] == 0) $model['status'] = 1;
			$model->status = $model['status'];
			$model->ship_addr = $data['addr'];
			$model->ship_area = Area::getAddressArea($data['prov'], $data['city'], $data['area']);
			$model->ship_name = $data['name'];
			$model->ship_mobile = $data['phone'];
			$model->ship_time = $data['time'];
			$model->confirm_addr_time = time();
			if($model->save()){
				$this->addLog('中奖订单后台填写收货地址-'.$model['id']);
				echo json_encode(['error' => 0,'message' => '保存成功']);
				Yii::$app->end();
			}
			foreach ($model->errors as $message) {
				echo json_encode(['error' => 1, 'message' => $message]);
				Yii::$app->end();
			}
		}

		$goodInfo = \app\models\Product::findOne($model['product_id']);
		$virtual = [];
		if($goodInfo['delivery_id'] == '2'){
			$virtual = VirtualProductInfo::findOne($model['id']);
		}
		$deliver = Deliver::findOne($id);
		$deliver['deliver_userid'] = Admin::findOne($deliver['confirm_userid']);

		return $this->render('address', [
			'model' => $model,
			'virtual' => $virtual,
			'deliver' => $deliver
		]);
	}*/
	
	public function actionDeliver()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		$exchange = $request->get('exchange');
		$model = Order::findOne($id);
		if (isset($exchange) && $exchange) $orderModel = ExchangeOrder::find()->where(['id' => $exchange])->one();
		else $orderModel = Deliver::findOne($id);
		
		if (!($model && $orderModel)) {
			echo json_encode(['error' => 1, 'message' => '该订单不存在']);
			Yii::$app->end();
		}
		
		if ($request->isPost) {
			$post = $request->post();
			$preparePerson = Deliver::findOne($id);
			if (Yii::$app->admin->id != $preparePerson['select_prepare']) {
				echo json_encode(['error' => 1, 'message' => '备货人错误']);
				Yii::$app->end();
			}
			
			if (isset($exchange) && $exchange) {
				$post['ExchangeOrder'] = $post['Deliver'];
			}
			$trans = Yii::$app->db->beginTransaction();
			try {
				if ($orderModel->load($post) && $orderModel->validate()) {
					$productInfo = Product::find()->where(['id' => $model['product_id']])->asArray()->one();
					$orderModel->status = 3;
					$model->status = 3;
					if (in_array($productInfo['delivery_id'], array(5, 6, 7, 9, 10)) && $post['Deliver']['platform'] == '手动') {
						$orderModel->status = 4;
						$model->status = 8;
					}
					$orderModel->prepare_userid = Yii::$app->admin->id;
					$orderModel->prepare_time = time();
					$model->last_modified = time();
					if ($orderModel->save() && $model->save()) {
						$trans->commit();
						$this->addLog('中奖订单备货成功-' . $model['id']);
						echo json_encode(['error' => 0, 'message' => '保存成功']);
						Yii::$app->end();
					} else {
						$trans->rollBack();
						$this->addLog('中奖订单备货失败-' . $model['id']);
						echo json_encode(['error' => 3, 'message' => '保存失败']);
						Yii::$app->end();
					}
				} else {
					$this->addLog('中奖订单备货失败-' . $model['id']);
					foreach ($orderModel->errors as $message) {
						echo json_encode(['error' => 1, 'message' => $message]);
						Yii::$app->end();
					}
				}
			} catch (\Exception $e) {
				$trans->rollBack();
				$this->addLog('中奖订单备货失败-' . $model['id']);
				echo json_encode(['error' => 2, 'message' => '抛出异常，保存失败']);
				Yii::$app->end();
			}
		}
		
		$person = Deliver::getEmployeeName();
		
		if ($request->get('type') == 'special') {
			return $this->render('special-deliver', [
				'model' => $model
			]);
		} else {
			return $this->render('deliver', [
				'model' => $model,
				'orderModel' => $orderModel,
				'person' => $person
			]);
		}
	}
	
	public function actionSend()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		$exchange = $request->get('exchange');
		$model = Order::findOne($id);
		
		if (isset($exchange) && $exchange)
			$orderModel = ExchangeOrder::find()->where(['id' => $exchange])->one();
		else $orderModel = Deliver::findOne($id);
		$express = Express::getExpressName();
		if (!$model && !$orderModel) {
			echo json_encode(['error' => 1, 'message' => '该订单不存在']);
			Yii::$app->end();
		}
		
		$userInfo = User::findOne($model['user_id']);
		if ($request->isPost) {
			$preparePerson = Deliver::findOne($id);
			if (Yii::$app->admin->id != $preparePerson['select_prepare']) {
				if (!in_array($orderModel->send, array(3, 8))) {
					echo json_encode(['error' => 1, 'message' => '备货人错误']);
					Yii::$app->end();
				}
				
			}
			$post = $request->post();

            $productModel = Product::findOne($model['product_id']);

            if ($productModel['delivery_id'] == 8) {    //拿码
                $faceValue = $productModel['face_value'];
               $rs= $this->webgetjdcard($faceValue);
                if($rs['code']==0){
                    echo json_encode(['error' => 1, 'message' => $rs['message']]);
                    Yii::$app->end();
                }
            }
			$trans = Yii::$app->db->beginTransaction();
			try {
                $productModel = Product::findOne($model['product_id']);

                $productModel->total = $productModel['total'] - 1;
                $orderModel->deliver_time = time();
                $orderModel->deliver_userid = Yii::$app->admin->id;
                //$virtual = \app\models\VirtualProductInfo::findOne(['order_id' => $id]);
                if ($orderModel->send != 5 && $orderModel->send != 6 && $orderModel->send != 7) {
                    if (in_array($orderModel->send, array(3, 8))) {
                        $orderModel->status = 2;

                    } else {
                        $orderModel->deliver_company = $post['company'];
                        $orderModel->deliver_order = $post['orderNo'];
                        $orderModel->deliver_cost = $post['cost'];
                    }

                } else {
                    $duibaTotal = DuibaOrderDistribution::findByTableId($userInfo['home_id'])->where(['order_no' => $id, 'user_id' => $model['user_id'], 'audit_status' => 1])->sum('credits');
                    if ($duibaTotal) {
                        if ($duibaTotal < $productModel->face_value) {
                            $model->status = 2;
                            $orderModel->status = 2;
                            if ($model->save() && $orderModel->save()) {
                                $trans->commit();
                                $this->addLog('中奖订单发货失败-' . $model['id']);
                                echo json_encode(['error' => 1, 'message' => '发货失败，兑换金额错误']);
                                Yii::$app->end();
                            } else {
                                $trans->rollBack();
                                echo json_encode(['error' => 2, 'message' => '保存失败，请重试']);
                                Yii::$app->end();
                            }
                        }
                    }


                }
                if ($productModel['delivery_id'] == 8) {   //如果是京东卡则改为已完成
                    $model->status = 8;
                    $orderModel->status = 8;
                } else {
                    $model->status = 4;
                    $orderModel->status = 4;
                }
				if ($model->save() && $orderModel->save() && $productModel->save()) {
					ProductStoreLog::insertRecord($model['product_id'], 2, '-1', $productModel['total'], '销售出库，中奖订单' . $model['id']);
					//发送信息通知客户
					$data = [];
					$periodInfo = Period::findOne($model['period_id']);
					$data = [
						'phone' => $model['ship_mobile'],
						'nickname' => isset($userInfo["nickname"]) ? $userInfo["nickname"] : $userInfo["phone"],
						'goodsName' => $productModel["name"],
						'from' => $userInfo["from"],
						'periodNumber' => $periodInfo['period_no']
					];
					if (in_array($productModel['delivery_id'], array(1, 2, 4))) {
						$type = 15;
						$data['expressCompany'] = $orderModel['deliver_company'];
						$data['expressNo'] = $orderModel['deliver_order'];
						$productType = 0;
					} else if (in_array($productModel['delivery_id'], array(3, 8))) {
						
						if ($productModel['delivery_id'] == 8) {

                            $rs = $this->getJdcard($id, $faceValue, $model['user_id'], $model['ship_mobile']);

							if ($rs['code'] == 1)   //如果有错误
							{
								$cardinfo = $rs['cardinfo'];
							} else {
								$trans->rollBack();
								echo json_encode(['error' => 2, 'message' => $rs['message']]);
                                    Yii::$app->end();
							}
						} else {
							$cardinfo = VirtualDepotJd::find()->andwhere(['status' => 0, 'par_value' => $faceValue])->asArray()->one();
						}
						$type = ($userInfo["from"] == 1) ? 16 : 18;
						$data['card'] = $cardinfo['card'];
						$data['pwd'] = $cardinfo['pwd'];
						$productType = 1;
					}
					if (!in_array($productModel['delivery_id'], array(5, 7))) Message::send($type, $model['ship_mobile'], $data);
					$rs = true;
					$deliverUid = SendMessage::getDeliverUid($model['ship_mobile'], $userInfo["id"]);
					if ($deliverUid) {
						$data['picture'] = $productModel["picture"];
						$data['order_id'] = $id;
						$SendModel = new SendMessage();
						$SendModel->user_id = $deliverUid;
						$SendModel->content = json_encode($data);
						$SendModel->type = isset($productType) ? $productType : 1;
						$SendModel->admin_id = Yii::$app->admin->id;
						$SendModel->create_time = time();
						$rs = $SendModel->save();
					}
					
					if ($rs) {
						$trans->commit();
						\app\models\UserAppInfo::updateAll(['new_pm' => 1], ['uid' => $userInfo["id"]]);
						$this->addLog('中奖订单发货成功-' . $model['id']);
						echo json_encode(['error' => 0, 'message' => '保存成功']);
						Yii::$app->end();
					}
				}
				$trans->rollBack();
				$this->addLog('中奖订单发货失败-' . $model['id']);
				echo json_encode(['error' => 2, 'message' => '保存失败']);
				Yii::$app->end();
				
			} catch (\Exception $e) {
				$trans->rollBack();
				$this->addLog('中奖订单发货失败-' . $model['id']);
				echo json_encode(['error' => 3, 'message' => '保存失败' . $e->getFile() . '_' . $e->getFile() . '_' . $e->getMessage()]);
				Yii::$app->end();
			}
		}
		
		$person = Deliver::getEmployeeName();
		
		$orderList = [];
		$orders = DuibaOrderDistribution::findByTableId($userInfo['home_id'])->where(['order_no' => $id, 'user_id' => $model->user_id])->asArray()->all();
		foreach ($orders as $key => $value) {
			$orderList[] = ['id' => $value['id'], 'orderid' => $value['order_num'], 'money' => $value['credits'] / 100, 'audit' => $value['audit_status']];
		}
		return $this->render('send', [
			'model' => $model,
			'orderModel' => $orderModel,
			'express' => $express,
			'person' => $person,
			'orderlist' => $orderList
		]);
	}
	
	public function actionModify()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		$exchange = $request->get('exchange');
		$orderModel = Order::findOne($id);
		if (isset($exchange) && $exchange) $deliverModel = ExchangeOrder::find()->where(['id' => $exchange])->one();
		else $deliverModel = Deliver::findOne($id);
		$company = Express::getExpressName();
		//var_dump($deliverModel);
		if ($request->post()) {
			$post = $request->post();
			if (isset($exchange) && $exchange) {
				$post['ExchangeOrder'] = $post['Deliver'];
			}
			
			if ($deliverModel->load($post) && $deliverModel->validate()) {
				if ($deliverModel->save()) {
					$this->addLog('中奖订单修改信息成功-' . $orderModel['id']);
					echo json_encode(['error' => 0, 'message' => '保存成功']);
					Yii::$app->end();
				} else {
					$this->addLog('中奖订单修改信息失败-' . $orderModel['id']);
					echo json_encode(['error' => 1, 'message' => '保存失败']);
					Yii::$app->end();
				}
			}
		}
		
		return $this->render('modify', [
			'order' => $orderModel,
			'deliver' => $deliverModel,
			'express' => $company
		]);
	}
	//换货操作
	public function actionChangeStatus()
	{
		$request = Yii::$app->request;
		$id = $request->post('id');
		$orderModel = Order::findOne($id);
		$deliver = Deliver::findOne($id);
		if (!$orderModel) {
			echo json_encode(['error' => 1, 'message' => '订单不存在']);
			Yii::$app->end();
		}
		$trans = Yii::$app->db->beginTransaction();
		try {
			$exchangeModel = new ExchangeOrder();
			$exchangeModel->order_no = $deliver['id'];
			$exchangeModel->confirm_time = $deliver['confirm_time'];
			$exchangeModel->confirm_userid = $deliver['confirm_userid'];
			$exchangeModel->admin_id = Yii::$app->admin->id;
			$exchangeModel->created_time = time();
			if ($exchangeModel->save()) {
				$deliver->is_exchange = $exchangeModel->primaryKey;
				
				$orderModel->status = 2;
				$orderModel->is_exchange = $exchangeModel->primaryKey;
				$orderModel->last_modified = time();
				if ($orderModel->save() && $deliver->save()) {
					$trans->commit();
					$this->addLog('中奖订单换货成功-' . $orderModel['id']);
					echo json_encode(['error' => 0, 'message' => '操作成功']);
					Yii::$app->end();
				} else {
					$trans->rollBack();
					$this->addLog('中奖订单换货失败-' . $orderModel['id']);
					echo json_encode(['error' => 3, 'message' => '操作失败']);
					Yii::$app->end();
				}
			} else {
				$trans->rollBack();
				$this->addLog('中奖订单换货失败-' . $orderModel['id']);
				echo json_encode(['error' => 5, 'message' => '操作失败']);
				Yii::$app->end();
			}
		} catch (\Exception $e) {
			$trans->rollBack();
			$this->addLog('中奖订单换货失败-' . $orderModel['id']);
			echo json_encode(['error' => 2, 'message' => '操作失败']);
			Yii::$app->end();
		}
	}
	
	public function actionChange()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		$deliverModel = Deliver::findOne($id);
		if (!$deliverModel) {
			echo json_encode(['error' => 1, 'message' => '订单不存在']);
			Yii::$app->end();
		}
		
		$person = Deliver::getEmployeeName();
		
		return $this->render('change', [
			'deliver' => $deliverModel,
			'person' => $person
		]);
	}
	
	public function actionUnusual()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		$orderModel = Order::findOne($id);
		$product = Product::findOne($orderModel['product_id']);
		if (!$orderModel) {
			echo json_encode(['error' => 1, 'message' => '订单不存在']);
			Yii::$app->end();
		}
		
		if ($request->isPost) {
			$post = $request->post();
			if ($post['un_fail'] == 1 && $post['afterTime']) {
				$orderModel->before_status = $orderModel['status'];
				$orderModel->fail_type = 1;
				$orderModel->fail_id = $post['unusual'];
				$orderModel->delay = strtotime($post['afterTime']);
				$orderModel->last_modified = time();
				$orderModel->status = 6;
			} elseif ($post['un_fail'] == 2) {
				if ($orderModel['status'] == 3 && $product['delivery_id'] == 1) {
					echo json_encode(['error' => 5, 'message' => '不能操作备货完成且发货为第三方的订单']);
					Yii::$app->end();
				} else {
					$orderModel->before_status = $orderModel['status'];
					$orderModel->fail_type = 2;
					$orderModel->fail_id = $post['unusual'];
					$orderModel->last_modified = time();
				}
			}
			if ($orderModel->save()) {
				$this->addLog('中奖订单设为异常成功-' . $orderModel['id'] . '备注：' . $post['unusual']);
				echo json_encode(['error' => 0, 'message' => '操作成功']);
				Yii::$app->end();
			} else {
				$this->addLog('中奖订单设为异常失败-' . $orderModel['id']);
				echo json_encode(['error' => 2, 'message' => '操作失败']);
				Yii::$app->end();
			}
		}
	}
	
	public function actionDelay()
	{
		$list = Order::find()->where('delay != 0 and delay <= ' . time())->all();
		foreach ($list as $key => $val) {
			$model = Order::findOne($val['id']);
			$model->fail_type = null;
			$model->fail_id = 0;
			$model->delay = 0;
			$model->last_modified = time();
			$model->before_status = 0;
			$model->save();
			$this->addLog('中奖订单延时成功-' . $model['id']);
		}
	}
	
	public function actionProductDeliver()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		$deliverList = Product::findOne($id);
		$arr = explode(',', $deliverList['delivery_id']);
		$return = [];
		foreach ($arr as $key => $val) {
			$return[$key]['id'] = $val;
			$return[$key]['name'] = Product::$deliveries[$val];
		}
		return $return;
	}
	
	public function actionReset()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		$model = Order::findOne($id);
		$deliverModel = Deliver::findOne($id);
		if (!$model) {
			echo json_encode(['error' => 1, 'message' => '订单不存在']);
			Yii::$app->end();
		}

		$model->status = 1;
		if($model['fail_id']&&strpos($model['fail_id'],"重置地址"))$model->status = 0;
		$model->fail_type = 0;
		$model->fail_id = '';
		$model->delay = 0;
		$model->before_status = 0;
		if ($model->save()) {
			if ($deliverModel) {
				$deliverModel->delete();
			}
			$this->addLog('重置订单成功');
			echo json_encode(['error' => 0, 'message' => '操作成功']);
			Yii::$app->end();
		} else {
			$this->addLog('重置订单失败');
			echo json_encode(['error' => 2, 'message' => '操作失败']);
			Yii::$app->end();
		}
	}
	
	public function actionSelectPrepare()
	{
		$post = Yii::$app->request->post();
		foreach ($post['checkArr'] as $value) {
			$order = Order::find()->where(['id' => $value, 'status' => 2])->one();
			if (!$order) {
				echo json_encode(['error' => 1, 'message' => '待备货状态才能选取备货人']);
				Yii::$app->end();
			}
			$model = Deliver::find()->where(['id' => $value])->one();
			if (!$model['id']) {
				echo json_encode(['error' => 1, 'message' => '订单不存在']);
				Yii::$app->end();
			}
			$person = Admin::find()->where(['real_name' => $post['prepareName']])->one();
			if (!$person['id']) {
				echo json_encode(['error' => 2, 'message' => '该管理员不存在']);
				Yii::$app->end();
			}
			$model->select_prepare = $person['id'];
			$model->save();
		}
		$this->addLog('选择备货人成功');
		echo json_encode(['error' => 0, 'message' => '操作成功']);
		Yii::$app->end();
	}
	
	public function actionDuiba()
	{
		$request = Yii::$app->request;
		$orderId = $request->get('orderid');
		$productId = $request->get('pid');
		$money = $request->get('money');
		$part = $request->get('part');
		
		$orderInfo = Order::find()->where(['id' => $orderId, 'product_id' => $productId])->asArray()->one();
		if (!$orderInfo) {
			echo json_encode(['code' => 0, 'msg' => '订单信息错误']);
			Yii::$app->end();
		}
		$productInfo = Product::find()->where(['id' => $productId])->asArray()->one();
		if ($productInfo) {
			$faceValue = $productInfo['face_value'];
			$duiba = Yii::$app->duiba;
			$userVirtualAddress = UserVirtualHand::find()->where(['order_id' => $orderId, 'user_id' => $orderInfo['user_id']])->asArray()->one();
			$url = '';
			if ($productInfo['delivery_id'] == 5) {
				$url = $duiba->redirectAlipay($orderInfo['user_id'], $orderInfo['id'], $money, $userVirtualAddress['account'], $userVirtualAddress['name']);
			} else if ($productInfo['delivery_id'] == 6) {
				$url = $duiba->redirectQB($orderInfo['user_id'], $orderInfo['id'], $money, $userVirtualAddress['account']);
			} else if ($productInfo['delivery_id'] == 7) {
				$url = $duiba->redirectPhonebill($orderInfo['user_id'], $orderInfo['id'], $money, $userVirtualAddress['account']);
			}
			
			if ($url) {
				echo json_encode(['code' => 100, 'msg' => '链接生成成功', 'url' => $url]);
				Yii::$app->end();
			}
		}
		echo json_encode(['code' => 0, 'msg' => '订单信息错误']);
		Yii::$app->end();
	}


	/*
	 * 拿取京东卡
	 */
	public function webgetjdcard($faceValue){
        /*---京东卡密---*/
        $balance = VirtualDepotJdcard::find()->andwhere(['status' => 0, 'denomination' => $faceValue])->count('id');

        if ($balance < 1) {

            //if(DOMAIN=='newadmin.huogou.com'){
                $rs = \Yii::$app->jdcard->pullcart($faceValue);      //面额
//            }else{
//                $rs = \Yii::$app->jdcard->cspullcart($faceValue);    //面额
//            }
            if ($rs['error_code'] > 1) {
                return ['code' => 0, 'message' => '库存不足(' . $rs['result'] . ')'];
            }
        }
        return ['code'=>2];
    }
	/*
	 * 获取京东卡改变京东卡状态
	 */

    public function getJdcard($id, $faceValue, $uid, $mobile)
	{
		$trans = \Yii::$app->db->beginTransaction();
		try {
			//领卡
			$cardinfo = VirtualDepotJdcard::find()->andwhere(['status' => 0, 'denomination' => $faceValue])->asArray()->one();

            if(!$cardinfo){
                $trans->rollBack();
                return ['code' => 0, 'message' => '卡号卡密获取失败'];
            }
			$jdcard = VirtualDepotJdcard::findone($cardinfo['id']);
			$jdcard->status = 1;
            $jdcard->backtime = time();
            $rs2 = $jdcard->save();           //测试隐藏
			//记录
			$log = new VirtualDepotLog();
			$log->card_id = $cardinfo['id'];
			$log->user_id = $uid;
			$log->phone = $mobile;
			$log->c_time = time();
			$log->admin_id = \Yii::$app->admin->id;
            $log->order_id = $id;
            $log->cardno = $cardinfo['cardno'];
            $log->cardpws = $cardinfo['cardpws'];
			$rs3 = $log->save();
//            $cardinfo = VirtualDepotJdcard::find()->andwhere(['status' => 0, 'denomination' => $faceValue])->asArray()->one();
//
//            if(!$cardinfo){
//                $trans->rollBack();
//                return ['code' => 0, 'message' => '卡号卡密获取失败'];
//            }

            $cardno = \Yii::$app->jdcard->decode($cardinfo['cardno']);  //解密
            $cardpws = \Yii::$app->jdcard->decode($cardinfo['cardpws']);
            if(!$cardno && !$cardpws){
                $trans->rollBack();
                return ['error' => 0, 'message' => '卡密解析失败'];
            }
			if ($rs2 && $rs3) {

				$decardinfo['card'] = $cardno;
				$decardinfo['pwd'] = $cardpws;
				$trans->commit();
				return ['code' => 1, 'cardinfo' => $decardinfo];
				
			} else {
				$trans->rollBack();
				return ['code' => 0, 'message' => '发送卡密失败'];
			}
			
			/*---京东卡密---*/
		} catch (\Exception $e) {
			$trans->rollBack();
			return ['code' => 0, 'message' => $e->getMessage()];
		}
	}
	
}
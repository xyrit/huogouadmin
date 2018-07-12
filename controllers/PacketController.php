<?php


namespace app\controllers;

use yii;
use yii\data\Pagination;
use app\models\Coupon;
use app\models\CouponType;
use app\models\CouponCode;
use app\models\Packet;

class PacketController extends BaseController{

	public function actionIndex()
	{
		$request = Yii::$app->request;
		if ($request->isAjax) {
			$page = $request->get('page', 1);
            $perpage = $request->get('rows', 30);
			$list = Packet::getList($page,$perpage);
			foreach ($list['rows'] as $key => &$value) {
				if ($value['num'] == 0) {
					$value['num'] = '无限';
				}
			}
			return $list;
		}
		
		return $this->render('index');
	}

	public function actionAdd()
	{
		$request = Yii::$app->request;
		if ($request->isPost) {
			$id = $request->post('packet_id','0');
			$packetInfo = Packet::findOne(['id'=>$id]);
			$coupons = $request->post('coupons');
			$coupon_nums = $request->post('coupon_nums');
			$nums = $request->post('nums');
			$content = $needCoupon = '';
			foreach ($coupons as $key => $value) {
				$content[$value] = $coupon_nums[$key];
				$needCoupon[$value] = $coupon_nums[$key] * $nums;
			}
			$valid = 1;
			$couponList = Coupon::getAllList();
			foreach ($needCoupon as $key => $value) {
				if (($value > $couponList[$key]['left_num'] || $value == 0 ) && $couponList[$key]['num'] != 0) {
					$valid = 0;
					break;
				}
			}

			if ($valid == 0) {
				echo json_encode(['code'=>0,'message'=>'生成失败，优惠券数量不够']);
				Yii::$app->end();
			}

			$transaction= Yii::$app->db->beginTransaction();
			try {
				if ($packetInfo) {
					$packetInfo->name = $request->post('name');
					$packetInfo->desc = $request->post('desc');
					$packetInfo->content = json_encode($content);
					$packetInfo->num = $nums;
					$packetInfo->update_time = time();
					$packetInfo->left_num = $nums-$packetInfo->send_num;
					$packetInfo->receive_limit = $request->post('receive_limit');
					$rs = $packetInfo->save(false);
					if ($rs) {
						$couponCodeValid = 1;
						foreach ($needCoupon as $key => $value) {
							if ($couponList[$key]['num'] != 0) {
								$num = CouponCode::freeze($key,$value,$id);
								$coupon = Coupon::findOne(['id'=>$key]);
								$coupon->left_num -= $value;
								$coupon->save();
								if ($num != $value) {
									$couponCodeValid = 0;
									break;
								}
							}
						}
					}
					if ($rs && $couponCodeValid) {
						$transaction->commit();
						echo json_encode(['code'=>100,'message'=>'保存成功']);
						Yii::$app->end();
					}else{
						$transaction->rollback();
						echo json_encode(['code'=>0,'message'=>'保存失败']);
						Yii::$app->end();
					}
				}else{
					$packet = new Packet();
					$packet->name = $request->post('name');
					$packet->num = $nums;
					$packet->desc = $request->post('desc');
					$packet->content = json_encode($content);
					$packet->create_time = time();
					$packet->update_time = time();
					$packet->left_num = $nums;
					$packet->receive_limit = $request->post('receive_limit');
					$packet->save(false);

					$packetId = $packet->attributes['id'];

					if ($packetId) {
						$couponCodeValid = 1;
						foreach ($needCoupon as $key => $value) {
							if ($couponList[$key]['num'] != 0) {
								$num = CouponCode::freeze($key,$value,$packetId);
								$coupon = Coupon::findOne(['id'=>$key]);
								$coupon->left_num -= $value;
								$coupon->save();
								if ($num != $value) {
									$couponCodeValid = 0;
									break;
								}
							}
						}
					}
					if ($packetId && $couponCodeValid) {
						$transaction->commit();
						echo json_encode(['code'=>100,'message'=>'保存成功']);
						Yii::$app->end();
					}else{
						$transaction->rollback();
						echo json_encode(['code'=>0,'message'=>'保存失败']);
						Yii::$app->end();
					}
				}
			} catch (\Exception $e) {
				$transaction->rollback();
				echo json_encode(['code'=>0,'message'=>'保存失败']);
				Yii::$app->end();
			}
		}
	}

	public function actionInfo()
	{
		$id = Yii::$app->request->get('id');
		$packetInfo = Packet::getInfoById($id);

		$packetInfo['content'] = json_decode($packetInfo['content'],true);

		$coupons = Coupon::getAllList();

		echo json_encode(['list'=>$coupons,'info'=>$packetInfo]);
		Yii::$app->end();
	}

	public function actionList()
	{
		$list = Packet::find()->asArray()->all();
		echo json_encode($list);
		Yii::$app->end();
	}
}
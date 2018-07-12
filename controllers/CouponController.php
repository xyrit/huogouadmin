<?php


namespace app\controllers;

use yii;
use yii\data\Pagination;
use app\models\Coupon;
use app\models\CouponType;
use app\models\CouponCode;
use app\models\UploadForm;
use yii\web\UploadedFile;

class CouponController extends BaseController{

	/**
	 * 优惠券列表
	 * @return [type] [description]
	 */
	public function actionIndex()
	{
		$request = Yii::$app->request;
		if ($request->isAjax) {
			$page = $request->get('page', 1);
            $perpage = $request->get('rows', 30);
            $list = Coupon::getList($page,$perpage);

            $couponType = CouponType::getList();

            foreach ($list['rows'] as $key => &$value) {
            	$value['type_name'] = $couponType[$value['type']]['name'];
            	$value['status'] = $value['status'] == '0' ? '正常' : '过期';
            	if ($value['num'] == 0) {
            		$value['left_num'] = $value['num'] = '无限';
            	}
            	$value['valid_time'] = '';
            	if ($value['valid_type'] == 1) {
            		$value['valid_time'] = date("Y-m-d H:i:s",$value['start_time']).'——'.date("Y-m-d H:i:s",$value['end_time'])." (".intval($value['valid']/3600/24)."天)";
            	}else{
            		$value['valid_time'] = '从领取开始 '.intval($value['valid']/3600/24)." 天有效";
            	}
            	$value['create_time'] = date("Y-m-d H:i:s",$value['create_time']);

            }

            return $list;
		}
		return $this->render('index');
	}

	/**
	 * 添加优惠券
	 * @return [type] [description]
	 */
	public function actionAdd()
	{
		$request = \Yii::$app->request;
		$type_id = $request->get('type_id') ? : $request->post('type_id') ;
		if ($request->isPost) {
			if ($type_id == 1) {
				$amount = ['money'=>$request->post('amount','0')];
				$range = $request->post('range');
				if (count($range) == 1 && (in_array(4, $range) || in_array(5, $range))) {
					$conditionProducts = $request->post('products','');
					$conditionPkProducts = $request->post('pk_products','');
					$condition = [
						'need'=>$request->post('need','0'),
						'range'=>implode(',',$request->post('range','')),
						'products'=>$conditionProducts ? implode(',',$conditionProducts) : '',
						'pk_products'=>$conditionPkProducts ? implode(',',$conditionPkProducts) : '',
					];
				} elseif (count($range) == 2 && (in_array(4, $range) && in_array(5, $range))) {
					$conditionProducts = $request->post('products','');
					$conditionPkProducts = $request->post('pk_products','');
					$condition = [
						'need'=>$request->post('need','0'),
						'range'=>implode(',',$request->post('range','')),
					];
					$condition['products'] = $conditionProducts ? implode(',',$conditionProducts) : '';
					$condition['pk_products'] = $conditionPkProducts ? implode(',',$conditionPkProducts) : '';
				}else{
					$condition = ['need'=>$request->post('need','0'),'range'=>implode(',',$request->post('range',''))];
				}
			}else if ($type_id == 2) {
				$amount = ['discount'=>$request->post('amount','0'),'max'=>$request->post('max','0')];
				$condition = ['need'=>$request->post('need','0'),'range'=>implode(',',$request->post('range',''))];
			}else if ($type_id == 3) {
				$amount = ['type'=>$request->post('recharge_type','point'),'amount'=>$request->post('amount','0')];
				$condition = [];
			}
			if (!empty($_FILES['icon']['name'])) {
				$imagModel = new UploadForm();
                $imagModel->imageFile = UploadedFile::getInstanceByName('icon');
                $uploadData = $imagModel->uploadCouponIcon();
			}else{
				echo json_encode(array(['code'=>0,'message'=>'图标不能为空']));
				Yii::$app->end();
			}

			$validType = $request->post('time');
			if ( $validType == '1') {
				$startTime = strtotime($request->post('starttime',''));
				$endTime = strtotime($request->post('endtime',''));
				$valid = $endTime-$startTime;
			}else if ($validType == '2') {
				$day = $request->post('valid');
				$valid = $day*24*3600;
			}

			$transaction= Yii::$app->db->beginTransaction();

			try {
				$coupon = new Coupon();
				$coupon->name = $request->post('name');
				$coupon->icon = $uploadData['basename'];
				$coupon->type = $type_id;
				$coupon->amount = json_encode($amount);
				$coupon->condition = json_encode($condition);
				$coupon->desc = $request->post('desc');
				$coupon->num = $request->post('nums');
				$coupon->receive_limit = $request->post('limit');
				$coupon->left_num = $request->post('nums');
				$coupon->valid_type = $validType;
				if ($validType == 1) {
					$coupon->start_time = $startTime;
					$coupon->end_time = $endTime;
				}
				$coupon->valid = $valid;
				$coupon->create_time = time();
				$coupon->update_time = time();
				$rs = $coupon->save(false);

				$couponId = $coupon->attributes['id'];

				if ($couponId) {
					if ($request->post('nums') == 0) {
						$nums = 1;
					}else{
						$nums = $request->post('nums');
					}
					$back = CouponCode::makeCode($couponId,$nums);
				}
				if ($couponId && !is_array($back) && $back == $nums) {
					$transaction->commit();
					echo json_encode(['code'=>100,'message'=>'添加成功']);
					Yii::$app->end();
				}else{
					echo json_encode(['code'=>0,'message'=>'添加失败']);
					$transaction->rollback();
					Yii::$app->end();
				}				
			} catch (\Exception $e) {
				echo json_encode(['code'=>0,'message'=>'添加失败']);
				$transaction->rollback();
				Yii::$app->end();
			}
		}
		$typeInfo = CouponType::getInfo($type_id);

		return $this->render('edit',[
				'typeInfo'=>$typeInfo
			]);
	}

	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function actionEdit()
	{
		$request = Yii::$app->request;
		$couponId = $request->get('id');
		if ($request->isPost) {
			$couponInfo = Coupon::findOne(['id'=>$couponId]);
			
			if ($request->post('type_id') == 1) {
				$amount = ['money'=>$request->post('amount','0')];
				$range = $request->post('range');
				if (count($range) == 1 && (in_array(4, $range) || in_array(5, $range))) {
					$conditionProducts = $request->post('products','');
					$conditionPkProducts = $request->post('pk_products','');
					$condition = [
						'need'=>$request->post('need','0'),
						'range'=>implode(',',$request->post('range','')),
						'products'=>$conditionProducts ? implode(',',$conditionProducts) : '',
						'pk_products'=>$conditionPkProducts ? implode(',',$conditionPkProducts) : '',
					];
				} elseif (count($range) == 2 && (in_array(4, $range) && in_array(5, $range))) {
					$conditionProducts = $request->post('products','');
					$conditionPkProducts = $request->post('pk_products','');
					$condition = [
						'need'=>$request->post('need','0'),
						'range'=>implode(',',$request->post('range','')),
					];
					$condition['products'] = $conditionProducts ? implode(',',$conditionProducts) : '';
					$condition['pk_products'] = $conditionPkProducts ? implode(',',$conditionPkProducts) : '';
				}else{
					$condition = ['need'=>$request->post('need','0'),'range'=>implode(',',$request->post('range',''))];
				}
			}else if ($request->post('type_id') == 2) {
				$amount = ['discount'=>$request->post('amount','0'),'max'=>$request->post('max','0')];
				$condition = ['need'=>$request->post('need','0'),'range'=>implode(',',$request->post('range',''))];
			}else if ($request->post('type_id') == 3) {
				$amount = ['type'=>$request->post('recharge_type','point'),'amount'=>$request->post('amount','0')];
				$condition = [];
			}

			$validType = $request->post('time');
			if ( $validType == '1') {
				$startTime = strtotime($request->post('starttime',''));
				$endTime = strtotime($request->post('endtime',''));
				$valid = $endTime-$startTime;
				$couponInfo->start_time = $startTime;
				$couponInfo->end_time = $endTime;
			}else if ($validType == '2') {
				$day = $request->post('valid');
				$valid = $day*24*3600;
			}

			$uploadData = '';
			if (!empty($_FILES['icon']['name'])) {
				$imagModel = new UploadForm();
                $imagModel->imageFile = UploadedFile::getInstanceByName('icon');
                $uploadData = $imagModel->uploadCouponIcon();
			}
			if ($uploadData) {
				$couponInfo->icon = $uploadData['basename'];
			}
			$couponInfo->name = $request->post('name');
			$couponInfo->amount = json_encode($amount);
			$couponInfo->condition = json_encode($condition);
			$couponInfo->desc = $request->post('desc');
			$couponInfo->num = $request->post('nums');
			$couponInfo->receive_limit = $request->post('limit');
			$couponInfo->valid = $valid;
			$couponInfo->valid_type = $validType;
			$rs = $couponInfo->save(false);

			if ($rs) {
				echo json_encode(['code'=>100,'message'=>'保存成功']);
				Yii::$app->end();
			}
			
		}else{
			$info = Coupon::find()->where(['id'=>$couponId])->asArray()->one();
			$typeInfo = CouponType::getInfo($info['type']);

			return $this->render('edit',['typeInfo'=>$typeInfo,'couponId'=>$couponId]);
		}
	}


	/**
	 * 优惠券详情
	 * @return [type] [description]
	 */
	public function actionInfo()
	{
		$info = Coupon::find()->where(['id'=>Yii::$app->request->get('id')])->asArray()->one();
		$typeInfo = CouponType::getInfo($info['type']);
		$info['typename'] = $typeInfo['name'];
		$info['amount'] = json_decode($info['amount']);
		$info['condition'] = json_decode($info['condition']);
		$info['valid'] = $info['valid']/24/3600;
		$info['start_time'] = date("Y-m-d H:i:s",$info['start_time']);
		$info['end_time'] = date("Y-m-d H:i:s",$info['end_time']);

		echo json_encode($info);
		Yii::$app->end();
	}

	/**
	 * 优惠券明细
	 * @return [type] [description]
	 */
	public function actionDetail()
	{
		
	}

	/**
	 * 获取优惠券列表
	 * @return [type] [description]
	 */
	public function actionGetList()
	{
		$couponList = Coupon::getAllList();
		echo json_encode($couponList);
		Yii::$app->end();
	}
}
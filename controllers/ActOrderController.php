<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 16/4/5
 * Time: 15:19
 */
namespace app\controllers;

use app\helpers\Express;
use app\helpers\Message;
use yii\helpers\ArrayHelper;
use app\models\ActDeliver;
use app\models\ActOrder;
use app\models\Admin;
use app\models\Image;
use app\models\User;
use yii\data\Pagination;
use yii\helpers\Json;
use app\helpers\Ex;
use Yii;

class ActOrderController extends BaseController
{
	private static $act_type = [
		1 => [
			'name' => '幸运大转盘',
		],
		2 => [
			'name' => '0元购',
		],
		3 => [
			'name' => '月度土豪榜',
		],
		4 => [
			'name' => '周度土豪榜',
		],
		5 => [
			'name' => '季土豪榜',
		],
	];
	private static $formatStatus = [
		0 => [
			'name' => '已中奖',
		],
		1 => [
			'name' => '待确认',
		],
		2 => [
			'name' => '备货',
		],
		3 => [
			'name' => '发货',
		],
		4 => [
			'name' => '待收货',
		],
		8 => [
			'name' => '已完成',
		],
		9 => [
			'name' => '已过期',
		],
	];


	/**
	 * 活动中奖订单列表
	 */
	public function actionIndex()
	{
		$request = \Yii::$app->request;
		$person = Admin::getEmployeeName();
		if ($request->isAjax || $request->get('excel') == 'order') {
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$status = $request->get('status', 'all');
			$get = $request->get();
			$query = ActOrder::find();
			if ($status != 'all') {
				$query->where(['status' => $status]);
			}
			if (isset($get['name'])&&$get['name']) {
				$userQuery = User::find()->where(['or', 'email="' . $get['name'] . '"', 'phone="' . $get['name'] . '"', 'nickname="' . $get['name'] . '"']);

				$users = $userQuery->all();
				$userIds = ArrayHelper::getColumn($users, 'id');
				$query->andWhere(['in','user_id',$userIds]);
			}

			if (isset($get['order'])&&$get['order']) {
				$query->andWhere(['id' => $get['order']]);
			}
			if (isset($get['product'])&&$get['product']) {
				$query->andWhere(['like', 'name', $get['product']]);
			}
			if (isset($get['excel']) && $get['excel'] == 'order') {
				ini_set('memory_limit', '500M');
				$list = $query
					->orderBy('id desc')
					->asArray()->all();
				$data[0] = ['id' => '订单号', 'name' => '商品名称','phone' => '会员手机', 'email' => '会员邮箱', 'act_type' => '活动类型', 'status' => '状态', 'create_time' => '中奖时间', 'select_prepare' => '备发货操作人'];

				foreach ($list as $key => $val) {
					$key = $key + 1;
					$user = User::findOne($val['user_id']);
					$data[$key]['id'] = $val['id'];
					$data[$key]['name'] = $val['name'];
					$data[$key]['phone'] = $user['phone'];
					$data[$key]['email'] = $user['email'];
					$data[$key]['act_type'] = self::$act_type[$val['act_type']]['name'];
					$data[$key]['status'] = self::$formatStatus[$val['status']]['name'];
					$data[$key]['create_time'] = date('Y-m-d H:i:s', $val['create_time']);
					$val['select_prepare'] = '';
					$deliverModel = ActDeliver::findOne($val['id']);
					if ($deliverModel && $deliverModel['select_prepare']) {
						$val['select_prepare'] = $person[$deliverModel['select_prepare']];
					} else {
						$val['select_prepare'] = '';
					}
					$data[$key]['select_prepare'] = $val['select_prepare'];
				}
				$excel = new Ex();
				$excel->download($data, '活动奖品订单数据' . date('Y-m-d H:i:s') . '.xls');
				unset($data);

			}
			$countQuery = clone $query;
			$totalCount = $countQuery->count();
			$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
			$list = $query
				->offset($pagination->offset)
				->limit($pagination->limit)
				->orderBy('id desc')
				->asArray()->all();
			//echo $query->createCommand()->getRawSql();die;
			foreach ($list as &$one) {
				$one['create_time'] = date('Y-m-d H:i:s', $one['create_time']);
				$user = User::findOne($one['user_id']);
				$one['phone'] = $user['phone'];
				$one['email'] = $user['email'];
				$one['act_type_name'] = static::$act_type[$one['act_type']]['name'];
				$one['select_prepare'] = '';
				$deliverModel = ActDeliver::findOne($one['id']);
				if ($deliverModel && $deliverModel['select_prepare']) {
					$one['select_prepare'] = $person[$deliverModel['select_prepare']];
				} else {
					$one['select_prepare'] = '';
				}
			}
			return ['rows' => $list, 'total' => $pagination->totalCount];
		}

		$count = ActOrder::orderStatusCount();
		return $this->render('index', [
			'count' => $count,
		]);
	}

	/**
	 *  订单详情
	 */
	public function actionView($id)
	{
		$detail = ActOrder::findOne($id)->toArray();
		$deliverInfo = ActDeliver::findOne($id);
		$person = Admin::getEmployeeName();

		$detail['remarkArr'] = Json::decode($detail['remark']);
		$detail['picture'] = Image::getActiveInfoUrl($detail['picture'], 'small');

		$priv['confirm'] = $this->checkPrivilege('act-order/confirm');
		$priv['refuse'] = $this->checkPrivilege('act-order/refuse');
		$priv['prepare'] = $this->checkPrivilege('act-order/prepare');
		$priv['ship'] = $this->checkPrivilege('act-order/ship');
		$priv['edit'] = $this->checkPrivilege('act-order/edit');
		return $this->render('view', [
			'detail' => $detail,
			'person' => $person,
			'deliverInfo' => $deliverInfo,
			'priv' => $priv,
		]);
	}

	/**
	 *  修改订单发货相关
	 */
	public function actionEdit()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		$orderModel = ActOrder::findOne($id);
		$deliverModel = ActDeliver::findOne($id);
		$company = Express::getExpressName();

		if ($request->post()) {
			$post = $request->post();

			if ($deliverModel->load($post) && $deliverModel->validate()) {
				if ($deliverModel->save()) {
					$this->addLog('活动中奖订单-修改信息成功-' . $orderModel['id']);
					echo json_encode(['error' => 0, 'message' => '保存成功']);
					Yii::$app->end();
				} else {
					$this->addLog('活动中奖订单-修改信息失败-' . $orderModel['id']);
					echo json_encode(['error' => 1, 'message' => '保存失败']);
					Yii::$app->end();
				}
			}
		}

		return $this->render('edit', [
			'order' => $orderModel,
			'deliver' => $deliverModel,
			'express' => $company
		]);
	}

	/**
	 * 订单添加备注
	 */
	public function actionAddRemark()
	{
		$request = \Yii::$app->request;
		$id = $request->post('id');
		$remark = $request->post('remark');

		$model = ActOrder::find()->where(['id' => $id])->one();
		if ($model) {
			$remarkArr = Json::decode($model->remark);
			$remarkArr[] = [
				'op_user' => \Yii::$app->admin->id,
				'op_content' => $remark,
				'op_time' => date('Y-m-d H:i:s'),
			];
			$model->remark = Json::encode($remarkArr);
			if ($model->save()) {
				$this->addLog('活动中奖订单-备注添加' . $model['id']);
				return 1;
			} else {
				return 0;
			}
		} else {
			return 2;
		}
	}


	/**
	 *  确认订单
	 */
	public function actionConfirm()
	{
		$request = \Yii::$app->request;
		if ($request->isPost) {
			$id = $request->post('id');
			$model = ActOrder::find()->where(['id' => $id, 'status' => ActOrder::STATUS_COMMIT_ADDRESS])->one();
			if ($model) {
				$model->status = 2;
				$model->confirm = 1;
				$model->last_modified = time();
				$trans = Yii::$app->db->beginTransaction();
				$user = User::userName($model['user_id']);
				try {
					if (!$model->save()) {
						$trans->rollBack();
						return 5;
					}
					$deliverModel = new ActDeliver();
					$deliverModel->id = $id;
					$deliverModel->confirm_userid = \Yii::$app->admin->id;
					$deliverModel->confirm_time = time();
					$deliverModel->status = 2;
					if (!$deliverModel->save()) {
						$trans->rollBack();
						return 7;
					}
					$this->addLog('活动中奖订单-收货地址确认' . $model['id']);
					$trans->commit();
					Message::send(15, $model['user_id'], ['nickname' => $user['username'], 'goodsName' => $model['name'], 'orderNo' => $model['id'], 'time' => date('Y-m-d H:i:s')]);
					return 0;
				} catch (\Exception $e) {
					$trans->rollBack();
					return 3;
				}
			}
		}
	}

	/**
	 * 驳回订单
	 */
	public function actionRefuse()
	{
		$request = Yii::$app->request;
		$response = Yii::$app->response;
		$response->format = \yii\web\Response::FORMAT_JSON;
		$id = $request->get('id');
		$model = ActOrder::find()->where(['id' => $id, 'status' => ActOrder::STATUS_COMMIT_ADDRESS])->one();
		if (!$model) {
			return ['error' => 1, 'message' => '该订单不存在'];
		}
		if ($request->isPost) {
			$reason = $request->post('confirm_reason');
			$model->status = 0;
			if (!$model->save()) {
				$this->addLog('活动中奖订单-收货地址驳回失败-' . $model['id']);
				return ['error' => 2, 'message' => '驳回失败'];
			} else {
				$this->addLog('活动中奖订单-收货地址驳回成功-原因【' . $reason . '】-' . $model['id']);
				return ['error' => 0, 'message' => '驳回成功'];
			}
		}
	}

	/**
	 * 选择备货人
	 */
	public function actionSelectPrepare()
	{
		$post = Yii::$app->request->post();
		foreach ($post['checkArr'] as $value) {
			$model = ActDeliver::find()->where(['id' => $value])->one();
			if (!$model['id']) {
				echo Json::encode(['error' => 1, 'message' => '订单不存在']);
				Yii::$app->end();
			}
			$person = Admin::find()->where(['real_name' => $post['prepareName']])->one();
			if (!$person['id']) {
				echo Json::encode(['error' => 2, 'message' => '该管理员不存在']);
				Yii::$app->end();
			}
			$model->select_prepare = $person['id'];
			$model->save();
		}
		$this->addLog('活动中奖订单-选择备货人成功');
		echo Json::encode(['error' => 0, 'message' => '操作成功']);
		Yii::$app->end();
	}

	/**
	 * 备货
	 */
	public function actionPrepare()
	{
		$request = \Yii::$app->request;
		$id = $request->get('id');
		$model = ActOrder::find()->where(['id' => $id, 'status' => ActOrder::STATUS_COMFIRM_ADDRESS])->one();

		if ($request->isPost) {
			$post = $request->post();
			$deliver = ActDeliver::findOne($id);
			if (Yii::$app->admin->id != $deliver['select_prepare']) {
				echo Json::encode(['error' => 1, 'message' => '备货人错误']);
				Yii::$app->end();
			}

			$trans = Yii::$app->db->beginTransaction();
			try {
				if ($deliver->load($post) && $deliver->validate()) {
					$deliver->status = 3;
					$deliver->prepare_userid = Yii::$app->admin->id;
					$deliver->prepare_time = time();
					$model->status = 3;
					$model->last_modified = time();
					if ($deliver->save() && $model->save()) {
						$trans->commit();
						$this->addLog('活动中奖订单-备货成功-' . $model['id']);
						echo Json::encode(['error' => 0, 'message' => '保存成功']);
						Yii::$app->end();
					} else {
						$trans->rollBack();
						$this->addLog('活动中奖订单-备货失败-' . $model['id']);
						echo Json::encode(['error' => 3, 'message' => '保存失败']);
						Yii::$app->end();
					}
				} else {
					$this->addLog('活动中奖订单-备货失败-' . $model['id']);
					foreach ($deliver->errors as $message) {
						echo Json::encode(['error' => 1, 'message' => $message]);
						Yii::$app->end();
					}
				}
			} catch (\Exception $e) {
				$trans->rollBack();
				$this->addLog('活动中奖订单-备货失败-' . $model['id']);
				echo Json::encode(['error' => 2, 'message' => '抛出异常，保存失败']);
				\Yii::$app->end();
			}
		}

		return $this->render('prepare', [
			'model' => $model,
		]);
	}

	/**
	 * 发货
	 */
	public function actionShip()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		$model = ActOrder::find()->where(['id' => $id, 'status' => ActOrder::STATUS_PREPARE_GOODS])->one();
		$deliver = ActDeliver::findOne($id);
		$express = Express::getExpressName();
		if (!($model && $deliver)) {
			echo json_encode(['error' => 1, 'message' => '该订单不存在']);
			Yii::$app->end();
		}

		if ($request->isPost) {
			if (Yii::$app->admin->id != $deliver['select_prepare']) {
				echo json_encode(['error' => 1, 'message' => '备货人错误']);
				Yii::$app->end();
			}
			$post = $request->post();
			$trans = Yii::$app->db->beginTransaction();
			try {
				$model->status = 4;
				$deliver->status = 4;
				$deliver->deliver_company = $post['company'];
				$deliver->deliver_order = $post['orderNo'];
				$deliver->deliver_time = time();
				$deliver->deliver_userid = Yii::$app->admin->id;
				$deliver->deliver_cost = $post['cost'];

				if ($model->save() && $deliver->save()) {
					$trans->commit();
					$this->addLog('活动中奖订单-发货成功-' . $model['id']);
					echo json_encode(['error' => 0, 'message' => '保存成功']);
					Yii::$app->end();
				} else {
					$trans->rollBack();
					$this->addLog('活动中奖订单-发货失败-' . $model['id']);
					echo json_encode(['error' => 2, 'message' => '保存失败']);
					Yii::$app->end();
				}
			} catch (\Exception $e) {
				$trans->rollBack();
				$this->addLog('活动中奖订单-发货失败-' . $model['id']);
				echo json_encode(['error' => 3, 'message' => '抛出异常，保存失败']);
				Yii::$app->end();
			}
		}

		$person = Admin::getEmployeeName();

		return $this->render('ship', [
			'model' => $model,
			'deliver' => $deliver,
			'express' => $express,
			'person' => $person
		]);
	}

}
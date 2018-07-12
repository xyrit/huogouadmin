<?php
/**
 * Created by PhpStorm.
 * User: joan
 * Date: 2016/7/7
 * Time: 13:03
 */

namespace app\controllers;

use app\models\Admin;
use app\models\Express;
use yii;

class ExpressController extends BaseController
{
	/**快递管理
	 * @pass
	 */
	public function actionIndex()
	{
		$request = Yii::$app->request;
		if ($request->isAjax) {
			$condition = [];
			//$condition['status'] = $request->get('status', 'all');
			$condition['name'] = $request->get('name');
			$condition['admin'] = $request->get('admin');
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$data = Express::getList($condition, $page, $pageSize);
			return $data;
		}
		$params['status'] = $this->checkPrivilege($this->getUniqueId() . '/change-status');
		return $this->render('index', $params);
	}

	public function actionAdd()
	{
		$request = \Yii::$app->request;
		$model = new Express();
		if ($request->isPost) {
			$post = $request->post();
			$model->created_at = time();
			$model->updated_at = time();
			$model->name=$post['name'];
			$model->keyword=$post['keyword'];
			$model->admin_id=Yii::$app->admin->id;
			if ($model&& $model->validate()) {
				$result = $model->save();
				if ($result) {
					self::updateExpressCache();
					$this->addTips('新增快递', 0, '操作成功');
				}
			}
			foreach ($model->errors as $message) {
				$this->addTips('新增快递', 1, $message);
			}
		}
	}

	public function actionEdit()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');

		if ($request->isPost) {
			$post = $request->post();
			$model = Express::findOne($id);
			$model->name=$post['name'];
			$model->keyword=$post['keyword'];
			$model->admin_id=Yii::$app->admin->id;
			$model->updated_at = time();
			if ($model->validate() && $model) {
				$result = $model->save();
				if ($result) {
					self::updateExpressCache();
					$this->addTips('编辑快递', 0, '操作成功');
				}
			}
			foreach ($model->errors as $message) {
				$this->addTips('编辑快递', 1, $message);
			}
		}
	}
	
	public static function updateExpressCache()
	{
		$cache = \Yii::$app->cache;
		$expressKey = 'logistics_express';
		$expressKey = md5($expressKey);
		$cache->delete($expressKey);
	}

}
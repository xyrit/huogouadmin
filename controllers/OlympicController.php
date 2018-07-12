<?php
/**
 * Created by PhpStorm.
 * User: Joan
 * Date: 2016/7/28
 * Time: 16:21
 */

namespace app\controllers;

use yii;
use app\models\OlympicSchedule;


class OlympicController extends BaseController
{
	
	
	/**奥运会赛程
	 * @pass
	 */
	public function actionIndex()
	{
		$request = Yii::$app->request;
		if ($request->isAjax) {
			$condition = [];
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$data = OlympicSchedule::getList($condition, $page, $pageSize);
			return $data;
		}
		$params['status'] = $this->checkPrivilege($this->getUniqueId() . '/change-status');
		return $this->render('index', $params);
	}
	
	public function actionAdd()
	{
		$request = \Yii::$app->request;
		$model = new OlympicSchedule();
		if ($request->isPost) {
			$post = $request->post();
			$model->name = $post['name'];
			$model->date = date('Ymd', strtotime($post['date']));
			$model->created_at = time();
			if ($model && $model->validate()) {
				$result = $model->save();
				if ($result) {
					$this->addTips('新增赛事', 0, '操作成功');
				}
			}
			foreach ($model->errors as $message) {
				$this->addTips('新增赛事', 1, $message);
			}
		}
	}
	
	public function actionEdit()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		if ($request->isPost) {
			$post = $request->post();
			$model = OlympicSchedule::findOne($id);
			$model->name = $post['name'];
			$model->date = date('Ymd', strtotime($post['date']));
			$model->created_at = time();
			if ($model->validate() && $model) {
				$result = $model->save();
				if ($result) {
					$this->addTips('编辑赛事', 0, '操作成功');
				}
			}
			foreach ($model->errors as $message) {
				$this->addTips('编辑赛事', 1, $message);
			}
		}
	}
}
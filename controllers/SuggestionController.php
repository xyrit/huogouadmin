<?php
/**
 * Created by PhpStorm.
 * User: suyan
 * Date: 2015/9/28
 * Time: 14:24
 */
namespace app\controllers;


use app\models\Suggestion;
use Yii;

class SuggestionController extends BaseController
{

    public function actionIndex()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 20);
            $condition['phone'] = $request->get('phone');
            $condition['startTime'] = $request->get('startTime');
            $condition['endTime'] = $request->get('endTime');
            $condition['email'] = $request->get('email');
            $condition['type'] = $request->get('type', 'all');

            $data = Suggestion::getList($condition, $page, $pageSize);
            return $data;
        }

        return $this->render('index');
    }

    public function actionDel()
    {
        $request = Yii::$app->request;

        if($request->isAjax){
            $id = $request->post('id');
            $model = Suggestion::findOne($id);
            $delete = $model->delete();
            if ($delete) {
                return ['error' => 0, 'message' => '删除成功'];
            }
            return ['error' => 1, 'message' => '删除失败'];
        }
    }
}
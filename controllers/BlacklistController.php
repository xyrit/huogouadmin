<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2016/4/14
 * Time: 15:41
 */

namespace app\controllers;


use app\models\BlackList;
use app\models\User;
use Yii;

class BlacklistController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $condition = [];
            $condition['type'] = $request->get('type', 'all');
            $condition['account'] = $request->get('account');
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 20);
            $data = BlackList::getList($condition, $page, $pageSize);
            return $data;
        }
        return $this->render('index');
    }

    /**
     * @pass
     */
    public function actionAdd()
    {
        $request = Yii::$app->request;
        if($request->isPost){
            $post = $request->post();
            $model = new BlackList();
            if ($post['BlackList']['account']) {
                $user = User::find()->where(['or', 'phone="'.$post['BlackList']['account'].'"', 'email="'.$post['BlackList']['account'].'"'])->one();
                if (!$user) {
                    echo json_encode(['error' => 1,'message' => '用户不存在']);
                    Yii::$app->end();
                } else {
                    $model->user_id = $user['id'];
                }
            }
            $model->created_at = time();
            if ($model->load($post) && $model->validate()) {
                $result = $model->save();
                if($result){
                    echo json_encode(['error' => 0, 'message' => '添加黑名单成功']);
                    Yii::$app->end();
                } else {
                    foreach ($model->errors as $message) {
                        echo json_encode(['error' => 1, 'message' => $message]);
                        Yii::$app->end();
                    }
                }
            }

            foreach ($model->errors as $message) {
                echo json_encode(['error' => 1, 'message' => $message]);
                Yii::$app->end();
            }
        }
    }

    /**
     * @pass
     * @return array
     */
    public function actionDel()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $id = $request->post('id');
            $model = BlackList::findOne($id);
            if (!$model) {
                return [
                    'error' => 1,
                    'message' => '该黑名单不存在'
                ];
            }

            $delete = BlackList::deleteAll(['id' => $id]);
            if ($delete) {
                return [
                    'error' => 0,
                    'message' => '删除成功'
                ];
            }
            return [
                'error' => 1,
                'message' => '删除失败'
            ];
        }
    }
}
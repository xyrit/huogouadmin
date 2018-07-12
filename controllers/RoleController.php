<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2015/12/29
 * Time: 10:48
 */

namespace app\controllers;

use app\models\Role;
use Yii;

class RoleController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 10);
            $roleList = Role::getList($page, $pageSize);
            return $roleList;
        }

        return $this->render('index');
    }

    public function actionAdd()
    {
        $request = Yii::$app->request;

        if($request->isPost){
            $model = new Role();
            $post = $request->post();
            isset($post['Role']['privilege']) && !empty($post['Role']['privilege']) && $post['Role']['privilege'] = implode(',', $post['Role']['privilege']);
            $model->created_at = time();
            if($model->load($post) && $model->validate()){
                if($model->save()){
                    echo json_encode(['error' => 0,'message' => '新增角色成功']);
                    Yii::$app->end();
                }
            }
            foreach ($model->errors as $message) {
                echo json_encode(['error' => 1, 'message' => $message]);
                Yii::$app->end();
            }
        }
    }

    public function actionEdit()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = Role::findOne($id);
        if (!$model) {
            echo json_encode(['error' => 1,'message' => ['该角色不存在']]);
            Yii::$app->end();
        }

        if($request->isPost){
            $post = $request->post();
            isset($post['Role']['privilege']) && !empty($post['Role']['privilege']) && $post['Role']['privilege'] = implode(',', $post['Role']['privilege']);
            $model->created_at = time();
            if($model->load($post) && $model->validate()){
                if($model->save()){
                    echo json_encode(['error' => 0,'message' => '权限设置成功']);
                    Yii::$app->end();
                }
            }
            foreach ($model->errors as $message) {
                echo json_encode(['error' => 1, 'message' => $message]);
                Yii::$app->end();
            }
        }
    }

    public function actionDel()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = Role::findOne($id);
        if (!$model) {
            echo json_encode(['error' => 1,'message' => ['该角色不存在']]);
            Yii::$app->end();
        }

        if ($request->isAjax) {
            $delete = Role::deleteAll(['id' => $id]);
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

    public function actionList()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $roleItems = [];
            $roles = Role::find()->all();
            foreach ($roles as $role) {
                $tmp['id'] = $role['id'];
                $tmp['text'] = $role['name'];
                $roleItems[] = $tmp;
            }

            return $roleItems;
        }
    }

    public function actionGetRolePrivilege()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        if ($request->isAjax) {
            $role = Role::findOne($id);
            return $role;
        }
    }
}
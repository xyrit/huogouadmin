<?php
/**
 * Created by PhpStorm.
 * User: zhangjicheng
 * Date: 15/9/18
 * Time: 14:54
 */

namespace app\controllers;

use app\models\Deliver;
use app\models\OrderManageGroupUser;
use app\models\Role;
use app\models\Admin;
use yii;
use yii\web\NotFoundHttpException;

class EmployeeController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $condition = [];
            $condition['status'] = $request->get('status', 'all');
            $condition['role'] = $request->get('role');
            $condition['account'] = $request->get('account');
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 10);
            $data = Admin::getList($condition, $page, $pageSize);
            foreach($data['rows'] as &$val){
                $role = Role::findOne($val['role']);
                $val['role_name'] = $role['name'];
            }

            return $data;
        }

        $params['status'] = $this->checkPrivilege($this->getUniqueId() . '/change-status');
        return $this->render('index', $params);
    }

    public function actionAdd()
    {
        $request = \Yii::$app->request;
        $model = new Admin();
        if($request->isPost){
            $post = $request->post();
            $model->created_at = time();
            $model->updated_at = time();
            if (isset($post['Admin']['privilege']) && !empty($post['Admin']['privilege'])) {
                $post['Admin']['privilege'] = implode(',', $post['Admin']['privilege']);
            } else {
                $post['Admin']['privilege'] = '';
            }
            if ($model->load( $post) && $model->validate()) {
                $model->password = Yii::$app->security->generatePasswordHash($post['Admin']['password']);
                $result = $model->save();
                if($result){
                    $this->addTips('新增员工', 0, '操作成功');
                }
            }
            foreach ($model->errors as $message) {
                $this->addTips('新增员工', 1, $message);
            }
        }
    }

    public function actionEdit()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');

        if($request->isPost){
            $post = $request->post();
            $model = Admin::findOne($id);
            if (isset($post['Admin']['privilege']) && !empty($post['Admin']['privilege'])) {
                $post['Admin']['privilege'] = implode(',', $post['Admin']['privilege']);
            } else {
                $post['Admin']['privilege'] = '';
            }
            if ($post['Admin']['password'] != $model['password']) {
                $post['Admin']['password'] = Yii::$app->security->generatePasswordHash($post['Admin']['password']);
            }
            if ($model->validate() && $model->load($post)) {
                $result = $model->save();
                if($result){
                    $this->addTips('编辑员工', 0, '操作成功');
                }
            }
            foreach ($model->errors as $message) {
                $this->addTips('编辑员工', 1, $message);
            }
        }
    }

    public function actionDel()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $id = $request->post('id');
            $model = Admin::findOne($id);
            if (!$model) {
                $this->addTips('编辑员工', 1, '该账号不存在');
            }

            $delete = Admin::updateAll(['status'=>Admin::STATUS_DEL], ['id' => $id]);
            if ($delete) {
                $this->addTips('编辑员工', 0, '删除成功');

            }
            $this->addTips('编辑员工', 1, '删除失败');

        }
    }

    public function actionChangeStatus()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $id = $request->post('id');
            $status = $request->post('status');
            $model = Admin::findOne($id);
            $model->status = $status;

            if ($model->save()) {
                $message = $status == 0 ? '启用成功' : '冻结成功';
                $this->addTips('编辑员工', 0, $message);
            }

            foreach ($model->errors as $message) {
                $this->addTips('编辑员工', 1, $message);
            }
        }

    }

    public function actionList()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $groupId = $request->get('group_id');
            $query = Admin::find()->where(['status' => 0]);
            if ($groupId) {
                // 过滤小组成员
                $groupUser = OrderManageGroupUser::findAll(['group_id' => $groupId]);
                $groupUserIds = yii\helpers\ArrayHelper::getColumn($groupUser, 'user_id');
                $query->andWhere(['not in', 'id', $groupUserIds]);
            }
            $admin = $query->asArray()->all();

            $data = [];
            foreach ($admin as $val) {
                $tmp['id'] = $val['id'];
                $tmp['name'] = $val['username'];
                $data[] = $tmp;
            }

            return $data;
        }
    }


    //操作人列表
    public function actionAdminList()
    {
        $tree = [];
        $all = Admin::find()->asArray()->all();
        foreach($all as $val){
            $tem['id'] = $val['id'];
            $tem['real_name'] = $val['real_name'];
            $tree[] = $tem;
        }
        return $tree;
    }

}
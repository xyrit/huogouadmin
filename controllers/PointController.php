<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2016/1/11
 * Time: 16:51
 * 福分调整
 */

namespace app\controllers;

use app\models\PointLog;
use app\models\User;
use app\services\Member;
use Yii;
use yii\helpers\Json;

class PointController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 20);
            $condition['account'] = $request->get('account');
            $condition['startTime'] = $request->get('startTime');
            $condition['endTime'] = $request->get('endTime');
            $condition['order'] = $request->get('order');
            $condition['status'] = $request->get('status', 'all');

            $data = PointLog::getList($condition, $page, $pageSize);
            return $data;
        }

        $params['financeApprove'] = $this->checkPrivilege($this->getUniqueId() . '/finance-approve');
        return $this->render('index', $params);
    }

    public function actionAdd()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $model = new PointLog();
            $post = $request->post();

            if ($model->load($post) && $model->validate()) {
                $model->status = 1;
                $model->admin_id = Yii::$app->admin->id;
                $model->created_at = time();

                if ($model->save()) {
                    $this->addLog('新增福分调整，编号-' . $model->id);
                    return Json::encode(['error' => 0,'message' => '新增福分调整成功']);
                }
            }
            foreach ($model->errors as $message) {
                return Json::encode(['error' => 1, 'message' => $message]);
            }
        }
    }

    public function actionEdit()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $id = $request->get('id');
            $model = PointLog::findOne($id);
            if ($model['status'] == 2) {
                return Json::encode(['error' => 1, 'message' => '已通过审核，无法修改']);
            }
            $post = $request->post();

            if ($model->load($post) && $model->validate()) {
                $model->status = 1;
                $model->admin_id = Yii::$app->admin->id;

                if ($model->save()) {
                    $this->addLog('修改福分调整，编号-' . $model->id);
                    return Json::encode(['error' => 0,'message' => '修改福分调整成功']);
                }
            }
            foreach ($model->errors as $message) {
                return Json::encode(['error' => 1, 'message' => $message]);
            }
        }
    }

    //财务审核
    public function actionFinanceApprove()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $post = $request->post();
            $id = $request->get('id');
            $model = PointLog::findOne($id);
            if ($model['status'] == 2) {
                return Json::encode(['error' => 1, 'message' => '已通过审核']);
            }
            if ($post['status'] == 3 && !$post['fail_reason']) {
                return Json::encode(['error' => 1, 'message' => '请输入不通过原因']);
            }

            $user = User::findOne($model['user_id']);
            if ($model['type'] == 1 && $user['point'] < $model['point']) {
                return Json::encode(['error' => 1, 'message' => '用户福分不足']);
            }

            $model->before_point = $user['point'];
            if ($model['type'] == 0) {
                $model->final_point = $user['point'] + $model['point'];
            } else {
                $model->final_point = $user['point'] - $model['point'];
            }

            $model->status = $post['status'];
            $model->fail_reason = $post['fail_reason'];
            $model->approve_admin_id = Yii::$app->admin->id;
            $model->updated_at = time();
            if (!$model->save()) {
                foreach ($model->errors as $message) {
                    return Json::encode(['error' => 1, 'message' => $message]);
                }
            }

            if ($model->status == 2) {
                $member = new Member(['id' => $model->user_id]);
                $point = $model['type'] == 1 ? ('-' . $model['point']) : $model['point'];
                $member->editPoint($point, 6, '后台扣除福分');
            }

            $this->addLog('财务审核福分调整，编号-' . $model->id);
            return Json::encode(['error' => 0,'message' => '审核成功']);
        }
    }
}
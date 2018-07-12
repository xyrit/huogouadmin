<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2016/1/11
 * Time: 17:23
 * 余额调整
 */

namespace app\controllers;

use app\models\AdjustBalance;
use app\models\User;
use Yii;
use yii\helpers\Json;


class MoneyController extends BaseController
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

            $data = AdjustBalance::getList($condition, $page, $pageSize);
            return $data;
        }

        $params['financeApprove'] = $this->checkPrivilege($this->getUniqueId() . '/finance-approve');
        return $this->render('index', $params);
    }

    public function actionAdd()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $model = new AdjustBalance();
            $post = $request->post();

            if ($model->load($post) && $model->validate()) {
                $model->status = 1;
                $model->admin_id = Yii::$app->admin->id;
                $model->created_at = time();

                if ($model->save()) {
                    $this->addLog('新增余额调整，编号-' . $model->id);
                    return Json::encode(['error' => 0,'message' => '新增余额调整成功']);
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
            $model = AdjustBalance::findOne($id);
            if ($model['status'] == 2) {
                return Json::encode(['error' => 1, 'message' => '已通过审核，无法修改']);
            }
            $post = $request->post();

            if ($model->load($post) && $model->validate()) {
                $model->status = 1;
                $model->admin_id = Yii::$app->admin->id;

                if ($model->save()) {
                    $this->addLog('修改余额调整，编号-' . $model->id);
                    return Json::encode(['error' => 0,'message' => '修改余额调整成功']);
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
            $model = AdjustBalance::findOne($id);
            if ($model['status'] == 2) {
                return Json::encode(['error' => 1, 'message' => '已通过审核']);
            }
            if ($post['status'] == 3 && !$post['fail_reason']) {
                return Json::encode(['error' => 1, 'message' => '请输入不通过原因']);
            }

            $user = User::findOne($model['user_id']);
            if ($model['type'] == 1 && $user['money'] < $model['money']) {
                return Json::encode(['error' => 1, 'message' => '用户余额不足']);
            }

            $trans = Yii::$app->db->beginTransaction();
            try {
                $model->before_money = $user['money'];
                if ($model['type'] == 0) {
                    $model->final_money = $user['money'] + $model['money'];
                } else {
                    $model->final_money = $user['money'] - $model['money'];
                }

                $model->status = $post['status'];
                $model->fail_reason = $post['fail_reason'];
                $model->approve_admin_id = Yii::$app->admin->id;
                $model->updated_at = time();
                if (!$model->save()) {
                    $trans->rollBack();
                    foreach ($model->errors as $message) {
                        return Json::encode(['error' => 1, 'message' => $message]);
                    }
                }

                if ($model->status == 2) {
                    $updateMoney = User::updateAll(['money' => $model->final_money], ['id' => $model['user_id']]);
                    if (!$updateMoney) {
                        $trans->rollBack();
                        foreach ($user->errors as $message) {
                            return Json::encode(['error' => 1, 'message' => $message]);
                        }
                    }
                }

                $trans->commit();
                $this->addLog('财务审核余额调整，编号-' . $model->id);
                return Json::encode(['error' => 0,'message' => '审核成功']);
            } catch (\Exception $e) {
                $trans->rollBack();
                return Json::encode(['error' => 1, 'message' => $e->getMessage()]);
            }
        }
    }

    public function actionUserInfo()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            if ($id = $request->get('id')) {
                $user = User::find()->where(['id' => $id])->asArray()->one();
            } else {
                $account = $request->get('account');
                $user = User::find()->where(['or', 'phone="' . $account . '"', 'email="' . $account . '"'])->asArray()->one();
            }

            if ($user) {
                return ['error' => 0, 'message' => ['user_id' => $user['id'], 'money' => $user['money'], 'point' => $user['point']]];
            } else {
                return ['error' => 1, 'message' => '用户不存在'];
            }
        }
    }
}
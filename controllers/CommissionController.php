<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2016/1/11
 * Time: 17:05
 * 佣金管理
 */

namespace app\controllers;


use app\models\BackstageLog;
use app\models\User;
use app\models\Withdraw;
use Yii;
use yii\helpers\Json;

class CommissionController extends BaseController
{
    const OPERATE_APPROVE_SUCCESS = 1;   //运营审核成功
    const OPERATE_APPROVE_FALSE = 2;    //运营审核失败
    const FINANCE_APPROVE_SUCCESS = 3;  //财务审核成功
    const FINANCE_APPROVE_FALSE = 4;    //财务审核失败

    public function actionIndex()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 20);
            $condition['account'] = $request->get('account');
            $condition['startTime'] = $request->get('startTime');
            $condition['endTime'] = $request->get('endTime');
            $condition['status'] = $request->get('status', 'all');

            $data = Withdraw::getList($condition, $page, $pageSize);
            return $data;
        }

        $params['operateApprove'] = $this->checkPrivilege($this->getUniqueId() . '/operate-approve');
        $params['financeApprove'] = $this->checkPrivilege($this->getUniqueId() . '/finance-approve');
        return $this->render('index', $params);
    }

    //运营审核
    public function actionOperateApprove()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $post = $request->post();
            $id = $request->get('id');
            $model = Withdraw::findOne($id);
            if ($model['status'] > 0) {
                return Json::encode(['error' => 1, 'message' => '运营审核已完成']);
            }
            if ($post['status'] == self::OPERATE_APPROVE_FALSE && !$post['fail_reason']) {
                return Json::encode(['error' => 1, 'message' => '请输入驳回原因']);
            }

            $trans = Yii::$app->db->beginTransaction();
            try {
                $model->status = $post['status'];
                $model->fail_reason = $post['fail_reason'];
                $model->audit_user = Yii::$app->admin->id;
                $model->audit_time = time();
                if (!$model->save(false)) {
                    $trans->rollBack();
                    foreach ($model->errors as $message) {
                        return Json::encode(['error' => 1, 'message' => $message]);
                    }
                }
                if ($model->status == self::OPERATE_APPROVE_FALSE) {
                    $user = User::findOne($model['user_id']);
                    $user->commission = $user->commission + $model['money'] * 100;
                    if (!$user->save()) {
                        $trans->rollBack();
                        foreach ($user->errors as $message) {
                            return Json::encode(['error' => 1, 'message' => $message]);
                        }
                    }
                }

                $trans->commit();
                if ($model->status == self::OPERATE_APPROVE_SUCCESS) {
                    $this->addLog('佣金运营审核-通过，编号-' . $model->id);
                } else {
                    $this->addLog('佣金运营审核-驳回，编号-' . $model->id);
                }

                return Json::encode(['error' => 0,'message' => '审核成功']);
            } catch (\Exception $e) {
                $trans->rollBack();
                return Json::encode(['error' => 1, 'message' => $e->getMessage()]);
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
            $model = Withdraw::findOne($id);
            if ($model['status'] == 0) {
                return Json::encode(['error' => 1, 'message' => '请先进行运营审核']);
            }
            if ($model['status'] == self::OPERATE_APPROVE_FALSE) {
                return Json::encode(['error' => 1, 'message' => '运营审核未通过，无法进行财务审核']);
            }
            if ($model['status'] >= self::FINANCE_APPROVE_SUCCESS) {
                return Json::encode(['error' => 1, 'message' => '财务审核已完成']);
            }
            if ($post['status'] == self::FINANCE_APPROVE_FALSE && !$post['fail_reason']) {
                return Json::encode(['error' => 1, 'message' => '请输入驳回原因']);
            }

            $trans = Yii::$app->db->beginTransaction();
            try {
                $model->status = $post['status'];
                $model->fail_reason = $post['fail_reason'];
                $model->pass_user = Yii::$app->admin->id;
                $model->pass_time = time();
                if (!$model->save(false)) {
                    $trans->rollBack();
                    foreach ($model->errors as $message) {
                        return Json::encode(['error' => 1, 'message' => $message]);
                    }
                }
                if ($model->status == self::FINANCE_APPROVE_FALSE) {
                    $user = User::findOne($model['user_id']);
                    $user->commission = $user->commission + $model['money'] * 100;
                    if (!$user->save()) {
                        $trans->rollBack();
                        foreach ($user->errors as $message) {
                            return Json::encode(['error' => 1, 'message' => $message]);
                        }
                    }
                }

                $trans->commit();
                if ($model->status == self::FINANCE_APPROVE_SUCCESS) {
                    $this->addLog('佣金财务审核-通过，编号-' . $model->id);
                } else {
                    $this->addLog('佣金财务审核-驳回，编号-' . $model->id);
                }

                return Json::encode(['error' => 0,'message' => '审核成功']);
            } catch (\Exception $e) {
                $trans->rollBack();
                return Json::encode(['error' => 1, 'message' => $e->getMessage()]);
            }
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/10/20
 * Time: 下午2:04
 */
namespace app\controllers;

use app\models\Product;
use app\models\Admin;
use app\models\OrderManageGroup;
use app\models\OrderManageGroupForm;
use app\models\OrderManageGroupUser;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use Yii;

class OrderManageGroupController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 25);
            $name = $request->get('name');
            $query = OrderManageGroup::find();
            if ($name) {
                $where = ['like','name', $name . '%'];
                $query->andWhere($where);
            }
            $countQuery = clone $query;
            $totalCount = $countQuery->count();
            $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
            $groups = $query->orderBy('id desc')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

            foreach ($groups as &$group) {
                $adminUser = Admin::findOne($group['by_uid']);
                $productNum = Product::find()->where(['order_manage_gid'=>$group['id']])->count();
                $userNum = OrderManageGroupUser::find()->where(['group_id'=>$group['id']])->count();
                $group['username'] = $adminUser->username;
                $group['product_nums'] = $productNum;
                $group['user_nums'] = $userNum;
            }

            $data['rows'] = $groups;
            $data['total'] = $pagination->totalCount;

            return $data;
        }

        return $this->render('index');
    }

    public function actionAdd()
    {
        $model = new OrderManageGroupForm();
        $request = Yii::$app->request;
        $admin = Yii::$app->admin;
        if ($request->isPost) {
            if ($model->load($request->post()) && $model->validate()) {
                $trans = Yii::$app->db->beginTransaction();
                try {
                    $orderManageGroup = new OrderManageGroup();
                    $orderManageGroup->by_uid = $admin->id;
                    $time = time();
                    $orderManageGroup->updated_at = $time;
                    $orderManageGroup->created_at = $time;
                    $orderManageGroup->name = $model['name'];
                    if ($orderManageGroup->save()) {
                        $userIds = explode(',', $model['userIds']);
                        foreach ($userIds as $uid) {
                            $groupUser = new OrderManageGroupUser();
                            $groupUser->user_id = $uid;
                            $groupUser->group_id = $orderManageGroup->id;
                            if (!$groupUser->save()) {
                                $trans->rollBack();
                                foreach ($groupUser->errors as $message) {
                                    echo json_encode(['error' => 1, 'message' => $message]);
                                    Yii::$app->end();
                                }
                            }
                        }
                        $trans->commit();
                        echo json_encode(['error' => 0,'message' => '新增小组成功']);
                        Yii::$app->end();
                    } else {
                        $trans->rollBack();
                        foreach ($orderManageGroup->errors as $message) {
                            echo json_encode(['error' => 1, 'message' => $message]);
                            Yii::$app->end();
                        }
                    }
                } catch (\Exception $e) {
                    $trans->rollBack();
                    echo json_encode(['error' => 1, 'message' => $e->getMessage()]);
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

        if ($request->isPost) {
            $id = $request->get('id');
            $orderManageGroup = OrderManageGroup::findOne($id);
            if (!$orderManageGroup) {
                echo json_encode(['error' => 1, 'message' => '未知的小组']);
                Yii::$app->end();
            }
            $model = new OrderManageGroupForm();

            if ($model->load($request->post()) && $model->validate()) {
                $trans = Yii::$app->db->beginTransaction();
                try {
                    $orderManageGroup->updated_at = time();
                    $orderManageGroup->name = $model['name'];
                    if ($orderManageGroup->save()) {
                        OrderManageGroupUser::deleteAll(['group_id' => $orderManageGroup->id]);
                        $userIds = explode(',', $model['userIds']);
                        foreach ($userIds as $uid) {
                            $groupUser = new OrderManageGroupUser();
                            $groupUser->user_id = $uid;
                            $groupUser->group_id = $orderManageGroup->id;
                            if (!$groupUser->save()) {
                                $trans->rollBack();
                                foreach ($groupUser->errors as $message) {
                                    echo json_encode(['error' => 1, 'message' => $message]);
                                    Yii::$app->end();
                                }
                            }
                        }
                        $trans->commit();
                        echo json_encode(['error' => 0,'message' => '编辑小组成功']);
                        Yii::$app->end();
                    } else {
                        $trans->rollBack();
                        foreach ($orderManageGroup->errors as $message) {
                            echo json_encode(['error' => 1, 'message' => $message]);
                            Yii::$app->end();
                        }
                    }
                } catch (\Exception $e) {
                    $trans->rollBack();
                    echo json_encode(['error' => 1, 'message' => $e->getMessage()]);
                    Yii::$app->end();
                }
            }
            foreach ($model->errors as $message) {
                return Json::encode(['error' => 1, 'message' => $message]);
            }
        }
    }

    public function actionDel()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $id = $request->post('id');
            $orderManageGroup = OrderManageGroup::findOne($id);

            if (!$orderManageGroup) {
                return [
                    'error' => 1,
                    'message' => '未知的小组'
                ];
            } else {
                $trans = Yii::$app->db->beginTransaction();
                try {
                    $groupId = $orderManageGroup->id;
                    $delete = OrderManageGroup::deleteAll(['id' => $id]);
                    if (!$delete) {
                        $trans->rollBack();
                        return [
                            'error' => 1,
                            'message' => '删除失败'
                        ];
                    }
                    $delete = OrderManageGroupUser::deleteAll(['group_id'=>$groupId]);
                    if (!$delete) {
                        $trans->rollBack();
                        return [
                            'error' => 1,
                            'message' => '删除失败'
                        ];
                    }

                    $trans->commit();
                    return [
                        'error' => 0,
                        'message' => '删除成功'
                    ];
                } catch (\Exception $e) {
                    $trans->rollBack();
                    return [
                        'error' => 1,
                        'message' => $e->getMessage()
                    ];
                }

            }
        }
    }

    // 获取订单小组列表
    public function actionList()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $groups = OrderManageGroup::find()->all();
            $list = [];
            foreach ($groups as $group) {
                $tmp['id'] = $group['id'];
                $tmp['name'] = $group['name'];
                $list[] = $tmp;
            }

            return $list;
        }
    }

    // 获取小组成员列表
    public function actionUserList()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $id = $request->get('id');
            $users = OrderManageGroupUser::findAll(['group_id' => $id]);
            $userIds = ArrayHelper::getColumn($users, 'user_id');
            $admins = Admin::find()->where(['id' => $userIds])->indexBy('id')->asArray()->all();

            $list = [];
            foreach ($userIds as $userId) {
                $tmp['id'] = $userId;
                $tmp['name'] = $admins[$userId]['username'];
                $list[] = $tmp;
            }

            return $list;
        }
    }
}
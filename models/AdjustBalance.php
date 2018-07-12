<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "adjust_balance".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $type
 * @property string $before_money
 * @property string $money
 * @property string $final_money
 * @property string $reason
 * @property integer $status
 * @property string $order
 * @property string $note
 * @property string $admin_id
 * @property string $created_at
 */
class AdjustBalance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adjust_balance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'before_money', 'money', 'final_money', 'status', 'admin_id', 'created_at'], 'integer'],
            [['reason', 'order'], 'string', 'max' => 255],
            [['note'], 'string', 'max' => 256],
            [['admin_id', 'created_at'], 'unique', 'targetAttribute' => ['admin_id', 'created_at'], 'message' => 'The combination of Admin ID and Created At has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户名',
            'type' => '操作',
            'before_money' => 'Before Money',
            'money' => '金额',
            'final_money' => 'Final Money',
            'reason' => '调整原因',
            'status' => '状态',
            'order' => '原始订单号',
            'note' => '备注',
            'admin_id' => '操作人',
            'created_at' => 'Created At',
        ];
    }

    public static function getList($condition, $page, $pageSize)
    {
        $query = AdjustBalance::find()->leftJoin('users', 'adjust_balance.user_id = users.id')->select(['adjust_balance.*', 'users.phone', 'users.email', 'users.money as user_money']);

        if (isset($condition['startTime']) && isset($condition['endTime']) && $condition['startTime'] && $condition['endTime']) {
            $query->andWhere(['between', 'adjust_balance.created_at', strtotime($condition['startTime']), strtotime($condition['endTime'])]);
        }
        if (isset($condition['account']) && $condition['account']) {
            $query->andWhere(['or', 'users.phone="' . $condition['account'] . '"', 'users.email="' . $condition['account'] . '"']);
        }
        if (isset($condition['order']) && $condition['order']) {
            $query->andWhere(['adjust_balance.order' => $condition['order']]);
        }
        if (isset($condition['status']) && $condition['status'] != 'all') {
            $query->andWhere(['adjust_balance.status' => $condition['status']]);
        }

        $order = 'adjust_balance.created_at DESC';
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
        $result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        $admin = Admin::find()->indexBy('id')->asArray()->all();

        foreach ($result as &$one) {
            $one['admin_name'] = isset($admin[$one['admin_id']]) ? $admin[$one['admin_id']]['username'] : '';
            $one['approve_admin_name'] = isset($admin[$one['approve_admin_id']]) ? $admin[$one['approve_admin_id']]['username'] : '';
        }

        $return['rows'] = $result;
        $return['total'] = $totalCount;
        return $return;
    }
}

<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "purchase_orders".
 *
 * @property string $id
 * @property double $money
 * @property integer $status
 * @property string $note
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $admin_id
 * @property integer $approved_at
 * @property integer $approved_admin_id
 * @property integer $stored_at
 * @property integer $stored_admin_id
 */
class PurchaseOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['money'], 'number'],
            [['status', 'created_at', 'updated_at', 'admin_id', 'approved_at', 'approved_admin_id', 'stored_at', 'stored_admin_id'], 'integer'],
            [['note'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'money' => 'Money',
            'status' => 'Status',
            'note' => 'Note',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'admin_id' => 'Admin ID',
            'approved_at' => 'Approved At',
            'approved_admin_id' => 'Approved Admin ID',
            'stored_at' => 'Stored At',
            'stored_admin_id' => 'Stored Admin ID',
        ];
    }

    public static function getList($condition, $page, $pageSize)
    {
        $query = PurchaseOrder::find();
        isset($condition['orderId']) && $condition['orderId'] && $query->andWhere(['id' => $condition['orderId']]);
        isset($condition['adminId']) && $condition['adminId'] && $condition['adminId'] != 'all' && $query->andWhere(['admin_id' => $condition['adminId']]);
        isset($condition['storedAdminId']) && $condition['storedAdminId'] && $condition['storedAdminId'] != 'all' && $query->andWhere(['stored_admin_id' => $condition['storedAdminId']]);
        isset($condition['startTime']) && $condition['startTime'] && $query->andWhere(['>', 'created_at', strtotime($condition['startTime'])]);
        isset($condition['endTime']) && $condition['endTime'] && $query->andWhere(['<', 'created_at', strtotime($condition['endTime'])]);
        isset($condition['storedStartTime']) && $condition['storedStartTime'] && $query->andWhere(['>', 'stored_at', strtotime($condition['storedStartTime'])]);
        isset($condition['storedEndTime']) && $condition['storedEndTime'] && $query->andWhere(['<', 'stored_at', strtotime($condition['storedEndTime'])]);
        isset($condition['status'])  && $query->andWhere(['status' => $condition['status']]);

        $order = 'created_at DESC';
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
        $result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        $admin = Admin::find()->indexBy('id')->asArray()->all();
        foreach ($result as &$one) {
            $one['admin_name'] = isset($admin[$one['admin_id']]) ? $admin[$one['admin_id']]['username'] : '';
            $one['approved_admin_name'] = isset($admin[$one['approved_admin_id']]) ? $admin[$one['approved_admin_id']]['username'] : '';
            $one['stored_admin_name'] = isset($admin[$one['stored_admin_id']]) ? $admin[$one['stored_admin_id']]['username'] : '';
        }

        $return['rows'] = $result;
        $return['total'] = $totalCount;
        return $return;
    }
}

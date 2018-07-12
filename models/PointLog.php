<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "point_log".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $type
 * @property string $before_point
 * @property string $point
 * @property string $final_point
 * @property string $reason
 * @property string $order
 * @property string $admin_id
 * @property string $created_at
 * @property string $note
 * @property integer $updated_at
 * @property integer $approve_admin_id
 * @property string $fail_reason
 * @property integer $status
 */
class PointLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'point_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'before_point', 'point', 'final_point', 'admin_id', 'created_at', 'updated_at', 'approve_admin_id', 'status'], 'integer'],
            [['reason', 'order', 'note', 'fail_reason'], 'string', 'max' => 255],
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
            'user_id' => 'User ID',
            'type' => 'Type',
            'before_point' => 'Before Point',
            'point' => 'Point',
            'final_point' => 'Final Point',
            'reason' => 'Reason',
            'order' => 'Order',
            'admin_id' => 'Admin ID',
            'created_at' => 'Created At',
            'note' => 'Note',
            'updated_at' => 'Updated At',
            'approve_admin_id' => 'Approve Admin ID',
            'fail_reason' => 'Fail Reason',
            'status' => 'Status',
        ];
    }

    public static function getList($condition, $page, $pageSize)
    {
        $query = PointLog::find()->leftJoin('users', 'point_log.user_id = users.id')->select(['point_log.*', 'users.phone', 'users.email', 'users.money as user_money']);

        if (isset($condition['startTime']) && isset($condition['endTime']) && $condition['startTime'] && $condition['endTime']) {
            $query->andWhere(['between', 'point_log.created_at', strtotime($condition['startTime']), strtotime($condition['endTime'])]);
        }
        if (isset($condition['account']) && $condition['account']) {
            $query->andWhere(['or', 'users.phone="' . $condition['account'] . '"', 'users.email="' . $condition['account'] . '"']);
        }
        if (isset($condition['order']) && $condition['order']) {
            $query->andWhere(['point_log.order' => $condition['order']]);
        }
        if (isset($condition['status']) && $condition['status'] != 'all') {
            $query->andWhere(['point_log.status' => $condition['status']]);
        }

        $order = 'point_log.created_at DESC';
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

    public static function point($condition)
    {
        $conn = Yii::$app->db;
        $items_sql = '';
        for( $i=100;$i<=109;$i++){
            if($i == 109){
                $items_sql .= '(SELECT sum(point) as comsue FROM point_follow_'.$i.' where '.$condition.' ) ';
            }else{
                $items_sql .= '(SELECT sum(point) as comsue FROM point_follow_'.$i.' where '.$condition.' ) union all';
            }
        }
        $comsuesql = $conn->createCommand('select sum(a.comsue) as comTotal from ('.$items_sql.') as a');
        $totalComsue = $comsuesql->queryOne();
        return $totalComsue['comTotal'];
    }
}

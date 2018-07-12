<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "stats_task".
 *
 * @property string $id
 * @property string $date
 * @property integer $type
 * @property integer $level
 * @property integer $cate
 * @property integer $num
 * @property integer $count
 */
class StatsTask extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stats_task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'type', 'level', 'cate', 'num', 'count'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'type' => 'Type',
            'level' => 'Level',
            'cate' => 'Cate',
            'num' => 'Num',
            'count' => 'Count',
        ];
    }

    public static function getList($condition, $page, $pageSize)
    {
        $query = StatsTask::find();

        if ($condition['type']) {
            $query->andWhere(['type' => $condition['type']]);
        }

        $query->orderBy('date desc');

        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
        $list = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->asArray()
            ->all();

        return ['rows' => $list, 'total' => $pagination->totalCount];
    }

    public static function getDetail($where, $page, $pageSize)
    {
        $condition = ' where 1=1 ';
        if (empty($where)) {
            $condition = '';
        } else {
            if (isset($where['user_id']) && $where['user_id'] != '0') {
                $condition .= ' and user_id = ' . $where['user_id'];
            }
            if (isset($where['type']) && $where['type'] != '0') {
                $condition .= ' and type = ' . $where['type'];
            }
            if (isset($where['level']) && $where['level'] != '0') {
                $condition .= ' and level = ' . $where['level'];
            }
            if (isset($where['cate']) && $where['cate'] != '0') {
                $condition .= ' and cate = ' . $where['cate'];
            }
            if (isset($where['num']) && $where['num'] != '0') {
                $condition .= ' and num = ' . $where['num'] . '';
            }
            if (isset($where['source']) && $where['source'] != '0') {
                $condition .= ' and source = ' . $where['source'];
            }
            if (isset($where['date']) && $where['date'] != 0) {
                $condition .= ' and created_at BETWEEN ' . strtotime($where['date']) . ' AND ' . strtotime($where['date'] . '23:59:59');
            }
            if (isset($where['startTime']) && $where['startTime'] != 0) {
                $condition .= ' and created_at >=' . strtotime($where['startTime']);
            }
            if (isset($where['endTime']) && $where['endTime'] != 0) {
                $condition .= ' and created_at <' . strtotime($where['endTime']);
            }
        }

        $count_sql = '';
        for ($i = 100; $i <= 109; $i++) {
            $count_sql .= '(SELECT COUNT(1) as total FROM user_task_follow_' . $i .$condition. ' ) union all';
        }
        $count_sql = rtrim($count_sql, 'union all');
        $connection = Yii::$app->db;
        $countSql = 'SELECT SUM(total) as total FROM (' . $count_sql . ') as r';
        $c = $connection->createCommand($countSql);
        $totalCount = $c->queryScalar();

        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page -1, 'defaultPageSize' => $pageSize, 'pageSizeLimit' => [1, $pageSize]]);
        $query_sql = '';
        for ($i = 100; $i <= 109; $i++) {
            $query_sql .= '(SELECT * FROM user_task_follow_' . $i .$condition. ' ORDER BY created_at DESC limit 0,' . ($pagination->offset + $pagination->limit) . ') union all';
        }
        $query_sql = rtrim($query_sql, 'union all');
        $querySql = 'SELECT * FROM (' . $query_sql . ') as r ORDER BY created_at DESC limit ' . $pagination->offset . ',' . $pagination->limit;
        $command = $connection->createCommand($querySql);
        $result = $command->queryAll();
        $result = ArrayHelper::toArray($result);
        $uids = ArrayHelper::getColumn($result, 'user_id');
        $userInfo = User::find()->select('id, phone, email, nickname')->where(['id' => $uids])->indexBy('id')->asArray()->all();
        foreach ($result as &$one) {
            $one['nickname'] = $userInfo[$one['user_id']]['nickname'];
            $one['phone'] = $userInfo[$one['user_id']]['phone'];
            $one['email'] = $userInfo[$one['user_id']]['email'];
        }
        return ['rows' => $result, 'total' => $pagination->totalCount];
    }
}

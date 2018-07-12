<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
use yii\db\Query;

/**
 * This is the model class for table "olympic_schedules".
 *
 * @property integer $id
 * @property integer $date
 * @property string $name
 * @property integer $created_at
 */
class OlympicSchedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'olympic_schedules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'name', 'created_at'], 'required'],
            [['date', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 60],
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
            'name' => 'Name',
            'created_at' => 'Created At',
        ];
    }

    public static function getList($condition = '', $page = 1, $pageSize = 10)
    {
        $query = new Query();
        $query->from('olympic_schedules');
        if ($condition) {
            if ($condition['name'] || $condition['admin']) {
                $query->andWhere(['or', ['like', 'name', $condition['name']], ['like', 'username',
                    $condition['admin']]]);
            }
        }
        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
        $list = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return ['rows' => $list, 'total' => $pagination->totalCount];
    }
}

<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "suggestions".
 *
 * @property string $id
 * @property integer $type
 * @property string $nickname
 * @property string $phone
 * @property string $email
 * @property string $content
 * @property string $created_at
 */
class Suggestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suggestions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'created_at'], 'integer'],
            [['content'], 'required'],
            [['content'], 'string'],
            [['nickname'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'nickname' => 'Nickname',
            'phone' => 'Phone',
            'email' => 'Email',
            'content' => 'Content',
            'created_at' => 'Created At',
        ];
    }

    public static function getList($condition, $page, $pageSize)
    {
        $query = Suggestion::find();

        if (isset($condition['startTime']) && isset($condition['endTime']) && $condition['startTime'] && $condition['endTime']) {
            $query->andWhere(['between', 'created_at', strtotime($condition['startTime']), strtotime($condition['endTime'])]);
        }
        if (isset($condition['phone']) && $condition['phone']) {
            $query->andWhere(['phone' => $condition['phone']]);
        }
        if (isset($condition['email']) && $condition['email']) {
            $query->andWhere(['email' => $condition['email']]);
        }
        if (isset($condition['type']) && $condition['type'] != 'all') {
            $query->andWhere(['type' => $condition['type']]);
        }

        $order = 'created_at DESC';
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
        $result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        $return['rows'] = $result;
        $return['total'] = $totalCount;
        return $return;
    }
}

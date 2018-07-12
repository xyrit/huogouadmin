<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "black_lists".
 *
 * @property string $id
 * @property integer $type
 * @property integer $user_id
 * @property integer $created_at
 */
class BlackList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'black_lists';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'user_id', 'created_at'], 'integer'],
            [['user_id', 'type'], 'unique', 'targetAttribute' => ['user_id', 'type'], 'message' => 'The combination of Type and User ID has already been taken.']
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
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    public static function getList($condition = '', $page = 1, $pageSize = 20)
    {
        $query = BlackList::find()->leftJoin('users u', 'black_lists.user_id=u.id')->select('black_lists.*, u.phone, u.email');
        if ($condition) {
            if ($condition['type'] && $condition['type'] != 'all') {
                $query->andWhere(['black_lists.type' => $condition['type']]);
            }
            if ($condition['account']) {
                $query->andWhere(['or', 'u.phone="'.$condition['account'].'"', 'u.email="'.$condition['account'].'"']);
            }
        }
        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
        $list = $query->orderBy('black_lists.created_at desc')->offset($pagination->offset)
            ->limit($pagination->limit)
            ->asArray()
            ->all();

        return ['rows'=>$list, 'total'=>$pagination->totalCount];
    }
}

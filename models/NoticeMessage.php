<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "notice_messages".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $mode
 * @property string $type_name
 * @property string $message
 * @property integer $status
 * @property string $created_at
 */
class NoticeMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at'], 'required'],
            [[ 'mode', 'status', 'created_at'], 'integer'],
            [['type_name', 'user_id'], 'string', 'max' => 100],
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
            'mode' => 'Mode',
            'type_name' => 'Type Name',
            'message' => 'Message',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    public static function addMessage($uid, $mode, $type_name, $message, $status = 0)
    {
        $model = new NoticeMessage();
        $model->user_id = $uid;
        $model->mode = $mode;
        $model->type_name = $type_name;
        $model->message = $message;
        $model->status = $status;
        $model->created_at = time();
        $model->save(false);
    }

    public static function getList($params = [], $page = 0, $pageSize = 20)
    {
        $query = NoticeMessage::find();

        if ((isset($params['startTime']) && isset($params['endTime'])) && ($params['startTime'] && $params['endTime'])) {
            $query->andWhere(['>=', 'created_at', strtotime($params['startTime'])]);
            $query->andWhere(['<', 'created_at', strtotime($params['endTime'])]);
        }
        if (isset($params['content']) && $params['content']) {
            $query->andWhere(['user_id' => $params['content']]);
        }
        if (isset($params['type']) && $params['type'] != 'all') {
            $query->andWhere(['mode' => $params['type']]);
        }
        if (isset($params['status']) && $params['status'] != 'all') {
            $query->andWhere(['status' => $params['status']]);
        }
        if (isset($params['content']) && $params['content']) {
            $query->andWhere(['user_id' => $params['content']]);
        }
        if (isset($params['type_name']) && $params['type_name']) {
            $query->andWhere(['type_name' => $params['type_name']]);
        }

        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
        $list = $query->offset($pagination->offset)->orderBy('id desc')->limit($pagination->limit)->asArray()->all();

        return ['rows' => $list, 'total' => $totalCount];
    }
}

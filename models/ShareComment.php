<?php

namespace app\models;

use app\helpers\MyRedis;
use Yii;
use yii\base\Exception;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "share_comments".
 *
 * @property string $id
 * @property string $share_topic_id
 * @property string $content
 * @property string $user_id
 * @property string $ip
 * @property string $created_at
 */
class ShareComment extends \yii\db\ActiveRecord
{
    const NEW_TIPS = 'share_comment_';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'share_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['share_topic_id', 'user_id', 'created_at'], 'integer'],
            [['content'], 'required'],
            [['content'], 'string'],
            [['ip'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'share_topic_id' => 'Share Topic ID',
            'content' => 'Content',
            'user_id' => 'User ID',
            'ip' => 'Ip',
            'created_at' => 'Created At',
        ];
    }

    public static function getList($shareTopicId, $condition, $page, $pageSize)
    {
        $query = ShareComment::find()->leftJoin('users u', 'share_comments.user_id=u.id')->select('share_comments.*, u.phone, u.email');

        if ($shareTopicId) {
            $query->where(['share_topic_id' => $shareTopicId]);
        }

        $condition['startTime'] && $query->andWhere(['>', 'share_comments.created_at', strtotime($condition['startTime'])]);
        $condition['endTime'] && $query->andWhere(['<', 'share_comments.created_at', strtotime($condition['endTime'])]);
        isset($condition['status']) && $condition['status'] != 'all' && $query->andWhere(['share_comments.status' => $condition['status']]);
        $condition['account'] && $query->andWhere(['or', 'u.phone="' . $condition['account'] . '"', 'u.email="' . $condition['account'] . '"']);

        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
        $list = $query->orderBy('share_comments.created_at DESC')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
        foreach ($list as &$comment) {
            $comment['reply_num'] = ShareReply::find()->where(['share_comment_id' => $comment['id']])->count();
            $comment['content'] = GroupTopicComment::commentDeal($comment['content']);
        }

        $data['rows'] = $list;
        $data['total'] = $totalCount;
        return $data;
    }
}

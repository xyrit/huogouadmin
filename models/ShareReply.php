<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "share_replys".
 *
 * @property string $id
 * @property string $share_comment_id
 * @property string $content
 * @property string $user_id
 * @property string $floor
 * @property string $reply_floor
 * @property string $ip
 * @property string $created_at
 */
class ShareReply extends \yii\db\ActiveRecord
{
    const NEW_TIPS = 'share_comment_reply_';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'share_replys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['share_comment_id', 'user_id', 'floor', 'reply_floor', 'created_at'], 'integer'],
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
            'share_comment_id' => 'Share Comment ID',
            'content' => 'Content',
            'user_id' => 'User ID',
            'floor' => 'Floor',
            'reply_floor' => 'Reply Floor',
            'ip' => 'Ip',
            'created_at' => 'Created At',
        ];
    }

    /**
     * �����ظ�
     * @param $post
     * @return bool|mixed
     */
    public static function addReply($post)
    {
        $count = ShareReply::find()->where(['share_comment_id' => $post['share_comment_id']])->select('floor')->orderBy('floor DESC')->one();
        $maxFloor = empty($count['floor']) ? 0 : $count['floor'];

        $model = new ShareReply();
        $model->share_comment_id = $post['share_comment_id'];
        $model->content = $post['content'];
        $model->user_id = $post['user_id'];
        $model->floor = $maxFloor + 1;
        $model->reply_floor = isset($post['reply_floor']) ? $post['reply_floor'] : 0;
        $model->ip = Yii::$app->request->userIP;
        $model->created_at = time();

        if ($model->validate()) {
            if ($model->save()) {
                return $model->primaryKey;
            } else {
                return false;
            }
        }

        return false;
    }

    public static function getList($id, $limit = 10)
    {
        $where = ['share_comment_id' => $id];
        $query = ShareReply::find();
        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->where($where)->count(), 'defaultPageSize' => $limit]);
        $list = $query->where($where)->orderBy('created_at DESC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->asArray()
            ->all();

        return ['list' => $list, 'pagination' => $pagination];
    }

    /**
     * 后台晒单评论列表
     * @param $shareCommentId
     * @param $condition
     * @param int $page
     * @param int $pageSize
     * @return mixed
     */
    public static function adminReplyList($shareCommentId, $condition, $page = 1, $pageSize = 20)
    {
        $query = ShareReply::find()->leftJoin('users u', 'share_replys.user_id=u.id')->select('share_replys.*, u.phone, u.email')->where(['share_comment_id' => $shareCommentId]);
        $condition['startTime'] && $query->andWhere(['>', 'share_replys.created_at', strtotime($condition['startTime'])]);
        $condition['endTime'] && $query->andWhere(['<', 'share_replys.created_at', strtotime($condition['endTime'])]);
        $condition['account'] && $query->andWhere(['or', 'u.phone="' . $condition['account'] . '"', 'u.email="' . $condition['account'] . '"']);

        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
        $list = $query->orderBy('share_replys.created_at DESC')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        foreach ($list as &$one) {
            $one['content'] = GroupTopicComment::commentDeal($one['content']);
        }

        $data['rows'] = $list;
        $data['total'] = $totalCount;
        return $data;
    }
}

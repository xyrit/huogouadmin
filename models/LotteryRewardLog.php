<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
/**
 * This is the model class for table "act_lottery_reward_log".
 *
 * @property string $id
 * @property string $user_id
 * @property string $activity_id
 * @property string $reward_id
 * @property string $created_at
 */
class LotteryRewardLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'act_lottery_reward_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'reward_id', 'created_at'], 'required'],
            [['user_id', 'activity_id', 'reward_id', 'created_at'], 'integer']
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
            'activity_id' => 'Activity ID',
            'reward_id' => 'Reward ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * 获取中奖列表
     * @param  int $page    页数
     * @param  int $perpage 每页数量
     * @return [type]          [description]
     */
    public static function getList($lottery_id, $page,$perpage)
    {
        $query = LotteryRewardLog::find()->where(['activity_id'=>$lottery_id])->orderBy('id desc');
        $pages = new Pagination(['defaultPageSize' => $perpage, 'totalCount' => $query->count(), 'page' => $page - 1]);

        $list = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();

        return ['rows' => $list, 'total' => $pages->totalCount];
    }
}

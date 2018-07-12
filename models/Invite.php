<?php

namespace app\models;

use app\services\Member;
use Yii;
use yii\db\Expression;
use yii\web\Cookie;

/**
 * This is the model class for table "invite".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $invite_uid
 * @property integer $status
 * @property integer $invite_time
 */
class Invite extends \yii\db\ActiveRecord
{
    const INVITE_COOKIE_NAME = 'inviteId';

    const STATUS_UNCONSUME = 0;
    const STATUS_CONSUME = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'invite_uid', 'status', 'invite_time'], 'required'],
            [['user_id', 'invite_uid', 'status', 'invite_time'], 'integer']
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
            'invite_uid' => 'Invite Uid',
            'status' => 'Status',
            'invite_time' => 'Invite Time',
        ];
    }

    /** 设置邀请唯一ID
     * @param $homeId
     */
    public static function setInviteIdCookie($homeId)
    {
        $cookies = Yii::$app->response->cookies;
        $expire = time() + 3600*24*30;
        $cookies->add(new Cookie([
            'name' => static::INVITE_COOKIE_NAME,
            'value' => $homeId,
            'expire' => $expire,
            'domain' => '.'.DOMAIN,
        ]));
    }

    /** 获取邀请唯一ID
     * @return mixed
     */
    public static function getInviteIdCookie()
    {
        if (isset(Yii::$app->request->cookies)) {
            $cookies = Yii::$app->request->cookies;
            return $cookies->getValue(static::INVITE_COOKIE_NAME);
        }
        return '';
    }

    /** 发放佣金
     * @param $chargeUserId
     * @param $money
     * @param string $desc
     */
    public static function commissionPayoff($chargeUserId, $money, $periodId)
    {
        $invite = static::findOne(['invite_uid'=>$chargeUserId]);
        if ($invite && $invite->user_id != 0 ) {
            if ($invite->status == static::STATUS_UNCONSUME) {
                //改变邀请状态
                $invite->status = static::STATUS_CONSUME;
                $invite->save();
                //送福分和经验
                static::addPointAndExp($invite->user_id);
            }
            $commissionPrice = $money*100*0.06;//佣金(分)
            //发放佣金
            $update = User::updateAll(['commission'=>new Expression('commission +'.$commissionPrice)], ['id'=>$invite->user_id]);
            if ($update) {
                $desc = serialize(['periodId'=>$periodId]);
                static::addCommissionLog($invite->user_id, $chargeUserId, $money, $commissionPrice, InviteCommission::TYPE_PAY, $desc);
            }

        }
    }

    /** 佣金充值到余额
     * @param $chargeUserId
     * @param $money
     * @param $periodId
     * @return bool
     */
    public static function commissionRecharge($chargeUserId, $money)
    {
        if ($money<1) {
            return false;
        }
        $commissionPrice = $money*100*-1;
        $user = User::find()->where(['id'=>$chargeUserId])->one();
        $commission = $user->commission;
        if ($commission>=$commissionPrice) {
            $user->commission = $commission + $commissionPrice;
            $user->money += $money;
            $save = $user->save();
            if ($save) {
                $desc = '用户佣金提取到账户余额';
                static::addCommissionLog($chargeUserId, $chargeUserId, 0, $commissionPrice, InviteCommission::TYPE_RECHARGE, $desc);
            }
            return $save;
        }

        return false;
    }

    /** 佣金提现
     * @param $chargeUserId
     * @param $money
     * @param $desc
     * @return bool
     */
    public static function commissionWithdraw($chargeUserId, $money, $desc)
    {
        if ($money<100) {
            return false;
        }
        $commissionPrice = $money*100*-1;
        $user = User::find()->where(['id'=>$chargeUserId])->one();
        $commission = $user->commission;
        if ($commission>=$commissionPrice) {
            static::addCommissionLog($chargeUserId, $chargeUserId, 0, $commissionPrice, InviteCommission::TYPE_WITHDRAW, $desc);
        }
    }

    public static function addPointAndExp($uid)
    {
        $desc = '成功邀请1位好友并消费';
        $member = new Member(['id'=>$uid]);
        $member->editPoint(50, PointFollowDistribution::POINT_FRIEND, $desc);
        $member->editExperience(50, ExperienceFollowDistribution::EXPR_FRIEND_BUY, $desc);
    }

    public static function addCommissionLog($userId, $actionUserId, $money, $commissionPrice, $type, $desc)
    {
        $time = time();
        $commission = new InviteCommission();
        $commission->user_id = $userId;
        $commission->action_user_id = $actionUserId;
        $commission->money = $money;
        $commission->commission = $commissionPrice;
        $commission->type = $type;
        $commission->desc = $desc;
        $commission->created_time = $time;
        $commission->save();
    }

}

<?php

namespace app\models;

use app\services\Member;
use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property string $id
 * @property string $backup_phone
 * @property string $intro
 * @property integer $sex
 * @property string $birthday
 * @property integer $constellation
 * @property string $live_city
 * @property string $hometown
 * @property string $qq
 * @property integer $monthly_income
 */
class UserProfile extends \yii\db\ActiveRecord
{
    const POINTS_INTRO = 10;
    const POINTS_SEX = 5;
    const POINTS_BIRTHDAY = 5;
    const POINTS_LIVICITY = 5;
    const POINTS_HOMETOWN = 5;
    const POINTS_QQ = 5;
    const POINTS_INCOME = 5;
    const POINTS_NICKNAME = 5;
    const POINTS_PHONE = 20;
    const POINTS_EMAIL = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex', 'constellation', 'qq', 'monthly_income'], 'integer'],
            [['backup_phone', 'live_city', 'hometown'], 'string', 'max' => 50],
            [['intro'], 'string', 'max' => 255],
            [['birthday'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'backup_phone' => 'Backup Phone',
            'intro' => 'Intro',
            'sex' => 'Sex',
            'birthday' => 'Birthday',
            'constellation' => 'Constellation',
            'live_city' => 'Live City',
            'hometown' => 'Hometown',
            'qq' => 'Qq',
            'monthly_income' => 'Monthly Income',
        ];
    }

    public static function saveUserProfile($userId, $param)
    {
        $model = UserProfile::findOne(['id' => $userId]);

        $member = new Member(['id' => $userId]);
        if (!$model['intro'] && $param['intro']) {
            $member->editPoint(static::POINTS_INTRO, PointFollowDistribution::POINT_PROFILE, "完善个人资料（签名）获得福分");
        }
        if (!$model['sex'] && $param['sex']) {
            $member->editPoint(static::POINTS_SEX, PointFollowDistribution::POINT_PROFILE, "完善个人资料（性别）获得福分");
        }
        if (!$model['birthday'] && $param['birthday']) {
            $member->editPoint(static::POINTS_BIRTHDAY, PointFollowDistribution::POINT_PROFILE, "完善个人资料（生日）获得福分");
        }
        if (!$model['live_city'] && $param['live_city']) {
            $member->editPoint(static::POINTS_LIVICITY, PointFollowDistribution::POINT_PROFILE, "完善个人资料（现居地）获得福分");
        }
        if (!$model['hometown'] && $param['hometown']) {
            $member->editPoint(static::POINTS_HOMETOWN, PointFollowDistribution::POINT_PROFILE, "完善个人资料（家乡）获得福分");
        }
        if (!$model['qq'] && $param['qq']) {
            $member->editPoint(static::POINTS_QQ, PointFollowDistribution::POINT_PROFILE, "完善个人资料（qq）获得福分");
        }
        if (!$model['monthly_income'] && $param['monthly_income']) {
            $member->editPoint(static::POINTS_INCOME, PointFollowDistribution::POINT_PROFILE, "完善个人资料（月收入）获得福分");
        }

        if ($param['nickname']) {
            $userModel = User::findOne($userId);
            if (!$userModel['nickname']) {
                $member->editPoint(static::POINTS_NICKNAME, PointFollowDistribution::POINT_PROFILE, "完善个人资料（昵称）获得福分");
            }
            $userModel->nickname = $param['nickname'];
            $userModel->save();
        }

        if (!$model) {
            $model = new UserProfile();
            $model->id = $userId;
        }

        $param['backup_phone'] && $model->backup_phone = $param['backup_phone'];
        $param['intro'] && $model->intro = $param['intro'];
        $param['sex'] && $model->sex = $param['sex'];
        $param['birthday'] && $model->birthday = $param['birthday'];
        $param['constellation'] && $model->constellation = $param['constellation'];
        $param['live_city'] && $model->live_city = $param['live_city'];
        $param['hometown'] && $model->hometown = $param['hometown'];
        $param['qq'] && $model->qq = $param['qq'];
        $param['monthly_income'] && $model->monthly_income = $param['monthly_income'];

        if (!$model->save()) {
            return false;
        }

        return true;
    }
}

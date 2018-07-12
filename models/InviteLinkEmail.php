<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invite_link_email".
 *
 * @property integer $id
 * @property string $webname
 * @property string $weburl
 * @property string $logourl
 * @property string $date
 */
class InviteLinkEmail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invite_link_email';//邀请-发送邮件
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['webname', 'weburl', 'logourl', 'date'], 'required'],
            [['date'], 'safe'],
            [['webname'], 'string', 'max' => 20],
            [['weburl', 'logourl'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'webname' => '//网站名称',
            'weburl' => '//网站链接',
            'logourl' => '//logo图片',
            'date' => 'Date',
        ];
    }
}

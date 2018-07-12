<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invite_tip".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $date
 */
class InviteTip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invite_tip'; //邀请-温馨提示
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'date'], 'required'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['title'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '//温馨提示标题',
            'description' => '//温馨提示描述',
            'date' => '//添加日期',
        ];
    }
    
    public static function selectTip(){   
        return self::find()->asArray()->all();        
    }
}


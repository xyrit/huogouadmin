<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "act_qualification".
 *
 * @property string $id
 * @property string $user_id
 * @property string $num
 * @property string $created_at
 */
class ActQualification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'act_qualification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'num', 'created_at'], 'required'],
            [['user_id', 'num', 'created_at'], 'integer']
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
            'num' => 'Num',
            'created_at' => 'Created At',
        ];
    }
}

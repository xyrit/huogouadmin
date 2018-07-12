<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_signs".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $signed_at
 * @property integer $continue
 * @property integer $total
 */
class UserSign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_signs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'signed_at', 'continue', 'total'], 'integer'],
            [['user_id'], 'unique']
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
            'signed_at' => 'Signed At',
            'continue' => 'Continue',
            'total' => 'Total',
        ];
    }
}

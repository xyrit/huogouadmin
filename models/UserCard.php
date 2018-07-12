<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_card".
 *
 * @property string $id
 * @property string $user_id
 * @property string $card_id
 * @property string $activity_id
 * @property string $create_time
 */
class UserCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'card_id', 'activity_id', 'create_time'], 'integer'],
            [['create_time'], 'required']
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
            'card_id' => 'Card ID',
            'activity_id' => 'Activity ID',
            'create_time' => 'Create Time',
        ];
    }
}

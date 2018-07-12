<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_tasks".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $task_id
 * @property integer $status
 * @property integer $complete_time
 */
class UserTask extends \yii\db\ActiveRecord
{
    const USER_TASK = 'ACTIVE_USER_TASK_';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'task_id', 'status', 'complete_time'], 'integer']
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
            'task_id' => 'Task ID',
            'status' => 'Status',
            'complete_time' => 'Complete Time',
        ];
    }
}

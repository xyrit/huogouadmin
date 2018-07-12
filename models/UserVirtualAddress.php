<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_virtual_address".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $type
 * @property string $account
 * @property string $contact
 * @property integer $created_at
 * @property integer $updated_at
 */
class UserVirtualAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_virtual_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'account'], 'required'],
            [['user_id', 'type', 'created_at', 'updated_at'], 'integer'],
            [['account'], 'string', 'max' => 64],
            [['contact'], 'string', 'max' => 32]
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
            'type' => 'Type',
            'account' => 'Account',
            'contact' => 'Contact',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function editAddress($model, $params)
    {
        $params['account'] && $model->account = $params['account'];
        $params['type'] && $model->type = $params['type'];
        isset($params['contact']) && $model->contact = $params['contact'];

        if (!isset($model->id)) {
            $model->user_id = $params['user_id'];
            $model->created_at = time();
        } else {
            $model->updated_at = time();
        }

        if (!$model->save()) {
            return false;
        }

        return true;
    }
}

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
class DuibaLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'duiba_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'admin_id', 'part'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => '订单ID',
            'admin_id' => '管理员ID',
            'money' => '兑换金额',
            'part' => '充值部分',
        ];
    }
}

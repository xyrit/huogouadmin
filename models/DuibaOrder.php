<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "duiba_orders".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $order_no
 * @property integer $credits
 * @property string $appKey
 * @property integer $timestamp
 * @property string $description
 * @property string $order_num
 * @property string $type
 * @property integer $face_price
 * @property integer $actual_price
 * @property string $ip
 * @property integer $wait_audit
 * @property string $params
 * @property integer $sign
 * @property integer $status
 * @property string $error_msg
 * @property integer $created_at
 * @property integer $updated_at
 */
class DuibaOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'duiba_orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order_no', 'order_num', 'type', 'face_price', 'actual_price', 'sign', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'credits', 'timestamp', 'face_price', 'actual_price', 'wait_audit', 'sign', 'status', 'created_at', 'updated_at'], 'integer'],
            [['order_no'], 'string', 'max' => 25],
            [['appKey', 'description', 'order_num', 'type', 'ip', 'params', 'error_msg'], 'string', 'max' => 255]
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
            'order_no' => 'Order No',
            'credits' => 'Credits',
            'appKey' => 'App Key',
            'timestamp' => 'Timestamp',
            'description' => 'Description',
            'order_num' => 'Order Num',
            'type' => 'Type',
            'face_price' => 'Face Price',
            'actual_price' => 'Actual Price',
            'ip' => 'Ip',
            'wait_audit' => 'Wait Audit',
            'params' => 'Params',
            'sign' => 'Sign',
            'status' => 'Status',
            'error_msg' => 'Error Msg',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

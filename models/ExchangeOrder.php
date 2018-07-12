<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exchange_order".
 *
 * @property string $id
 * @property string $order_no
 * @property integer $admin_id
 * @property string $created_time
 */
class ExchangeOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exchange_orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'confirm_userid', 'confirm_time'], 'required'],
            [['status', 'confirm_userid', 'confirm_time', 'prepare_userid', 'prepare_time', 'deliver_userid', 'deliver_time',  'bill_time', 'id'], 'integer'],
            [['price'], 'number'],
            [['mark_text'], 'string'],
            [['platform', 'deliver_company', 'payment', 'send'], 'string', 'max' => 100],
            [['third_order', 'standard', 'deliver_order',  'bill_order'], 'string', 'max' => 255],
            [['bill', 'deliver_cost'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_no' => 'Order No',
            'admin_id' => 'Admin ID',
            'created_time' => 'Created Time',
        ];
    }
}

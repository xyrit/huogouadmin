<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "virtual_depot_log".
 *
 * @property integer $id
 * @property integer $card_id
 * @property integer $user_id
 * @property string $phone
 * @property integer $c_time
 * @property integer $admin_id
 * @property integer $order_id
 * @property string $cardno
 * @property string $cardpws
 * @property integer $activity_id
 */
class VirtualDepotLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'virtual_depot_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_id', 'user_id', 'c_time', 'admin_id', 'order_id', 'activity_id'], 'integer'],
            [['phone'], 'string', 'max' => 15],
            [['cardno', 'cardpws'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'card_id' => 'Card ID',
            'user_id' => 'User ID',
            'phone' => 'Phone',
            'c_time' => 'C Time',
            'admin_id' => 'Admin ID',
            'order_id' => 'Order ID',
            'cardno' => 'Cardno',
            'cardpws' => 'Cardpws',
            'activity_id' => 'Activity ID',
        ];
    }
}

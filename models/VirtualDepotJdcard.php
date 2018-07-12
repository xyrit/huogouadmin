<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "virtual_depot_jdcard".
 *
 * @property integer $id
 * @property string $cardno
 * @property integer $add_time
 * @property string $expirationtime
 * @property integer $status
 * @property integer $buyback
 * @property integer $backtime
 * @property integer $denomination
 * @property string $card_type
 * @property string $cardpws
 */
class VirtualDepotJdcard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'virtual_depot_jdcard';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['add_time', 'status', 'buyback', 'backtime', 'denomination'], 'integer'],
            [['cardpws'], 'required'],
            [['cardno', 'cardpws'], 'string', 'max' => 50],
            [['expirationtime'], 'string', 'max' => 30],
            [['card_type'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cardno' => 'Cardno',
            'add_time' => 'Add Time',
            'expirationtime' => 'Expirationtime',
            'status' => 'Status',
            'buyback' => 'Buyback',
            'backtime' => 'Backtime',
            'denomination' => 'Denomination',
            'card_type' => 'Card Type',
            'cardpws' => 'Cardpws',
        ];
    }
}

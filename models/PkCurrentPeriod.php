<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pk_current_periods".
 *
 * @property string $id
 * @property string $product_id
 * @property string $table_id
 * @property string $period_number
 * @property string $period_no
 * @property string $price
 * @property string $start_time
 * @property string $end_time
 */
class PkCurrentPeriod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pk_current_periods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'table_id', 'period_number', 'period_no', 'price'], 'integer'],
            [['table_id', 'period_number', 'period_no', 'start_time'], 'required'],
            [['start_time'], 'string', 'max' => 16],
            [['product_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'table_id' => 'Table ID',
            'period_number' => 'Period Number',
            'period_no' => 'Period No',
            'price' => 'Price',
            'start_time' => 'Start Time',
        ];
    }
}

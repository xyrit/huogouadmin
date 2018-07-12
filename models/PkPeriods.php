<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pk_periods".
 *
 * @property string $id
 * @property string $table_id
 * @property string $product_id
 * @property string $period_number
 * @property string $period_no
 * @property string $lucky_code
 * @property string $price
 * @property string $start_time
 * @property string $end_time
 * @property string $exciting_time
 * @property integer $size
 * @property integer $match_num
 */
class PkPeriods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pk_periods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'table_id', 'product_id', 'period_number', 'price', 'start_time', 'end_time', 'match_num'], 'required'],
            [['id', 'table_id', 'product_id', 'period_number', 'lucky_code', 'price', 'size', 'match_num'], 'integer'],
            [['period_no'], 'string', 'max' => 20],
            [['start_time', 'end_time', 'exciting_time'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_id' => 'Table ID',
            'product_id' => 'Product ID',
            'period_number' => 'Period Number',
            'period_no' => 'Period No',
            'lucky_code' => 'Lucky Code',
            'price' => 'Price',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'exciting_time' => 'Exciting Time',
            'size' => 'Size',
            'match_num' => 'Match Num',
        ];
    }
}

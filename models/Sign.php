<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "signs".
 *
 * @property string $id
 * @property integer $days
 * @property integer $type
 * @property integer $num
 */
class Sign extends \yii\db\ActiveRecord
{
    const SIGN_LIST = 'SIGN_LIST';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'signs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['days', 'type', 'num'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'days' => 'Days',
            'type' => 'Type',
            'num' => 'Num',
        ];
    }
}

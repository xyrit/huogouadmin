<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "global_config".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property integer $value_int
 * @property double $value_float
 */
class GlobalConfig extends \app\core\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'global_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['value'], 'string'],
            [['value_int'], 'integer'],
            [['value_float'], 'number'],
            [['key'], 'string', 'max' => 60],
            [['key'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'value' => 'Value',
            'value_int' => 'Value Int',
            'value_float' => 'Value Float',
        ];
    }

    public function getConfigByKey($key){
        $data = GlobalConfig::find()->where(['key'=>$key])->asArray()->one();
        return $data['value'];
    }
}

<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "keywords".
 *
 * @property string $id
 * @property integer $type
 * @property string $content
 */
class Keyword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keywords';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'content'], 'required'],
            [['type'], 'string', 'max' => 255],
            [['content'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'content' => 'Content',
        ];
    }

    public static function keywords($content)
    {
        $keywords = Keyword::find()->where(['type' => 1])->asArray()->all();
        $words = ArrayHelper::getColumn($keywords, 'content');

        foreach($words as $key => $val){
            if(strstr($content, $val) !== false){
                return 1;
            }
        }
    }
}

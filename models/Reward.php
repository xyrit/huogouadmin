<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "act_lottery_reward".
 *
 * @property string $id
 * @property string $rand
 * @property integer $lottery_id
 * @property string $name
 * @property string $content
 * @property integer $num
 * @property double $probability
 * @property string $basename
 * @property string $created_at
 */
class Reward extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'act_lottery_reward';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'content', 'probability', 'created_at', 'type'], 'required'],
            [['lottery_id', 'num', 'created_at', 'left'], 'integer'],
            [['probability'], 'number'],
            [['rand'], 'string', 'max' => 50],
            [['name', 'content', 'basename', 'icon'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rand' => 'Rand',
            'lottery_id' => 'Lottery ID',
            'name' => 'Name',
            'content' => 'Content',
            'num' => 'Num',
            'probability' => 'Probability',
            'basename' => 'Basename',
            'created_at' => 'Created At',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actives".
 *
 * @property string $id
 * @property string $title
 * @property string $sub_title
 * @property integer $flag
 * @property string $icon
 * @property string $url
 * @property string $picture
 * @property integer $status
 * @property string $created_at
 * @property integer $from
 * @property integer $min_ver
 */
class Active extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actives';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flag', 'status', 'created_at', 'type', 'list_order', 'from'], 'integer'],
            [['desc', 'min_ver'], 'string'],
            [['title', 'sub_title', 'icon', 'url'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'sub_title' => 'Sub Title',
            'flag' => 'Flag',
            'icon' => 'Icon',
            'url' => 'Url',
            'picture' => 'Picture',
            'status' => 'Status',
            'created_at' => 'Created At',
            'desc' => 'Desc',
            'list_order' => 'list_order',
            'min_ver' => 'ver'
        ];
    }
}

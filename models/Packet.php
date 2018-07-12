<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "packet".
 *
 * @property string $id
 * @property string $name
 * @property integer $num
 * @property string $desc
 * @property string $content
 * @property integer $send_num
 * @property integer $left_num
 * @property integer $create_time
 * @property integer $update_time
 */
class Packet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'packet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num', 'desc', 'create_time', 'update_time'], 'required'],
            [['num', 'send_num', 'left_num', 'create_time', 'update_time'], 'integer'],
            [['desc'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['content'], 'string', 'max' => 400]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'num' => 'Num',
            'desc' => 'Desc',
            'content' => 'Content',
            'send_num' => 'Send Num',
            'left_num' => 'Left Num',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }

    /**
     * 获取红包列表
     * @param  int $page    页数
     * @param  int $perpage 每页数量
     * @return [type]          [description]
     */
    public static function getList($page,$perpage)
    {
    	$query = Packet::find()->orderBy('create_time desc');
        $pages = new Pagination(['defaultPageSize' => $perpage, 'totalCount' => $query->count(), 'page' => $page - 1]);

        $list = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();

        return ['rows' => $list, 'total' => $pages->totalCount];
    }

    public static function getInfoById($id)
    {
        return Packet::find()->where(['id'=>$id])->asArray()->one();
    }

}
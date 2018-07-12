<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_config".
 *
 * @property integer $id
 * @property string $type
 * @property string $content
 * @property string $auth
 * @property string $time
 * @property integer $status
 * @property string $system
 * @property integer $sort
 * @property integer $from
 */
class AppConfig extends \yii\db\ActiveRecord
{
    public static $targetTypes = [
        'url' => '打开url',
        'home' => '打开首页',
        'detail' => '打开商品',
        'cate' => '打开商品分类',
        'search' => '打开商品搜索',
        'share' => '打开晒单',
        'ten' => '打开十元专区',
        'lottery' => '打开最新揭晓',
        'discover' => '打开发现页',
        'shopcart' => '打开购物车',
        'ucenter' => '打开个人中心',
        'recharge' => '打开充值页',
        'newhand' => '新手引导',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['content', 'system'], 'string'],
            [['time'], 'safe'],
            [['status', 'sort', 'from'], 'integer'],
            [['type'], 'string', 'max' => 20],
            [['auth'], 'string', 'max' => 10]
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
            'auth' => 'Auth',
            'time' => 'Time',
            'status' => 'Status',
            'system' => 'System',
            'sort' => 'Sort',
        ];
    }

    public static function addConfig($from, $type, $content, $status, $system, $sort=0)
    {
        $model = new AppConfig();
        $model->from = $from;
        $model->type = $type;
        $model->content = $content;
        $model->time = date('Y-m-d H:i:s', time());
        $model->status = $status;
        $model->system = $system;
        $model->sort = $sort;
        $model->auth = (string)Yii::$app->admin->id;
        if($model->save()) {
            return $model->id;
        } else {
            $msg = $model->getFirstErrors();
            return 0;
        }
    }

    public static function editConfig($id, $from, $type, $content, $status, $system, $sort=0)
    {
        $model = AppConfig::find()->where(['id'=>$id])->one();
        $model->type = $type;
        $model->content = $content;
        $model->time = date('Y-m-d H:i:s', time());
        $model->status = $status;
        $model->system = $system;
        $model->sort = $sort;
        $model->auth = (string)Yii::$app->admin->id;
        if($model->save()) {
            return $model->id;
        } else {
            $msg = $model->getFirstErrors();
            return 0;
        }
    }
}

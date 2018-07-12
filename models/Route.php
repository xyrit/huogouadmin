<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "route".
 *
 * @property string $id
 * @property string $url
 * @property integer $created_at
 */
class Route extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'route';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['created_at'], 'integer'],
            [['url'], 'string', 'max' => 64],
            [['url'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'url地址',
            'created_at' => 'Created At',
        ];
    }

    //获取所有url
    public static function findUrl()
    {
        $handler = opendir(Yii::getAlias('@app/controllers'));
        $arr = [];
        while( ($filename = readdir($handler)) !== false )
        {
            if($filename != '.' && $filename != '..'){
                $controller = substr($filename,0, -14);
                $controller = strtolower(preg_replace('/((?<=[a-z])(?=[A-Z]))/', '-', $controller)).'/';
                $file_path = "app\controllers\\".substr($filename, 0, -4);
                $class = new \ReflectionClass($file_path);
                $method = $class->getMethods();
                foreach($method as $key => $val){
                    if($val->class == $file_path){
                        $action = substr($val->name, 6);
                        $action = strtolower(preg_replace('/((?<=[a-z])(?=[A-Z]))/', '-', $action));
                        $url = $controller.$action;
                        $arr[] = $url;
//                        $exist = Route::find()->where(['url'=>$url])->one();
//                        if(!$exist){
//                            static::insertUrl($url);
//                        }
                    }
                }
            }
        }
        closedir($handler);
        return $arr;
    }

    public static function insertUrl($url)
    {
        $model = new Route();
        $model->url = $url;
        $model->created_at = time();
        if($model->validate()){
            $model->save();
        }
    }

    public static function getRouteList($routes, $pid = 0)
    {
        $tree = [];
        foreach($cate as $v){
            if($v['parent_id'] == $pid){
                $c['id'] = $v['id'];
                $c['text'] = $v['name'];
                $c['children'] = self::getCategory($cate, $v['id']);
                $tree[] = $c;
            }
        }

        return $tree;
    }
}

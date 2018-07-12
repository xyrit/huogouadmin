<?php

namespace app\models;
use app\models\PkOrders;
use app\models\JdcardBuybackList;
use app\models\Order;
use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $route
 * @property integer $pass
 * @property integer $show
 * @property integer $status
 * @property string $order
 * @property string $updated_at
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'required'],
            [['parent_id', 'pass', 'show', 'status', 'order', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['route'], 'string', 'max' => 50],
            [['name', 'parent_id'], 'unique', 'targetAttribute' => ['name', 'parent_id'], 'message' => 'The combination of Parent ID and Name has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => '父级菜单',
            'name' => '菜单名',
            'route' => '路由',
            'pass' => '验证',
            'show' => '显示',
            'status' => '状态',
            'order' => '排序',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getMenu($cate, $pid=0)
    {
        $tree = [];
        foreach($cate as $v){
            if($v['parent_id'] == $pid){
                $c['id'] = $v['id'];
                $c['text'] = $v['name'];
                $c['attributes'] = ['url' => $v['route']];
                $c['children'] = self::getMenu($cate, $v['id']);
                $tree[] = $c;
            }
        }

        return $tree;
    }

    public static function menuTree($all, $pid = 0)
    {
        $tree = [];
        foreach($all as $v){
            if($v['parent_id'] == $pid){
                $c['id'] = $v['id'];
                $c['text'] = $v['name'];
                $c['children'] = self::menuTree($all, $v['id']);
                $tree[] = $c;
            }
        }

        return $tree;
    }

    public static function menuList($all, $pid = 0, $level = 1, &$result = [])
    {
        foreach ($all as $v) {
            if ($v['parent_id'] == $pid) {
                $c['id'] = $v['id'];
                $c['name'] = $v['name'];
                $c['parent_id'] = $v['parent_id'];
                $c['level'] = $level;
                $result[] = $c;
                self::menuList($all, $v['id'], $level + 1, $result);
            }
        }
    }
}

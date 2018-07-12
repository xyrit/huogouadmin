<?php

namespace app\models;

use Yii;

use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "backstage_log".
 *
 * @property string $id
 * @property string $admin_id
 * @property integer $module
 * @property string $content
 * @property string $created_at
 */
class BackstageLog extends \yii\db\ActiveRecord
{
    // 1中奖模块  2商品模块  3分类模块  4 品牌模块  5 佣金模块 6 佣金处理模块
    const ORDER_MODULE = 1;
    const PRODUCT_MODULE = 2;
    const CATE_MODULE = 3;
    const BRAND_MODULE = 4;
    const FINANCE_MODULE = 5;
    const FINANCE_DEAL_MODULE = 6;
    const BALANCE_MODULE = 7;
    const POINT_MODULE = 8;
    const DELIVER_MODULE = 9;
    const GROUP_MODULE = 10;

    private static $tableId ;

    public static function instantiate($row)
    {
        return new static(static::$tableId);
    }

    public function __construct($tableId, $config = [])
    {
        parent::__construct($config);
        static::$tableId = $tableId;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        $tableId = substr(static::$tableId, 0, 1);
        return 'backstage_log_' . '10'.$tableId;
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id', 'module', 'created_at'], 'required'],
            [['admin_id', 'created_at', 'module'], 'integer'],
            [['content'], 'string', 'max' => 255],
            [['admin_id', 'created_at'], 'unique', 'targetAttribute' => ['admin_id', 'created_at'], 'message' => 'The combination of Admin ID and Created At has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_id' => 'Admin ID',
            'module' => 'Module',
            'content' => 'Content',
            'created_at' => 'Created At',
        ];
    }

    /**
     * 添加记录
     **/
    public static function addLog($admin_id = '', $module_id, $content)
    {
        if(!$admin_id) $admin_id = Yii::$app->admin->id;
        $model = new BackstageLog($admin_id);
        $model->admin_id = $admin_id;
        $model->module = $module_id;
        $model->content = $content;
        $model->created_at = time();
        $model->save();
    }

    /**
     * 获取所有记录
     **/
    public static function fetchAllRecords($where = [], $page = 1, $perpage = 25){
        $itemSql = "";
        for ($i=0; $i < 10; $i++) {
            $itemModel = new BackstageLog($i);
            $itemSql .= "(select * from ".$itemModel::tableName('10'.$i).") union ";
        }
        $itemSql = substr($itemSql,0,-6);

        $itemSql = 'SELECT * FROM (' . $itemSql . ') as log LEFT JOIN menu ON log.module = menu.id';

        $condition = ' where 1=1 ';
        if (empty($where)) {
            $condition = '';
        } else {
            if(isset($where['module']) && $where['module'] != 'all') {
                $condition .= ' and (log.module = ' . $where['module'] . ' or menu.parent_id = ' . $where['module'] . ')';
            }
            if(isset($where['content']) && $where['content'] != ''){
                $user = Admin::find()->where(['real_name' => $where['content']])->one();
                if($user){
                    $condition .= ' and log.admin_id = '.$user['id'].'';
                }else{
                    $condition .= ' and log.content like "%'.$where['content'].'%"';
                }
            }
            if (isset($where['startTime']) && !empty($where['startTime']) && isset($where['endTime']) && !empty($where['endTime'])) {
                $condition .= ' and log.created_at BETWEEN ' . strtotime($where['startTime']) . ' AND ' . strtotime($where['endTime']);
            }
        }

        $connection = \Yii::$app->db;
        $c = $connection->createCommand($itemSql . $condition);
        $totalCount = $c->query()->rowCount;
        $pagination = new Pagination(['totalCount' => $totalCount, 'page'=>$page -1, 'defaultPageSize'=>$perpage,'pageSizeLimit'=>[1,$perpage]]);

        $sql = $itemSql .$condition.' order by log.created_at desc limit '.  $pagination->offset . ',' . $pagination->limit;

        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        $result = ArrayHelper::toArray($result);

        return ['rows'=>$result, 'total'=>$totalCount];
    }
}

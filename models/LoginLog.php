<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "login_log".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $type
 * @property integer $action
 * @property string $ip
 * @property string $created_at
 */
class LoginLog extends \yii\db\ActiveRecord
{
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
        $tableId = substr(static::$tableId, 0, 3);
        return 'login_log_' . $tableId;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at'], 'required'],
            [['user_id', 'type', 'action', 'ip', 'created_at'], 'integer'],
            [['user_id', 'created_at'], 'unique', 'targetAttribute' => ['user_id', 'created_at'], 'message' => 'The combination of User ID and Created At has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'action' => 'Action',
            'ip' => 'Ip',
            'created_at' => 'Created At',
        ];
    }

    public static function findByHomeId($homeId) {
        $model = new static($homeId);
        return $model::find();
    }

    public static function addLog($uid, $action = 0, $type = 0)
    {
        $user = \app\models\User::findOne($uid);
        $model = new LoginLog($user['home_id']);
        $model->user_id = $uid;
        $model->type = $type;
        $model->action = $action;
        $model->ip = ip2long(Yii::$app->request->getUserIP());
        $model->created_at = time();
        $model->save();
    }

    /**
     * 获取所有记录
     **/
    public static function fetchAllRecords($where = [], $page = 1, $perpage = 25){
        $itemSql = "";
        for ($i=0; $i < 10; $i++) {
            $itemSql .= "(select * from login_log_10".$i.") union ";
        }
        $itemSql = substr($itemSql,0,-6);

        $condition = ' where 1=1 ';
        if (empty($where)) {
            $condition = '';
        } else {
            if(isset($where['type']) && $where['type'] != 'all') $condition .= ' and type = '.$where['type'].'';
            if(isset($where['content']) && $where['content'] != ''){
                $user = User::find()->where(['or', 'email="'.$where['content'].'"', 'phone="'.$where['content'].'"',  'nickname="'.$where['content'].'"'])->one();
                $condition .= ' and user_id = '.$user['id'].'';
            }
            if (isset($where['startTime']) && !empty($where['startTime']) && isset($where['endTime']) && !empty($where['endTime'])) {
                $condition .= ' and created_at BETWEEN ' . strtotime($where['startTime']) . ' AND ' . strtotime($where['endTime']);
            }
        }

        $connection = \Yii::$app->db;
        $c = $connection->createCommand("select count(*) from (".$itemSql.") as a ".$condition);
        $totalCount = $c->queryScalar();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page'=>$page -1, 'defaultPageSize'=>$perpage,'pageSizeLimit'=>[1,$perpage]]);

        $sql = "select * from (".$itemSql.") as a " .$condition.' order by created_at desc limit '.  $pagination->offset . ',' . $pagination->limit;

        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        $result = ArrayHelper::toArray($result);

        return ['rows'=>$result, 'total'=>$totalCount];
    }
}

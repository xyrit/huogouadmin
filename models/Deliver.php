<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "deliver".
 *
 * @property string $id
 * @property integer $status
 * @property integer $confirm_userid
 * @property string $confirm_time
 * @property string $platform
 * @property string $third_order
 * @property double $price
 * @property string $standard
 * @property string $mark_text
 * @property string $deliver_company
 * @property string $deliver_order
 * @property integer $prepare_userid
 * @property string $prepare_time
 * @property integer $deliver_userid
 * @property string $deliver_time
 * @property integer $is_exchange
 * @property string $bill
 * @property string $bill_time
 * @property string $bill_num
 * @property string $payment
 * @property string $send
 * @property string $bill_order
 * @property string $deliver_cost
 */
class Deliver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deliver';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'confirm_userid', 'confirm_time'], 'required'],
            [['status', 'confirm_userid', 'confirm_time', 'prepare_userid', 'prepare_time', 'deliver_userid', 'deliver_time', 'is_exchange',  'id'], 'integer'],
            [['price'], 'number'],
            [['mark_text'], 'string'],
            [['platform', 'deliver_company', 'payment', 'send'], 'string', 'max' => 100],
            [['third_order', 'standard', 'deliver_order', 'bill_time','bill_num', 'bill_order'], 'string', 'max' => 255],
            [['bill', 'deliver_cost'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'confirm_userid' => 'Confirm Userid',
            'confirm_time' => 'Confirm Time',
            'platform' => 'Platform',
            'third_order' => 'Third Order',
            'price' => 'Price',
            'standard' => 'Standard',
            'mark_text' => 'Mark Text',
            'deliver_company' => 'Deliver Company',
            'deliver_order' => 'Deliver Order',
            'prepare_userid' => 'Prepare Userid',
            'prepare_time' => 'Prepare Time',
            'deliver_userid' => 'Deliver Userid',
            'deliver_time' => 'Deliver Time',
            'is_exchange' => 'Is Exchange',
            'bill' => 'Bill',
            'bill_time' => 'Bill Time',
            'bill_num' => 'Bill Num',
            'payment' => 'Payment',
            'send' => 'Send',
            'bill_order' => 'Bill Order',
            'deliver_cost' => 'Deliver Cost',
        ];
    }

    /**
     * 第三方平台发货列表
     *
     */
    public static function thirdPlatformDeliverList($status = 'all', $perpage = 10, $delivery = 1, $condition)
    {
        $query = new Query();
        $query->from('orders a')->select('a.*,b.prepare_userid, b.third_order, b.price,c.name,c.price as product_price')->leftJoin('deliver b', 'a.id = b.id')->leftJoin('products c', 'a.product_id = c.id')
            ->leftJoin('users d', 'a.user_id = d.id');

        if($status == 'all' || $status == ''){
            $where = ['or', 'a.status=2', 'a.status=3'];
            $query->andWhere($where);
        }else{
            $where = ['a.status'=>$status];
            $query->andWhere($where);
        }

        if(!empty($condition)){
            if($condition['content']){
                $content = ['or', 'a.id = "'.$condition['content'].'"', 'c.name like "%'.$condition['content'].'%"'];
                $query->andWhere($content);
            }
            if($condition['startTime']) $query->andWhere(['>=', 'create_time', strtotime($condition['startTime'])]);
            if($condition['endTime']) $query->andWhere(['<', 'create_time', strtotime($condition['endTime'])]);
            if($condition['name']) $query->andWhere(['or', 'email="'.$condition['name'].'"', 'phone="'.$condition['name'].'"', 'nickname="'.$condition['name'].'"']);
        }

        $query->andWhere(['c.delivery_id'=>$delivery]);

        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' =>$perpage, 'pageSizeLimit'=>[0, PHP_INT_MAX]]);
        $list = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('a.confirm_addr_time asc')
            ->all();
        return ['list'=>$list, 'total'=>$pagination->totalCount];
    }

    /**
     * 详情页
     */
    public static function orderDetail($id)
    {
        $connection = \Yii::$app->db;
        $sql = "select deliver.*,deliver.price as actual_price, deliver.mark_text as deliver_market, c.* from deliver left join orders as c on deliver.id = c.id where c.id= '".$id."'";
        $command = $connection->createCommand($sql);
        $result = $command->queryOne();

        return $result;
    }

    /**
     * 获取员工名字
     */
    public static function getEmployeeName()
    {
        $all = Admin::find()->all();
        return ArrayHelper::map($all, 'id', 'real_name');
    }
}

<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "free_products".
 *
 * @property integer $id
 * @property string $name
 * @property string $brief
 * @property string $intro
 * @property integer $price
 * @property integer $marketable
 * @property string $picture
 * @property string $bn
 * @property string $barcode
 * @property integer $delivery_id
 * @property integer $order_manage_gid
 * @property integer $total_period
 * @property integer $list_order
 * @property integer $start_type
 * @property string $start_time
 * @property integer $after_end
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $admin_id
 */
class FreeProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'free_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'picture', 'delivery_id', 'order_manage_gid', 'start_time', 'after_end', 'created_at', 'updated_at'], 'required'],
            [['price', 'marketable', 'delivery_id', 'order_manage_gid', 'total_period', 'list_order', 'start_type', 'after_end', 'created_at', 'updated_at', 'admin_id'], 'integer'],
            [['name', 'brief', 'picture', 'bn'], 'string', 'max' => 255],
            [['barcode'], 'string', 'max' => 25],
            ['start_type', 'in', 'range'=>[0,1,2,3]],
            ['start_time', 'validateStartTime'],
            [['intro'], 'string'],
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
            'brief' => 'Brief',
            'price' => 'Price',
            'marketable' => 'Marketable',
            'picture' => 'Picture',
            'bn' => 'Bn',
            'barcode' => 'Barcode',
            'delivery_id' => 'Delivery ID',
            'order_manage_gid' => 'Order Manage Gid',
            'total_period' => 'Total Period',
            'list_order' => 'List Order',
            'start_type' => 'Start Type',
            'start_time' => 'Start Time',
            'after_end' => 'After End',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'admin_id' => 'Admin ID',
        ];
    }

    public function validateStartTime($attribute, $params)
    {
        $startType = $this->start_type;

        $arrStartTime = explode(' ', $this->start_time);
        if ($startType==0) {//具体时间
            if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $arrStartTime[0], $matches)) {
                $this->addError($attribute, 'start_time 格式不正确');
            }
        } elseif($startType==1) {//每天
            if ($arrStartTime[0]) {
                $this->addError($attribute, 'start_time 格式不正确');
            }
        } elseif($startType==2) {//每周
            if (!in_array($arrStartTime[0], [1,2,3,4,5,6,7])) {
                $this->addError($attribute, 'start_time 格式不正确');
            }
        } elseif($startType=3) {//每月
            if (!($arrStartTime[0]>=1 && $arrStartTime[0]<=28)) {
                $this->addError($attribute, 'start_time 格式不正确');
            }
        }
    }

    public static function market($product, $market)
    {
        return FreeProduct::updateAll(['marketable'=>$market],['id'=>$product->id]);
    }

    public static function getList($condition, $page = 1, $pageSize = 20)
    {
        $query = FreeProduct::find();
        if ($condition) {
            if ($condition['marketable']!='all') {
                $query->where(['marketable'=>$condition['marketable']]);
            }
        }
        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'defaultPageSize' => $pageSize ]);
        $list = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('id desc')
            ->asArray()
            ->all();
        return ['rows' => $list, 'total' => $pagination->totalCount];;
    }
}



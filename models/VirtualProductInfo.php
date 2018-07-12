<?php

namespace app\models;

use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "virtual_product_info".
 *
 * @property string $id
 * @property string $user_id
 * @property string $order_id
 * @property integer $type
 * @property string $account
 * @property string $contact
 * @property string $note
 * @property string $created_at
 */
class VirtualProductInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'virtual_product_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order_id', 'account', 'created_at'], 'required'],
            [['user_id', 'type', 'created_at'], 'integer'],
            [['order_id'], 'string', 'max' => 25],
            [['account', 'contact'], 'string', 'max' => 32],
            [['note'], 'string', 'max' => 255],
            [['order_id'], 'unique']
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
            'order_id' => 'Order ID',
            'type' => 'Type',
            'account' => 'Account',
            'name' => 'Name',
            'contact' => 'Contact',
            'note' => 'Note',
            'created_at' => 'Created At',
        ];
    }

    /**
     * 虚拟物品确认信息
     * @param $param
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function virutalProductSubmit($param)
    {
        $trans = Yii::$app->db->beginTransaction();

        try {
            $addressInfo = UserVirtualAddress::findOne($param['addressid']);
            $model = VirtualProductInfo::findOne(['order_id' => $param['orderId']]);
            if (!$model) {
                $model = new VirtualProductInfo();
            }
            $model->type = $addressInfo['type'];
            $model->account = $addressInfo['account'];
            $model->contact = $addressInfo['contact'];
            $model->note = $param['mark_text'];
            $model->order_id = $param['orderId'];
            $model->user_id = $param['user_id'];
            $model->created_at = time();
            if ($model->save()) {
                $params = array();
                $params['mark_text'] = $param['mark_text'];
                $params['last_modified'] = time();
                $params['status'] = 1;
                $params['confirm_addr_time'] = time();

                if (!Order::updateAll($params, ['id' => $param['orderId']])) {
                    $trans->rollBack();
                    return false;
                }

                $userInfo = \app\services\User::baseInfo($param['user_id']);
                $orderInfo = Order::findOne($param['orderId']);
                $productInfo = Product::findOne($orderInfo['product_id']);
                $data['nickname'] = $userInfo['username'];
                $data['goodsName'] = $productInfo['name'];
                $data['orderNo'] = $param['orderId'];
                $data['address'] = '话费充值 ' . $addressInfo['account'];
                $data['time'] = date("Y-m-d H:i:s");
                \app\helpers\Message::send(13, $param['user_id'], $data);

                $trans->commit();
                return true;
            } else {
                $trans->rollBack();
                return false;
            }
        } catch (Exception $e) {
            $trans->rollBack();
            return false;
        }
    }
}

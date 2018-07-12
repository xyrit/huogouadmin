<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase_order_items".
 *
 * @property string $id
 * @property integer $purchase_order_id
 * @property integer $supplier_id
 * @property integer $product_id
 * @property integer $product_num
 * @property double $supplier_price
 * @property double $privilege
 */
class PurchaseOrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchase_order_id', 'supplier_id', 'product_id', 'product_num'], 'integer'],
            [['supplier_price', 'privilege'], 'number'],
            [['purchase_order_id', 'product_id'], 'unique', 'targetAttribute' => ['purchase_order_id', 'product_id'], 'message' => 'The combination of Purchase Order ID and Product ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'purchase_order_id' => 'Purchase Order ID',
            'supplier_id' => 'Supplier ID',
            'product_id' => 'Product ID',
            'product_num' => 'Product Num',
            'supplier_price' => 'Supplier Price',
            'privilege' => 'Privilege',
        ];
    }
}

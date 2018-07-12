<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier_products".
 *
 * @property string $id
 * @property integer $supplier_id
 * @property integer $product_id
 * @property double $price
 */
class SupplierProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'product_id'], 'integer'],
            [['price'], 'number'],
            [['supplier_id', 'product_id'], 'unique', 'targetAttribute' => ['supplier_id', 'product_id'], 'message' => 'The combination of Supplier ID and Product ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'supplier_id' => 'Supplier ID',
            'product_id' => 'Product ID',
            'price' => 'Price',
        ];
    }
}

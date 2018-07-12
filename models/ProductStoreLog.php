<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_store_logs".
 *
 * @property string $id
 * @property integer $product_id
 * @property integer $type
 * @property integer $num
 * @property integer $final_store
 * @property string $reason
 * @property integer $created_at
 * @property integer $admin_id
 */
class ProductStoreLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_store_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'type', 'num', 'final_store', 'created_at', 'admin_id'], 'integer'],
            [['reason'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'type' => 'Type',
            'num' => 'Num',
            'final_store' => 'Final Store',
            'reason' => 'Reason',
            'created_at' => 'Created At',
            'admin_id' => 'Admin ID',
        ];
    }

    //插入记录  type 1入库 2出库 3修改
    public static function insertRecord($product_id,$type,$num, $final_store, $reason)
    {
        $model = new ProductStoreLog();
        $model->product_id = $product_id;
        $model->type = $type;
        $model->num = $num;
        $model->final_store = $final_store;
        $model->reason = $reason;
        $model->admin_id = Yii::$app->admin->id;
        $model->created_at = time();
        $model->save();
    }
}

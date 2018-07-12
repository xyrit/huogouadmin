<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "suppliers".
 *
 * @property string $id
 * @property string $name
 * @property string $contact
 * @property string $contact_way
 * @property string $address
 * @property integer $product_num
 * @property integer $created_at
 * @property integer $admin_id
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suppliers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_num', 'created_at', 'admin_id'], 'integer'],
            [['name', 'address'], 'string', 'max' => 64],
            [['contact'], 'string', 'max' => 32],
            [['contact_way'], 'string', 'max' => 16],
            [['name'], 'unique']
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
            'contact' => 'Contact',
            'contact_way' => 'Contact Way',
            'address' => 'Address',
            'product_num' => 'Product Num',
            'created_at' => 'Created At',
            'admin_id' => 'Admin ID',
        ];
    }

    public static function getList($condition, $page, $pageSize)
    {
        $query = Supplier::find();
        if ($condition['name']) {
            $query->andWhere(['name' => $condition['name']]);
        }

        $order = 'created_at DESC';
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
        $result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        $return['rows'] = $result;
        $return['total'] = $totalCount;
        return $return;
    }

    public static function supplierList()
    {
        $all = Supplier::find()->all();
        return ArrayHelper::map($all, 'id', 'name');
    }

}

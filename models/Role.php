<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "roles".
 *
 * @property string $id
 * @property string $name
 * @property string $privilege
 * @property string $created_at
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'required'],
            [['created_at'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['privilege'], 'string', 'max' => 255]
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
            'privilege' => 'Privilege',
            'created_at' => 'Created At',
        ];
    }

    public static function getList($page, $pageSize)
    {
        $query = Role::find();
        $pages = new Pagination(['defaultPageSize' => $pageSize, 'totalCount' => $query->count(), 'page' => $page - 1]);

        $roles = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();

        return ['rows' => $roles, 'total' => $pages->totalCount];
    }
}

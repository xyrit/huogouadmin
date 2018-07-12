<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
/**
 * This is the model class for table "coupon".
 *
 * @property string $id
 * @property string $name
 * @property string $icon
 * @property integer $type
 * @property string $amount
 * @property string $condition
 * @property string $desc
 * @property integer $num
 * @property integer $receive_limit
 * @property integer $send_num
 * @property integer $left_num
 * @property integer $use_num
 * @property integer $status
 * @property integer $valid_type
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $valid
 * @property integer $create_time
 * @property integer $update_time
 */
class Coupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'desc', 'left_num', 'valid_type', 'create_time', 'update_time'], 'required'],
            [['type', 'num', 'receive_limit', 'send_num', 'left_num', 'use_num', 'status', 'valid_type', 'start_time', 'end_time', 'valid', 'create_time', 'update_time'], 'integer'],
            [['desc'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['icon', 'amount'], 'string', 'max' => 100],
            [['condition'], 'string', 'max' => 200]
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
            'icon' => 'Icon',
            'type' => 'Type',
            'amount' => 'Amount',
            'condition' => 'Condition',
            'desc' => 'Desc',
            'num' => 'Num',
            'receive_limit' => 'Receive Limit',
            'send_num' => 'Send Num',
            'left_num' => 'Left Num',
            'use_num' => 'Use Num',
            'status' => 'Status',
            'valid_type' => 'Valid Type',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'valid' => 'Valid',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
    /**
	 * 获取优惠券列表
	 * @param  int $page    页数
	 * @param  int $perpage 每页数量
	 * @return [type]          [description]
	 */
	public static function getList($page,$perpage)
	{
		$query = Coupon::find()->orderBy('create_time desc');
	    $pages = new Pagination(['defaultPageSize' => $perpage, 'totalCount' => $query->count(), 'page' => $page - 1]);

	    $list = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();

	    return ['rows' => $list, 'total' => $pages->totalCount];
	}

	/**
	 * 获取所有优惠券
	 * @return [type] [description]
	 */
	public static function getAllList()
	{
		$list = Coupon::find()->orderBy('create_time desc')->asArray()->all();
		$all = '';
		foreach ($list as $key => $value) {
			$all[$value['id']] = $value;
		}
		return $all;
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/25
 * Time: 17:16
 */

namespace app\models;


class NoticeRead extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'notice_read';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'type', 'notice_id'], 'required'],
			[['user_id', 'type', 'notice_id', 'view', 'open', 'created_time'], 'integer']
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => '编号',
			'user_id' => '用户id',
			'type' => '公告类型',
			'notice_id' => '公告id',
			'view' => '是否查看',
			'open' => '是否开启',
			'created_time' => '更新时间'
		];
	}
}
<?php

namespace app\models;

use app\helpers\Message;
use app\services\Member;
use Yii;

/**
 * This is the model class for table "act_rich_log".
 *
 * @property string $id
 * @property string $user_id
 * @property string $money
 * @property integer $type
 * @property string $created_at
 */
class ActRichLog extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'act_rich_log';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'money', 'type', 'created_at'], 'integer'],
			[['created_at'], 'required']
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
			'money' => 'Money',
			'type' => 'Type',
			'created_at' => 'Created At',
		];
	}

	public static function addLog($user_id, $money, $type, $rank, $time)
	{
		$model = new ActRichLog();
		$model->user_id = $user_id;
		$model->money = $money;
		$model->type = $type;
		$model->rank = $rank;
		$model->datetime = $time;
		$model->created_at = time();
		if ($model->save()) return $model->primaryKey;
		else return 0;
	}

	/**
	 * 土豪榜奖品
	 **/
	public static function richReward($type)
	{
		$model = Config::find()->where('`key` = "' . $type . '"')->one();
		//$content = json_decode( json_encode( $model['value']),true);var_dump($content);die;
		$content = json_decode($model['value']);
		$rewards = [];
		foreach ($content as $val) {
			$object = json_decode(json_encode($val), true);
			$rewards[$object['rank']]['type'] = $object['type'];
			$rewards[$object['rank']]['name'] = $object['name'];
			$rewards[$object['rank']]['picture'] = $object['picture'];
		}
		return $rewards;
	}

	//统计整除返现数据
	public static function richCount($start, $end)
	{
		$list = ActRichLog::find()->where(['status' => 1])->andWhere("last_modify >= '" . $start . "' and last_modify < '" . $end . "'")->all();
		$count = 0;
		$point = 0;
		$dayRewards = self::richReward('richdayconfig');
		$monthRewards = self::richReward('richmonthconfig');
		if ($list) {
			foreach ($list as $val) {
				if ($val['type'] == 1) {
					$reward = $dayRewards[$val['rank']];
				} elseif ($val['type'] == 3) {
					$reward = $monthRewards[$val['rank']];
				}
				if (isset($reward['type'])) {
					if ($reward['type'] == 2) {
						$count += $reward['name'];
					} elseif ($reward['type'] == 3) {
						$total = sprintf("%.2f", ($val['money'] * ($reward['name'] / 100)));
						$arr = explode('.', $total);
						$first = floor($arr[0]);
						$second = floor($arr[1]);
						if (isset($first) && $first != 0) {
							$count += $first;
						}
						if (isset($second) && $second != 0) {
							$point += $second;
						}
					}
				}

			}
		}
		return ['money' => $count, 'point' => $point];
	}
}

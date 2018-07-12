<?php

namespace app\models;

use app\helpers\DateFormat;
use Yii;
use app\models\PaymentOrderItemDistribution as PayItem;
use yii\data\Pagination;

/**
 * This is the model class for table "payment_orders_100".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $status
 * @property integer $payment
 * @property string $bank
 * @property integer $money
 * @property integer $point
 * @property integer $total
 * @property integer $ip
 * @property integer $source
 * @property integer $create_time
 * @property integer $buy_time
 */
class PaymentOrderDistribution extends \yii\db\ActiveRecord
{
	const STATUS_PAID = 1;
	const STATUS_UNPAY = 0;

	private static $_tableId;

	public static function instantiate($row)
	{
		return new static(static::$_tableId);
	}

	public function __construct($tableId, $config = [])
	{
		parent::__construct($config);
		static::$_tableId = $tableId;
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		$tableId = substr(static::$_tableId, 0, 3);
		return 'payment_orders_' . $tableId;
	}

	public static function getTableIdByOrderId($orderId)
	{
		return substr($orderId, 0, 3);
	}

	public static function getTableIdByUserHomeId($userHomeId)
	{
		return substr($userHomeId, 0, 3);
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'user_id', 'payment', 'money', 'point', 'total', 'ip'], 'required'],
			[['user_id', 'status', 'payment', 'money', 'point', 'total', 'user_point', 'ip', 'source'], 'integer'],
			[['bank'], 'string', 'max' => 30]
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
			'status' => 'Status',
			'payment' => 'Payment',
			'bank' => 'Bank',
			'money' => 'Money',
			'point' => 'Point',
			'total' => 'Total',
			'user_point' => 'UserPoint',
			'ip' => 'Ip',
			'source' => 'Source',
			'create_time' => 'Create Time',
			'buy_time' => 'Buy Time',
		];
	}

	/**
	 * @param $tableId
	 * @return \yii\db\ActiveQuery the newly created [[ActiveQuery]] instance.
	 */
	public static function findByTableId($tableId)
	{
		$model = new static($tableId);
		return $model::find();
	}

	/**
	 * @param $tableId
	 * @param $condition
	 * @return \yii\db\ActiveRecord|null ActiveRecord instance matching the condition, or `null` if nothing matches.
	 */
	public static function findOneByTableId($tableId, $condition)
	{
		$model = new static($tableId);
		return $model::findOne($condition);
	}

	/**
	 * @param $tableId
	 * @param $condition
	 * @return \yii\db\ActiveRecord[] an array of ActiveRecord instances, or an empty array if nothing matches.
	 */
	public static function findAllByTableId($tableId, $condition)
	{
		$model = new static($tableId);
		return $model::findAll($condition);
	}

	/** 生成订单Id
	 * @param $userHomeId
	 * @return string
	 */
	public static function generateOrderId($userHomeId)
	{
		$tableId = substr($userHomeId, 0, 3);
		list($sec, $usec) = explode('.', microtime(true));
		$orderId = $tableId . date('YmdHis') . $usec . mt_rand(10, 99) . '1';
		return $orderId;
	}

	/**
	 * 获取所有订单
	 * @param  string $time 时间
	 * @param  string $type > < >= <= =
	 * @return [type]       [description]
	 */
	public static function fetchAllOrdersByTimes($time, $type, $limit, $orderBy = "buy_time desc", $tableNum = 10, $page = 1, $end_time = '')
	{
		$listSql = $itemSql = "";
		$where = " where buy_time " . $type . $time;
		if ($end_time) {
			$where += " and buy_time <= " . $end_time;
		}
		for ($i = 0; $i < $tableNum; $i++) {
			$model = new static('10' . $i);
			$listSql .= "(select * from " . $model::tableName('10' . $i) . $where . ") union ";
			$itemModel = new PayItem('10' . $i);
			$itemSql .= "(select * from " . $itemModel::tableName('10' . $i) . ") union ";
		}
		$listSql = substr($listSql, 0, -6);
		$itemSql = substr($itemSql, 0, -6);
		$sql = "select * from (" . $listSql . ") a left join (" . $itemSql . ") b on a.id=b.payment_order_id order by " . $orderBy . " limit " . $limit * ($page - 1) . "," . $limit;

		$command = \Yii::$app->db->createCommand($sql);
		$result = $command->queryAll();
		return $result;
	}

	public static function getOrder($where = [], $page = 1, $perpage = 25)
	{
		$condition = ' where 1=1 ';
		if (empty($where)) {
			$condition = '';
		} else {
			if (isset($where['status']) && $where['status'] != '0') {
				if ($where['status'] == 1) {
					$condition .= ' and (point > 0 or money > 0) ';
				} elseif ($where['status'] == 2) {
					$condition .= ' and (point = 0 and money = 0) ';
				}
			}
			if (isset($where['id']) && $where['id'] != '') {
				$condition .= ' and id = "' . $where['id'] . '"';
			}
			if (isset($where['user_id']) && $where['user_id'] != '') {
				$condition .= ' and user_id = ' . $where['user_id'] . '';
			}
			if (isset($where['start']) && !empty($where['start']) && isset($where['end']) && !empty($where['end'])) {
				$condition .= ' and create_time BETWEEN ' . strtotime($where['start']) . ' AND ' . strtotime($where['end']);
			}
		}

		$count_sql = '';
		for ($i = 100; $i <= 109; $i++) {
			$count_sql .= '(SELECT COUNT(1) as total FROM payment_orders_' . $i . $condition . ' ) UNION ALL';
		}
		$count_sql = rtrim($count_sql, 'UNION ALL');
		$connection = \Yii::$app->db;
		$countSql = 'SELECT SUM(total) as total FROM (' . $count_sql . ') as r';
		$c = $connection->createCommand($countSql);
		$totalCount = $c->queryScalar();

		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage, 'pageSizeLimit' => [1, $perpage]]);
		$query_sql = '';
		for ($i = 100; $i <= 109; $i++) {
			$query_sql .= '(SELECT * FROM payment_orders_' . $i . $condition . ' ORDER BY buy_time DESC limit 0,' . ($pagination->offset + $pagination->limit) . ') UNION ALL';
		}
		$query_sql = rtrim($query_sql, 'UNION ALL');
		$querySql = 'SELECT * FROM (' . $query_sql . ') as r ORDER BY buy_time DESC limit ' . $pagination->offset . ',' . $pagination->limit;
		$command = $connection->createCommand($querySql);
		$result = $command->queryAll();

		$sum_sql = '';
		for ($i = 100; $i <= 109; $i++) {
			$sum_sql .= '(SELECT SUM(money) as money, SUM(point) as point, SUM(total) as total FROM payment_orders_' . $i . $condition . ' ) UNION ALL';
		}
		$sum_sql = rtrim($sum_sql, 'UNION ALL');
		$sumQuery = $connection->createCommand('SELECT SUM(r.money) as totalMoney, SUM(r.point) as totalPoint, SUM(r.total) as total FROM (' . $sum_sql . ') as r ');
		$sum = $sumQuery->queryOne();

		return ['list' => $result, 'total' => $totalCount, 'count' => $sum];
	}

	/***
	 * 留存数据
	 * $start 开始时间 $end 结束时间 $userArr 用户array
	 **/
	public static function leftDate($start, $end, $before, $after)
	{
		$sql = '';
		for ($i = 0; $i < 10; $i++) {
			$sql .= "select  distinct user_id from payment_orders_10" . $i . " where  user_id not in(select distinct user_id from 
payment_orders_10" . $i . "  where  create_time < '" . $before . "' and create_time >= '" . $after . "') and (create_time >= '" . $before . "' and create_time < '" . $after . "') union all ";
		}
		$sql = substr($sql, 0, -11);
		$connection = \Yii::$app->db;
		$result = $connection->createCommand($sql)->queryAll();
		$count = count($result);

		$str = '';
		foreach ($result as $val) {
			$str .= $val['user_id'] . ',';
		}
		$userIdArr = (substr($str, 0, -1)) ? substr($str, 0, -1) : 0;

		$sql2 = '';
		for ($j = 0; $j < 10; $j++) {
			$sql2 .= "select count(distinct user_id) as count from payment_orders_10" . $j . " where create_time >= '" . $start . "' and create_time < '" . $end . "' and user_id in (" . $userIdArr . ") union all ";
		}
		$sql2 = substr($sql2, 0, -11);

		$list = $connection->createCommand($sql2)->queryAll();

		$return = 0;
		foreach ($list as $val) {
			$return += $val['count'];
		}
		return ['count' => $count, 'num' => $return];
	}

	/***
	 * 留存数据副本
	 * $start 开始时间 $end 结束时间 $userArr 用户array
	 **/
	public static function leftDateback($start, $end, $before, $after)
	{
		$dayList = User::find()->select('id')->where("created_at >= '" . $before . "' and created_at < '" . $after . "'")->asArray()->all();
		$arr = '';
		foreach ($dayList as $key => $val) {
			$arr .= $val['id'] . ',';
		}
		$arr = (substr($arr, 0, -1)) ? substr($arr, 0, -1) : 0;
		$count = User::find()->where("created_at >= '" . $before . "' and created_at < '" . $after . "'")->count(1);

		$sql = '';
		for ($i = 0; $i < 10; $i++) {
			$sql .= "select count(distinct user_id) as count from payment_orders_10" . $i . " where create_time >= '" . $start . "' and create_time < '" . $end . "' and user_id in (" . $arr . ") union all ";
		}
		$sql = substr($sql, 0, -11);
		$connection = \Yii::$app->db;
		$result = $connection->createCommand($sql)->queryAll();

		$return = 0;
		foreach ($result as $val) {
			$return += $val['count'];
		}
		return ['count' => $count, 'num' => $return];
	}
}

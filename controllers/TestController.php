<?php

namespace app\controllers;

use app\models\ActRichLog;
use app\models\LotteryRewardLog;
use app\models\PaymentOrderDistribution;
use app\models\Reward;
use yii;
use yii\console\Controller;
use app\models\User;
use app\models\Deliver;
use app\models\Stats;
use app\models\Order;
use app\models\Invite;
use app\models\StatsTask;
use app\models\ActQualificationLog;
use app\models\PointLog;
use app\models\UserPacket;
use app\models\UserCoupons;


/**
 * 统计
 */
class TestController extends Controller
{


	public function actionIndex()
	{
		set_time_limit(0);
		$date = date("Ymd",strtotime('-1 day'));
		//$date = '20160414';
		// $date = $today-1;

		$statsData['date'] = $date;
		$time = strtotime($date);
		$endTime = strtotime(date('Y-m-d', time()));
		//$endTime = strtotime('20160415');
		//注册人数
		$regNum = User::find()->where("created_at >= ".$time." and created_at < ".$endTime)->count(1);
		$statsData['reg_num'] = $regNum;

		//充值
		$rechargeTable = 'recharge_orders_10';
		$paymentTable = 'payment_orders_10';
		$rechargeSql = $paymentSql = $todayRegRechargeSql = $todayRegPaymentSql = $couponSql1 = $couponSql2 = '';
		for ($i=0; $i < 10; $i++) {
			$todayRegRechargeSql .= "select count(distinct user_id) as count,sum(money) as sum from recharge_orders_10".$i." where status = 1 and user_id in (select id from users where created_at >= '".$time."' and created_at < '".$endTime."') and pay_time >= '".$time."' and pay_time < '".$endTime."'  and payment < 7 union all ";
			$todayRegPaymentSql .= "select count(distinct user_id) as count,sum(money) as sum from payment_orders_10".$i." where status = 1 and user_id in (select id from users where created_at >= '".$time."' and created_at < '".$endTime."') and  buy_time >= '".$time."' and buy_time < '".$endTime."' union all ";
			$rechargeSql .= "select count(distinct user_id) as count,sum(money) as sum from recharge_orders_10".$i." where  pay_time >= '".$time."' and pay_time < '".$endTime."' and status = 1  and payment < 7 union all ";
			$paymentSql .= "select count(distinct user_id) as count,sum(money) as sum from payment_orders_10".$i." where  buy_time >= '".$time."' and buy_time < '".$endTime."' and status = 1 union all ";
			$couponSql1 .= "select count(coupon1) as count,sum(deduction1) as sum from payment_orders_10".$i." where status = 1 and deduction1 > 0 and  buy_time >= '".$time."' and buy_time < '".$endTime."'  union all ";
			$couponSql2 .= "select count(coupon2) as count,sum(deduction2) as sum from payment_orders_10".$i." where status = 1 and deduction2 > 0 and  buy_time >= '".$time."' and buy_time < '".$endTime."' union all ";
		}
		$rechargeSql = substr($rechargeSql, 0,-11);
		$paymentSql = substr($paymentSql, 0,-11);
		$todayRegRechargeSql = substr($todayRegRechargeSql, 0,-11);
		$todayRegPaymentSql = substr($todayRegPaymentSql, 0,-11);
		$couponSql1 = substr($couponSql1,0,-11);
		$couponSql2 = substr($couponSql2,0,-11);

		$rechargeSql = "select sum(count) as users,sum(sum) as money from (".$rechargeSql.")t";
		$paymentSql = "select sum(count) as users,sum(sum) as money from (".$paymentSql.")t";
		$todayRegRechargeSql = "select sum(count) as users,sum(sum) as money from (".$todayRegRechargeSql.")t";
		$todayRegPaymentSql = "select sum(count) as users,sum(sum) as money from (".$todayRegPaymentSql.")t";
		$couponSql1 = "select sum(count) as count,sum(sum) as money from (".$couponSql1.")t";
		$couponSql2 = "select sum(count) as count,sum(sum) as money from (".$couponSql2.")t";

		$db = \Yii::$app->db;
		$todayRegRechargeData = $db->createCommand($todayRegRechargeSql)->queryOne();
		$todayRegPaymentData = $db->createCommand($todayRegPaymentSql)->queryOne();
		$rechargeData = $db->createCommand($rechargeSql)->queryOne();
		$paymentData = $db->createCommand($paymentSql)->queryOne();
		$couponData1 = $db->createCommand($couponSql1)->queryOne();
		$couponData2 = $db->createCommand($couponSql2)->queryOne();

		$statsData['valid_reg_num'] = $todayRegPaymentData['users'] ? : 0 ;
		$statsData['today_reg_recharge'] = $todayRegRechargeData['money'] ? : 0 ;
		$statsData['today_reg_payment'] = $todayRegPaymentData['money'] ? : 0 ;
		$statsData['recharge_num'] = $rechargeData['users'] ? : 0 ;
		$statsData['recharge_money'] = $rechargeData['money'] ? : 0 ;
		$statsData['pay_num'] = $paymentData['users'] ? : 0 ;
		$statsData['pay_money'] = $paymentData['money'] ? : 0 ;

		// 邀请人数
		$inviteNum = Invite::find()->where("invite_time >= '".$time."' and invite_time < '".$endTime."'")->count();
		$statsData['invite_num'] = $inviteNum;

		//签到人数
		$signNum = StatsTask::find()->where(['date'=>$date,'type'=>1])->one();
		$statsData['sign_num'] = $signNum['count'];

		//抽奖次数
		$lotteryQualification = ActQualificationLog::find()->select("type,count(1) as count")->where("created_at >= '".$time."' and created_at < '".$endTime."'")->groupBy('type')->asArray()->all();
		$statsData['share_lottery'] = $statsData['recharge_lottery'] = 0;
		foreach ($lotteryQualification as $key => $value) {
			if ($value['type'] == 1) {
				$statsData['recharge_lottery'] = $value['count'];
			}else if ($value['type'] == 2) {
				$statsData['share_lottery'] = $value['count'];
			}
		}

		//红包发出数量
		$packetNum = UserPacket::find()->where("receive_time >= '".$time."' and receive_time < '".$endTime."'")->count(1);
		$statsData['packet_send_num'] = $packetNum;
		//优惠券发出数量
		$couponNum = UserCoupons::find()->where("receive_time >= '".$time."' and receive_time < '".$endTime."'")->count(1);
		$statsData['coupon_send_num'] = $couponNum;
		//优惠券使用张数及抵扣金额
		$statsData['coupon_use_num'] = $couponData1['count']+$couponData2['count'];
		$statsData['coupon_money'] = $couponData1['money'] + $couponData2['money'];

		//产生积分
		$addPoint = PointLog::point("point > 0 and created_at >= '".$time."' and created_at < '".$endTime."'");
		$usedPoint = PointLog::point("point <0 and created_at >= '".$time."' and created_at < '".$endTime."'");
		$material_point = PointLog::point("type = 5 and created_at >= '".$time."' and created_at < '".$endTime."'");
		$invite_point = PointLog::point("type = 2 and created_at >= '".$time."' and created_at < '".$endTime."'");
		$share_point = PointLog::point("type = 3 and created_at >= '".$time."' and created_at < '".$endTime."'");
		$buy_point = PointLog::point("type = 1 and point > 0 and created_at >= '".$time."' and created_at < '".$endTime."'");
		$pointsql = $db->createCommand('select sum(point) as totalPoint from users');
		$point = $pointsql->queryOne();
		$left_point = $point['totalPoint'];

		$statsData['used_point'] = abs($usedPoint) ? : 0 ;
		$statsData['add_point'] = $addPoint ? : 0 ;
		$statsData['buy_point'] = $buy_point ? : 0 ;
		$statsData['share_point'] = $share_point ? : 0 ;
		$statsData['invite_point'] = $invite_point ? : 0 ;
		$statsData['material_point'] = $material_point ? : 0 ;
		$statsData['left_point'] = $left_point ? : 0 ;

		//开奖次数
		$orderNum = Order::find()->where("create_time >= '".$time."' and create_time < '".$endTime."'")->count(1);
		$statsData['lottery_num'] = $orderNum;

		//发货次数
		$deliverNum = Deliver::find()->where("deliver_time >= '".$time."' and deliver_time < '".$endTime."'")->count(1);
		$statsData['deliver_num'] = $deliverNum;

		//十元专区
		$tenNum = Order::find()->leftJoin('products', 'orders.product_id = products.id')->where("orders.create_time >= '".$time."' and orders.create_time < '".$endTime."'")->andWhere(['products.buy_unit'=>10])->count(1);
		$statsData['ten_num'] = $tenNum;

		//限购专区
		$limitNum = Order::find()->leftJoin('products', 'orders.product_id = products.id')->where("orders.create_time >= '".$time."' and orders.create_time < '".$endTime."'")->andWhere(['products.limit_num'=>5])->count(1);
		$statsData['limit_num'] = $limitNum;

		//用户留存
		$endMonth = strtotime('-1 month', strtotime($date));
		$beforeMonth = strtotime('-1 day', $endMonth);
		$userMonthNum = PaymentOrderDistribution::leftDate($time, $endTime, $beforeMonth, $endMonth);

		$beforDay = strtotime('-1 day', strtotime($date));
		$userDayNum = PaymentOrderDistribution::leftDate($time, $endTime, $beforDay, $time);

		$beforWeek = strtotime('-7 days', strtotime($date));
		$endWeek = strtotime('-6 days', strtotime($date));
		$userWeekNum = PaymentOrderDistribution::leftDate($time, $endTime, $beforWeek, $endWeek);

		if($userDayNum['count'] != 0) $statsData['tomorrow_left'] = sprintf("%.2f", ($userDayNum['num'] / $userDayNum['count']) * 100);
		else $statsData['tomorrow_left'] = 0;
		if($userWeekNum['count'] != 0) $statsData['week_left'] = sprintf("%.2f", ($userWeekNum['num'] / $userWeekNum['count']) * 100);
		else $statsData['week_left'] = 0;
		if($userMonthNum['count'] != 0)  $statsData['month_left'] = sprintf("%.2f", ($userMonthNum['num'] / $userMonthNum['count']) * 100);
		else $statsData['month_left'] = 0;
		var_dump($statsData);exit;
		//会员总数
		$memberCount = User::find()->count(1);
		$statsData['member_num'] = $memberCount;

		//土豪榜返现
		$richCount = ActRichLog::richCount($time, $endTime);
		$statsData['rich_money'] = $richCount['money'];
		$statsData['rich_point'] = $richCount['point'];

		//抽奖
		$rewardMoney = Reward::find()->where('type = 4 and del = 0')->asArray()->all();
		$statsData['lottery_money'] = 0;
		foreach($rewardMoney as $val){
			$content = yii\helpers\Json::decode($val['content']);
			$moneyQuery = LotteryRewardLog::find()->where(['reward_id'=>$val['id']])->andWhere("created_at >= '".$time."' and created_at < '".$endTime."'")->count(1);
			$statsData['lottery_money'] += $moneyQuery * $content[0];
		}
		$rewardPoint = Reward::find()->where(['type'=>5, 'del'=>0])->asArray()->all();
		$statsData['lottery_point'] = 0;
		foreach($rewardPoint as $val){
			$content = yii\helpers\Json::decode($val['content']);
			$pointQuery = LotteryRewardLog::find()->where(['reward_id'=>$val['id']])->andWhere("created_at >= '".$time."' and created_at < '".$endTime."'")->count(1);
			$statsData['lottery_point'] += $pointQuery * $content[0];
		}

		$stats = New Stats();
		foreach ($statsData as $key => $value) {
			$stats->$key = $value;
		}
		$stats->save();

		print_r($statsData);
	}

	public function actionUserTask()
	{
		set_time_limit(0);
		$date = date('Ymd', strtotime('-1 days'));
		$startTime = strtotime($date);
		$endTIme = $startTime + 86400;

		$sql = '';
		for ($i = 100; $i <= 109; $i++) {
			$sql .= " (SELECT type,level,cate,num FROM user_task_follow_$i WHERE created_at >= $startTime AND created_at < $endTIme) UNION ALL";
		}
		$sql = rtrim($sql, 'UNION ALL');
		$connection = Yii::$app->db;
		$sql = "SELECT type,level,cate,num FROM ($sql) as r";
		$result = $connection->createCommand($sql)->queryAll();
		$data = [];
		foreach ($result as $row) {
			isset($data[$row['type']][$row['level']][$row['cate']][$row['num']]) ? $data[$row['type']][$row['level']][$row['cate']][$row['num']]++ : $data[$row['type']][$row['level']][$row['cate']][$row['num']] = 1;
		}
		$trans = Yii::$app->db->beginTransaction();
		try {
			foreach ($data as $type => $typeData) {
				foreach ($typeData as $level => $levelData) {
					foreach ($levelData as $cate => $cateData) {
						foreach ($cateData as $num => $count) {
							$statsTask = \app\models\StatsTask::findOne(['date' => $date, 'type' => $type, 'level' => $level, 'cate' => $cate, 'num' => $num]);
							if ($statsTask) {
								$statsTask->count = $count;
								if (!$statsTask->save()) {
									$trans->rollBack();
									return false;
								}
							} else {
								$statsTask = new \app\models\StatsTask();
								$statsTask->date = $date;
								$statsTask->type = $type;
								$statsTask->level = $level;
								$statsTask->cate = $cate;
								$statsTask->num = $num;
								$statsTask->count = $count;
								if (!$statsTask->save()) {
									$trans->rollBack();
									return false;
								}
							}
						}
					}
				}
			}
			$trans->commit();
			echo "user_task success";
		} catch (\Exception $e) {
			$trans->rollBack();
			echo $e->getMessage();
		}
	}


}
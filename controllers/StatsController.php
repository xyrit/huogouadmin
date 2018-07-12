<?php

	namespace app\controllers;

	use app\models\ActRichLog;
	use yii;
	use app\models\User;
	use app\models\Deliver;
	use app\models\Stats;
	use app\models\Order;
	use app\models\Invite;
	use app\models\UserSign;
	use app\models\ActQualificationLog;
	use app\models\UserPacket;
	use app\models\PointLog;
	use app\models\UserCoupons;

	/**
	* 统计
	*/
	class StatsController extends BaseController
	{
		public function actionIndex()
		{
			if (Yii::$app->request->isAjax) {
				$page = Yii::$app->request->get('page','1');
				$perpage = Yii::$app->request->get('rows','20');
				$list = ['rows'=>[],'total'=>0];

				$list = Stats::getList($page,$perpage);

				if ($page == 1) {
					$today = date("Ymd",time());
					$todayData['date'] = $today;
					$startTime = strtotime($today);
					//注册人数
					$regNum = User::find()->where(['>=', 'created_at', $startTime])->count(1);
					$todayData['reg_num'] = $regNum;

					//充值
					$rechargeTable = 'recharge_orders_10';
					$paymentTable = 'payment_orders_10';
					$rechargeSql = $paymentSql = $todayRegRechargeSql = $todayRegPaymentSql = $couponSql1 = $couponSql2 = '';
					for ($i=0; $i < 10; $i++) {
						$todayRegRechargeSql .= 'SELECT COUNT(DISTINCT r.user_id) AS count, SUM(r.money) AS sum FROM recharge_orders_10' . $i . ' r LEFT JOIN users u ON r.user_id=u.id WHERE r.status = 1 AND r.pay_time >= ' . $startTime . ' AND u.created_at >= ' . $startTime . ' and payment < 7 UNION ALL ';
						$todayRegPaymentSql .= 'SELECT COUNT(DISTINCT p.user_id) AS count, SUM(p.money) AS sum FROM payment_orders_10' . $i . ' p LEFT JOIN users u ON p.user_id=u.id WHERE p.status = 1 AND p.buy_time >=' . $startTime . ' AND u.created_at >= ' . $startTime . ' UNION ALL ';
						$rechargeSql .= 'SELECT COUNT(DISTINCT user_id) AS count, SUM(money) as sum FROM recharge_orders_10' . $i . ' WHERE pay_time >=' . $startTime . ' AND status = 1  and payment < 7 UNION ALL ';
						$paymentSql .= 'SELECT COUNT(DISTINCT user_id) AS count, SUM(money) as sum FROM payment_orders_10' . $i . ' WHERE buy_time >=' . $startTime . ' AND status = 1 UNION ALL ';
						$couponSql1 .= 'SELECT COUNT(coupon1) AS count, SUM(deduction1) AS sum FROM payment_orders_10' . $i . ' WHERE status = 1 AND deduction1 > 0 AND buy_time >=' . $startTime . ' UNION ALL ';
						$couponSql2 .= 'SELECT COUNT(coupon2) AS count, SUM(deduction2) AS sum FROM payment_orders_10' . $i . ' WHERE status = 1 AND deduction2 > 0 AND buy_time >=' . $startTime . ' UNION ALL ';
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

					$todayData['valid_reg_num'] = $todayRegPaymentData['users'] ? : 0 ;
					$todayData['today_reg_recharge'] = $todayRegRechargeData['money'] ? : 0 ;
					$todayData['today_reg_payment'] = $todayRegPaymentData['money'] ? : 0 ;
					$todayData['recharge_num'] = $rechargeData['users'] ? : 0 ;
					$todayData['recharge_money'] = $rechargeData['money'] ? : 0 ;
					$todayData['pay_num'] = $paymentData['users'] ? : 0 ;
					$todayData['pay_money'] = $paymentData['money'] ? : 0 ;
					
					// 邀请人数
					$inviteNum = Invite::find()->where(['>=', 'invite_time', $startTime])->count(1);
					$todayData['invite_num'] = $inviteNum;

					//签到人数
					$signNum = UserSign::find()->where(['signed_at'=>$today])->count(1);
					$todayData['sign_num'] = $signNum;

					//抽奖次数
					$lotteryQualification = ActQualificationLog::find()->select("type,count(1) as count")->where(['>=', 'created_at', $startTime])->groupBy('type')->asArray()->all();
					$todayData['share_lottery'] = $todayData['recharge_lottery'] = 0;
					foreach ($lotteryQualification as $key => $value) {
						if ($value['type'] == 1) {
							$todayData['recharge_lottery'] = $value['count'];
						}else if ($value['type'] == 2) {
							$todayData['share_lottery'] = $value['count'];
						}
					}

					//红包发出数量
					$packetNum = UserPacket::find()->where(['>=', 'receive_time', $startTime])->count(1);
					$statsData['packet_send_num'] = $packetNum;
					//优惠券发出数量
					$couponNum = UserCoupons::find()->where(['>=', 'receive_time', $startTime])->count(1);
					$statsData['coupon_send_num'] = $couponNum;
					//优惠券使用张数及抵扣金额
					$todayData['coupon_use_num'] = $couponData1['count']+$couponData2['count'];
					$todayData['coupon_money'] = $couponData1['money'] + $couponData2['money'];

					//产生积分
					$addPoint = PointLog::point("point > 0 and created_at >= $startTime");
					$usedPoint = PointLog::point("point <0 and created_at >= $startTime");

					$todayData['used_point'] = $usedPoint;
					$todayData['add_point'] = $addPoint;

					//开奖次数
					$orderNum = Order::find()->where(['>=', 'create_time', $startTime])->count(1);
					$todayData['lottery_num'] = $orderNum;

					//土豪榜发放
					$endTime = strtotime(date('Ymd',strtotime('+1 day', $startTime)));
					$richCount = ActRichLog::richCount($startTime, $endTime);
					$todayData['rich_money'] = $richCount['money'];
					$todayData['rich_point'] = $richCount['point'];

					//发货次数
					$deliverNum = Deliver::find()->where(['>=', 'deliver_time', $startTime])->count(1);
					$todayData['deliver_num'] = $deliverNum;
					$data['rows'] = [];
					array_push($data['rows'],$todayData);
					// $data['totalCount'] = $list['totalCount'];
					foreach ($list['rows'] as $key => $value) {
						$data['rows'][] = $value;
					}
					$data['total'] = $list['total'];
					return $data;
				}else{
					return $list;
				}
			}
			return $this->render('index');
		}

		public function actionOrder()
		{
			$request = Yii::$app->request;
			$get = $request->get();
			$type = $request->get('type', 0);
			$start = $request->get('startTime');
			$end = $request->get('endTime');
			$date = '';
			$order = '';
			$deliver = '';
			$ten = '';
			$limit = '';
			if($type == 0 || $type == 1){
				if($type == 0) {
					$date = date('Ymd', strtotime('-7 days')) . "," . date('Ymd', strtotime('-6 days')) . "," . date('Ymd', strtotime('-5 days')) . "," . date('Ymd', strtotime('-4 days')) . "," . date('Ymd', strtotime('-3 days')) . "," . date('Ymd', strtotime('-2 days')) . "," . date('Ymd', strtotime('-1 day'));
				}elseif($type == 1){
					$days = (strtotime($end) - strtotime($start)) / (3600 * 24 );
					for($i = 0; $i <= $days; $i++){
						$date .= date('Y-m-d', strtotime ("+".$i." day", strtotime($start))).',';
					}
					$date = substr($date, 0, -1);
				}
				$dataArr = explode(',', $date);
				foreach($dataArr as $val){
					$val = date('Ymd', strtotime($val));
					$count = Stats::find()->select('lottery_num, deliver_num, ten_num, limit_num')->where(['date'=>$val])->one();
					$order .= $count['lottery_num'].',';
					$deliver .= $count['deliver_num'].',';
					$ten .= $count['ten_num'].',';
					$limit .= $count['limit_num'].',';
				}
			}elseif($type == 2 || $type == 3){
				$arr = Stats::diffDate($start, $end);
				if($type == 2){
					for($i = 0; $i <= $arr['month']; $i++){
						$date .= date('Y-m', strtotime ("+".$i." month", strtotime($start))).',';
					}
					$date = substr($date, 0, -1);
					$dataArr = explode(',', $date);
					foreach($dataArr as $val){
						$val = strtotime($val);
						$mdays=date('t',$val);
						$mstart = strtotime(date('Y-m-1 00:00:00',$val));
						$mend = strtotime(date('Y-m-'.$mdays.' 23:59:59', $val));
						$count = Stats::find()->select('sum(lottery_num) as lottery_num, sum(deliver_num) as deliver_num, sum(ten_num) as ten_num, sum(limit_num) as limit_num')->where('UNIX_TIMESTAMP(date) >= '.$mstart.' and UNIX_TIMESTAMP(date) <= '.$mend)->one();

						$order .= $count['lottery_num'].',';
						$deliver .= $count['deliver_num'].',';
						$ten .= $count['ten_num'].',';
						$limit .= $count['limit_num'].',';
					}
				}elseif($type == 3){
					for($i = 0; $i <= $arr['year'] + 1; $i++){
						$date .= date('Y', strtotime ("+".$i." year", strtotime($start))).',';
					}
					$date = substr($date, 0, -1);
					$dataArr = explode(',', $date);
					foreach($dataArr as $val){
						$s = $val.'-1-1 00:00:00';
						$e = ($val + 1).'-1-1 00:00:00';
						$ystart = strtotime($s);
						$yend = strtotime($e);
						$count = Stats::find()->select('sum(lottery_num) as lottery_num, sum(deliver_num) as deliver_num, sum(ten_num) as ten_num, sum(limit_num) as limit_num')->where('UNIX_TIMESTAMP(date) >= '.$ystart.' and UNIX_TIMESTAMP(date) <= '.$yend)->one();
						$l = isset($count['lottery_num']) ? $count['lottery_num'] : 0;
						$d = isset($count['deliver_num']) ? $count['deliver_num'] : 0 ;
						$order .=  $l.',';
						$deliver .= $d .',';
						$ten .= $count['ten_num'].',';
						$limit .= $count['limit_num'].',';
					}
				}
			}

			$order = substr($order, 0, -1);
			$deliver = substr($deliver, 0, -1);
			$ten = substr($ten, 0, -1);
			$limit = substr($limit, 0, -1);

			return $this->render('order', [
				'date' => $date,
				'order' => $order,
				'deliver' => $deliver,
				'ten' => $ten,
				'limit' => $limit,
				'get' => $get
			]);
		}

		/**
		 * @pass
		 **/
		public function actionList()
		{
			$request = Yii::$app->request;
			if($request->isAjax){
				$page = $request->get('page', 1);
				$perpage = $request->get('row', 10);
				return Stats::getList($page, $perpage);
			}
		}

		public function actionPoint()
		{
			$request = Yii::$app->request;
			$get = $request->get();
			$type = $request->get('type', 0);
			$start = $request->get('startTime');
			$end = $request->get('endTime');
			$date = '';
			$invite = '';
			$material = '';
			$share = '';
			$buy = '';
			$consume = '';
			$left = '';
			if($type == 0 || $type == 1){
				if($type == 0) {
					$date = date('Ymd', strtotime('-7 days')) . "," . date('Ymd', strtotime('-6 days')) . "," . date('Ymd', strtotime('-5 days')) . "," . date('Ymd', strtotime('-4 days')) . "," . date('Ymd', strtotime('-3 days')) . "," . date('Ymd', strtotime('-2 days')) . "," . date('Ymd', strtotime('-1 day'));
				}elseif($type == 1){
					$days = (strtotime($end) - strtotime($start)) / (3600 * 24 );
					for($i = 0; $i <= $days; $i++){
						$date .= date('Y-m-d', strtotime ("+".$i." day", strtotime($start))).',';
					}
					$date = substr($date, 0, -1);
				}
				$dataArr = explode(',', $date);
				foreach($dataArr as $val){
					$val = date('Ymd', strtotime($val));
					$count = Stats::find()->select('used_point, invite_point, material_point, share_point, buy_point, left_point')->where(['date'=>$val])->one();
					$invite .= $count['invite_point'].',';
					$material .= $count['material_point'].',';
					$share .= $count['share_point'].',';
					$buy .= $count['buy_point'].',';
					$left .= $count['left_point'].',';
					$consume .= $count['used_point'].',';
				}
			}elseif($type == 2 || $type == 3){
				$arr = Stats::diffDate($start, $end);
				if($type == 2){
					for($i = 0; $i <= $arr['month']; $i++){
						$date .= date('Y-m', strtotime ("+".$i." month", strtotime($start))).',';
					}
					$date = substr($date, 0, -1);
					$dataArr = explode(',', $date);
					foreach($dataArr as $val){
						$val = strtotime($val);
						$mdays=date('t',$val);
						$mstart = strtotime(date('Y-m-1 00:00:00',$val));
						$mend = strtotime(date('Y-m-'.$mdays.' 23:59:59', $val));
						$count = Stats::find()->select('sum(invite_point) as invite_point, sum(material_point) as material_point, sum(share_point) as share_point, sum(buy_point) as buy_point,  sum(left_point) as left_point, sum(used_point) as used_point')->where('UNIX_TIMESTAMP(date) >= '.$mstart.' and UNIX_TIMESTAMP(date) <= '.$mend)->one();

						$invite .= $count['invite_point'].',';
						$material .= $count['material_point'].',';
						$share .= $count['share_point'].',';
						$buy .= $count['buy_point'].',';
						$left .= $count['left_point'].',';
						$consume .= $count['used_point'].',';
					}
				}elseif($type == 3){
					for($i = 0; $i <= $arr['year'] + 1; $i++){
						$date .= date('Y', strtotime ("+".$i." year", strtotime($start))).',';
					}
					$date = substr($date, 0, -1);
					$dataArr = explode(',', $date);
					foreach($dataArr as $val){
						$s = $val.'-1-1 00:00:00';
						$e = ($val + 1).'-1-1 00:00:00';
						$ystart = strtotime($s);
						$yend = strtotime($e);
						$count = Stats::find()->select('sum(invite_point) as invite_point, sum(material_point) as material_point, sum(share_point) as share_point, sum(buy_point) as buy_point,  sum(left_point) as left_point, sum(used_point) as used_point')->where('UNIX_TIMESTAMP(date) >= '.$ystart.' and UNIX_TIMESTAMP(date) <= '.$yend)->one();
						$invite .= $count['invite_point'].',';
						$material .= $count['material_point'].',';
						$share .= $count['share_point'].',';
						$buy .= $count['buy_point'].',';
						$left .= $count['left_point'].',';
						$consume .= $count['used_point'].',';
					}
				}
			}
			$invite = substr($invite, 0, -1);
			$material = substr($material, 0, -1);
			$share = substr($share, 0, -1);
			$buy = substr($buy, 0, -1);
			$left = substr($left, 0, -1);
			$consume = substr($consume, 0, -1);

			return $this->render('point', [
				'date' => $date,
				'invite' => $invite,
				'share' => $share,
				'meterial' => $material,
				'buy' => $buy,
				'left' => $left,
				'consume' => $consume,
				'get' => $get
			]);
		}


		public function actionMoney()
		{
			$request = Yii::$app->request;
			$get = $request->get();
			$type = $request->get('type', 0);
			$start = $request->get('startTime');
			$end = $request->get('endTime');
			$date = '';
			$income = '';
			$recharge = '';
			$reg = '';
			if($type == 0 || $type == 1){
				if($type == 0) {
					$date = date('Ymd', strtotime('-7 days')) . "," . date('Ymd', strtotime('-6 days')) . "," . date('Ymd', strtotime('-5 days')) . "," . date('Ymd', strtotime('-4 days')) . "," . date('Ymd', strtotime('-3 days')) . "," . date('Ymd', strtotime('-2 days')) . "," . date('Ymd', strtotime('-1 day'));
				}elseif($type == 1){
					$days = (strtotime($end) - strtotime($start)) / (3600 * 24 );
					for($i = 0; $i <= $days; $i++){
						$date .= date('Y-m-d', strtotime ("+".$i." day", strtotime($start))).',';
					}
					$date = substr($date, 0, -1);
				}
				$dataArr = explode(',', $date);
				foreach($dataArr as $val){
					$val = date('Ymd', strtotime($val));
					$count = Stats::find()->select('pay_money, recharge_money, today_reg_recharge')->where(['date'=>$val])->one();
					$income .= $count['pay_money'].',';
					$recharge .= $count['recharge_money'].',';
					$reg .= $count['today_reg_recharge'].',';
				}
			}elseif($type == 2 || $type == 3){
				$arr = Stats::diffDate($start, $end);
				if($type == 2){
					for($i = 0; $i <= $arr['month']; $i++){
						$date .= date('Y-m', strtotime ("+".$i." month", strtotime($start))).',';
					}
					$date = substr($date, 0, -1);
					$dataArr = explode(',', $date);
					foreach($dataArr as $val){
						$val = strtotime($val);
						$mdays=date('t',$val);
						$mstart = strtotime(date('Y-m-1 00:00:00',$val));
						$mend = strtotime(date('Y-m-'.$mdays.' 23:59:59', $val));
						$count = Stats::find()->select('sum(pay_money) as pay_money, sum(recharge_money) as recharge_money, sum(today_reg_recharge) as today_reg_recharge')->where('UNIX_TIMESTAMP(date) >= '.$mstart.' and UNIX_TIMESTAMP(date) <= '.$mend)->one();

						$income .= $count['pay_money'].',';
						$recharge .= $count['recharge_money'].',';
						$reg .= $count['today_reg_recharge'].',';
					}
				}elseif($type == 3){
					for($i = 0; $i <= $arr['year'] + 1; $i++){
						$date .= date('Y', strtotime ("+".$i." year", strtotime($start))).',';
					}
					$date = substr($date, 0, -1);
					$dataArr = explode(',', $date);
					foreach($dataArr as $val){
						$s = $val.'-1-1 00:00:00';
						$e = ($val + 1).'-1-1 00:00:00';
						$ystart = strtotime($s);
						$yend = strtotime($e);
						$count = Stats::find()->select('sum(pay_money) as pay_money, sum(recharge_money) as recharge_money, sum(today_reg_recharge) as today_reg_recharge')->where('UNIX_TIMESTAMP(date) >= '.$ystart.' and UNIX_TIMESTAMP(date) <= '.$yend)->one();
						$income .= $count['pay_money'].',';
						$recharge .= $count['recharge_money'].',';
						$reg .= $count['today_reg_recharge'].',';
					}
				}
			}

			$income = substr($income, 0, -1);
			$recharge = substr($recharge, 0, -1);
			$reg = substr($reg, 0, -1);

			return $this->render('money', [
				'income' => $income,
				'recharge' => $recharge,
				'reg' => $reg,
				'date' => $date,
				'get' => $get
			]);
		}

		/**
		 * @pass
		 **/
		public function actionMember()
		{
			$request = Yii::$app->request;
			$get = $request->get();
			$type = $request->get('type', 0);
			$start = $request->get('startTime');
			$end = $request->get('endTime');
			$reg = '';
			$pay = '';
			$date = '';
			if($type == 0 || $type == 1){
				if($type == 0) {
					$date = date('Ymd', strtotime('-7 days')) . "," . date('Ymd', strtotime('-6 days')) . "," . date('Ymd', strtotime('-5 days')) . "," . date('Ymd', strtotime('-4 days')) . "," . date('Ymd', strtotime('-3 days')) . "," . date('Ymd', strtotime('-2 days')) . "," . date('Ymd', strtotime('-1 day'));
				}elseif($type == 1){
					$days = (strtotime($end) - strtotime($start)) / (3600 * 24 );
					for($i = 0; $i <= $days; $i++){
						$date .= date('Y-m-d', strtotime ("+".$i." day", strtotime($start))).',';
					}
					$date = substr($date, 0, -1);
				}
				$dataArr = explode(',', $date);
				foreach($dataArr as $val){
					$val = date('Ymd', strtotime($val));
					$count = Stats::find()->select('reg_num, pay_num')->where(['date'=>$val])->one();
					$reg .= $count['reg_num'] ? : 0;
					$pay .= $count['pay_num'] ? : 0;
					$reg .= ',';
					$pay .= ',';
				}
			}elseif($type == 2 || $type == 3){
				$arr = Stats::diffDate($start, $end);
				if($type == 2){
					for($i = 0; $i <= $arr['month']; $i++){
						$date .= date('Y-m', strtotime ("+".$i." month", strtotime($start))).',';
					}
					$date = substr($date, 0, -1);
					$dataArr = explode(',', $date);
					foreach($dataArr as $val){
						$val = strtotime($val);
						$mdays=date('t',$val);
						$mstart = strtotime(date('Y-m-1 00:00:00',$val));
						$mend = strtotime(date('Y-m-'.$mdays.' 23:59:59', $val));
						$count = Stats::find()->select('sum(reg_num) as reg_num, sum(pay_num) as pay_num')->where('UNIX_TIMESTAMP(date) >= '.$mstart.' and UNIX_TIMESTAMP(date) <= '.$mend)->one();
						$reg .= $count['reg_num'] ? : 0;
						$pay .= $count['pay_num'] ? : 0;
						$reg .= ',';
						$pay .= ',';
					}
				}elseif($type == 3){
					for($i = 0; $i <= $arr['year'] + 1; $i++){
						$date .= date('Y', strtotime ("+".$i." year", strtotime($start))).',';
					}
					$date = substr($date, 0, -1);
					$dataArr = explode(',', $date);
					foreach($dataArr as $val){
						$s = $val.'-1-1 00:00:00';
						$e = ($val + 1).'-1-1 00:00:00';
						$ystart = strtotime($s);
						$yend = strtotime($e);
						$count = Stats::find()->select('sum(reg_num) as reg_num, sum(pay_num) as pay_num')->where('UNIX_TIMESTAMP(date) >= '.$ystart.' and UNIX_TIMESTAMP(date) <= '.$yend)->one();
						$reg .= $count['reg_num'] ? : 0;
						$pay .= $count['pay_num'] ? : 0;
						$reg .= ',';
						$pay .= ',';
					}
				}
			}

			$reg = substr($reg, 0, -1);
			$pay = substr($pay, 0, -1);

			return $this->render('member', [
				'reg' => $reg,
				'pay' => $pay,
				'date' => $date,
				'get' => $get
			]);
		}

		/**
		 * @pass
		 **/
		public function actionCount()
		{
			$conn = \Yii::$app->db;
			$list = Stats::find()->select('sum(pay_money) as pay_money, sum(recharge_money) as recharge_money')->one();
			$return['pay_money'] = $list['pay_money'];
			$return['money'] = $list['recharge_money'];

			$balsql = $conn->createCommand('SELECT sum(money) as balance, sum(commission) as commission FROM users ');
			$comm = $balsql->queryOne();
			$return['balance'] = $comm['balance'];
			$return['commission'] = $comm['commission'];

			$date = $date = date("Ymd",time());
			$time = strtotime($date);
			$regNum = User::find()->where("created_at >= '".$time."'")->count(1);
			$return['reg_num'] = $regNum;

			$paymentSql = '';
			$rechargeSql = '';
			for ($i=0; $i < 10; $i++) {
				$paymentSql .= "select sum(money) as sum from payment_orders_10".$i." where buy_time >= '".$time."' and status = 1 union all ";
				$rechargeSql .= "select sum(money) as sum from recharge_orders_10".$i." where pay_time >= '".$time."' and status = 1  and payment < 7 union all ";
			}
			$paymentSql = substr($paymentSql, 0,-11);
			$rechargeSql = substr($rechargeSql, 0,-11);
			$paymentSql = "select sum(sum) as money from (".$paymentSql.")t";
			$rechargeSql = "select sum(sum) as money from (".$rechargeSql.")t";
			$rechargeData = $conn->createCommand($rechargeSql)->queryOne();
			$paymentData = $conn->createCommand($paymentSql)->queryOne();
			$return['today_payment'] = $paymentData['money'];
			$return['today_recharge'] = $rechargeData['money'];

			$luckysql = $conn->createCommand("SELECT count(1) as total FROM orders where create_time >='".$time."'");
			$luckyTotal = $luckysql->queryOne();
			$return['luckyTotal'] = $luckyTotal['total'];

			//今日发货
			$deliversql = $conn->createCommand("SELECT count(1) as total FROM deliver where confirm_time >= '".$time."'");
			$deliverTotal = $deliversql->queryOne();
			$return['deliverTotal'] = $deliverTotal['total'];

			$yes = Stats::find()->select('reg_num, pay_money, lottery_num, deliver_num, recharge_money')->orderBy('date desc')->one();
			$yesterday = $yes;

			return $this->render('count', [
				'return' => $return,
				'yesterday' => $yesterday
			]);
		}
	}
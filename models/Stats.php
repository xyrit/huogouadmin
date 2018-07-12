<?php

	namespace app\models;

	use Yii;
	use yii\data\Pagination;

	/**
	* 数据统计
	*/
	class Stats extends \yii\db\ActiveRecord
	{
		
		public static function tableName()
		{
			return 'stats';
		}

		public function rules(){
			return [
				[['date','reg_num','recharge_num','recharge_money','pay_num','pay_money','invite_num','sign_num','share_lottery'],'required'],
				[['date','reg_num','valid_reg_num','today_reg_recharge','today_reg_payment','recharge_num','recharge_money','pay_num','pay_money','invite_num','sign_num','share_lottery','recharge_lottery','packet_send_num','coupon_send_num','coupon_use_num','coupon_money','used_point','add_point','lottery_num','deliver_num'],'integer']
			];
		}

		public function attributeLabels(){
			return [
				'date' => '日期',
				'reg_num' => '注册人数',
				'valid_reg_num' => '有效用户',
				'today_reg_recharge' => '今日用户充值',
				'today_reg_payment' => '今日用户消费',
				'recharge_num' => '充值人数',
				'recharge_money' => '充值金额',
				'pay_num' => '购买人数',
				'pay_money' => '购买金额',
				'invite_num' => '邀请人数',
				'sign_num' => '签到人数',
				'share_lottery' => '分享抽奖',
				'recharge_lottery' => '充值抽奖',
				'packet_send_num' => '红包发出数量',
				'coupon_send_num' => '优惠券发出数量',
				'coupon_use_num' => '优惠券使用数量',
				'coupon_money' => '优惠券抵扣金额',
				'used_point' => '使用福分',
				'add_point' => '发出福分',
				'lottery_num' => '开奖次数',
				'deliver_num' => '发货次数'
			];
		}

		public  static function getList($page,$perpage)
		{
			$query = Stats::find()->orderBy('date desc');
		    $pages = new Pagination(['defaultPageSize' => $perpage, 'totalCount' => $query->count(), 'page' => $page - 1]);

		    $list = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();

		    return ['rows' => $list, 'total' => $pages->totalCount];
		}

		/*
		*function：计算两个日期相隔多少年，多少月，多少天
		*param string $date1[格式如：2011-11-5]
		*param string $date2[格式如：2012-12-01]
		*return array array('年','月','日');
		*/
		public static function diffDate($date1,$date2){
			if(strtotime($date1)>strtotime($date2)){
				$tmp=$date2;
				$date2=$date1;
				$date1=$tmp;
			}
			list($Y1,$m1,$d1)=explode('-',$date1);
			list($Y2,$m2,$d2)=explode('-',$date2);
			$y=$Y2-$Y1;
			$m=$m2-$m1;
			$d=$d2-$d1;
			if($d<0){
				$d+=(int)date('t',strtotime("-1 month $date2"));
				$m--;
			}
			if($m<0){
				$m+=12;
				$y--;
			}
			return array('year'=>$y,'month'=>$m,'day'=>$d);
		}
	}
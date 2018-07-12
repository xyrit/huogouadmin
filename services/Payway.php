<?php

	namespace app\services;

	use app\services\Pay;
	use app\services\Thirdpay;


	/**
	* 选择支付方式
	*/
	class Payway
	{
		private $payType = ['recharge'=>1,'consume'=>2];
    	private $payName = ['debit'=>1,'credit'=>2,'platform'=>3,'commssion'=>4,'huogoucard'=>5];

		public function chooseway($uid,$payType,$payName,$payBank,$point,$payMoney,$source){
			if (!$payType || !isset($this->payType[$payType])) {
				return array('code'=>10011,'message'=>'支付类型不正确');
			}

			if ($payName == 'balance') {
	            // 余额消费
	            $pay = new Pay($uid);
	            $order = $pay->createPayOrder($source,$point,1,$payBank);
	            if (!$order) {
	            	return array('code'=>10013,'message'=>'订单创建失败');
	            }
	            return array('code'=>100,'type'=>'balance','order'=>$order);
	        }else{
	        	if (!isset($this->payName[$payName])) {
					return array('code'=>10012,'message'=>'支付方式不正确');
		        }
	            $name = $this->payName[$payName];
	        	$type = $this->payType[$payType];
	        	if (intval($payMoney) <= 0) {
	        		return array('code'=>10014,'message'=>'充值金额不正确');
	        	}
	        	if (!$payBank) {
	        		return array('code'=>10015,'message'=>'银行不能为空');
	        	}
	            $createOrder = new Thirdpay();
	            $order = $createOrder->createRechargeOrder($uid,$payMoney,$type,$name,$payBank,$source,$point);
	            if (!$order) {
	            	return array('code'=>10013,'message'=>'订单创建失败');
	            }
	            return array('code'=>100,'type'=>'third','order'=>$order);
	        }
		}
	}
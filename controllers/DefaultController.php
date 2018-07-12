<?php

namespace app\controllers;

use app\models\Admin;
use app\models\Menu;
use app\models\Product;
use app\models\PointLog;
use app\models\PkOrders;
use app\models\JdcardBuybackList;
use yii;
use app\models\Order;

class DefaultController extends BaseController
{
	public function actionIndex()
	{
        //查询商品
        $jdproductlist= Product::find()->select('id')->where(['delivery_id'=>8])->asArray()->all();
        $jdid_list=[];
        foreach($jdproductlist as $row)
        {
            $jdid_list[]=$row['id'];               //所有京东商品
        }
        //查询是否有未处理的订单
        $oderstatus=[1,2,3];
        $pkorder=PkOrders::find()->where(['status'=>$oderstatus])->count();
        $order=Order::find()->where(['status'=>$oderstatus,'product_id'=>$jdid_list])->count();
        $jdback=JdcardBuybackList::find()->where(['pay_status'=>2])->count();

		return $this->render('index',['jdback'=>$jdback,'jdcard'=>$pkorder+$order]);
	}
	
	public function actionGetMenu()
	{
		$adminid = Yii::$app->admin->id;
		$admin = Admin::findOne($adminid);
		$privilege = explode(',', $admin['privilege']);
		$query = Menu::find();
		if ($admin['username'] != 'admin') {
			$query->andWhere(['id' => $privilege]);
		}
		$menuAll = $query->andWhere(['show' => 1])->asArray()->all();
		return Menu::getMenu($menuAll);
	}
	
	public function actionIndexPage()
	{
		$conn = \Yii::$app->db;
		$return = [];
		$sql = '';
		$is_ajax = Yii::$app->request->get('is_ajax');
		$start = strtotime(date('Y-m-d', time()));
		$end = strtotime(date("Y-m-d", strtotime("+1 day")));
		if ($is_ajax) {
			switch ($is_ajax) {
				case 'incomeTotal':
					//总收入
					for ($i = 0; $i < 10; $i++) {
						$tableId = '10' . $i;
						if ($i == 9) {
							$sql .= '(SELECT * FROM period_buylist_' . $tableId . ') ';
						} else {
							$sql .= '(SELECT * FROM period_buylist_' . $tableId . ' ) union all';
						}
					}
					$incomesql = $conn->createCommand('SELECT sum(buy_num) as total FROM (' . $sql . ') as t ');
					$incomeTotal = $incomesql->queryOne();
					return isset($incomeTotal['total'])?['error'=>0,'msg'=>$incomeTotal['total']]:['error'=>0,'msg'=>0];
					break;
				case 'moneyTotal':
					//总充值
					$totalrecharge = '';
					for ($i = 0; $i < 10; $i++) {
						$tableId = '10' . $i;
						if ($i == 9) {
							$totalrecharge .= '(SELECT * FROM recharge_orders_' . $tableId . ' where status = 1 ) ';
						} else {
							$totalrecharge .= '(SELECT * FROM recharge_orders_' . $tableId . ' where status = 1 ) union all';
						}
					}
					$moneysql = $conn->createCommand('SELECT sum(money) as total FROM (' . $totalrecharge . ') as t ');
					$moneyTotal = $moneysql->queryOne();
					return isset($moneyTotal['total'])?['error'=>0,'msg'=>$moneyTotal['total']]:['error'=>0,'msg'=>0];
					break;
				case 'todayIncomeTotal':
					//今日收入
					$sql = '';
					for ($i = 100; $i < 110; $i++) {
						if ($i == 109) {
							$sql .= '(SELECT * FROM period_buylist_' . $i . ' where buy_time >= "' . $start . '" and buy_time < "' . $end . '") ';
						} else {
							$sql .= '(SELECT * FROM period_buylist_' . $i . ' where buy_time >= "' . $start . '" and buy_time < "' . $end . '" ) union all';
						}
					}
					$todayincomesql = $conn->createCommand('SELECT sum(buy_num) as total FROM (' . $sql . ') as t ');
					$todayIncomeTotal = $todayincomesql->queryOne();
					return isset($todayIncomeTotal['total'])?['error'=>0,'msg'=>$todayIncomeTotal['total']]:['error'=>0,'msg'=>0];
					break;
				case 'rechargeTotal':
					//今日充值
					$sql = '';
					for ($i = 100; $i < 110; $i++) {
						if ($i == 109) {
							$sql .= '(SELECT * FROM recharge_orders_' . $i . ' where status = 1 and pay_time >= "' . $start . '" and pay_time < "' . $end . '") ';
						} else {
							$sql .= '(SELECT * FROM recharge_orders_' . $i . ' where status = 1 and pay_time >= "' . $start . '" and pay_time < "' . $end . '" ) union all';
						}
					}
					$rechargesql = $conn->createCommand('SELECT sum(money) as total FROM (' . $sql . ') as t ');
					$rechargeTotal = $rechargesql->queryOne();
					return isset($rechargeTotal['total'])?['error'=>0,'msg'=>$rechargeTotal['total']]:['error'=>0,'msg'=>0];
					break;
				default:
					return ['error'=>0,'msg'=>0];
			}
		}
		
		//账户余额
		$balsql = $conn->createCommand('SELECT sum(money) as balance FROM users ');
		$balance = $balsql->queryOne();
		$return['balance'] = $balance['balance'];
		
		//佣金余额
		$commsql = $conn->createCommand('SELECT sum(commission) as comm FROM users ');
		$comm = $commsql->queryOne();
		$return['comm'] = $comm['comm'] / 100;
		
		//福分消费
		$return['totalComsue'] = PointLog::point('point < 0');
		$return['comTotal'] = PointLog::point('type = 1 and point > 0');
		$return['taskTotal'] = PointLog::point('type = 5');
		$return['inviteTotal'] = PointLog::point('type = 2');
		$return['shareTotal'] = PointLog::point('type = 3');
		$return['modifyTotal'] = PointLog::point('type = 6');
		
		//福分余额
		$pointsql = $conn->createCommand('select sum(point) as totalPoint from users');
		$point = $pointsql->queryOne();
		$return['totalPoint'] = $point['totalPoint'];
		
		//一级分类
		$catesql = $conn->createCommand('SELECT count(1) as total FROM product_category where parent_id=0 and top_id = 0 ');
		$cateTotal = $catesql->queryOne();
		$return['cateTotal'] = $cateTotal['total'];
		
		//品牌
		$brandsql = $conn->createCommand('SELECT count(1) as total FROM brands ');
		$brandTotal = $brandsql->queryOne();
		$return['brandTotal'] = $brandTotal['total'];
		
		//商品总数量
		$productsql = $conn->createCommand('SELECT count(1) as total FROM products ');
		$productTotal = $productsql->queryOne();
		$return['productTotal'] = $productTotal['total'];
		
		//在售商品数量
		$onlinesql = $conn->createCommand('SELECT count(1) as total FROM products where marketable = 1');
		$onlineTotal = $onlinesql->queryOne();
		$return['onlineTotal'] = $onlineTotal['total'];
		
		//会员数量
		$usersql = $conn->createCommand('SELECT count(1) as total FROM users');
		$userTotal = $usersql->queryOne();
		$return['userTotal'] = $userTotal['total'];
		
		//今日新增会员
		$toadysql = $conn->createCommand('SELECT count(1) as total FROM users where created_at >= "' . $start . '" and created_at < "' . $end . '"');
		$toadyTotal = $toadysql->queryOne();
		$return['toadyTotal'] = $toadyTotal['total'];
		
		//今日开奖
		$luckysql = $conn->createCommand('SELECT count(1) as total FROM orders where create_time >="' . $start . '" and create_time < "' . $end . '"');
		$luckyTotal = $luckysql->queryOne();
		$return['luckyTotal'] = $luckyTotal['total'];
		
		//今日发货
		$deliversql = $conn->createCommand('SELECT count(1) as total FROM deliver where deliver_time >="' . $start . '" and deliver_time < "' . $end . '"');
		$deliverTotal = $deliversql->queryOne();
		$return['deliverTotal'] = $deliverTotal['total'];
		
		//订单统计
		$order = Order::orderStatusCount();
		
		//热销商品
		$hotsql = $conn->createCommand('SELECT DISTINCT product_id from (select * FROM periods Order by period_number DESC) tmp GROUP BY product_id Order by period_number DESC LIMIT 10');
		$hotProductList = $hotsql->queryAll();
		foreach ($hotProductList as $key => $val) {
			$maxperiod = $conn->createCommand('select max(period_number) as period_number from periods where product_id = ' . $val['product_id'] . '');
			$max = $maxperiod->queryOne();
			$product = Product::findOne($val['product_id']);
			$hotProductList[$key]['product_id'] = $product['name'];
			$hotProductList[$key]['period_number'] = $max['period_number'];
		}
		
		return $this->render('indexPage', [
			'return' => $return,
			'order' => $order,
			'hotProductList' => $hotProductList,
		]);
	}
	
	public function actionLogout()
	{
		$adminUser = \Yii::$app->admin;
		$adminUser->logout();
		$adminUser->setReturnUrl(['/admin']);
		return $this->redirect($adminUser->loginUrl);
	}
	
}

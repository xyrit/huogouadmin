<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/13
 * Time: 10:05
 * pk 订单
 */
namespace app\controllers;

use app\models\ActivityProducts;
use app\models\Admin;
use app\models\PkOrders as PkOrdersModel;
use app\models\PkPaymentOrderItemDistribution;
use app\models\PkPeriods;
use app\models\VirtualDepotJdcard;
use yii\data\Pagination;
use app\helpers\DateFormat;
use app\models\User;
use app\models\ProductCategory;
use yii\helpers\ArrayHelper;
use app\models\VirtualDepotLog;
use app\helpers\Message;

class PkorderController extends BaseController
{

	public $status_name = ['已中奖', '待确认', '待备货', '待发货', '待收货', '待晒单', '换货', '发货异常', '已完成'];
	public static $deliveries = [
		8 => '聚合卡密',
		2 => '自建仓发货',

	];

	public static $virtual_deliveries = [
		8 => '聚合卡密',
	];

	public static $activty_type = [
		1 => 'PK场',
	];

	public function actionList()
	{

		$request = \Yii::$app->request;
		if ($request->isAjax || $request->get('excel') == 'virtual') {
			$page = $request->get('page', 1);
			$perpage = $request->get('rows', 10);
			$get = $request->get();


			$list = $this->getList($get, $page, $perpage);


			$status = $this->status_name;
			foreach ($list['list'] as &$val) {
				//   $user = User::baseInfo($val['uid']);
				$val['create_time'] = DateFormat::microDate($val['create_time']);
				$val['status'] = $status[$val['status']];
				//  $val['update_time'] = DateFormat::microDate($val['update_time']);
				// $val['uid'] = $user;
				//   unset($val['pwd']);
				$user = \app\models\User::userName($val['user_id']);
				$val['phone'] = $user['phone'];
                $val['nickname'] = $user['nickname'];
            $product=ActivityProducts::findOne($val['product_id']);
                $val['productname']=$product->name;
            $pkperiods=PkPeriods::findone($val['period_id']);
                $val['period_no']=$pkperiods['period_no'];
                $val['size']=$pkperiods['size'];
                if($val['deliver_adminid']){
                $val['deliver_adminname']=Admin::findone($val['deliver_adminid'])->real_name;
                }else{
                    $val['deliver_adminid']='';
                }

			}


			return ['total' => $list['totalCount'], 'rows' => $list['list']];
		}
		return $this->render('list');
	}


	public function actionView()
	{

		$status = $this->status_name;
		$id = \Yii::$app->request->get('id');

		$detail = PkOrdersModel::findOne($id)->toArray();
		$user = User::findOne($detail['user_id']);
		//  $detail['created_at'] = DateFormat::microDate($detail['item_buy_time']);
		$detail['user_id'] = User::userName($detail['user_id']);
		$goodInfo = ActivityProducts::findOne($detail['product_id'])->toArray();
		$cats = ProductCategory::find()->all();
		$cat_name = ArrayHelper::map($cats, 'id', 'name');
		$detail['status_name'] = $status[$detail['status']];

		if ($goodInfo['is_virtual']) {
			$goodInfo['is_virtual'] = '是';
			$goodInfo['delivery_id'] = self::$virtual_deliveries[$goodInfo['delivery_id']];
		} else {
			$goodInfo['is_virtual'] = '否';
			$goodInfo['delivery_id'] = self::$deliveries[$goodInfo['delivery_id']];
		}

        //备注
        $desc = json_decode($detail['remark']);
		// 中奖码
        $Periodinfo = PkPeriods::findOne($detail['period_id'])->toArray();
        //用户信息
		//查询这期所有购买记录   后期加上
		//  $tab_id=PkPaymentOrderItemDistribution::getTableIdByOrderId($user->home_id);
		//  $orderItemslist = PkPaymentOrderItemDistribution::findByTableId($user->home_id)->where(['user_id'=>$user->id,'product_id'=>$detail['product_id'],'period_id'=>$detail['period_id']])->asArray()->all();

		return $this->render('view', [
			'cat_name' => $cat_name[$goodInfo['cat_id']],
			'detail' => $detail,
			'goodInfo' => $goodInfo,
			'periodinfo' => $Periodinfo,
            'user' => $user->toArray(),
            'desc' => $desc
		]);
	}


	//确认订单
	public function actionDeliver()
	{

		$id = \Yii::$app->request->post('id');

		$pkorder = PkOrdersModel::findone($id)->toArray();
		$mobile = $pkorder['ship_mobile'];
		$product = ActivityProducts::findone($pkorder['product_id']);
        $period_id = PkPeriods::findOne($pkorder['period_id']);
		if ($product) {
			$product = $product->toArray();
		} else {
			return ['code' => 201, 'message' => '商品不存在'];
		}
		$userInfo = User::findOne($pkorder['user_id']);

		if ($pkorder['status'] == 3 && $pkorder['confirm'] == 1) {

			$balance = VirtualDepotJdcard::find()->andwhere(['status' => 0, 'denomination' => $product['face_value']])->count('id');
			$rs['error_code'] = 1;
			if ($balance < 1) {
			  //  if(DOMAIN=='newadmin.huogou.com'){
                $rs = \Yii::$app->jdcard->pullcart($product['face_value']);      //面额
             //   }else{
             //       $rs = \Yii::$app->jdcard->cspullcart($product['face_value']);      //面额
             //   }
                if ($rs['error_code'] > 1) {
                    return ['error' => 1, 'message' => '库存不足(' . $rs['result'] . ')'];
                }
			}
			$trans = \Yii::$app->db->beginTransaction();
			try {
				//修改状态
				$pkordersave = PkOrdersModel::findOne($id);
				$pkordersave->status = 8;
				$pkordersave->last_modified = time();
                $pkordersave->deliver_adminid = \Yii::$app->admin->id;
                $pkordersave->deliver_time = time();
				$rs1 = $pkordersave->save();
				//领卡
                $cardinfo = VirtualDepotJdcard::find()->andwhere(['status' => 0, 'denomination' => $product['face_value']])->asArray()->one();
                if(!$cardinfo){
                    return ['error' => 0, 'message' => '卡号卡密获取失败'];
                }

					$jdcard = VirtualDepotJdcard::findone($cardinfo['id']);
					$jdcard->status = 1;
                $jdcard->backtime = time();
					$rs2 = $jdcard->save();
				//记录
				$log = new VirtualDepotLog();
				$log->card_id = $cardinfo['id'];
				$log->user_id = $pkorder['user_id'];
				$log->phone = $mobile;
				$log->c_time = time();
                $log->order_id = $id;
                $log->cardno = $cardinfo['cardno'];
                $log->cardpws = $cardinfo['cardpws'];
                $log->activity_id = 1;
				$log->admin_id = \Yii::$app->admin->id;
				$rs3 = $log->save();
				if ($rs1 && $rs2 && $rs3) {

					if ($userInfo["from"] == 1) {
                        $send_type = 16;
					} else {
                        $send_type = 18;
					}
					$SendModel = new \app\models\SendMessage;
						$data['picture'] = $product["picture"];
						$data['order_id'] = $id;
                    $SendModel->user_id = $pkorder['user_id'];
						$SendModel->content = json_encode($data);
                    $SendModel->type = $send_type;
						$SendModel->admin_id = \Yii::$app->admin->id;
						$SendModel->create_time = time();
                    if ($SendModel->save()) {
                            $trans->commit();
                        //发送短信
                        $cardno = \Yii::$app->jdcard->decode($cardinfo['cardno']);  //解密
                        $cardpws = \Yii::$app->jdcard->decode($cardinfo['cardpws']);
                        if(!$cardno && !$cardpws){
                            return ['error' => 0, 'message' => '卡密解析失败'];
                        }
                        $data = [
                            'phone' => $mobile,
                            'nickname' => isset($userInfo["nickname"]) ? $userInfo["nickname"] : $userInfo["phone"],
                            'goodsName' => $product["name"],
                            'from' => $userInfo["from"],
                            'periodNumber' => $period_id->period_no,
                            'card' => $cardno,
                            'pwd' => $cardpws,
                        ];
                        Message::send($send_type, $mobile, $data);
                            \app\models\UserAppInfo::updateAll(['new_pm' => 1], ['uid' => $pkorder['user_id']]);
                            $messege = '已发送卡密到手机';
                            return ['error' => 0, 'message' => $messege];
                        }

                } else {
					$trans->rollBack();
                    return ['error' => 1, 'message' => '保存出错'];
				}

				//换卡
			} catch (\Exception $e) {
				$trans->rollBack();
				return ['error' => 1, 'message' => $e->getMessage()];
			}
            $trans->rollBack();
		}

        return ['error' => 1, 'message' => '订单有误'];
	}

	/*
	 * @return 驳回
	 */
	public function actionRefuse()
	{
		$id = \Yii::$app->request->post('id');
        $pkorder = PkOrdersModel::findOne($id);
        if ($pkorder->status == 3 && $pkorder->confirm == 1) {
            $pkorder->confirm = 0;        //驳回
            $pkorder->status = 0; //改为已中奖
			$pkorder->last_modified = time();
            $pkorder->ship_mobile = '';
            $pkorder->save(false);
			return ['error' => 0, 'message' => '驳回成功!'];
		}
		return ['error' => 1, 'message' => '订单错误'];
	}

    /**
     * PK单购买记录
     */
	public function actionPayList(){

        $request = \Yii::$app->request;
        if ($request->isAjax || $request->get('excel') == 'virtual') {
            $page = $request->get('page', 1);
            $perpage = $request->get('row', 10);
            $get = $request->get();


            $list = $this->getList($get, $page, $perpage);


            $status = $this->status_name;
            foreach ($list['list'] as &$val) {
                //   $user = User::baseInfo($val['uid']);
                $val['create_time'] = DateFormat::microDate($val['create_time']);
                $val['status'] = $status[$val['status']];
                //  $val['update_time'] = DateFormat::microDate($val['update_time']);
                // $val['uid'] = $user;
                //   unset($val['pwd']);
                $user = \app\models\User::userName($val['user_id']);
                $val['phone'] = $user['phone'];
                $val['email'] = $user['email'];
                $val['nickname'] = $user['nickname'];
            }


            return ['total' => $list['totalCount'], 'rows' => $list['list']];
        }
        return $this->render('paylist');

    }
    public function actionSaveDesc()
    {
        $id = \Yii::$app->request->post('id');
        $desc = \Yii::$app->request->post('desc');
        if (!$desc) {
            return ['error' => 1, 'message' => '保存信息不存在 !'];
        }
        $pkorder = PkOrdersModel::findOne($id);
        $indesc['desc'] = $desc;
        $indesc['time'] = date('Y-m-d h:i:s', time());
        $indesc['admin_id'] = \Yii::$app->admin->id;
        if ($pkorder->remark) {
            $remarkarr = json_decode($pkorder->remark, 1);

            $remarkarr[] = $indesc;
        } else {
            $remarkarr[] = $indesc;
        }
        $remark = json_encode($remarkarr);
        $pkorder->remark = $remark;
        $rs = $pkorder->save();
        if ($rs) {
            return ['error' => 0, 'message' => '保存成功!'];
        }
        return ['error' => 1, 'message' => '保存失败!'];
    }

	public function getList($get, $page = 1, $perpage = 10)
	{
		$query = PkOrdersModel::find();

		if (isset($get['startTime']) && $get['startTime']) $query->andWhere(['>=', 'create_time', strtotime($get['startTime'])]);
		if (isset($get['endTime']) && $get['endTime']) $query->andWhere(['<=', 'create_time', strtotime($get['endTime'])]);
		if (isset($get['account']) && $get['account']) {
			$where['phone'] = $get['account'];
            if($get['from']==0){
                $users=[];
             $user = User::find()->select('id')->where($where)->asArray()->all();
                foreach ($user as $row)
                {
                    $users[]= $row['id'];
                }
                $query->andWhere(['user_id' => $users]);
            }else{
                $where['from'] = $get['from'];
                $user = User::find()->select('id')->where($where)->asArray()->one();
                $query->andWhere(['user_id' => $user['id']]);
            }


		}
        if (isset($get['from']) && $get['from']) {
            if( $get['from'] > 0){
            $where['from'] = $get['from'];
            // 查询用户id
            $user = User::find()->select('id')->where($where)->asArray()->all();
            $users=[];
            foreach ($user as $row)
            {
                $users[]= $row['id'];
            }
            $query->andWhere(['user_id' => $users]);
            }
        }
        if (isset($get['status'])) $query->andWhere(['status' => $get['status']]);
		if (isset($get['orderid']) && $get['orderid']) $query->andWhere(['id' => $get['orderid']]);
        //不显示回购订单
        $query->andWhere(['is_buyback' => 0]);
		$countQuery = clone $query;

		$pagination = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'defaultPageSize' => $perpage]);

		$list = $query->offset($pagination->offset)
			->limit($pagination->limit)
			->orderBy('id desc')->asArray()
			->all();
		return ['list' => $list, 'totalCount' => $pagination->totalCount];
	}

    public function actionJdencode()
    {
        $no = \Yii::$app->request->get('no');
        $pwd = \Yii::$app->request->get('pwd');

        $cardno = \Yii::$app->jdcard->encode($no);  //解密
        $cardpws = \Yii::$app->jdcard->encode($pwd);
        echo '卡号:' . $cardno . '<br>';
        echo '卡密:' . $cardpws;
    }


}
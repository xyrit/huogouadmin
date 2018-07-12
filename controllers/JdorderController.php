<?php

namespace app\controllers;


use app\models\Admin;

use app\models\JdcardBuybackMobile;
use app\services\Category;
use app\services\Product;
use app\helpers\DateFormat;
use app\models\ProductCategory;
use yii\helpers\ArrayHelper;

use app\models\PaymentOrderItemDistribution;
use app\models\Order;
use app\models\Deliver;
use app\models\User;
use app\helpers\Ex;
use app\models\Product as ModelProduct;
use app\models\ActivityProducts;
use app\models\PkPeriods;

use app\models\PkOrders as PkOrdersModel;
use yii\data\Pagination;
class JdorderController extends BaseController{

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


    public function actionPkorders(){

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
        return $this->render('pkorders');
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

        return $this->render('view', [
            'cat_name' => $cat_name[$goodInfo['cat_id']],
            'detail' => $detail,
            'goodInfo' => $goodInfo,
            'periodinfo' => $Periodinfo,
            'user' => $user->toArray(),
            'desc' => $desc
        ]);



    }

    public function actionOrders(){

        $request = \Yii::$app->request;
        $catlist = Category::getList(0);
        $status = $request->get('status', 'all');
        if ($request->isAjax || $request->get('excel') == 'order') {
            $get = $request->get();
            if (isset($get['sub']) && $get['sub'] == 'sub') {
                $where['order'] = $get['order'];
                $deliver = Deliver::find()->select('id');
                if ($get['startTime'] || $get['endTime']) {
                    if ($get['time'] == 2) {
                        $get['startTime'] && $deliver->andWhere(['>=', 'prepare_time', strtotime($get['startTime'])]);
                        $get['endTime'] && $deliver->andWhere(['<', 'prepare_time', strtotime($get['endTime'])]);
                    } elseif ($get['time'] == 3) {
                        $get['startTime'] && $deliver->andWhere(['>=', 'deliver_time', strtotime($get['startTime'])]);
                        $get['endTime'] && $deliver->andWhere(['<', 'deliver_time', strtotime($get['endTime'])]);
                    } elseif ($get['time'] == 4) {
                        $get['startTime'] && $deliver->andWhere(['>=', 'unix_timestamp(bill_time)', strtotime($get['startTime'])]);
                        $get['endTime'] && $deliver->andWhere(['<', 'unix_timestamp(bill_time)', strtotime($get['endTime'])]);
                    } else {
                        $where['startTime'] = $get['startTime'];
                        $where['endTime'] = $get['endTime'];
                    }
                }
                if ($get['prepare_userid']) {
                    $admin = Admin::findOne(['real_name' => $get['prepare_userid']]);
                    $deliver->andWhere(['prepare_userid' => $admin['id']]);

                }
                if (!empty($deliver->where)) {
                    $ids = $deliver->all();
                    //echo $deliver->createCommand()->getRawSql();die;
                    $ids && $where['ids'] = ArrayHelper::getColumn($ids, 'id');

                }
                $where['from'] = $get['from'];
                $where['time'] = $get['time'];
                if ($get['name']) {
                    $userQuery = User::find()->where(['or', 'email="' . $get['name'] . '"', 'phone="' . $get['name'] . '"', 'nickname="' . $get['name'] . '"']);
                    if ($where['from']) {
                        $user = $userQuery->andWhere(['from' => $where['from']])->one();
                        $where['name'] = $user['id'];
                    } else {
                        $users = $userQuery->all();
                        $userIds = ArrayHelper::getColumn($users, 'id');
                        $where['name'] = $userIds;
                    }
                }
                if ($get['period_no']) {//期号
                    $where['period_no'] = $get['period_no'];
                }
                if ($get['product_name'] || $get['cat_id']) {
                    if ($get['product_name'] && $get['cat_id']) {
                        $product = ModelProduct::find()->where(['like', 'name', $get['product_name']])->andwhere
                        (['cat_id' => $get['cat_id']])->all();
                    } elseif ($get['product_name']) {
                        $product = ModelProduct::find()->where(['like', 'name', $get['product_name']])->all();
                    } elseif ($get['cat_id']) {
                        if ($get['cat_id2'] && intval($get['cat_id2']) > 0) {
                            $product = ModelProduct::find()->where('cat_id="' . $get['cat_id2'] . '"')->all();

                        } else {
                            $catids = ProductCategory::children($get['cat_id']);
                            $catids = ArrayHelper::getColumn($catids, 'id');
                            array_push($catids, $get['cat_id']);
                            $product = ModelProduct::find()->where(['in', 'cat_id', $catids])->all();
                        }

                    }
                    $where['product_ids'] = empty(ArrayHelper::getColumn($product, 'id')) ? array("-1") : ArrayHelper::getColumn($product, 'id');
                }


                if (isset($get['types']) && $get['types']) {
                    if ($get['types'] == 1) {
                        $product = ModelProduct::find()->where(['in', 'delivery_id', [1, 2, 4]])->all();
                    } elseif ($get['types'] == 2) {
                        $product = ModelProduct::find()->where(['not in', 'delivery_id', [1, 2, 4]])->all();
                    }

                    foreach ($product as $key => $val) {
                        $proArr[$key] = $val['id'];
                    }
                    $where['types'] = isset($proArr) ? $proArr : [0];
                    if (isset($where['product_ids']) && !empty($where['product_ids'])) {
                        $newarr = array_intersect($where['product_ids'], $where['types']);
                        $where['product_ids'] = (!empty($newarr)) ? $newarr : '-1';
                    } else {
                        $where['product_ids'] = $where['types'];
                    };
                }

                if (isset($get['order_type']) && $get['order_type']) {

                        if($get['order_type']==1)
                        {
                            $where['ship_mobile']=1;

                        }else{
                            $where['ship_mobile']=2;
                        }

                }


            }

            $product = ModelProduct::find()->select('id')->where(['delivery_id' => 8])->all();
            foreach ($product as $key => $val) {
                $arr[$key] = $val['id'];
            }
            $where['deliver'] = isset($arr) ? $arr : '';
            $where['status'] = $request->get('status', 'all');

            $person = Deliver::getEmployeeName();
            if (isset($get['excel']) && $get['excel'] == 'order') {
                ini_set('memory_limit', '1000M');
                //$list = Order::orderList($where, PHP_INT_MAX);
                $perpage = 5000;
                $list = Order::orderList($where);//获取总条数
                $maxPage = ceil($list['total'] / $perpage);//获取最大页数
                $newData = [];
                $where['excel'] = 1;
                for ($i = 0; $i < $maxPage; $i++) {
                    $where['page'] = $i;
                    $result = Order::orderList($where, $perpage);
                    foreach ($result['list'] as $k => &$v) {
                        $newData[] = $v;
                    }
                }
                $list['list'] = $newData;
                $data[0] = ['id' => '订单号', 'from' => '站点来源', 'name' => '商品名称', 'catone' => '分类', 'phone' => '手机',
                    'email' => '邮箱', 'period_number' => '第几期', 'period_no' => '当前期号', 'code' => '伙购码', 'status' => '状态', 'deliver' => '发货方式', 'time' => '中奖时间', 'ship_name' => '收货人', 'ship_area' => '收货地址', 'confirm_userid' => '确认人', 'prepare_userid' => '备货人', 'price' => '成本', 'goodprice' => '伙购价格', 'platform' => '平台', 'third_order' => '第三方订单号', 'payment' => '支付方式', 'bill' => '发票', 'bill_time' => '发票时间', 'bill_num' => '发票号', 'deliver_userid' => '发货人', 'deliver_company' => '快递公司', 'deliver_order' => '快递单号', 'prepare_time' => '备货时间', 'deliver_time' => '发货时间', 'total_point' => '福分总额'];
                $person = Deliver::getEmployeeName();
                $productName = Product::getProductName();
                $productDeliver = Product::getProductDeliver();
                $productCat = Product::getProductCate();
                $catArr = Category::getCateList();
                $periodArr = '';
                foreach ($list['list'] as $key => $val) {
                    $key = $key + 1;
                    $periodArr .= $val['period_id'] . ',';
                    $data[$key]['id'] = $val['id'];
                    $data[$key]['from'] = ($val['from'] == 2) ? '滴滴夺宝' : '伙购网';
                    $data[$key]['name'] = $productName[$val['product_id']];
                    $data[$key]['catone'] = $catArr[$productCat[$val['product_id']]];
                    $data[$key]['phone'] = $val['phone'];
                    $data[$key]['email'] = $val['email'];
                    $data[$key]['period_number'] = $val['period_number'];
                    $data[$key]['period_no'] = $val['period_no'];
                    $data[$key]['period'] = $val['period_id'];
                    $data[$key]['code'] = $val['lucky_code'];
                    $status = Order::getStatus($val['status']);
                    $data[$key]['status'] = $status['name'];
                    $deliver = Order::getDeliver($productDeliver[$val['product_id']]);
                    $data[$key]['deliver'] = $deliver['name'];
                    $data[$key]['time'] = DateFormat::microDate($val['end_time']);
                    $data[$key]['ship_name'] = $val['ship_name'];
                    $data[$key]['ship_area'] = $val['ship_area'] . $val['ship_addr'];
                    if ($val['confirm_userid']) $data[$key]['confirm_userid'] = $person[$val['confirm_userid']];
                    else $data[$key]['confirm_userid'] = '';
                    if ($val['prepare_userid']) $data[$key]['prepare_userid'] = $person[$val['prepare_userid']];
                    else $data[$key]['prepare_userid'] = '';
                    $data[$key]['price'] = $val['deliver_price'];
                    $data[$key]['ship_name'] = $val['ship_name'];
                    $data[$key]['goodprice'] = $val['goodprice'];
                    $data[$key]['platform'] = $val['platform'];
                    $data[$key]['third_order'] = $val['third_order'];
                    $data[$key]['payment'] = $val['payment'];
                    $data[$key]['bill'] = $val['bill'];
                    $data[$key]['bill_time'] = $val['bill_time'];
                    $data[$key]['bill_num'] = $val['bill_num'];
                    if ($val['deliver_userid']) $data[$key]['deliver_userid'] = $person[$val['deliver_userid']];
                    else $data[$key]['deliver_userid'] = '';
                    $data[$key]['deliver_company'] = $val['deliver_company'];
                    $data[$key]['deliver_order'] = $val['deliver_order'];
                    if ($val['prepare_time']) $data[$key]['prepare_time'] = DateFormat::microDate($val['prepare_time']);
                    else $data[$key]['prepare_time'] = '';
                    if ($val['deliver_time']) $data[$key]['deliver_time'] = DateFormat::microDate($val['deliver_time']);
                    else $data[$key]['deliver_time'] = '';
                }

                $totalPoint = PaymentOrderItemDistribution::getOrderTotalPoint(substr($periodArr, 0, -1));
                $pointArr = [];
                foreach ($totalPoint as $val) {
                    $pointArr[$val['period_id']] = $val['totalPoint'];
                }

                foreach ($data as $key => $val) {
                    if ($key != 0) $data[$key]['total_point'] = isset($pointArr[$val['period']]) ? $pointArr[$val['period']] : '';
                    unset($data[$key]['period']);
                }
                $excel = new Ex();
                $excel->download($data, '中奖数据' . date('Y-m-d H:i:s') . '.xls');
                unset($data);
            }

            $pageSize = $request->get('rows', 25);
            $list = Order::orderList($where, $pageSize);

            $arr = [];
            foreach ($list['list'] as $key => $val) {
                $goodInfo = Product::info($val['product_id']);
                $arr[$key]['id'] = $val['id'];
                $buyBack = \app\models\JdcardBuybackList::findOne(['order_id' => $val['id']]);
                $arr[$key]['name'] = isset($buyBack) ? '【回购】' . $goodInfo['name'] : $goodInfo['name'];
                $arr[$key]['cat_id'] = Category::getCatName($val['cat_id'], 1);
                $arr[$key]['code'] = $val['lucky_code'];
                $arr[$key]['period_id'] = $val['period_id'];
                $arr[$key]['period_number'] = $val['period_number'];
                $arr[$key]['period_no'] = $val['period_no'];
                $status = Order::getStatus($val['status']);
                $arr[$key]['fail'] = $val['fail_type'];
                $arr[$key]['fail_remark'] = $val['fail_id'];
                $arr[$key]['status'] = $status['name'];
                $arr[$key]['delay'] = DateFormat::microDate($val['delay']);
                $arr[$key]['is_exchange'] = $val['is_exchange'];
                $user = User::findOne($val['user_id']);
                $arr[$key]['from'] = $user['from'];
                $arr[$key]['phone'] = $user['phone'];
                $arr[$key]['email'] = $user['email'];
                $deliver = Order::getDeliver($goodInfo['delivery_id']);
                $arr[$key]['delivery'] = $deliver['name'];
                if ($val['confirm_addr_time']) $arr[$key]['confirm_addr_time'] = DateFormat::microDate($val['confirm_addr_time']);
                $arr[$key]['create_time'] = DateFormat::microDate($val['end_time']);
                $arr[$key]['last_modified'] = DateFormat::microDate($val['last_modified']);
                $deliverModel = Deliver::findOne($val['id']);
                if ($deliverModel && $deliverModel['select_prepare']) $arr[$key]['select_prepare'] = $person[$deliverModel['select_prepare']];
                else $arr[$key]['select_prepare'] = '';
            }

            $data['rows'] = $arr;
            $data['total'] = $list['total'];
            $data['status'] = $where['status'];
            return $data;
        }

        return $this->render('orders', [
            'status' => $status,
            'catlist' => $catlist,
            'deliveryItems' => ModelProduct::$deliveries,
        ]);
    }

    public function getList($get, $page = 1, $perpage = 10)
    {
        $query = PkOrdersModel::find();

        if (isset($get['startTime']) && $get['startTime']) $query->andWhere(['>=', 'create_time', strtotime($get['startTime'])]);
        if (isset($get['endTime']) && $get['endTime']) $query->andWhere(['<=', 'create_time', strtotime($get['endTime'])]);
        if (isset($get['account']) && $get['account']) {
            $where['phone'] = $get['account'];
            if ($get['from'] > 0) {
                $where['from'] = $get['from'];
            }
            // 查询用户id
            $user = User::find()->select('id')->where($where)->asArray()->one();
            $query->andWhere(['user_id' => $user['id']]);
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
}
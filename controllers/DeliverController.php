<?php
/**
 * Created by PhpStorm.
 * User: zhangjicheng
 * Date: 15/9/18
 * Time: 14:54
 */

namespace app\controllers;

use app\helpers\Ex;
use app\models\BackstageLog;
use app\models\ExchangeOrder;
use app\services\User;
use Yii;
use app\models\Deliver;
use app\services\Product;
use app\helpers\DateFormat;
use app\models\ProductCategory;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use app\models\Order;
use app\models\Period;
use app\models\VirtualProductInfo;
use app\models\User as ModelUser;
use app\helpers\Message;
use app\models\Product as ModelProduct;
use app\helpers\Express;
use app\models\Admin;
use app\helpers\Excel;
use yii\web\NotFoundHttpException;

class DeliverController extends BaseController
{
    public function actionIndex()
    {
        $status = Yii::$app->request->get('status', 'all');
        $request = Yii::$app->request;
        $count = Order::thirdStatusCount();

        if($request->isAjax || $request->get('excel')){
            $where = [];
            $perpage = $request->get('rows', 25);
            $where['endTime'] = $request->get('endTime', '');
            $where['startTime'] = $request->get('startTime', '');
            $where['name'] = $request->get('name', '');
            $where['content'] = $request->get('content', '');

            $list = Deliver::thirdPlatformDeliverList($status, $perpage, 1, $where);

            $get = $request->get();
            if(isset($get['excel']) && $get['excel'] == 'deliver'){
                $list = Deliver::thirdPlatformDeliverList(3, PHP_INT_MAX, 1, $where);
                $data[0] = ['adminuser'=>'经手人', 'platformId'=>'采购平台订单号', 'name'=>'商品名称', 'number'=>'开奖期数', 'id'=>'订单号','product_price'=>'伙购价格','price'=>'备货成本'];
                foreach($list['list'] as $key => $val){
                    $key = $key +1;
                    $admin = Admin::findOne($val['prepare_userid']);
                    $period = Period::findOne($val['period_id']);
                    $data[$key]['adminuser'] = $admin['real_name'];
                    $data[$key]['platformId'] = $val['third_order'];
                    $data[$key]['name'] = $val['name'];
                    $data[$key]['number'] = $period['period_number'];
                    $data[$key]['id'] = $val['id'];
                    $data[$key]['product_price'] = $val['product_price'];
                    $data[$key]['price'] = $val['price'];
                }
                $excel = new Ex();
                $excel->download($data, '采购数据' . date('Y-m-d H:i:s') . '.xls');
            }

            $cats = ProductCategory::find()->all();
            $cats = ArrayHelper::map($cats, 'id', 'name');
            $arr = [];
            foreach($list['list'] as $key=>$val){
                $goodInfo = Product::info($val['product_id']);
                $period = Period::findOne($val['period_id']);
                $arr[$key]['id'] = $val['id'];
                $arr[$key]['name'] = $goodInfo['name'];
                $arr[$key]['cat_id'] = $cats[$goodInfo['cat_id']];
                $user = ModelUser::findOne($val['user_id']);
                $arr[$key]['phone'] = $user['phone'];
                $arr[$key]['email'] = $user['email'];
                $arr[$key]['period_number'] = $period['period_number'];
                $arr[$key]['ship_name'] = $val['ship_name'];
                $arr[$key]['ship_mobile'] = $val['ship_mobile'];
                $status =  Order::getStatus($val['status']);
                $arr[$key]['status'] = $status['name'];
                $arr[$key]['create_time'] = DateFormat::microDate($val['confirm_addr_time']);
                $arr[$key]['exchange'] = $val['is_exchange'];
            }

            return ['rows'=>$arr, 'total'=>$list['total']];
        }


        return $this->render('index',[
            'count' => $count,
            'status' => $status,
        ]);
    }

    public function actionView()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');

        $detail = Deliver::orderDetail($id);
        $detail['user_id'] = ModelUser::findOne($detail['user_id']);
        $goodInfo = Product::info($detail['product_id']);
        $periodInfo = Period::find()->where(['id'=>$detail['period_id']])->one();
        $cats = ProductCategory::find()->all();
        $cats = ArrayHelper::map($cats, 'id', 'name');
        $person = Deliver::getEmployeeName();
        $exchange = ExchangeOrder::findOne(['order_no'=>$detail['id']]);
        $express = Express::getExpressName();

        //来源
        $conn = Yii::$app->db;
        $sql =  $conn->createCommand('select * from period_buylist_'.$periodInfo['table_id'].' where period_id = '.$periodInfo['id'].'');
        $periodTable = $sql->queryOne();
        $periodTable['buy_time'] = DateFormat::microDate($periodTable['buy_time']);
        $periodTable['source'] = Order::getSource($periodTable['source']);

        return $this->render('view', [
            'detail' => $detail,
            'goodInfo' => $goodInfo,
            'catName' => $cats,
            'periodInfo' => $periodInfo,
            'person' => $person,
            'periodTable' => $periodTable,
            'exchange' => $exchange,
            'express' => $express
        ]);
    }

    public function actionPrepare(){
        $request = Yii::$app->request;
        $post = $request->post();
        $deliverModel = Deliver::findOne($post['id']);
        $orderModel = Order::findOne($post['id']);
        if(!($deliverModel && $orderModel)) throw new NotFoundHttpException;

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $username = User::baseInfo($orderModel['user_id']);
        $product = ModelProduct::findOne($orderModel['product_id']);
        $trans = Yii::$app->db->beginTransaction();
        try {
            $deliverModel->platform = $post['platform'];
            $deliverModel->bill = $post['bill'];
            $deliverModel->status = 3;
            $deliverModel->payment = $post['payment'];
            $deliverModel->third_order = $post['order'];
            $deliverModel->price = $post['price'];
            $deliverModel->standard = $post['standard'];
            $deliverModel->mark_text = $post['comment'];
            $deliverModel->prepare_time = time();
            $deliverModel->prepare_userid = Yii::$app->admin->id;

            $orderModel->status = 3;
            $orderModel->last_modified = time();
            if (!($deliverModel->save() && $orderModel->save())) {
                $trans->rollBack();
                return ['code' => 101, 'msg' => '备货失败'];
            }

            $trans->commit();
            BackstageLog::addLog(Yii::$app->admin->id, 9, '备货-订单' . $orderModel['id']);
            Message::send(16, $orderModel['user_id'], ['nickname' => $username['username'], 'time' => date('Y-m-d H:i:s'), 'goodsName' => $product['name'], 'orderNo' => $orderModel['id']]);
            return ['code' => 100, 'msg' => '备货成功'];
        }catch (Exception $e) {
            $trans->rollBack();
            file_put_contents('prepare.txt', print_r($e, true).PHP_EOL, FILE_APPEND);
            return ['code'=>103, 'msg'=>'备货失败'];
        }
    }

    public function actionShip(){
        $request = Yii::$app->request;
        $post = $request->post();
        $deliverModel = Deliver::findOne($post['id']);
        $orderModel = Order::findOne($post['id']);
        if(!($deliverModel && $orderModel)) throw new NotFoundHttpException;

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $username = User::baseInfo($orderModel['user_id']);
        $product = ModelProduct::findOne($orderModel['product_id']);
        $trans = Yii::$app->db->beginTransaction();
        try{
            if($product['delivery_id'] == 2){
                $deliverModel->status = 4;
                $deliverModel->deliver_userid = Yii::$app->admin->id;
                $deliverModel->deliver_time = time();
            }else{
                if($orderModel['is_exchange']){
                    $deliverModel->status = 4;
                    $exchange = ExchangeOrder::findOne(['order_no'=>$deliverModel['id']]);
                    $exchange->deliver_company = $post['company'];
                    $exchange->deliver_order = $post['deliver_order'];
                    $exchange->deliver_time = time();
                    $exchange->deliver_userid = Yii::$app->admin->id;
                    if (!$exchange->save()) {
                        $trans->rollBack();
                        return ['code'=>105, 'msg'=>'换货订单发货失败'];
                    }
                }else{
                    $deliverModel->status = 4;
                    $deliverModel->deliver_company = $post['company'];
                    $deliverModel->deliver_order = $post['deliver_order'];
                    $deliverModel->deliver_time = time();
                    $deliverModel->deliver_userid = Yii::$app->admin->id;
                }
            }
            $orderModel->status = 4;
            $orderModel->last_modified = time();
            if (!($deliverModel->save() && $orderModel->save()) ) {
                $trans->rollBack();
                return ['code'=>104, 'msg'=>'订单发货失败'];
            }

            $trans->commit();
            BackstageLog::addLog(Yii::$app->admin->id, 9, '发货-订单'.$deliverModel['id']);
            if($product['delivery_id'] != 2){
                Message::send(17, $orderModel['user_id'], ['nickname'=>$username['username'], 'time'=>date('Y-m-d H:i:s'),'goodsName'=>$product['name'], 'expressCompany'=>$post['company'], 'expressNo'=>$post['deliver_order'], 'orderNo'=>$deliverModel['id']]);
            }
            return ['code'=>100, 'msg'=>'发货成功'];
        }catch (Exception $e) {
            $trans->rollBack();
            file_put_contents('prepare.txt', print_r($e, true).PHP_EOL, FILE_APPEND);
            return ['code'=>103, 'msg'=>'发货失败'];
        }
    }

    public function actionPrepares()
    {
        $request = Yii::$app->request;
        if($request->isPost){
            $post = $request->post();
            $model = Deliver::findOne($post['id']);
            $orderModel = Order::findOne($post['id']);
            if($model){
                $username = User::baseInfo($orderModel['user_id']);
                $product = ModelProduct::findOne($orderModel['product_id']);
                $trans = Yii::$app->db->beginTransaction();
                try {
                    if(isset($post['prepareId']) && $post['prepareId']){
                        $model->platform = isset($post['other']) ? $post['other'] : $post['platform'];
                        $model->bill = isset($post['bill']) ? $post['bill'] : '无';
                        $model->status = 3;
                        $model->payment = isset($post['paymentother']) ? $post['paymentother'] : $post['payment'];
                        $model->third_order = $post['order'];
                        $model->price = $post['price'];
                        $model->standard = $post['standard'];
                        $model->mark_text = $post['comment'];
                        $model->prepare_time = time();
                        $model->prepare_userid = Yii::$app->admin->id;
                        if (!$model->save()) {
                            $trans->rollBack();
                            return 0;
                        }

                        $orderModel->status = 3;
                        $orderModel->last_modified = time();
                        if(!$orderModel->save()){
                            $trans->rollBack();
                            return 0;
                        }

                        $trans->commit();
                        BackstageLog::addLog(Yii::$app->admin->id, 9, '备货-订单'.$model['id']);
                        Message::send(16, $orderModel['user_id'], ['nickname'=>$username['username'], 'time'=>date('Y-m-d H:i:s'),'goodsName'=>$product['name'],'orderNo'=>$model['id']]);
                        return 1;
                    }elseif(isset($post['deliverId']) && $post['deliverId']){
                        if($product['delivery_id'] == 2){
                            $model->status = 4;
                            $model->deliver_userid = Yii::$app->admin->id;
                            $model->deliver_time = time();
                        }else{
                            $company = isset($post['other']) ? $post['other'] : $post['company'];
                            if($orderModel['is_exchange']){
                                $model->status = 4;
                                $exchange = ExchangeOrder::findOne(['order_no'=>$model['id']]);
                                $exchange->deliver_company = $company;
                                $exchange->deliver_order = $post['deliver_order'];
                                $exchange->deliver_time = time();
                                $exchange->deliver_userid = Yii::$app->admin->id;
                                if (!$exchange->save()) {
                                    $trans->rollBack();
                                    return 0;
                                }
                            }else{
                                $model->status = 4;
                                $model->deliver_company = $company;
                                $model->deliver_order = $post['deliver_order'];
                                $model->deliver_time = time();
                                $model->deliver_userid = Yii::$app->admin->id;
                            }
                        }
                        if (!$model->save()) {
                            $trans->rollBack();
                            return 0;
                        }

                        $orderModel->status = 4;
                        $orderModel->last_modified = time();

                        if(!$orderModel->save()){
                            $trans->rollBack();
                            return 0;
                        }

                        $trans->commit();
                        BackstageLog::addLog(Yii::$app->admin->id, 9, '发货-订单'.$model['id']);
                        if($product['delivery_id'] != 2){
                            Message::send(17, $orderModel['user_id'], ['nickname'=>$username['username'], 'time'=>date('Y-m-d H:i:s'),'goodsName'=>$product['name'], 'expressCompany'=>$company, 'expressNo'=>$post['deliver_order'], 'orderNo'=>$model['id']]);
                        }
                        return 1;
                    }elseif(isset($post['unsuccessId']) && $post['unsuccessId']){
                        $model->status = 6;
                        if (!$model->save()) {
                            $trans->rollBack();
                            return 0;
                        }

                        $orderModel->status = 6;
                        $orderModel->last_modified = time();
                        if (!$orderModel->save()) {
                            $trans->rollBack();
                            return 0;
                        }

                        $trans->commit();
                        return 1;
                    } else {
                        $trans->rollBack();
                        return 0;
                    }
                } catch (Exception $e) {
                    $trans->rollBack();
                    return 0;
                }
            }
        }
    }
    //虚拟物品发货
    public function actionVirtual()
    {
        $status = Yii::$app->request->get('status');
        $request = Yii::$app->request;

        $where = [];
        if($request->isGet){
            $get = $request->get();
            if(isset($get['sub']) && $get['sub'] == 'sub'){
                $where['endTime'] = $get['endTime'];
                $where['startTime'] = $get['startTime'];
                $where['name'] = $get['name'];
                $where['content'] = $get['content'];
            }
        }

        $list = Deliver::thirdPlatformDeliverList($status, 25, $delivery = 2, $where);

        $arr = [];
        foreach($list['list'] as $key=>$val){
            $goodInfo = Product::info($val['product_id']);
            $period = Period::findOne($val['period_id']);
            $info = VirtualProductInfo::findOne(['order_id'=>$val['id']]);
            $arr[$key]['id'] = $val['id'];
            $arr[$key]['order_no'] = $val['order_no'];
            $arr[$key]['name'] = $goodInfo['name'];
            $arr[$key]['cat_id'] = $goodInfo['cat_id'];
            $arr[$key]['period_number'] = $period['period_number'];
            $arr[$key]['status'] = $val['status'];
            $arr[$key]['user_id'] = ModelUser::findOne($val['user_id']);
            $arr[$key]['ship_name'] = $info['account'];
            $arr[$key]['ship_mobile'] = $val['ship_mobile'];
            $arr[$key]['create_time'] = DateFormat::microDate($val['confirm_addr_time']);
        }

        $categoryChildren = ProductCategory::allOrderList();
        $catName = ArrayHelper::getColumn($categoryChildren, 'name');

        return $this->render('virtual',[
            'list' => $arr,
            'pagination' => $list['pagination'],
            'catName' => $catName,
            'status' => $status,
            'condition' => $where
        ]);
    }

    public function actionVirtualDetail()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');

        $detail = Deliver::orderDetail($id);
        $goodInfo = Product::info($detail['product_id']);
        $periodInfo = Period::find()->where(['id'=>$detail['period_id']])->one();
        $recharge = VirtualProductInfo::findOne(['order_id'=>$id]);
        $recharge['user_id'] = ModelUser::userName($recharge['user_id']);
        $person = Deliver::getEmployeeName();

        if($request->isPost){
            $trans = Yii::$app->db->beginTransaction();
            $post = $request->post();
            $model = Deliver::findOne($post['id']);
            $model->deliver_userid = Yii::$app->admin->id;
            $model->deliver_time = time();
            $model->status = 4;
            $model->platform = isset($post['other']) ? $post['other'] : $post['platform'];
            $model->third_order = $post['order'];
            $model->price = $post['price'];
            $model->bill = $post['bill'];
            $model->standard = $post['standard'];
            $model->mark_text = $post['comment'];
            if($model->save()){
                $order = Order::findOne($post['id']);
                $order->status = 4;
                $order->last_modified = time();
                if($order->save()){
                    $trans->commit();
                    BackstageLog::addLog(Yii::$app->admin->id, 9, '虚拟物品发货-订单'.$model['id']);
                    Message::send(17, $periodInfo['user_id'], ['nickname'=>$recharge['user_id']['username'], 'time'=>date('Y-m-d H:i:s'),'goodsName'=>$goodInfo['name'], 'expressCompany'=>'11', 'expressNo'=>'222', 'orderNo'=>$detail['id']]);
                    return 1;
                }else{
                    $trans->rollBack();
                    return 0;
                }
            }else{
                $trans->rollBack();
                return 0;
            }
        }

        return $this->render('virtual_detail',[
            'detail' => $detail,
            'goodInfo' => $goodInfo,
            'periodInfo' => $periodInfo,
            'recharge' => $recharge,
            'person' => $person
        ]);
    }

    public function actionModifySend()
    {
        $id = Yii::$app->request->get('id');
        $detail = Deliver::findOne($id);
        $express = Express::getExpressName();

        $request = Yii::$app->request;
        if($request->isPost){
            $post = $request->post();
            $model = Deliver::findOne($post['id']);
            if (!$model) return 0;
            if($model['status'] == 4){
                $model->deliver_company = isset($post['comother']) ? $post['comother'] : $post['company'];;
                $model->deliver_order = $post['deliver_order'];
            }
            $model->platform = isset($post['other']) ? $post['other'] : $post['platform'];
            $model->third_order = $post['order'];
            $model->bill = $post['bill'];
            $model->price = $post['price'];
            $model->standard = $post['standard'];
            $model->mark_text = $post['comment'];
            if($model->save()){
                BackstageLog::addLog(Yii::$app->admin->id, 9, '修改备发货信息-订单'.$model['id']);
                return 1;
            } else{
                return 0;
            }
        }

        return $this->render('modify', [
            'detail' => $detail,
            'express' => $express
        ]);
    }
}
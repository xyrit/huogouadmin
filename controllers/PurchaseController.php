<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2016/1/14
 * Time: 15:39
 * 采购管理
 */

namespace app\controllers;

use app\helpers\DateFormat;
use app\models\Admin;
use app\models\Deliver;
use app\models\Product;
use app\models\ProductStoreLog;
use app\models\Purchase;
use app\models\PurchaseOrder;
use app\models\PurchaseOrderItem;
use app\models\SupplierProduct;
use app\models\VirtualDepot;
use app\models\VirtualProductInfo;
use app\models\VirtualPurchaseOrder;
use Yii;
use yii\helpers\Json;

class PurchaseController extends BaseController
{
    private $virtualProducts = array(
        '0' => array('name'=>'10元移动充值卡','parValue'=>'10','perMoney'=>'9.94','mark'=>'yd0006','type' => 'yd'),
        '1' => array('name'=>'30元移动充值卡','parValue'=>'30','perMoney'=>'29.4','mark'=>'yd0008','type' => 'yd'),
        '2' => array('name'=>'50元移动充值卡','parValue'=>'50','perMoney'=>'49.4','mark'=>'yd0009','type' => 'yd'),
        '3' => array('name'=>'100元移动充值卡','parValue'=>'100','perMoney'=>'99.4','mark'=>'yd0009','type' => 'yd'),
        '4' => array('name'=>'30元联通充值卡','parValue'=>'30','perMoney'=>'29.4','mark'=>'lt0003','type'=>'lt'),
        '5' => array('name'=>'50元联通充值卡','parValue'=>'50','perMoney'=>'49.4','mark'=>'lt0003','type'=>'lt'),
        '6' => array('name'=>'100元联通充值卡','parValue'=>'100','perMoney'=>'99.4','mark'=>'lt0003','type'=>'lt'),
        '7' => array('name'=>'30元电信充值卡','parValue'=>'30','perMoney'=>'29.4','mark'=>'dx0002','type'=>'dx'),
        '8' => array('name'=>'50元电信充值卡','parValue'=>'50','perMoney'=>'49.4','mark'=>'dx0002','type'=>'dx'),
        '9' => array('name'=>'100元电信充值卡','parValue'=>'100','perMoney'=>'99.4','mark'=>'dx0002','type'=>'dx'),
        // '10' => array('name'=>'10元Q币充值卡','parValue'=>'10','perMoney'=>'9.4','mark'=>'yd0006','type'=>'qb'),
    );

    public function actionIndex()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 20);
            $condition['orderId'] = $request->get('orderId');
            $condition['adminId'] = $request->get('adminId', 'all');
            $condition['startTime'] = $request->get('startTime');
            $condition['endTime'] = $request->get('endTime');

            $data = PurchaseOrder::getList($condition, $page, $pageSize);
            return $data;
        }

        $params['view'] = $this->checkPrivilege($this->getUniqueId() . '/view');
        return $this->render('index', $params);
    }

    public function actionAdd()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $model = new PurchaseOrder();
            $purchase = $request->post('Purchase');

            $trans = Yii::$app->db->beginTransaction();
            try {
                $model->status = 0;
                $model->created_at = time();
                $model->admin_id = Yii::$app->admin->id;

                if (!$model->save()) {
                    $trans->rollBack();
                    foreach ($model->errors as $message) {
                        return Json::encode(['error' => 1, 'message' => $message]);
                    }
                }

                $sum = 0;
                $flag = false;
                foreach ($purchase as $supplierId => $product) {
                    foreach ($product as $productId => $one) {
                        if ($one['num'] > 0) {
                            $flag = true;
                            $supplierProduct = SupplierProduct::findOne(['supplier_id' => $supplierId, 'product_id' => $productId]);
                            if (!$supplierProduct) {
                                $trans->rollBack();
                                return Json::encode(['error' => 1, 'message' => '新增采购订单失败']);
                            }
                            $purchaseOrderItem = new PurchaseOrderItem();
                            $purchaseOrderItem->purchase_order_id = $model->id;
                            $purchaseOrderItem->supplier_id = $supplierId;
                            $purchaseOrderItem->product_id = $productId;
                            $purchaseOrderItem->product_num = $one['num'];
                            $purchaseOrderItem->privilege = $one['privilege_price'];
                            $purchaseOrderItem->supplier_price = $supplierProduct['price'];
                            if (!$purchaseOrderItem->save()) {
                                $trans->rollBack();
                                foreach ($purchaseOrderItem->errors as $message) {
                                    return Json::encode(['error' => 1, 'message' => $message]);
                                }
                            }

                            $sum += $supplierProduct['price'] * $one['num'] - $one['privilege_price'];
                        }
                    }
                }

                if (!$flag) {
                    $trans->rollBack();
                    return Json::encode(['error' => 1, 'message' => '请添加商品']);
                }

                $model->money = $sum;
                if (!$model->save()) {
                    $trans->rollBack();
                    foreach ($model->errors as $message) {
                        return Json::encode(['error' => 1, 'message' => $message]);
                    }
                }

                $trans->commit();
                $this->addLog('新增采购订单，编号-' . $model['id']);
                return Json::encode(['error' => 0, 'message' => '新增采购订单成功']);
            } catch (\Exception $e) {
                $trans->rollBack();
                return Json::encode(['error' => 1, 'message' => $e->getMessage()]);
            }
        }

        return $this->render('add');
    }

    public function actionEdit()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = PurchaseOrder::findOne($id);

        if ($request->isPost) {
            $purchase = $request->post('Purchase');

            $trans = Yii::$app->db->beginTransaction();
            try {
                $model->updated_at = time();

                if (!$model->save()) {
                    $trans->rollBack();
                    foreach ($model->errors as $message) {
                        return Json::encode(['error' => 1, 'message' => $message]);
                    }
                }

                $sum = 0;
                //删除
                PurchaseOrderItem::deleteAll(['purchase_order_id' => $id]);
                foreach ($purchase as $supplierId => $product) {
                    foreach ($product as $productId => $one) {
                        $supplierProduct = SupplierProduct::findOne(['supplier_id' => $supplierId, 'product_id' => $productId]);
                        if (!$supplierProduct) {
                            $trans->rollBack();
                            return Json::encode(['error' => 1, 'message' => '编辑采购订单失败']);
                        }
                        $purchaseOrderItem = new PurchaseOrderItem();
                        $purchaseOrderItem->purchase_order_id = $model->id;
                        $purchaseOrderItem->supplier_id = $supplierId;
                        $purchaseOrderItem->product_id = $productId;
                        $purchaseOrderItem->product_num = $one['num'];
                        $purchaseOrderItem->privilege = $one['privilege_price'];
                        $purchaseOrderItem->supplier_price = $supplierProduct['price'];
                        if (!$purchaseOrderItem->save()) {
                            $trans->rollBack();
                            foreach ($purchaseOrderItem->errors as $message) {
                                return Json::encode(['error' => 1, 'message' => $message]);
                            }
                        }

                        $sum += $supplierProduct['price'] * $one['num'] - $one['privilege_price'];
                    }
                }

                $model->money = $sum;
                if (!$model->save()) {
                    $trans->rollBack();
                    foreach ($model->errors as $message) {
                        return Json::encode(['error' => 1, 'message' => $message]);
                    }
                }

                $trans->commit();
                $this->addLog('编辑采购订单，编号-' . $model['id']);
                return Json::encode(['error' => 0, 'message' => '编辑采购订单成功']);
            } catch (\Exception $e) {
                $trans->rollBack();
                return Json::encode(['error' => 1, 'message' => $e->getMessage()]);
            }
        }

        $purchaseOrderItem = PurchaseOrderItem::find()
            ->leftJoin('suppliers', 'purchase_order_items.supplier_id=suppliers.id')
            ->leftJoin('products', 'purchase_order_items.product_id=products.id')
            ->select(['purchase_order_items.*', 'products.name as product_name', 'suppliers.name as supplier_name'])
            ->where(['purchase_order_items.purchase_order_id' => $id])->asArray()->all();
        foreach ($purchaseOrderItem as &$one) {
            $one['total'] = $one['supplier_price'] * $one['product_num'] - $one['privilege'];
        }

        return $this->render('edit', ['model' => $model, 'orderItem' => $purchaseOrderItem]);
    }

    public function actionView()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $admin = Admin::find()->indexBy('id')->asArray()->all();
        $model = PurchaseOrder::find()->where(['id' => $id])->asArray()->one();
        $model['admin_name'] = isset($admin[$model['admin_id']]) ? $admin[$model['admin_id']]['username'] : '';
        $model['approved_admin_name'] = isset($admin[$model['approved_admin_id']]) ? $admin[$model['approved_admin_id']]['username'] : '';

        $purchaseOrderItem = PurchaseOrderItem::find()
            ->leftJoin('suppliers', 'purchase_order_items.supplier_id=suppliers.id')
            ->leftJoin('products', 'purchase_order_items.product_id=products.id')
            ->select(['purchase_order_items.*', 'products.name as product_name', 'suppliers.name as supplier_name'])
            ->where(['purchase_order_items.purchase_order_id' => $id])->asArray()->all();
        $totalPrice = 0;
        foreach ($purchaseOrderItem as &$one) {
            $one['sum'] = sprintf('%.2f', $one['supplier_price'] * $one['product_num']);
            $one['total'] = sprintf('%.2f', $one['supplier_price'] * $one['product_num'] - $one['privilege']);
            $totalPrice += $one['total'];
        }


        return $this->render('view', ['model' => $model, 'orderItem' => $purchaseOrderItem, 'totalPrice' => $totalPrice]);
    }

    // 采购入库
    public function actionStore()
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 10);
            $condition = [];
            $condition['orderId'] = $request->get('id', 0);
            $condition['adminId'] = $request->get('admin_id', 0);
            $condition['storedAdminId'] = $request->get('stored_admin_id', 0);
            $condition['storedStartTime'] = $request->get('sstart', '');
            $condition['storedEndTime'] = $request->get('send', '');
            $condition['startTime'] = $request->get('cstart', '');
            $condition['endTime'] = $request->get('cend', '');
            $condition['status'] = 1;
            $data = PurchaseOrder::getList($condition, $page, $pageSize);

            return $data;
        }
        $params['view'] = $this->checkPrivilege('product/store-view');
        return $this->render('storage-list');
    }

    // 入库操作
    public function actionEnterStore()
    {
        $request = Yii::$app->request;
        $getId = $request->get('id');
        $id = isset($getId) ? $getId : $request->post('id');
        $model = PurchaseOrder::findOne($id);
        $items = PurchaseOrderItem::find()->where(['purchase_order_id'=>$model['id']])->all();
        if(!$model){
            echo json_encode(['error'=>1, 'message'=>'订单不存在']);
            Yii::$app->end();
        }

        if($request->isPost){
            $begin = Yii::$app->db->beginTransaction();
            try{
                foreach($items as $val){
                    $productModel = Product::findOne($val['product_id']);
                    $productModel->total = $productModel['total'] + $val['product_num'];
                    if(!$productModel->save()){
                        $begin->rollBack();
                        $this->addLog('入库失败-'.$model['id'].',更新商品表失败');
                        echo json_encode(['error'=>2, 'message'=>'更新商品表失败']);
                        Yii::$app->end();
                    }
                    ProductStoreLog::insertRecord($val['product_id'], 1, $val['product_num'], $productModel['total'], '采购入库，采购订单号'.$model['id']);
                }
                $model->stored_at = time();
                $model->stored_admin_id = Yii::$app->admin->id;
                if($model->save()){
                    $begin->commit();
                    $this->addLog('入库成功-'.$model['id']);
                    echo json_encode(['error'=>0, 'message'=>'入库成功']);
                    Yii::$app->end();
                }else{
                    $begin->rollBack();
                    $this->addLog('入库失败-'.$model['id']);
                    echo json_encode(['error'=>3, 'message'=>'入库失败']);
                    Yii::$app->end();
                }
            }catch (Exception $e){
                $begin->rollBack();
                $this->addLog('入库失败-'.$model['id']);
                echo json_encode(['error'=>4, 'message'=>'入库失败']);
                Yii::$app->end();
            }

        }

        $goodList = [];
        foreach($items as $key => $val){
            $product = Product::findOne($val['product_id']);
            $goodList[$key]['name'] = $product['name'];
            $goodList[$key]['bn'] = $product['bn'];
            $goodList[$key]['num'] = $val['product_num'];
        }
        $person = Deliver::getEmployeeName();

        return $this->render('enter-store', [
            'model' => $model,
            'admin' => $person,
            'goodsList' => $goodList
        ]);
    }

    //采购商品
    public function actionOrder()
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            $page = $request->get('page', 1);
            $perpage = $request->get('rows', 20);
            $list = Purchase::getList('', $page, $perpage);

            foreach($list['list'] as &$val){
                $val['last_update_time'] = DateFormat::microDate($val['last_update_time']);
                $val['status'] = Purchase::getStatus($val['status']);
            }

            return ['rows'=>$list['list'], 'total'=>$list['totalCount']];
        }

        return $this->render('order');
    }

    //采购商品详情
    public function actionOrderView()
    {
        $id = Yii::$app->request->get('id');
        $info = Purchase::getInfoById($id);

        $info['schedule'] = Json::decode($info['schedule'],true);
        $info['status'] = Purchase::getStatus($info['status']);

        if ($info['type'] == '2') {
            $order = VirtualPurchaseOrder::find()->where(['purchaseid' => $id])->asArray()->one();
            $cards = VirtualDepot::find()->where(['orderid'=>$order['orderid']])->asArray()->all();
            $info['order'] = $order;
            $info['cards'] = $cards;
        }

        return $this->render('order-view', [
            'info' => $info,
        ]);
    }

    /**
     * @pass
     **/
    //通过审核
    public function actionPass(){
        $id = Yii::$app->request->get('id');

        $info = Purchase::getInfoById($id);

        if ($info['type'] == '2' && $info['status'] == '0') {
            $config = Json::decode($info['extra'],true);
            if ($config['interface'] == 'zhifuka') {
                $vid = $config['vid'];
                $parValue = $config['parValue'];
                $order = VirtualPurchaseOrder::createOrder($vid,$parValue,$info['nums']);
                if ($order) {
                    $mark = $this->virtualProducts[$config['vid']]['mark'];
                    $result = Yii::$app->zhifuka->buyCard($mark,$parValue,$info['nums'],$order,\Yii::$app->request->userIP);
                    if ($result['code'] == '100') {
                        VirtualPurchaseOrder::updateAll(
                            array(
                                'status' => 1,
                                'update_time' => time(),
                                'exchange_no' => $result['msg']['exchange_id'],
                                'result' => $result['msg']['result'],
                            ),array('orderid'=>$result['msg']['orderid'])
                        );
                        $schedule = Json::decode($info['schedule'],true);
                        $newSchedule = array(
                            'user'=>Yii::$app->admin->identity->username,
                            'schedule' => '通过申请',
                            'time' => date("Y-m-d H:i:s",time())
                        );
                        array_push($schedule, $newSchedule);
                        Purchase::updateAll(
                            array('status'=>2,'schedule'=>Json::encode($schedule)),
                            array('id'=>$id)
                        );
                        $virtualDepotField = ['orderid','card','pwd','par_value','type'];
                        $virtualDepotValue = [];
                        foreach ($result['msg']['cards'] as $key => $value) {
                            $virtualDepotValue[] = [$order,$value['card'],$value['pwd'],$parValue,$this->virtualProducts[$config['vid']]['type']];
                        }
                        $db = \Yii::$app->db;
                        $db->createCommand()->batchInsert('virtual_depot',$virtualDepotField,$virtualDepotValue)->execute();
                    }else{
                        VirtualPurchaseOrder::updateAll(
                            array(
                                'update_time' => time(),
                                'result' => $result['msg']
                            ),array('orderid'=>$order)
                        );
                    }
                }
            }
        }
    }
}
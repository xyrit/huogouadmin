<?php
namespace app\controllers;

use app\models\ActivityProducts;
use app\models\Admin;
use app\models\JdcardBuybackList;
use app\models\JdcardBuybackMobile;
use app\models\Order;
use app\models\Period;
use app\models\PkOrders;
use app\models\PkPeriods;
use app\models\Product;
use app\models\User;
use yii\data\Pagination;
use yii\web\Response;
use Yii;
use app\helpers\Ex;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/18
 * Time: 10:28
 * 京东卡回购
 */
class JdcardbuybackController extends BaseController
{
    public function actionMobileList()
    {

        $request = \Yii::$app->request;
        if ($request->isAjax || $request->get('excel') == 'virtual') {
            $page = $request->get('page', 1);
            $perpage = $request->get('row', 10);

            $mobilecount = JdcardBuybackMobile::find()->count();
            $pagination = new Pagination(['totalCount' => $mobilecount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
            $mobilelist = JdcardBuybackMobile::find()->offset($pagination->offset)
                ->limit($pagination->limit)
                ->orderBy('id desc')->asArray()
                ->all();

            if ($mobilelist) {
                foreach ($mobilelist as &$row) {
                    //根据商品id 查询面额
                    $mobileModel = JdcardBuybackList::find();
                    $mobileModel->select(['pay_status', 'mobile', 'face_value', 'count(*) as nums']);
                    $mobileModel->groupBy(['face_value', 'pay_status']);
                    $mobileModel->where(['mobile' => $row['mobile']]);
                    $order_face = $mobileModel->asArray()->all();
                    //查询已支付面额区分
                    $str = '';
                    $str1 = '';
                    $str3 = '';
                    $zcount = [];
                    foreach ($order_face as $key1 => $row1) {
                        if ($row1['pay_status'] == 1) {
                            $str .= $row1['face_value'] . '面值' . $row1['nums'] . '张,';
                        } else {
                            $str1 .= $row1['face_value'] . '面值' . $row1['nums'] . '张,';
                        }
                        if (array_key_exists($row1['face_value'], $zcount)) {
                            $zcount[$row1['face_value']] += $row1['nums'];
                        } else {
                            $zcount[$row1['face_value']] = $row1['nums'];
                        }
                    }
                    foreach ($zcount as $key2 => $row2) {
                        $str3 .= $key2 . '面值' . $row2 . '张,';
                    }
                    $row['y'] = $str;
                    $row['n'] = $str1;
                    $row['z'] = $str3;            //总张数

                    // 查询未支付面额区分
                }
            }

            return ['total' => $mobilecount, 'rows' => $mobilelist];
        }
        return $this->render('mobilelist');

    }
    public function actionBuybackList()
    {

        $request = \Yii::$app->request;
        if($request->get('mobile')){
            $mobile = $request->get('mobile');
            setcookie('buymobile', $mobile, time() + 24 * 3600, '/');
        }else{
            $mobile=0;
        }

        if ($request->isAjax || $request->get('excel') == 'buyback') {
            $page = $request->get('page', 1);
            $perpage = $request->get('row', 10);
            $mobile = $mobile ? $mobile : $_COOKIE['buymobile'];
            if (!$mobile) {
                return false;
            }
            $JdcardBuyback = JdcardBuybackList::find();
            $JdcardBuyback->select(['order_id', 'order_type', 'pay_no', 'pay_type','pay_accounts','pay_name','pay_money', 'period_id', 'u.nickname', 'u.phone', 'face_value', 'pay_status', 'pay_time', 'add_time', 'u.from', 'jdcard_buyback_list.id id','action_log']);
            $JdcardBuyback->leftJoin('users u', 'u.id=jdcard_buyback_list.user_id');
            $JdcardBuyback->where(['mobile' => $mobile]);
            if ($request->get('start_time')) {
                $JdcardBuyback->andWhere(['>=', 'pay_time', strtotime($request->get('start_time'))]);
            }
            if ($request->get('end_time')) {
                $JdcardBuyback->andWhere(['<', 'pay_time', strtotime($request->get('end_time'))]);
            }
            if ($request->get('account')) {
                $JdcardBuyback->andWhere(['u.phone' => $request->get('account')]);
            }
            if ($request->get('beihuo')) {
                //查询备货人
                $admin=Admin::find()->where(['real_name'=>$request->get('beihuo')])->one();

                $JdcardBuyback->andFilterWhere(['like','action_log','{"log_status2":{"admin_id":'.$admin['id']]);

            }
            if ($request->get('period_no')) {
                //查询期号
                if(strstr($request->get('period_no'),'PK')){
                 $period=PkPeriods::find()->where(['period_no'=>$request->get('period_no')])->one();
                }else {
                 $period=Period::find()->where(['period_no'=>$request->get('period_no')])->one();
                }
                $JdcardBuyback->andWhere(['period_id' => $period['id']]);
            }
            if ($request->get('order_id')) {
                //查询订单号
                $JdcardBuyback->andWhere(['order_id' =>$request->get('order_id')]);
            }
            $Buybackcount = $JdcardBuyback->count();
            if ($request->get('excel') == 'buyback') {
                ini_set('memory_limit', '1000M');
                $perpage = 50;
                $list = [];
                $maxPage = ceil($Buybackcount / $perpage);//获取最大页数

                for ($i = 1; $i <= $maxPage; $i++) {
                    $pagination = new Pagination(['totalCount' => $Buybackcount, 'page' => $i - 1, 'defaultPageSize' => $perpage]);
                    $Buybacklist = $JdcardBuyback->offset($pagination->offset)
                        ->limit($pagination->limit)
                        ->orderBy('jdcard_buyback_list.id desc')->asArray()
                        ->all();
                    foreach ($Buybacklist as &$row) {
                        if ($row['order_type'] == 1) {
                            $row['order_id'] = 'PK' . $row['order_id'];
                            $row['order_type'] = '活动:PK场';
                        } else {
                            $row['order_type'] = '普通';
                        }
                        $row['add_time'] = date('Y-m-d h:i:s', $row['add_time']);
                        switch ($row['pay_type']) {
                            case 1:
                                $row['pay_type'] = '支付宝';
                                break;
                            case 2:
                                $row['pay_type'] = '微信';
                                break;
                            case 3:
                                $row['pay_type'] = '银行卡';
                                break;
                            default:
                                $row['pay_type'] = '未知';
                        }
                        if ($row['from'] == 1) {
                            $row['from'] = '伙购';
                        } else {
                            $row['from'] = '滴滴';
                        }
                        if($row['pay_status']==1){
                            $row['pay_status'] = '已付款';
                        }else{
                            $row['pay_status'] = '未付款';
                        }
                        $action_log=json_decode($row['action_log'],1);
                        unset($row['action_log']);
                        unset($row['id']);
                        $row['beihuo']='无';
                        $row['fahuo']='无';
                        if($action_log)
                        {
                            if(!empty($action_log['log_status2'])){
                                $beihuo=Admin::findOne($action_log['log_status2']['admin_id']);
                                $row['beihuo']=$beihuo['real_name'];
                            }else{
                                $row['beihuo']='无';
                            }
                            if(!empty($action_log['log_status1'])){
                               $fahuo=Admin::findOne($action_log['log_status1']['admin_id']);
                                $row['fahuo']=$fahuo['real_name'];
                            }else{
                                $row['fahuo']='无';
                            }

                        }

                        $row['pay_time'] = date('Y-m-d h:i:s', $row['pay_time']);
                        //根据订单查询中奖时间
                        if($row['order_type']==0){
                            $wintime=Period::findOne($row['period_id']);
                        }else{
                            $wintime=PkPeriods::findOne($row['period_id']);
                        }
                        //分割
                        if($wintime['exciting_time'])
                        {
                        $arr = explode(".",$wintime['exciting_time']);
                        $row['wintime']=date('Y-m-d H:i:s',$arr[0]);
                        }else{
                            $row['wintime']=0;
                        }
                        //查询期号
                        if ($row['order_type'] == '活动:PK场') {
                         $period= PkOrders::findOne($row['period_id']);
                        } else {
                         $period= Period::findOne($row['period_id']);
                        }
                        $row['period_no']=$period['period_no'];
                    }

                    $list = array_merge($list, $Buybacklist);
                }

                $data = ['order_id' => '订单编号', 'order_type' => '订单类型', 'pay_no' => '流水号', 'pay_type' => '付款类型', 'pay_accounts' => '帐号','pay_name' => '姓名','pay_money' => '金额','period_id' => '期数', 'nickname' => '获奖用户昵称', 'phone' => '获奖手机号', 'face_value' => '面值', 'pay_status' => '付款状态', 'pay_time' => '付款时间', 'add_time' => '回购时间', 'from' => 'App类型','beihuo'=>'备货人','fahuo'=>'发货人','wintime'=>'中奖时间','period_no' => '当前期号',];

               array_unshift($list, $data);

                $excel = new Ex();
                $excel->download($list, '回购京东卡数据' . date('Y-m-d H:i:s') . '.xls');
                unset($list);
                exit;

            }
            $pagination = new Pagination(['totalCount' => $Buybackcount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
            $Buybacklist = $JdcardBuyback->offset($pagination->offset)
                ->limit($pagination->limit)
                ->orderBy('jdcard_buyback_list.id desc')->asArray()
                ->all();

            foreach ($Buybacklist as &$row){
                if($row['order_type']==0){
                  $periodinfo= Period::findOne($row['period_id']);

                }
                else if($row['order_type']==1){
                    $periodinfo=PkPeriods::findOne($row['period_id']);
                }else{
                    $periodinfo['period_no']='无';
                }
                $row['period_no']=$periodinfo['period_no'];

                //添加备货人
                $action_log=json_decode($row['action_log'],1);
                if(isset($action_log['log_status2'])){
                $beihuo=Admin::findOne($action_log['log_status2']['admin_id']);
                $row['beihuo']=$beihuo['real_name'];
                }else{
                    $row['beihuo']='';
                }
            }

            return ['total' => $Buybackcount, 'rows' => $Buybacklist];
        }
        return $this->render('buybacklist');

    }


    // 详情
    public function actionBuybackInfo()
    {
        $request = \Yii::$app->request;
        $id = $request->get('id', 0);
        if ($request->post()) {
            $post = $request->post();
            $JdcardBuyback = JdcardBuybackList::findOne($post['buyback']['id']);
            if(!$post['buyback']['pay_accounts'] ||  !$post['buyback']['pay_money'] || !$post['buyback']['pay_name']){
                echo json_encode(['code' => 2, 'message' => '数据错误']);
                Yii::$app->end();
            }
            if ($JdcardBuyback->pay_status == 0) {
                $trans = Yii::$app->db->beginTransaction();
                try{
                $JdcardBuyback->pay_type = $post['buyback']['pay_type'];
                $JdcardBuyback->pay_accounts = $post['buyback']['pay_accounts'];
                $JdcardBuyback->pay_money = $post['buyback']['pay_money'];
                $JdcardBuyback->pay_desc = $post['buyback']['pay_desc'];
                $JdcardBuyback->pay_name = $post['buyback']['pay_name'];
                $JdcardBuyback->rate = $post['buyback']['rate'];
                $JdcardBuyback->pay_status = 2;     //改为待付款
                $JdcardBuyback->admin_id = \Yii::$app->admin->id;
                $JdcardBuyback->bank_name = $post['buyback']['bank_name'];
                //记录操作记录
                $action_log['log_status2'] = ['admin_id' => \Yii::$app->admin->id, 'time' => date('Y-m-d h:i:s')];
                $action_log = json_encode($action_log);
                $JdcardBuyback->action_log = $action_log;
                $rs = $JdcardBuyback->save();
                //更改订单状态
                switch ($JdcardBuyback['order_type']) {
                    case 0:
                        $orderModel = Order::findOne($JdcardBuyback['order_id']);
                        $orderModel->status = 3;
                        $rs2 = $orderModel->save();
                        break;
                    case 1:
                        $pkorderModel = PkOrders::findOne($JdcardBuyback['order_id']);
                        $pkorderModel->status = 3;
                        $rs2 = $pkorderModel->save();
                        break;
                    default:
                        $trans->rollBack();
                        echo json_encode(['code' => 2, 'message' => ' 订单状态不存在']);
                        Yii::$app->end();
                        break;

                }

                if ($rs && $rs2) {
                    $trans->commit();
                    echo json_encode(['code' => 1, 'message' => '操作成功']);
                    Yii::$app->end();
                } else {
                    $trans->rollBack();
                    echo json_encode(['code' => 2, 'message' => ' 操作失败']);
                    Yii::$app->end();
                }
                }catch (\Exception $e) {
                    $trans->rollBack();
                    echo json_encode(['code' => 2, 'message' => $e->getMessage()]);
                    Yii::$app->end();
                }
            }

        } else {
            if ($id) {
                $Buyback = JdcardBuybackList::findOne($id)->toArray();
                $data['buyback'] = $Buyback;
                $data['pay_type'] = JdcardBuybackList::$pay_type;

                /*****查询备注*****/
                $desc=[];
                if($Buyback['order_type']==1){
                    $order=PkOrders::findOne($Buyback['order_id']);
                    if($order['remark']){
                        $remark=json_decode($order['remark'],1);
                        foreach ($remark as $key=>$row){
                            if(isset($row['admin_id'])){
                                $admin=Admin::findOne($row['admin_id']);
                            $desc[$key]['op_user']=$admin->real_name;
                            }else{
                                $desc[$key]['op_user']='';
                            }
                            $desc[$key]['op_content']=$row['desc'];
                            $desc[$key]['op_time']=$row['time'];
                        }
                    }

                }else{
                    $order=Order::findOne($Buyback['order_id']);
                    if($order['remark']){
                        $remark=json_decode($order['remark'],1);
                        if($remark){
                        foreach ($remark as &$row){
                            $admin=Admin::findOne($row['op_user']);
                            $row['op_user']=$admin->real_name;
                        }
                        $desc=$remark;
                        }else{
                            $desc[0]['op_user']='';
                            $desc[0]['op_content']=$order['remark'];
                            $desc[0]['op_time']='';
                        }
                    }
                }
                $data['desc_log']=$desc;

                /*****查询备注*****/
                if ($Buyback['pay_status'] == 0) {
                    $smaty = 'info';
                   //查询商品的面值
                    if($Buyback['order_type']==1){
                      $order= PkOrders::findOne($Buyback['order_id']);
                        $products=ActivityProducts::findOne($order['product_id']);
                    }else{
                        $order= Order::findOne($Buyback['order_id']);
                        $products=Product::findOne($order['product_id']);
                    }
                $data['face']=$products['face_value'];
                } else {
                    $smaty = 'add_pay';
                    //查询用户昵称和手机
                    $userinfo = User::findOne($Buyback['user_id'])->toArray();
                    $data['userinfo'] = $userinfo;

                    //操作日志
                    $data['action_log'] = json_decode($Buyback['action_log'], 1);
                    if ($data['action_log']) {
                        foreach ($data['action_log'] as &$row) {
                            $row['real_name'] = Admin::findOne($row['admin_id'])->real_name;
                        }
                    }

                }
                return $this->render($smaty, $data);
            }
        }

    }

    //确认订单
    public function actionQuerybuyback(){
        $request = \Yii::$app->request;
        $post = $request->post();
        $JdcardBuyback = JdcardBuybackList::findOne($post['buyback']['id']);
    if ($JdcardBuyback->pay_status == 2 ) {
        $trans = Yii::$app->db->beginTransaction();
        try{
        if(!$post['buyback']['pay_no'])
        {
            echo json_encode(['code' => 2, 'message' => ' 操作失败,请填写订单号']);
            Yii::$app->end();
        }
        $JdcardBuyback->pay_no = $post['buyback']['pay_no'];
        $JdcardBuyback->pay_status = 1;     //改为已支付
        $JdcardBuyback->pay_time = time();     //改为已支付
        $JdcardBuyback->admin_id = \Yii::$app->admin->id;
        $action_log_arr = json_decode($JdcardBuyback->action_log, 1);
        $action_log_arr['log_status1'] = ['admin_id' => \Yii::$app->admin->id, 'time' => date('Y-m-d h:i:s')];
        $JdcardBuyback->action_log = json_encode($action_log_arr);

        //更改订单状态
        switch ($JdcardBuyback['order_type']) {
            case 0:
                $orderModel = Order::findOne($JdcardBuyback['order_id']);
                $orderModel->status = 8;
                $rs2 = $orderModel->save();
                break;
            case 1:
                $pkorderModel = PkOrders::findOne($JdcardBuyback['order_id']);
                $pkorderModel->status = 8;
                $rs2 = $pkorderModel->save();
                break;
            default:
                $trans->rollBack();
                echo json_encode(['code' => 2, 'message' => ' 订单状态不存在']);
                Yii::$app->end();
                break;

        }
        $rs = $JdcardBuyback->save();

        if ($rs && $rs2) {
            $trans->commit();
            echo json_encode(['code' => 1, 'message' => '操作成功']);
            Yii::$app->end();
        } else {
            $trans->rollBack();
            echo json_encode(['code' => 2, 'message' => ' 操作失败']);
            Yii::$app->end();
        }
        }catch (\Exception $e) {
            $trans->rollBack();
            echo json_encode(['code' => 2, 'message' => $e->getMessage()]);
            Yii::$app->end();
        }

    }
    }

    //回购电话列表
    public function actionBuybackMobilelist()
    {
        $request = \Yii::$app->request;

        if ($request->isAjax) {
            $page = $request->get('page', 1);
            $perpage = $request->get('row', 10);

            $mobileList = JdcardBuybackMobile::find();


            $mobileListcount = JdcardBuybackMobile::find()->count();

            $pagination = new Pagination(['totalCount' => $mobileListcount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
            $list = $mobileList->offset($pagination->offset)
                ->limit($pagination->limit)
                ->orderBy('id desc')->asArray()
                ->all();

            return ['total' => $mobileListcount, 'rows' => $list];
        }

        return $this->render('mobilelist');
    }


    public function actionBuybackAddmobile()
    {

        $request = \Yii::$app->request;
        $mobile = $request->post('mobile');
        $id = $request->post('id');
        if ($id) {
            $mobileModel = JdcardBuybackMobile::findone($id);
            $mobileModel->mobile = $mobile;
            $mobileModel->admin_id = \Yii::$app->admin->id;
            $rs = $mobileModel->save();
        } else {
            try {
                $mobileModel = new JdcardBuybackMobile();
                $mobileModel->mobile = $mobile;
                $mobileModel->admin_id = \Yii::$app->admin->id;
                $mobileModel->add_time = time();
                $rs = $mobileModel->save();
            } catch (\Exception $e) {

                return json_encode(['error' => 0, 'message' => $e->getMessage()]);
            }
        }
        if ($rs) {
            echo json_encode(['code' => 1, 'message' => '操作成功']);
        } else {
            echo json_encode(['code' => 2, 'message' => '操作失败']);
        }

    }

    public function actionOneEdit(){
        $request = \Yii::$app->request;
        $name = $request->post('name');
        $val = $request->post('val');
        $id = $request->post('id');
        if($id){
         $jdbuybakc= JdcardBuybackList::findOne($id);
            if($name=='pay_accounts'){
                $jdbuybakc->pay_accounts=$val;
            }
            if($name=='pay_name'){
                $jdbuybakc->pay_name=$val;
            }
            if($jdbuybakc->save()){
                echo json_encode(['code' => 1, 'message' => '操作成功']);
                Yii::$app->end();
            }else{
                echo json_encode(['code' => 2, 'message' => '操作失败']);
                Yii::$app->end();
            }
        }
        echo json_encode(['code' => 2, 'message' => '参数错误']);
        Yii::$app->end();
    }

}
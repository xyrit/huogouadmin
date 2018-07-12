<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/11/3
 * Time: 上午10:54
 */

namespace app\controllers;

use app\helpers\DateFormat;
use app\models\Product;
use app\models\PurchaseOrder;
use app\models\PurchaseOrderItem;
use app\models\Supplier;
use app\services\Member;
use Yii;
use app\models\Invite;
use app\models\User;
use app\models\Withdraw;
use app\models\PointLog;
use yii\data\Pagination;
use app\models\AdjustBalance;
use app\models\Admin;
use app\models\BackstageLog;
use app\helpers\Excel;
use app\helpers\Ex;
use yii\helpers\Json;

class FinanceController extends BaseController
{
    public function actionCommission()
    {
        $query = Withdraw::find()->select('withdraw.*, u.phone as user_phone, u.email')->leftJoin('users as u', 'u.id=withdraw.user_id');
        $status = Yii::$app->request->get('status', '-1');
        $start_time = Yii::$app->request->get('start_time', '');
        $end_time = Yii::$app->request->get('end_time', '');
        $account = Yii::$app->request->get('account', '');
        $excel = Yii::$app->request->get('excel', '');

        $condition = ['status' => $status, 'start_time' => $start_time, 'end_time' => $end_time, 'account' => $account];
        if ($start_time != '') {
            $query->andWhere(['>=', 'withdraw.apply_time', strtotime($start_time)]);
        }
        if ($end_time != '') {
            $query->andWhere(['<=', 'withdraw.apply_time', strtotime($end_time . ' 23:59:59')]);
        }
        if ($status != -1) {
            $query->andWhere(['withdraw.status' => $status]);
        }
        if ($account != '') {
            $query->andWhere(['or', 'u.phone="'.$account.'"', 'u.email="'.$account.'"', 'u.nickname="'.$account.'"']);
        }
        $query->orderBy('withdraw.apply_time desc');

        $countQuery = clone $query;
        $totalCount = $countQuery->count();

        if(isset($excel) && $excel == 'commission'){
            $pagination = new Pagination(['totalCount' => $totalCount, 'defaultPageSize' => PHP_INT_MAX, 'pageSizeLimit'=>[0, PHP_INT_MAX]]);
            $list = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
            $data[0] = ['id'=>'编号', 'user_phone'=>'手机号', 'email'=>'邮箱', 'money'=>'提现金额', 'bank'=>'开户行', 'account'=>'户名','bank_number'=>'账号','phone'=>'联系电话', 'status'=>'状态', 'apply_time'=>'时间'];

            $data = [];
            foreach($list as $key => $val){
                $key = $key + 1;
                $data[$key]['id'] = $val['id'];
                $data[$key]['user_phone'] = $val['user_phone'];
                $data[$key]['email'] = $val['email'];
                $data[$key]['money'] = $val['money'];
                $data[$key]['bank'] = $val['bank'];
                $data[$key]['account'] = $val['account'];
                $data[$key]['bank_number'] = $val['bank_number'];
                $data[$key]['phone'] = $val['phone'];
                if($val['status'] == 0){
                    $status = '新建';
                } elseif($val['status'] == 1){
                    $status = '待处理';
                }elseif($val['status'] == 2){
                    $status = '完成';
                }elseif($val['status'] == 3){
                    $status = '驳回';
                }
                $data[$key]['status'] = $status;
                $data[$key]['apply_time'] = DateFormat::microDate($val['apply_time']);
            }
            $excel = new Ex();
            $excel->download( $data, '佣金提现-'.date('Y-m-d H:i:s').'.xls');
        }else{
            $pagination = new Pagination(['totalCount' => $totalCount, 'defaultPageSize' => 25]);
            $list = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
        }

        $get = Yii::$app->request->get();
        if(empty($get)){
            $url = Yii::$app->request->getUrl().'?excel=commission';
        }else{
            $url = Yii::$app->request->getUrl().'&excel=commission';
        }

        return $this->render('commission', [
            'list' => $list,
            'pagination' => $pagination,
            'condition' => $condition,
            'url' => $url,
        ]);
    }

    public function actionCommissionView()
    {

        $request = \Yii::$app->request;
        $id = $request->get('id');
        $info = Withdraw::findOne($id);

        $rejectReason = [
            '电话号码不正确' => '电话号码不正确',
            '银行信息错误' => '银行信息错误',
            '支行信息错误' => '支行信息错误',
            '账号信息错误' => '账号信息错误',
            '其它' => '其它',
        ];
        return $this->render('commission-view', [
            'info' => $info,
            'rejectReason' => $rejectReason,
        ]);
    }

    public function actionCommissionAudit()
    {

        $request = \Yii::$app->request;
        $id = $request->post('id');
        $rejectReason = $request->post('reject_reason');
        $pass = $request->post('pass');
        $payment = $request->post('payment');
        $paymentNo = $request->post('payment_no');
        $info = Withdraw::findOne($id);

        $userId = \Yii::$app->admin->id;
        if ($info && $rejectReason) {
            if ($rejectReason == '其它') {
                $rejectReason = $request->post('other');
            }
            $trans = \Yii::$app->db->beginTransaction();
            $info->status= 3;
            $info->fail_reason = $rejectReason;
            $info->audit_user = $userId;
            $info->audit_time = time();
            if (!$info->save()) {
                $trans->rollBack();
            }

            $user = User::findOne($info['user_id']);
            $user->commission = $user->commission + $info['money'] * 100;
            if (!$user->save()) {
                $trans->rollBack();
            }

            $trans->commit();
            BackstageLog::addLog(\Yii::$app->admin->id, 5, '佣金驳回-编号'.$info['id']);
        } elseif ($info && $pass) {
            $info->status= 1;
            $info->audit_user = $userId;
            $info->audit_time = time();
            $info->save();
            BackstageLog::addLog(\Yii::$app->admin->id, 5, '佣金审核-编号'.$info['id']);
        } elseif ($info && $payment && $paymentNo) {
            $info->status= 2;
            $info->payment= $payment;
            $info->payment_no= $paymentNo;
            $info->pass_user = $userId;
            $info->pass_time = time();
            $save = $info->save();
            BackstageLog::addLog(\Yii::$app->admin->id, 6, '佣金处理-编号'.$info['id']);
            if ($save) {
                $desc = serialize(['bank'=>$info->bank, 'bank_number'=>$info->bank_number]);
                Invite::commissionWithdraw($info->user_id, $info->money, $desc);
            }
        }
        return $this->redirect(['finance/commission-view', 'id'=>$id]);
    }

    //余额调整
    public function actionBalance()
    {
        $query = AdjustBalance::find();
        $condition = [];
        $request = \Yii::$app->request;
        if($request->isGet){
            $get = $request->get();
            if(!empty($get)){
                if((isset($get['startTime']) && isset($get['endTime'])) && ($get['startTime'] && $get['endTime'])){
                    $condition['start'] = $get['startTime'];
                    $condition['end'] = $get['endTime'];
                    $query->andWhere(['>=', 'created_at', strtotime($get['startTime'])]) ;
                    $query->andWhere(['<', 'created_at', strtotime($get['endTime'])]);
                }
                if(isset($get['content']) && $get['content']){
                    $condition['content'] = $get['content'];
                    $user = User::find()->where(['or', 'email="'.$get['content'].'"', 'phone="'.$get['content'].'"',  'nickname="'.$get['content'].'"'])->one();
                    $query->andWhere(['user_id'=>$user['id']]);
                }
            }
        }

        $countQuery = clone $query;

        $totalCount = $countQuery->count();

        if(isset($get['excel']) && $get['excel'] == 'balance'){
            $pagination = new Pagination(['totalCount' => $totalCount, 'defaultPageSize' => PHP_INT_MAX, 'pageSizeLimit'=>[0, PHP_INT_MAX]]);
            $list = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
            $data[0] = ['id'=>'编号', 'user_phone'=>'手机号', 'email'=>'邮箱', 'money'=>'金额', 'reason'=>'原因', 'order'=>'原始单号','created_at'=>'操作时间'];

            $data = [];
            foreach($list as $key => $val){
                $key = $key + 1;
                $user = User::findOne($val['user_id']);
                $data[$key]['id'] = $val['id'];
                $data[$key]['user_phone'] = $user['phone'];
                $data[$key]['email'] = $user['email'];
                if($val['type'] == 0){
                    $status = '+';
                } elseif($val['type'] == 1){
                    $status = '-';
                }
                $data[$key]['money'] = $status.$val['money'];
                $data[$key]['reason'] = $val['reason'];
                $data[$key]['order'] = $val['order'];
                $data[$key]['created_at'] = DateFormat::microDate($val['created_at']);
            }
            $excel = new Ex();
            $excel->download( $data, '余额调整-'.date('Y-m-d H:i:s').'.xls');
        }

        $pagination = new Pagination(['totalCount' => $totalCount, 'defaultPageSize' => 25]);
        $list = $query->offset($pagination->offset)->orderBy('id desc')->limit($pagination->limit)->all();

        foreach($list as $key => $val){
            $list[$key]['user_id'] = User::findOne($val['user_id']);
        }

        if(empty($get)){
            $url = Yii::$app->request->getUrl().'?excel=balance';
        }else{
            $url = Yii::$app->request->getUrl().'&excel=balance';
        }

        return $this->render('balance', [
            'list' => $list,
            'pagination' => $pagination,
            'condition' => $condition,
            'url' => $url,
        ]);
    }

    //新增
    public function actionAdjustBalance()
    {

        $model = new AdjustBalance();
        $request = \Yii::$app->request;
        if($request->isPost){
            $post = $request->post('AdjustBalance');
            $userId = User::find()->where(['or', 'email="'.$post['user_id'].'"', 'phone="'.$post['user_id'].'"'])->one();
            $model->user_id = $userId['id'];
            if($request->post('other')) $model->reason = $request->post('other');
            else $model->reason = $post['reason'];
            $model->final_money = $request->post('final_money');
            $model->before_money = $request->post('beformoney');
            $model->type = $post['type'];
            $model->order = $post['order'];
            $model->money = $post['money'];
            $model->admin_id = \Yii::$app->admin->id;
            $model->created_at = time();
           if($model->save()){
               $user = User::findOne($userId['id']);
               $user->money = $request->post('final_money');
               if($user->save()){
                   if($post['type'] == 0) $log = '增加'; else $log = '减少';
                   BackstageLog::addLog(Yii::$app->admin->id, 7, '对'.$post['user_id'].$log.'金额'.$post['money']);

                   return $this->refresh();
               }
           }
        }

        $reason = [
            '充值未到账' => '充值未到账',
            '已扣款购买失败' => '已扣款购买失败',
            '其它' => '其它',
        ];
        return $this->render('adjust', [
            'model' => $model,
            'reason' => $reason
        ]);
    }

    //查看
    public function actionBalanceView()
    {
        $request = \Yii::$app->request;
        $id = $request->get('id');
        $model = AdjustBalance::findOne($id);
        if($model){
            $model['user_id'] = User::userName($model['user_id']);
            $model['admin_id'] = Admin::findOne($model['admin_id']);
            return $this->render('balance-view',[
                'model' => $model
            ]);
        }
    }

    //查找用户余额
    public function actionUser()
    {
        $request = \Yii::$app->request;
        if($request->isPost){
            $name = $request->post('name');
            if(!$name) return 1;
            $find = User::find()->where(['or', 'email="'.$name.'"', 'phone="'.$name.'"'])->one();
            if($find){
                return $find['money'];
            }else{
                return 1;
            }
        }
    }

    //福分列表
    public function actionPointList()
    {
        $query = PointLog::find();
        $condition = [];
        $request = \Yii::$app->request;
        if($request->isGet){
            $get = $request->get();
            if(!empty($get)){
                if((isset($get['startTime']) && isset($get['endTime'])) && ($get['startTime'] && $get['endTime'])){
                    $condition['start'] = $get['startTime'];
                    $condition['end'] = $get['endTime'];
                    $query->andWhere(['>=', 'created_at', strtotime($get['startTime'])]) ;
                    $query->andWhere(['<', 'created_at', strtotime($get['endTime'])]);
                }
                if(isset($get['content']) && $get['content']){
                    $condition['content'] = $get['content'];
                    $user = User::find()->where(['or', 'email="'.$get['content'].'"', 'phone="'.$get['content'].'"',  'nickname="'.$get['content'].'"'])->one();
                    $query->andWhere(['user_id'=>$user['id']]);
                }
            }
        }

        $countQuery = clone $query;
        $totalCount = $countQuery->count();

        if(isset($get['excel']) && $get['excel'] == 'point'){
            $pagination = new Pagination(['totalCount' => $totalCount, 'defaultPageSize' => PHP_INT_MAX, 'pageSizeLimit'=>[0, PHP_INT_MAX]]);
            $list = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
            $data[0] = ['id'=>'编号', 'user_phone'=>'手机号', 'email'=>'邮箱', 'point'=>'福分', 'reason'=>'原因', 'order'=>'原始单号','created_at'=>'操作时间'];

            $data = [];
            foreach($list as $key => $val){
                $key = $key + 1;
                $user = User::findOne($val['user_id']);
                $data[$key]['id'] = $val['id'];
                $data[$key]['user_phone'] = $user['phone'];
                $data[$key]['email'] = $user['email'];
                if($val['type'] == 0){
                    $status = '+';
                } elseif($val['type'] == 1){
                    $status = '-';
                }
                $data[$key]['point'] = $status.$val['point'];
                $data[$key]['reason'] = $val['reason'];
                $data[$key]['order'] = $val['order'];
                $data[$key]['created_at'] = DateFormat::microDate($val['created_at']);
            }
            $excel = new Ex();
            $excel->download( $data, '福分调整-'.date('Y-m-d H:i:s').'.xls');
        }

        $pagination = new Pagination(['totalCount' => $totalCount, 'defaultPageSize' => 25]);
        $list = $query->offset($pagination->offset)->orderBy('id desc')->limit($pagination->limit)->all();

        foreach($list as $key => $val){
            $list[$key]['user_id'] = User::findOne($val['user_id']);
        }

        if(empty($get)){
            $url = Yii::$app->request->getUrl().'?excel=point';
        }else{
            $url = Yii::$app->request->getUrl().'&excel=point';
        }

        return $this->render('point-list', [
            'list' => $list,
            'pagination' => $pagination,
            'condition' => $condition,
            'url' => $url
        ]);
    }

    //添加福分
    public function actionAdjustPoint()
    {
        $model = new PointLog();

        $request = \Yii::$app->request;
        if($request->isPost){
            $post = $request->post('PointLog');
            $userId = User::find()->where(['or', 'email="'.$post['user_id'].'"', 'phone="'.$post['user_id'].'"', 'nickname="'.$post['user_id'].'"'])->one();
            $model->user_id = $userId['id'];
            if($request->post('other')) $model->reason = $request->post('other');
            else $model->reason = $post['reason'];
            $model->final_point = $request->post('final_point');
            $model->before_point = $request->post('beforpoint');
            $model->type = $post['type'];
            $model->order = $post['order'];
            $model->point = $post['point'];
            $model->admin_id = \Yii::$app->admin->id;
            $model->created_at = time();

            if($model->save()){
                if($post['type'] == 0) $log = '增加'; else $log = '减少';
                BackstageLog::addLog(Yii::$app->admin->id, 8, '对'.$post['user_id'].$log.'福分'.$post['point']);

                $user = User::findOne($userId['id']);
                $user->point = $request->post('final_point');
                $user->save();

                $member = New Member();
                if($post['type'] == 0) $logs = '+'; else $logs = '-';
                $member->editPoint($logs.$post['point'], 6, '伙购网对您'.$logs.$post['point']);
                return $this->refresh();
            }
        }

        $reason = [
            '邀请好友且消费未赠送' => '邀请好友且消费未赠送',
            '完善个人资料未赠送' => '完善个人资料未赠送',
            '其它' => '其它',
        ];

        return $this->render('adjust-point', [
            'model' => $model,
            'reason' => $reason,
        ]);
    }

    //查看福分
    public function actionPointView()
    {
        $request = \Yii::$app->request;
        $id = $request->get('id');
        $model = PointLog::findOne($id);
        if($model){
            $model['user_id'] = User::userName($model['user_id']);
            $model['admin_id'] = Admin::findOne($model['admin_id']);
            return $this->render('point-view',[
                'model' => $model
            ]);
        }
    }

    //查找用户余额
    public function actionUserPoint()
    {
        $request = \Yii::$app->request;
        if($request->isPost){
            $name = $request->post('name');
            $find = User::find()->where(['or', 'email="'.$name.'"', 'phone="'.$name.'"', 'nickname="'.$name.'"'])->one();
            if($find){
                return $find['point'];
            }else{
                return 1;
            }
        }
    }

    //采购审核列表
    public function actionPurchaseVerifyList()
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 10);
            $condition = [];
            $condition['orderId'] = $request->get('id', 0);
            $condition['admin_id'] = $request->get('admin_id', 0);
            $condition['startTime'] = $request->get('sstart', '');
            $condition['endTime'] = $request->get('send', '');
            $condition['status'] = 0;
            $data = PurchaseOrder::getList($condition, $page, $pageSize);

            $person = Admin::getEmployeeName();
            foreach($data['rows'] as &$val){
                $val['admin_id'] = $person[$val['admin_id']];
                $val['created_at'] = DateFormat::microDate($val['created_at']);
                $val['status'] = '待审核';
            }

            return $data;
        }
        return $this->render('purchase-verify-list');
    }

    //采购审核详情
    public function actionPurchaseVerifyView()
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
            $post = $request->post();
            if($post['status'] == 1){
                $model->status = 1;
                $model->updated_at = time();
                $model->approved_admin_id = Yii::$app->admin->id;
                $model->approved_at = time();
            }else if($post['status'] == 2){
                $model->status = 2;
                $model->updated_at = time();
                $model->approved_admin_id = Yii::$app->admin->id;
                $model->approved_at = time();
                $model->note = $post['reason'];
            }
            if($model->save()){
                $this->addLog('审核采购成功-'.$model['id']);
                echo json_encode(['error'=>0, 'message'=>'审核成功']);
                Yii::$app->end();
            }else{
                $this->addLog('审核采购失败-'.$model['id']);
                echo json_encode(['error'=>1, 'message'=>'审核失败']);
                Yii::$app->end();
            }
        }

        $goodList = [];
        $supply = Supplier::supplierList();
        $total = 0;
        foreach($items as $key => $val){
            $product = Product::findOne($val['product_id']);
            $goodList[$key]['suppler_name'] = $supply[$val['supplier_id']];
            $goodList[$key]['product_name'] = $product['name'];
            $goodList[$key]['price'] = $val['supplier_price'];
            $goodList[$key]['num'] = $val['product_num'];
            $goodList[$key]['privilege'] = $val['privilege'];
            $goodList[$key]['total'] = ($val['supplier_price'] * $val['product_num']) - $val['privilege'];
            $total += $goodList[$key]['total'];
        }
        $person = Admin::getEmployeeName();
        return $this->render('purchase-verify-view', [
            'model' => $model,
            'admin' => $person,
            'goodsList' => $goodList,
            'total' => $total
        ]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: zhangjicheng
 * Date: 15/9/19
 * Time: 16:58
 */

namespace app\controllers;

use app\helpers\DateFormat;
use app\helpers\Ex;
use app\models\UserVirtual;
use app\services\User;
use Yii;

class VirtualController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if($request->isAjax || $request->get('excel') == 'virtual'){
            $page = $request->get('page', 1);
            $perpage = $request->get('row', 10);
            $get = $request->get();

            if(isset($get['excel']) && $get['excel'] == 'virtual'){
                $data = [];
                $list = UserVirtual::getList($get, $page, PHP_INT_MAX);
                $data[0] = ['id'=>'ID', 'username'=>'用户', 'orderid'=>'获奖id', 'par_value'=>'面值','card'=>'卡号','create_time'=>'获得时间','update_time'=>'更新时间'];
                foreach($list['list'] as $key => $val){
                    $key = $key +1;
                    $user = \app\models\User::userName($val['uid']);
                    $data[$key]['id'] = $val['id'];
                    $data[$key]['username'] =$user['username'];
                    $data[$key]['orderid'] = $val['orderid'];
                    $data[$key]['par_value'] = $val['par_value'];
                    $data[$key]['card'] = $val['card'];
                    $data[$key]['create_time'] = DateFormat::microDate($val['create_time']);
                    $data[$key]['update_time'] = DateFormat::microDate($val['update_time']);
                }
                $excel = new Ex();
                $excel->download( $data, '虚拟订单-'.date('Y-m-d H:i:s').'.xls');
            }


            $list = UserVirtual::getList($get, $page, $perpage);
            foreach($list['list'] as &$val){
                $user = User::baseInfo($val['uid']);
                $val['create_time'] = DateFormat::microDate($val['create_time']);
                $val['update_time'] = DateFormat::microDate($val['update_time']);
                $val['uid'] = $user;
                unset($val['pwd']);
            }

            return ['total'=>$list['totalCount'], 'rows'=>$list['list']];
        }

        return $this->render('index');
    }
}
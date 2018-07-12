<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\data\Pagination;
use app\models\RechargeOrderDistribution;

/**
 * 推广数据
 */
class SpreadController extends BaseController
{
    public $channel = array(
        'huogou' => '自主注册',
        '3' => '微信',
        'wy_17' => '微易17',
        'wy_23' => '微易23',
        'wy_24' => '微易24',
        'lm_1'=>'zdaaa',
        'lm_2'=>'zdaaa002',
        'lm_10'=>'zdbbb',
        'lm_11'=>'zdbbb001',
        'lm_12'=>'zdbbb002',
        'lm_13'=>'zdbbb003',
        'lm_14'=>'zdbbb004',
        'lm_15'=>'zdbbb005',
        'lm_16'=>'zdbbb006',
        'lm_17'=>'zdaaa001',
        'lm_18'=>'zdbbb007',
        'lm_19'=>'zdbbb008',
        'lm_20'=>'zdbbb009',
        'lm_21'=>'zdbbb010',
        'lm_22'=>'zdbbb011',
        'lm_23'=>'zdbbb012',
        'lm_24'=>'zdbbb013',
        'lm_25'=>'zdbbb014',
        'lm_26'=>'zdbbb015',
        'lm_27'=>'zdbbb016',
        'lm_28'=>'zdbbb017',
        'lm_29'=>'zdbbb018'
    );


    public function actionIndex()
    {

        if (Yii::$app->request->isAjax) {
            $page = Yii::$app->request->get('page', '1');
            $perpage = Yii::$app->request->get('rows', '20');
            $spread = Yii::$app->request->get('spread','');
            $starttime = strtotime(Yii::$app->request->get('starttime',''));
            $endtime = strtotime(Yii::$app->request->get('endtime',''));
            $where = '1=1';
            $payWhere = '';
            if ($spread) {
                $where .= " and spread_source like '%".$spread."%'";
            }
            if ($starttime) {
                $where .= " and created_at >='".$starttime."'";
                $payWhere .= " and create_time >='".$starttime."'";
            }
            if ($endtime) {
                $where .= " and created_at <'".$endtime."'";
                $payWhere .= " and create_time <'".$endtime."'";
            }
            $users = User::find()->select('count(1) as count,spread_source')->where($where)->groupBy('spread_source')->asArray()->all();
            $spread_source = [];
            foreach ($users as $key => $value) {
                $source = '';
                if (!$value['spread_source']) {
                    $source = 'huogou';
                    $source_name = $this->channel['huogou'];
                } else {
                    $source = $value['spread_source'];
                    if (isset($this->channel[$source])) {
                        $source_name = $this->channel[$source];
                    } else {
                        $source_name = $source;
                    }
                }
                $list[$source] = array(
                    'reg_nums' => $value['count'],
                    'spread_source' => $source,
                    'spread_source_name' => $source_name,
                    'recharge_nums' => 0,
                    'recharge_money' => 0,
                    'consume_nums' => 0,
                    'consume_money' => 0,
                    'consume_point' => 0
                );
                $spread_source[] = $source;
            }

            $db = \Yii::$app->db;
            $rechargeSql = "";
            for ($i = 0; $i < 10; $i++) {
                $rechargeSql .= "select sum(money) as recharge,spread_source,count(distinct user_id) as count from recharge_orders_10" . $i . " where status = 1 and payment <> 6".$payWhere." and spread_source in ('".implode("','",$spread_source)."') group by spread_source union all ";
            }
            $rechargeSql = substr($rechargeSql, 0, -11);
            $rechargeSql = "select sum(recharge) as recharge,spread_source,sum(count) as count from (" . $rechargeSql . ") a group by spread_source";
            $recharge = $db->createCommand($rechargeSql)->queryAll();
            foreach ($recharge as $key => $value) {
                $source = '';
                if (!$value['spread_source']) {
                    $source = 'huogou';
                } else {
                    $source = $value['spread_source'];
                }
                $list[$source]['recharge_money'] = $value['recharge'];
                $list[$source]['recharge_nums'] = $value['count'];
            }

            $consumeSql = "";
            for ($i = 0; $i < 10; $i++) {
                $consumeSql .= "select sum(money) as consume,spread_source,count(distinct user_id) as count,sum(point) as point from payment_orders_10" . $i . " where  status = 1 and payment <> 6".$payWhere." and spread_source in ('".implode("','",$spread_source)."') group by spread_source union all ";
            }
            $consumeSql = substr($consumeSql, 0, -11);
            $consumeSql = "select sum(consume) as consume,spread_source,sum(count) as count,sum(point) as point from (" . $consumeSql . ") a group by spread_source";
            $consume = $db->createCommand($consumeSql)->queryAll();

            foreach ($consume as $key => $value) {
                $source = '';
                if (!$value['spread_source']) {
                    $source = 'huogou';
                } else {
                    $source = $value['spread_source'];
                }
                $list[$source]['consume_money'] = $value['consume'];
                $list[$source]['consume_nums'] = $value['count'];
                $list[$source]['consume_point'] = $value['point'];
            }
            /*****/

            $data['total'] = count($list);
            $data['rows'] = array_values($list);;

            return $data;

        } else {
            return $this->render('index');
        }

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/9/29
 * Time: 下午2:42
 */

namespace app\services;

use app\helpers\DateFormat;
use app\helpers\Ip;
use app\models\CurrentPeriod;
use app\models\Period as PeriodModel;
use app\models\PeriodBuylistDistribution;
use app\models\ProductCategory;
use app\models\ShareTopic;
use app\models\UserBuylistDistribution;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use app\models\PaymentOrderDistribution as Pay;
use app\models\User as UserModel;

class Period
{
    /**
     *  倒计时秒数
     */
    const COUNT_DOWN_TIME = 180;
    /**
     *  倒计时误差时间
     */
    const COUNT_DOWN_FAULT_BIT_TIME = 2;
    /**
     * 已满员期数信息
     * @param $id 期数ID
     */
    public static function info($id)
    {
        $period = PeriodModel::find()->where(['id' => $id])->asArray()->one();
        $info = [];
        if ($period) {
            $leftTime = $period['end_time'] + static::COUNT_DOWN_TIME - microtime(true);
            if ($leftTime >= static::COUNT_DOWN_FAULT_BIT_TIME) {
                $info['left_time'] = (int)$leftTime;
                $info['status'] = 1;
            } else {
                if (!$period['user_id']) {
                    return $info;
                }
                $userInfo = User::baseInfo($period['user_id']);
                $userBuyInfo = UserBuylistDistribution::findByUserHomeId($userInfo['home_id'])
                    ->where(['user_id' => $userInfo['id'], 'period_id' => $period['id']])
                    ->asArray()
                    ->one();

                $info['status'] = 2;
                $info['lucky_code'] = $period['lucky_code'];
                $info['user_name'] = $userInfo['username'];
                $info['user_home_id'] = $userInfo['home_id'];
                $info['uid'] = $userInfo['id'];
                $info['user_avatar'] = $userInfo['avatar'];
                $info['user_addr'] = Ip::getAddressByIp(long2ip($period['ip']));
                $info['user_buy_num'] = $userBuyInfo['buy_num'];
                $info['user_buy_time'] = DateFormat::microDate($userBuyInfo['buy_time']);
                $info['raff_time'] = DateFormat::microDate($period['end_time']); //揭晓时间
                $info['left_time'] = 0;
            }

            $productInfo = Product::info($period['product_id']);
            $info['goods_id'] = $period['product_id'];
            $info['goods_name'] = $productInfo['name'];
            $info['goods_brief'] = $productInfo['brief'];
            $info['goods_picture'] = $productInfo['picture'];
            $info['goods_catid'] = $productInfo['cat_id'];
            $info['price'] = sprintf('%.2f', $period['price']);
            $info['start_time'] = DateFormat::microDate($period['start_time']);
            $info['end_time'] = DateFormat::microDate($period['end_time']);
            $info['period_number'] = $period['period_number'];
            $info['period_id'] = $period['id'];
            $info['goods_info'] = $productInfo['intro'];
            $info['limit_num'] = $productInfo['limit_num'];
        }
        return $info;
    }

    public static function getStartRaffleList($time)
    {
        $time = empty($time) ? microtime(true) : $time;
        $query = \app\models\Period::find();
        $query->andWhere(['>', 'end_time', $time]);
        $query->orderBy('end_time asc');
        $result = $query->asArray()->all();
        $productIds = ArrayHelper::getColumn($result, 'product_id');
        $productsInfo = Product::info($productIds);
        $list = [];
        $now = microtime(true);
        foreach ($result as $key=>$one) {
            $productInfo = $productsInfo[$one['product_id']];
            $info = [];
            $info['period_id'] = $one['id'];
            $info['goods_picture'] = $productInfo['picture'];
            $info['goods_name'] = $productInfo['name'];
            $info['period_number'] = $one['period_number'];
            $info['price'] = sprintf('%.2f', $one['price']);
            $info['goods_id'] = $one['product_id'];

            $leftTime = $one['end_time'] + static::COUNT_DOWN_TIME - $now;
            $info['left_time'] = $leftTime > 0 ? (int)$leftTime : 0;
            $endTime = $one['end_time'];
            $list[] = $info;
        }

        $result = [];
        $result['list'] = $list;
        $result['maxSeconds'] = isset($endTime) ? $endTime : $now;
        $result['time'] = $time;

        return $result;
    }


    /** 某期的参与纪录/购买记录
     * @param $id 期数ID
     * @param $page
     * @param int $perpage
     */
    public static function buyList($id, $page, $perpage = 20)
    {
        $periodInfo = CurrentPeriod::findOne($id);
        if (!$periodInfo) {
            $periodInfo = PeriodModel::findOne($id);
        }

        $tableId = $periodInfo->table_id;
        $query = PeriodBuylistDistribution::findByTableId($tableId)->where(['and','period_id='.$id,['>','buy_num',0]]);
        $query->select([
            'id',
            'product_id',
            'period_id',
            'user_id',
            'buy_num',
            'ip',
            'source',
            'buy_time'
        ]);
        $query->orderBy('id desc');

        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
        $result = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        $userIds = ArrayHelper::getColumn($result, 'user_id');
        $usersBaseInfo = User::baseInfo($userIds);
        $buyList = [];
        foreach ($result as $one) {
            $info = [];
            $info['buy_device'] = static::getSource($one['source']);
            $info['buy_id'] = $one['id'];
            $info['buy_ip'] = long2ip($one['ip']);
            $info['buy_ip_addr'] = Ip::getAddressByIp(long2ip($one['ip']));
            $info['buy_num'] = $one['buy_num'];
            $info['buy_time'] = DateFormat::microDate($one['buy_time']);
            $userBaseInfo = $usersBaseInfo[$one['user_id']];
            $info['user_name'] = $userBaseInfo['username'];
            $info['user_id'] = $userBaseInfo['id'];
            $info['user_home_id'] = $userBaseInfo['home_id'];
            $info['user_avatar'] = $userBaseInfo['avatar'];
            $buyList[] = $info;
        }


        $return['list'] = $buyList;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        return $return;
    }

    /** 根据buyId和期数Id获取用户购买的码
     * @param $periodId
     * @param $buyId
     * @return mixed|string
     */
    public static function getUserBuyCodesByBuyId($periodId, $buyId)
    {
        $periodInfo = CurrentPeriod::findOne($periodId);
        if($periodInfo['left_num'] != 0) return '';
        if (!$periodInfo) {
            $periodInfo = PeriodModel::findOne($periodId);
        }
        $tableId = $periodInfo->table_id;
        $result = PeriodBuylistDistribution::findByTableId($tableId)->select(['codes'])->where(['id' => $buyId])->one();
        if ($result) {
            return $result->codes;
        }
        return '';
    }

    /** 期数列表
     * @param $catId    商品分类id
     * @param int $isRevealed 是否已开奖 all=全部,0=未开奖，1=已开奖
     * @param $page
     * @param int $perpage
     * @param  $isLimit 是否限购 all=全部,0=不限购，1=限购
     * @return array
     */
    public static function getList($catId, $isRevealed = 'all', $page, $perpage = 20, $isLimit = 'all')
    {
        $query = PeriodModel::find();
        if ($isRevealed !== 'all') {
            if ($isRevealed) {
                $query->andWhere(['<>', 'user_id', 0]);
            } else {
                $query->andWhere(['=', 'user_id', 0]);
            }
        }

        if ($isLimit !== 'all') {
            if ($isLimit) {
                $query->andWhere(['<>','limit_num',0]);
            } else {
                $query->andWhere(['=','limit_num',0]);
            }
        }

        if ($catId) {
            $categoryChildren = ProductCategory::allOrderList($catId);
            $catIds = [];
            if ($categoryChildren) {
                $catIds = ArrayHelper::getColumn($categoryChildren, 'id');
            }
            array_unshift($catIds, $catId);
            $query->where(['cat_id' => $catIds]);
        } else {
            $query->andWhere(['<>', 'cat_id', 0]);
        }
        $query->orderBy('end_time desc');

        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
        $result = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
        $userIds = ArrayHelper::getColumn($result, 'user_id');
        $productIds = ArrayHelper::getColumn($result, 'product_id');
        $usersInfo = User::baseInfo($userIds);
        $productsInfo = Product::info($productIds);
        $list = [];
        foreach ($result as $one) {
            if (empty($productsInfo[$one['product_id']])) {
                continue;
            }
            $productInfo = $productsInfo[$one['product_id']];
            $info = [];
            $info['period_id'] = $one['id'];
            $info['goods_picture'] = $productInfo['picture'];
            $info['goods_name'] = $productInfo['name'];
            $info['period_number'] = $one['period_number'];
            $info['price'] = sprintf('%.2f', $one['price']);
            $info['goods_id'] = $one['product_id'];

            $leftTime = $one['end_time'] + static::COUNT_DOWN_TIME - microtime(true);
            if ($leftTime<=static::COUNT_DOWN_FAULT_BIT_TIME && $one['user_id']) {
                $userInfo = $usersInfo[$one['user_id']];
                $userBuyInfo = UserBuylistDistribution::findByUserHomeId($userInfo['home_id'])
                    ->where(['user_id' => $userInfo['id'], 'period_id' => $one['id']])
                    ->asArray()
                    ->one();

                $info['raff_time'] = DateFormat::formatTime($one['end_time']);
                $info['user_name'] = $userInfo['username'];
                $info['user_home_id'] = $userInfo['home_id'];
                $info['user_avatar'] = $userInfo['avatar'];
                $info['publish_time'] = DateFormat::microDate($one['end_time']);
                $info['user_addr'] = Ip::getAddressByIp(long2ip($one['ip']));
                $info['lucky_code'] = $one['lucky_code'];
                $info['user_buy_num'] = $userBuyInfo['buy_num'];
                $info['user_buy_time'] = DateFormat::microDate($userBuyInfo['buy_time']);
                $share = ShareTopic::findOne(['period_id'=>$info['period_id'],'is_pass'=>1]);
                if ($share) {
                    $info['share_id'] = $share->id;
                } else {
                    $info['share_id'] = 0;
                }
                $info['left_time'] = 0;
                $info['end_time'] = $one['end_time'];
            } else {
                $info['left_time'] = (int)$leftTime;
                $info['end_time'] = $one['end_time'];
            }
            $list[] = $info;
        }

        $return['list'] = $list;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        return $return;
    }

    /**
     * 获取用户单期购买记录
     * @param  int $uid 用户id
     * @param  int $pid 期数id
     * @return [type]      [description]
     */
    public static function getCodeByUser($uid,$pid){
        $periodInfo = CurrentPeriod::find()->where(['id'=>$pid])->asArray()->one();
        if (!$periodInfo) {
            $periodInfo = PeriodModel::find()->where(['id'=>$pid])->one();
        }
        $table_id = $periodInfo['table_id'];
        $codes = array();
        $periodBuylist = new PeriodBuylistDistribution($table_id);
        $codesInfo = $periodBuylist->find()->where(['period_id'=>$pid,'user_id'=>$uid])->orderBy('buy_time desc')->asArray()->all();
        foreach ($codesInfo as $key => $value) {
            $codes[$key]['time'] = DateFormat::microDate($value['buy_time']);
            $codes[$key]['codes'] = $value['codes'];
        }
        return $codes;
    }

    /**
     * 计算结果
     * @param  int $id 期数id
     * @return [type]     [description]
     */
    public static function compute($pid,$pno){
        $period = PeriodModel::find()->select('end_time')->where(['product_id'=>$pid,'period_number'=>$pno])->asArray()->one();
        $end_time = $period['end_time'];
        
        $list = Pay::fetchAllOrdersByTimes($end_time,"<=",100);
        return $list;
    }

    /**
     * 来源
     * @param  int $source 来源id
     * @return [type]         [description]
     */
    private static function getSource($source){
        switch ($source) {
            case '1':
                return array('ico'=>'pc','name'=>'PC电脑');
                break;
            case '2':
                return array('ico'=>'weixin','name'=>'微信公众平台');
                break;
            case '3':
                return array('ico'=>'iphone','name'=>'iOS客户端');
                break;
            case '4':
                return array('ico'=>'android','name'=>'Android客户端');
                break;        
            case '5':
                return array('ico'=>'','name'=>'触屏版');
                break;    
            default:
                return array('ico'=>'pc','name'=>'PC电脑');
                break;
        }
    }

    public static function getLotteryCodes($pid){
        $periodInfo = PeriodModel::findOne(['id'=>$pid]);
        $periodBuylist = new PeriodBuylistDistribution($periodInfo['table_id']);
        $buyList = $periodBuylist->find()->where(['period_id'=>$periodInfo['id'],'user_id'=>$periodInfo['user_id']])->orderBy('buy_time desc')->asArray()->all();
        foreach ($buyList as $key => &$value) {
            $value['buy_time'] = DateFormat::microDate($value['buy_time']);
            $value['lucky_code'] = $periodInfo['lucky_code'];
        }
        return $buyList;
    }

    /**
     * 用户购买某期商品数量
     * @param  int $pid 购买数量
     * @return [type]      [description]
     */
    public static function getUserHasBuyCount($uid,$pid){
        $home = UserModel::find()->select('home_id')->where(['id'=>$uid])->asArray()->one();
        $buy = UserBuylistDistribution::findByUserHomeId($home['home_id'])->where(['user_id'=>$uid,'period_id'=>$pid])->asArray()->one();
        return $buy['buy_num'];
    }

    /**
     * 获取最新购买记录
     * @param  int $time 时间戳
     * @return [type]       [description]
     */
    public static function getNewBuyList($time,$pid){
        $periodInfo = currentPeriod::find()->select('table_id')->where(['id'=>$pid])->asArray()->one();
        if (!$periodInfo) {
            $periodInfo = PeriodModel::find()->select(['table_id'])->where(['id'=>$pid])->asArray()->one();
        }
        $model = new PeriodBuylistDistribution($periodInfo['table_id']);
        $list = $model->find()->select('user_id,buy_num,buy_time')->where(['and','period_id='.$pid,['>','buy_time',$time]])->asArray()->all();
        return $list;
    }
}
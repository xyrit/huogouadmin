<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/9/25
 * Time: 下午3:16
 */

namespace app\services;

use app\helpers\DateFormat;
use app\helpers\Ip;
use app\models\Area;
use app\models\CurrentPeriod;
use app\models\ExperienceFollowDistribution;
use app\models\FollowProduct;
use app\models\Friend;
use app\models\Invite;
use app\models\InviteApply;
use app\models\PaymentOrderItemDistribution;
use app\models\UserVirtualAddress;
use app\modules\admin\models\ExchangeOrder;
use app\services\User;
use app\models\UserAddress;
use app\models\Withdraw;
use app\modules\member\models\UserTransferAccount;
use yii;
use app\models\FriendApply;
use app\models\InviteCommission;
use app\models\InviteFriend;
use app\models\Order;
use app\models\PaymentOrderDistribution;
use app\models\PointFollowDistribution;
use app\models\Product as ProductModel;
use app\models\RechargeOrderDistribution;
use app\models\User as UserModel;
use app\models\Image;
use app\models\UserBuylistDistribution;
use yii\base\Object;
use yii\data\Pagination;
use app\models\Period as PeriodModel;
use app\models\PeriodBuylistDistribution;
use yii\helpers\ArrayHelper;
use app\models\GroupTopicComment;
use app\helpers\MyRedis;
use app\services\Pay;

/**
 *  登录用户相关
 * Class Member
 * @package app\services
 */
class Member extends Object
{

    public $id;
    public $homeId;
    public $account;

    public function init()
    {
        if ($this->account) {
            $model = UserModel::find()->select('id,home_id')->where(['phone'=>$this->account])->one();
            if (!$model) {
                $model = UserModel::find()->select('id,home_id')->where(['email'=>$this->account])->one();
            }
            if ($model) {
                $this->id = $model->id;
                $this->homeId = $model->home_id;
            }
        } elseif($this->id) {
            $model = UserModel::find()->select('id,home_id')->where(['id'=>$this->id])->one();
            if ($model) {
                $this->homeId = $model->home_id;
            }
        } elseif ($this->homeId) {
            $model = UserModel::find()->select('id,home_id')->where(['home_id'=>$this->homeId])->one();
            if ($model) {
                $this->id = $model->id;
            }
        }
    }

    /**
     *  获取会员基本信息
     */
    public function getBaseInfo()
    {
        return User::baseInfo($this->id);
    }

    /** 获取会员所有信息
     * @return mixed
     */
    public function getAllInfo()
    {
        return User::allInfo($this->id);
    }

    /** 修改昵称
     * @param $nickname
     * @return int
     */
    public function editNickName($nickname)
    {
        return \app\models\User::updateAll(['nickname'=>$nickname],['id'=>$this->id]);
    }

    /** 会员更改福分
     * @param $point 加减福分
     * @param $type 福分变更类型 1=伙购消费，2=成功邀请好友并消费，3=成功晒单，4=晒单评论, 5=完善资料
     * @param $desc 福分变更描述
     * @param string $flag 购买扣除福分只记录  不执行减福分操作
     * @return bool
     * @throws yii\db\Exception
     */
    public function editPoint($point, $type, $desc, $flag = '')
    {
        $baseInfo = $this->getBaseInfo();
        
        $point += 0;
        if ($point > 0) {
            $currentPoint = $baseInfo['point'] + $point;
        } elseif ($point < 0) {
            $currentPoint = $baseInfo['point'] - (-1 * $point);
        } else {
            return true;
        }
        $db = \Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            if ($type == 4 && $point > 0) {
                $key  = 'point_follow_' . date("Ymd") . '_' . $this->id;
                if (!$this->setKeyValue($key, 100)) {
                    return true;
                }
            }

            if ($flag == 'buy' && $point < 0) {
                $currentPoint = $baseInfo['point'];
            } else {
                UserModel::updateAll(['point' => $currentPoint], ['id' => $this->id]);
            }

            $pointFollow = new PointFollowDistribution($baseInfo['home_id']);
            $pointFollow->user_id = $this->id;
            $pointFollow->point = $point;
            $pointFollow->current_point = $currentPoint;
            $pointFollow->type = $type;
            $pointFollow->desc = $desc;
            $pointFollow->created_at = time();
            $pointFollow->save();
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }

    /**
     * 福分流水列表
     * @param $startTime
     * @param $endTime
     * @param $page
     * @param int $perpage
     * @return mixed
     */
    public function getPointFollowList($startTime, $endTime, $page, $perpage = 20)
    {
        $baseInfo = $this->getBaseInfo();
        $query = PointFollowDistribution::findByUserHomeId($baseInfo['home_id'])->where(['user_id' => $this->id]);

        if ($startTime) {
            $query->andWhere(['>', 'created_at', $startTime]);
        }
        if ($endTime) {
            $query->andWhere(['<', 'created_at', $endTime]);
        }
        $order = 'id desc';

        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
        $list = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        $return['list'] = $list;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        return $return;
    }

    public function changePassword($password)
    {
        $user = UserModel::findOne($this->id);
        if ($user) {
            $user->setPassword($password);
            return $user->save();
        }
        return false;
    }

    /**
     * 修改用户经验
     * @param $experience
     * @param $type
     * @param $desc
     * @return bool
     * @throws yii\db\Exception
     */
    public function editExperience($experience, $type, $desc)
    {
        $baseInfo = $this->getBaseInfo();
        $experience += 0;
        if ($experience > 0) {
            $currentExpr = $baseInfo['experience'] + $experience;
        } elseif ($experience < 0) {
            $currentExpr = $baseInfo['experience'] - (-1 * $experience);
            $currentExpr = $currentExpr < 0 ? 0 : $currentExpr;
        } else {
            return true;
        }

        $db = \Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            if ($type == 4 && $experience > 0) {
                $key  = 'experience_follow_' . date("Ymd") . '_' . $this->id;
                if (!$this->setKeyValue($key, 100)) {
                    return true;
                }
            }
            UserModel::updateAll(['experience' => $currentExpr], ['id' => $this->id]);
            $pointFollow = new ExperienceFollowDistribution($baseInfo['home_id']);
            $pointFollow->user_id = $this->id;
            $pointFollow->experience = $experience;
            $pointFollow->current_experience = $currentExpr;
            $pointFollow->type = $type;
            $pointFollow->desc = $desc;
            $pointFollow->created_at = time();
            $pointFollow->save();
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }

    /** 经验流水表
     * @param $page
     * @param int $perpage
     */
    public function getExperienceFollowList($page, $perpage = 20)
    {

    }

    /**
     * 购买记录列表 ，云购纪录
     * @param $startTime
     * @param $endTime
     * @param $page
     * @param int $perpage
     * @param int $status
     * @return mixed
     */
    public function getBuyList($startTime, $endTime, $page, $perpage = 20, $status = -1, $total = 'all')
    {
        $baseInfo = $this->getBaseInfo();
        $homeId = $baseInfo['home_id'];
        $userId = $baseInfo['id'];

        $userBuylistDistribution = new UserBuylistDistribution($homeId);
        $userBuyListTable = $userBuylistDistribution::tableName();
        if ($status != -1) {
            if ($status == 0) { //即将揭晓
                $query = UserBuylistDistribution::findByUserHomeId($homeId)
                    ->innerJoin("((SELECT id FROM current_periods) UNION (SELECT id FROM periods WHERE periods.end_time > " . (microtime(true) - Period::COUNT_DOWN_TIME) . ")) as p", 'p.id = ' . $userBuyListTable . '.period_id')
                    ->select($userBuyListTable . '.*')
                    ->where([$userBuyListTable . '.user_id' => $userId]);
            } elseif ($status == 1) { //已揭晓
                $query = UserBuylistDistribution::findByUserHomeId($homeId)
                    ->innerJoin('periods p', 'p.id = ' . $userBuyListTable . '.period_id')
                    ->select($userBuyListTable . '.*')
                    ->where([$userBuyListTable . '.user_id' => $userId])
                    ->andWhere(['<', 'p.end_time', microtime(true) - Period::COUNT_DOWN_TIME]);
            } elseif ($status == 2) { //已退购
                $query = UserBuylistDistribution::findByUserHomeId($homeId)
                    ->innerJoin('orders o', 'o.period_id = ' . $userBuyListTable . '.period_id')
                    ->select($userBuyListTable . '.*')
                    ->where([$userBuyListTable . '.user_id' => $userId, 'o.status' => 7]);
            }
            $query->andWhere(['>', $userBuyListTable . '.buy_num', 0]);

            $order = $userBuyListTable . '.buy_time desc';

            if ($startTime) {
                $query->andWhere(['>', $userBuyListTable . '.buy_time', $startTime]);
            }
            if ($endTime) {
                $query->andWhere(['<', $userBuyListTable . '.buy_time', $endTime]);
            }
        } else {
            //$curtime = microtime(true);
            //$select = [$userBuyListTable.".*", "IFNULL(p.end_time, ".$curtime.") as end_time"];
            //$query = UserBuylistDistribution::findByUserHomeId($homeId)->select($select)
            //    ->leftJoin('periods as p', 'p.id='.$userBuyListTable.'.period_id')->where([$userBuyListTable.'.user_id' => $userId]);
            $query = UserBuylistDistribution::findByUserHomeId($homeId)->where(['user_id' => $userId]);
            $query->andWhere(['>', 'buy_num', 0]);
            if ($startTime) {
                $query->andWhere(['>', 'buy_time', $startTime]);
            }
            if ($endTime) {
                $query->andWhere(['<', 'buy_time', $endTime]);
            }
            $order = 'buy_time DESC';
        }

        $countQuery = clone $query;
        if($total == 'all'){
            $totalCount = $countQuery->count();
            $limit = $perpage;
        }else{
            if($total == 'zero') $totalCount = 0;
            else $totalCount = $total;
            $num = $totalCount / $perpage;
            $curpage = ceil($num);
            if($curpage == $page && ($totalCount % $perpage != 0)){
                $limit = $totalCount % $perpage;
                if($limit < 1) $limit = $totalCount;
                else $limit = $limit;
            }else{
                if($totalCount == 0) $limit = 0;
                else $limit = $perpage;
            }
        }

        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage, 'pageSizeLimit' => [1, PHP_INT_MAX]]);

        $result = $query->orderBy($order)->offset($pagination->offset)->limit($limit)->asArray()->all();

        $buylist = array();
        foreach ($result as $one) {
            $productId = $one['product_id'];
            $periodId = $one['period_id'];
            $buyNum = $one['buy_num'];
            $curPeriodInfo = Product::curPeriod($periodId);
            $info = [];
            if($curPeriodInfo){
                $productInfo = Product::info($productId);
                $info['goods_picture'] = $productInfo['picture'];
                $info['goods_name'] = $productInfo['name'];
                $info['period_number'] = $curPeriodInfo['period_number'];
                $info['status'] = 0;
                $info['code_sales'] = $curPeriodInfo['sales_num'];
                $info['progress'] = $curPeriodInfo['progress'];
                $info['left_num'] = $curPeriodInfo['left_num'];
                $info['code_quantity'] = $curPeriodInfo['price'];
                $info['code_price'] = sprintf('%.2f', $curPeriodInfo['price']);
                $info['limit_num'] = $productInfo['limit_num'];
            }else{
                $info = Period::info($periodId);
                if (!$info) {
                    continue;
                }
                $info['code_sales'] = $info['price'];
                $info['code_quantity'] = $info['price'];
                $info['lucky_code'] = isset($info['lucky_code']) ? $info['lucky_code'] : '';
                $info['code_price'] = sprintf('%.2f', $info['price']);
                $info['limit_num'] = $info['limit_num'];
            }

            $info['user_buy_num'] = $buyNum;
            $info['product_id'] = $productId;
            $info['period_id'] = $periodId;
            $info['user_buy_time'] = $one['buy_time'];
            $buylist[] = $info;
        }

        $return['list'] = $buylist;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        $return['pagination'] = $pagination;
        return $return;
    }

    /** 购买记录详情
     * @param $periodId 期数ID
     */
    public function getBuyDetail($periodId)
    {
        $periodInfo = CurrentPeriod::findOne($periodId);
        if (!$periodInfo) {
            $periodInfo = PeriodModel::findOne($periodId);
        }
        $tableId = $periodInfo->table_id;
        $query = PeriodBuylistDistribution::findByTableId($tableId)->where(['period_id' => $periodId, 'user_id' => $this->id]);
        $result = $query->orderBy('id desc')->asArray()->all();
        return $result;
    }

    /**
     * 换货商品
     * @param $startTime
     * @param $endTime
     * @param $page
     * @param int $perpage
     * @param int $status
     * @param string $total
     * @return mixed
     */
    public function getExchangeOrderList($startTime, $endTime, $page, $perpage = 20, $status = -1, $total = 'all')
    {
        $baseInfo = $this->getBaseInfo();
        $homeId = $baseInfo['home_id'];
        $userId = $baseInfo['id'];
        if ($status != -1) {
            $where['o.status'] = $status;
        }

        $where['o.user_id'] = $this->id;
        $query = ExchangeOrder::find()->select('o.*, exchange_orders.id as ex_id')->leftJoin('orders as o', 'exchange_orders.order_no=o.id')->leftJoin('periods as p', 'o.period_id=p.id')->where($where);

        if ($startTime) {
            $query->andWhere(['>', 'exchange_orders.created_time', $startTime]);
        }
        if ($endTime) {
            $query->andWhere(['<', 'exchange_orders.created_time', $endTime]);
        }

        $query->andWhere(['<','p.end_time', microtime(true)- Period::COUNT_DOWN_TIME]);
        $countQuery = clone $query;

        if($total == 'all'){
            $totalCount = $countQuery->count();
            $limit = $perpage;
        }else{
            if($total == 'zero') $totalCount = 0;
            else $totalCount = $total;
            $num = $totalCount / $perpage;
            $curpage = ceil($num);
            if($curpage == $page && ($totalCount % $perpage != 0)){
                $limit = $totalCount % $perpage;
                if($limit < 1) $limit = $totalCount;
                else $limit = $limit;
            }else{
                if($totalCount == 0) $limit = 0;
                else $limit = $perpage;
            }
        }

        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
        $orders = $query->orderBy('exchange_orders.created_time desc')->offset($pagination->offset)->limit($limit)->asArray()->all();
        $periodIds = ArrayHelper::getColumn($orders, 'period_id');
        $productIds = ArrayHelper::getColumn($orders, 'product_id');
        $periodsInfo = PeriodModel::find()->where(['id' => $periodIds])->indexBy('id')->asArray()->all();
        $productsInfo = ProductModel::find()->where(['id' => $productIds])->indexBy('id')->asArray()->all();
        $list = array();
        foreach ($orders as $order) {
            $productInfo = $productsInfo[$order['product_id']];
            $periodInfo = $periodsInfo[$order['period_id']];
            $userBuyList = UserBuylistDistribution::findByUserHomeId($homeId)
                ->where(['user_id'=>$userId, 'period_id'=>$order['period_id']])
                ->asArray()
                ->one();
            $info = [];
            $info['ex_id'] = $order['ex_id'];
            $info['order_id'] = $order['id'];
            $info['order_no'] = $order['order_no'];
            $info['order_state'] = $order['status'];
            $info['period_id'] = $order['period_id'];
            $info['goods_picture'] = $productInfo['picture'];
            $info['goods_name'] = $productInfo['name'];
            $info['lucky_code'] = $periodInfo['lucky_code'];
            $info['start_time'] = DateFormat::microDate($periodInfo['start_time']);
            $info['end_time'] = DateFormat::microDate($periodInfo['end_time']);
            $info['price'] = sprintf('%.2f', $periodInfo['price']);
            $info['buy_num'] = $userBuyList['buy_num'];
            $info['is_exchange'] = $order['is_exchange'];
            //TODO
            $info['product_type'] = 0;
            $info['goods_id'] = $order['product_id'];
            $info['period_number'] = $periodInfo['period_number'];
            $info['raff_time'] = DateFormat::microDate($periodInfo['end_time']);
            $info['allow_share'] = $productInfo['allow_share'];
            $info['limit_num'] = $productInfo['limit_num'];
            $info['status'] = $order['status'];
            $list[] = $info;
        }

        $return['list'] = $list;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        $return['pagination'] = $pagination;
        return $return;
    }

    /** 获得的商品列表
     * @param $page
     * @param int $perpage
     */
    public function getProductList($startTime, $endTime, $page, $perpage = 20, $status = -1, $total = 'all')
    {
        $baseInfo = $this->getBaseInfo();
        $homeId = $baseInfo['home_id'];
        $userId = $baseInfo['id'];
        if ($status != -1) {
            $where['orders.status'] = $status;
        }

        $where['orders.user_id'] = $this->id;
        $query = Order::find()->select('orders.*')->leftJoin('periods as p', 'orders.period_id=p.id')->where($where);

        if ($startTime) {
            $query->andWhere(['>', 'orders.create_time', $startTime]);
        }
        if ($endTime) {
            $query->andWhere(['<', 'orders.create_time', $endTime]);
        }

        $query->andWhere(['<','p.end_time', microtime(true)- Period::COUNT_DOWN_TIME]);
        $countQuery = clone $query;

        if($total == 'all'){
            $totalCount = $countQuery->count();
            $limit = $perpage;
        }else{
            if($total == 'zero') $totalCount = 0;
            else $totalCount = $total;
            $num = $totalCount / $perpage;
            $curpage = ceil($num);
            if($curpage == $page && ($totalCount % $perpage != 0)){
                $limit = $totalCount % $perpage;
                if($limit < 1) $limit = $totalCount;
                else $limit = $limit;
            }else{
                if($totalCount == 0) $limit = 0;
                else $limit = $perpage;
            }
        }

        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
        $orders = $query->orderBy('orders.create_time desc')->offset($pagination->offset)->limit($limit)->asArray()->all();
        $periodIds = ArrayHelper::getColumn($orders, 'period_id');
        $productIds = ArrayHelper::getColumn($orders, 'product_id');
        $periodsInfo = PeriodModel::find()->where(['id' => $periodIds])->indexBy('id')->asArray()->all();
        $productsInfo = ProductModel::find()->where(['id' => $productIds])->indexBy('id')->asArray()->all();
        $list = array();
        foreach ($orders as $order) {
            $productInfo = $productsInfo[$order['product_id']];
            $periodInfo = $periodsInfo[$order['period_id']];
            $userBuyList = UserBuylistDistribution::findByUserHomeId($homeId)
                ->where(['user_id'=>$userId, 'period_id'=>$order['period_id']])
                ->asArray()
                ->one();
            $info = [];
            $info['order_id'] = $order['id'];
            $info['order_no'] = $order['order_no'];
            $info['order_state'] = $order['status'];
            $info['period_id'] = $order['period_id'];
            $info['goods_picture'] = $productInfo['picture'];
            $info['goods_name'] = $productInfo['name'];
            $info['lucky_code'] = $periodInfo['lucky_code'];
            $info['start_time'] = DateFormat::microDate($periodInfo['start_time']);
            $info['end_time'] = DateFormat::microDate($periodInfo['end_time']);
            $info['price'] = sprintf('%.2f', $periodInfo['price']);
            $info['buy_num'] = $userBuyList['buy_num'];
            $info['is_exchange'] = $order['is_exchange'];
            //TODO
            $info['product_type'] = 0;
            $info['goods_id'] = $order['product_id'];
            $info['period_number'] = $periodInfo['period_number'];
            $info['raff_time'] = DateFormat::microDate($periodInfo['end_time']);
            $info['allow_share'] = $productInfo['allow_share'];
            $info['limit_num'] = $productInfo['limit_num'];
            $info['status'] = $order['status'];
            $info['delivery_id'] = $productInfo['delivery_id'];
            $list[] = $info;
        }

        $return['list'] = $list;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        $return['pagination'] = $pagination;
        return $return;
    }

    /** 换货的商品列表
     * @param $page
     * @param int $perpage
     */
    public function getChangeList($page, $perpage = 20)
    {

    }

    /** 晒单列表
     * @param $page
     * @param int $perpage
     */
    public function getShareList( $page, $perpage = 20)
    {
        return Share::getListByType($page, 0, 10, $perpage, $this->id, 0);
    }

    /**
     *  充值纪录
     * @param $page
     * @param $startTime
     * @param $endTime
     * @param int $perpage
     */
    public function getRechargeRecord($startTime, $endTime, $page, $perpage = 20)
    {
        $baseInfo = $this->getBaseInfo();
        $tableId = RechargeOrderDistribution::getTableIdByUserHomeId($baseInfo['home_id']);
        $query = RechargeOrderDistribution::findByTableId($tableId)->where(['user_id' => $this->id]);
        $query->andWhere(['=', 'status', RechargeOrderDistribution::STATUS_PAID]);
        $query->andWhere(['<>', 'money', 0]);

        // 充值总额
        $totalQuery = clone $query;
        $totalMoney = $totalQuery->select('SUM(post_money) as totalMoney')->asArray()->one();

        if ($startTime != '') {
            $query->andWhere(['>', 'pay_time', $startTime]);
        }
        if ($endTime != '') {
            $query->andWhere(['<', 'pay_time', $endTime]);
        }

        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
        $query->orderBy('create_time desc');
        $records = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        $return['list'] = $records;
        $return['totalMoney'] = intval($totalMoney['totalMoney']);
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        return $return;
    }

    /** 消费纪录
     * @param $page
     * @param $startTime
     * @param $endTime
     * @param int $perpage
     */
    public function getPayRecord($startTime, $endTime, $page, $perpage = 20)
    {
        $baseInfo = $this->getBaseInfo();
        $tableId = PaymentOrderDistribution::getTableIdByUserHomeId($baseInfo['home_id']);
        $query = PaymentOrderDistribution::findByTableId($tableId)->where(['user_id' => $this->id]);
        $query->andWhere(['=', 'status', PaymentOrderDistribution::STATUS_PAID]);
        $query->andWhere(['<>', 'money', 0]);

        // 消费总额
        $totalQuery = clone $query;
        $totalMoney = $totalQuery->select('SUM(money) as totalMoney')->asArray()->one();

        if ($startTime != '') {
            $query->andWhere(['>', 'buy_time', $startTime]);
        }
        if ($endTime != '') {
            $query->andWhere(['<', 'buy_time', $endTime]);
        }


        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
        $query->orderBy('create_time desc');
        $records = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        $return['list'] = $records;
        $return['totalMoney'] = intval($totalMoney['totalMoney']);
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        return $return;
    }

    /** 关注的商品列表
     * @param $page
     * @param int $perpage
     */
    public function getFollowProductList($page, $perpage = 20)
    {
        $query = FollowProduct::find()->where(['user_id' => $this->id]);
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
        $query->orderBy('id desc');
        $result = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        $list = array();
        foreach ($result as $one) {
            $productInfo = Product::info($one['product_id']);
            $periodInfo = Product::curPeriodInfo($productInfo['id']);
            $info = [];
            $info['goods_id'] = $productInfo['id'];
            $info['goods_name'] = $productInfo['name'];
            $info['goods_picture'] = $productInfo['picture'];
            $info['period_id'] = $periodInfo['id'];
            $info['period_number'] = $periodInfo['period_number'];
            $info['limit_buy'] = $periodInfo['limit_num'] <= 0 ? 0 : 1;
            $info['quantity'] = $periodInfo['price'];
            $info['sales'] = $periodInfo['sales_num'];
            $info['is_sale'] = $productInfo['marketable'];

            $list[] = $info;
        }

        $return['list'] = $list;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        return $return;
    }

    /**
     * 加入的圈子
     */
    public function getJoinedGroups()
    {

    }

    /** 发表的话题列表
     * @param $page
     * @param int $perpage
     */
    public function getTopicList($page, $perpage = 20)
    {

    }

    /** 发表的话题回复列表
     * @param $page
     * @param int $perpage
     */
    public function getTopicCommentList($page, $perpage = 20)
    {

    }

    /** 邀请的列表
     * @param $page
     * @param int $perpage
     */
    public function getInvitedList($page, $perpage = 20)
    {
        $query = Invite::find()->where(['user_id'=>$this->id]);
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new yii\data\Pagination(['totalCount'=>$totalCount, 'page'=>$page-1, 'defaultPageSize'=>$perpage]);
        $query->orderBy('id desc');
        $invite = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
        $userIds = yii\helpers\ArrayHelper::getColumn($invite, 'invite_uid');
        $usersBaseInfo = User::baseInfo($userIds);
        foreach ($invite as &$one) {
            $userBaseInfo = $usersBaseInfo[$one['invite_uid']];
            $one['user_nickname'] = $userBaseInfo['username'];
            $one['user_home_id'] = $userBaseInfo['home_id'];
            $one['user_avatar'] = $userBaseInfo['avatar'];
            $one['invite_time'] = date('Y-m-d H:i:s',$one['invite_time']);
        }

        $return['list'] = $invite;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        return $return;
    }

    /** 佣金明细列表
     * @param $page
     * @param int $perpage
     */
    public function getCommissionList($type, $startTime, $endTime, $page, $perpage = 20)
    {
        $query = InviteCommission::find()->where(['user_id'=>$this->id]);
        if ($startTime) {
            $query->andWhere(['>', 'created_time', $startTime]);
        }
        if ($endTime) {
            $query->andWhere(['<', 'created_time', $endTime]);
        }
        if ($type!=-1) {
            if ($type==InviteCommission::TYPE_PAY) {
                $query->andWhere(['=', 'type', InviteCommission::TYPE_PAY]);
            }elseif ($type==InviteCommission::TYPE_RECHARGE) {
                $query->andWhere(['=', 'type', InviteCommission::TYPE_RECHARGE]);
            }elseif ($type==InviteCommission::TYPE_WITHDRAW) {
                $query->andWhere(['=', 'type', InviteCommission::TYPE_WITHDRAW]);
            }
        }
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new yii\data\Pagination(['totalCount'=>$totalCount, 'page'=>$page-1, 'defaultPageSize'=>$perpage]);
        $query->orderBy('id desc');
        $commissionList = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
        $userIds = yii\helpers\ArrayHelper::getColumn($commissionList, 'action_user_id');
        $usersBaseInfo = User::baseInfo($userIds);
        foreach ($commissionList as &$one) {
            $userBaseInfo = $usersBaseInfo[$one['action_user_id']];
            $one['user_nickname'] = $userBaseInfo['username'];
            $one['user_home_id'] = $userBaseInfo['home_id'];
            $one['user_avatar'] = $userBaseInfo['avatar'];
            $one['commission'] = sprintf('%.2f', $one['commission'] / 100);
            if ($one['type'] == InviteCommission::TYPE_PAY) {
                $desc = unserialize($one['desc']);
                $periodId = $desc['periodId'];
                $info = CurrentPeriod::findOne($periodId);
                if ($info) {
                    $periodNumber = $info->period_number;
                    $productInfo = \app\models\Product::findOne($info->product_id);
                    $productName = $productInfo->name;
                } else {
                    $info = \app\models\Period::findOne($periodId);
                    $periodNumber = $info->period_number;
                    $productInfo = \app\models\Product::findOne($info->product_id);
                    $productName = $productInfo->name;
                }

                $one['desc'] = '<a target="_blank" href="'.yii\helpers\Url::to(['/product/lottery', 'pid'=>$periodId]).'">(第' . $periodNumber . '期)'.$productName.'</a>';
            } elseif($one['type'] == InviteCommission::TYPE_WITHDRAW) {
                $desc = unserialize($one['desc']);
                $bank = $desc['bank'];
                $bankNumber = $desc['bank_number'];
                $one['desc'] = '用户佣金提取到银行账户(' . $bank . ' ' . $bankNumber . ')';
            }
            if ($one['type'] == InviteCommission::TYPE_PAY) {
                $one['type'] = '收入';
            } elseif ($one['type'] == InviteCommission::TYPE_RECHARGE) {
                $one['type'] = '充值到账户';
            } elseif ($one['type'] == InviteCommission::TYPE_WITHDRAW) {
                $one['type'] = '提现';
            }
        }

        $return['list'] = $commissionList;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        return $return;
    }

    /** 提现纪录
     * @param $page
     * @param $startTime
     * @param $endTime
     * @param int $perpage
     */
    public function getWithdrawList($startTime, $endTime, $page, $perpage = 20)
    {
        $query = Withdraw::find()->where(['user_id' => $this->id]);
        if ($startTime) {
            $query->andWhere(['>', 'apply_time', $startTime]);
        }
        if ($endTime) {
            $query->andWhere(['<', 'apply_time', $endTime]);
        }
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
        $query->orderBy('id desc');
        $result = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        foreach ($result as &$one) {
            $one['money'] = sprintf('%.2f', $one['money']/100);
            //$one['service_charge'] = sprintf('%.2f', $one['service_charge']/100);
        }
        $return['list'] = $result;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        return $return;
    }


    /** 好友列表
     * @param $page
     * @param int $perpage
     */
    public function getFirends($page, $perpage = 20, $user_id = '')
    {
        if($user_id){
            $query = Friend::find()->where(['user_id'=>$user_id])->andWhere('friend_userid!='.$user_id);
        }else{
            $query = Friend::find()->where(['user_id'=>$this->id])->andWhere('friend_userid!='.$this->id);
        }
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
        $query->orderBy('id desc');
        $result = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        $userIds = ArrayHelper::getColumn($result, 'friend_userid');
        $usersInfo = User::allInfo($userIds);

        $list = [];
        foreach ($result as $one) {
            $userInfo = $usersInfo[$one['friend_userid']];

            $info = [];
            $info['user_id'] = $userInfo['id'];
            $info['user_name'] = $userInfo['username'];
            $info['user_home_id'] = $userInfo['home_id'];
            $info['friend_userid'] = $one['friend_userid'];
            $info['user_avatar'] = Image::getUserFaceUrl($userInfo['avatar'], 160);
            //TODO
            $info['grade_pic'] = $userInfo['level']['pic']; //等级图片
            $info['grade_name'] = $userInfo['level']['name'];//等级名称
            $info['address'] = Ip::getAddressByIp(long2ip($userInfo['last_login_ip']));//地址
            $info['intro'] = $userInfo['intro'];//简介

            $list[] = $info;
        }

        $return['list'] = $list;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        $return['pagination'] = $pagination;
        return $return;
    }

    /**
     * 好友查找
     * @param $arr
     */
    public function findFriendList($arr)
    {
        $userIds = ArrayHelper::getColumn($arr, 'id');
        $usersInfo = User::allInfo($userIds);

        $list = [];
        foreach ($arr as $one) {
            $userInfo = $usersInfo[$one['id']];
            $existFriend = Friend::findOne(['and', 'user_id'=>Yii::$app->user->id, 'friend_userid'=>$one['id']]);
            $info = [];
            $info['user_id'] = $userInfo['id'];
            $info['user_name'] = User::baseInfo($userInfo['id']);
            $info['user_home_id'] = $userInfo['home_id'];
            $info['user_avatar'] = Image::getUserFaceUrl($userInfo['avatar'], 160);
            $info['friend'] = $existFriend;
            //TODO
            $info['grade'] = ''; //经验等级
            $info['grade_name'] = $userInfo['level']['name'];//等级名称
            $info['address'] = $userInfo['hometown'];//地址
            $info['intro'] = $userInfo['intro'];//简介
            $list[] = $info;
        }

        return $list;
    }

    /**
     * 好友查找
     * status 0随机推送好友，1获得商品最多好友，2最活跃好友，3最新加入好友
     */
    public function randomFriend($status = 0,$userBase = 0, $limit = 8)
    {
        $conn = \Yii::$app->db;
        $list = [];
        if($status == 0 || $status == 3){
            if($status == 0){
                $command = $conn->createCommand("SELECT * FROM `users` AS a JOIN (SELECT MAX(ID) AS ID FROM `users`) AS b ON (a.ID >= FLOOR( b.ID*RAND() ) + ".$userBase." )  LIMIT ".$limit." ");
            }elseif($status == 3){
                $command = $conn->createCommand("select * from users order by id desc limit ".$limit);
            }
            $find = $command->queryAll();

            foreach ($find as $key => $one) {
                $userInfo = User::allInfo($one['id']);
                $username = User::baseInfo($one['id']);
                $existFriend = Friend::findOne(['and', 'user_id='.Yii::$app->user->id, 'friend_userid='.$one['id']]);
                $avatar = Image::getUserFaceUrl($userInfo['avatar'], 160);
                $list[$key]['user_id'] = $one['id'];
                $list[$key]['username'] = $username['username'];
                $list[$key]['user_home_id'] = $userInfo['home_id'];
                $list[$key]['user_avatar'] = $avatar;
                $list[$key]['friend'] = $existFriend['id'];
                //TODO
                $list[$key]['grade'] = ''; //经验等级
                $list[$key]['grade_name'] = $userInfo['level']['name'];//等级名称
                $list[$key]['address'] = $userInfo['hometown'];//地址
                $list[$key]['intro'] = $userInfo['intro'];//简介
            }
        }elseif($status == 1 || $status == 2){
            if($status == 1){
                $command = $conn->createCommand("select *,count(*) as num from orders group by user_id order by num desc limit ".$limit);
                $find = $command->queryAll();
            }elseif($status == 2){
                $find = GroupTopicComment::activeUser($limit);
            }

            foreach ($find as $key => $one) {
                $userInfo = User::allInfo($one['user_id']);
                $username = User::baseInfo($one['user_id']);
                $avatar = Image::getUserFaceUrl($userInfo['avatar'], 160);
                $existFriend = Friend::findOne(['and', 'user_id='.Yii::$app->user->id, 'friend_userid='.$one['user_id']]);
                $list[$key]['user_id'] = $one['user_id'];
                $list[$key]['username'] = $username['username'];
                $list[$key]['user_home_id'] = $userInfo['home_id'];
                $list[$key]['user_avatar'] = $avatar;
                $list[$key]['friend'] = $existFriend;
                //TODO
                $list[$key]['grade'] = ''; //经验等级
                $list[$key]['grade_name'] = $userInfo['level']['name'];//等级名称
                $list[$key]['address'] = $userInfo['hometown'];//地址
                $list[$key]['intro'] = $userInfo['intro'];//简介
            }
        }

        return $list;
    }

    /** 好友请求
     * @param $page
     * @param int $perpage
     */
    public function getFirendsApply($page, $perpage = 10)
    {
        $query = FriendApply::find()->where(['apply_userid'=>$this->id, 'status'=>0]);
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
        $query->orderBy('id desc');
        $result = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        $userIds = ArrayHelper::getColumn($result, 'user_id');
        $usersInfo = User::allInfo($userIds);

        $list = [];
        foreach ($result as $one) {
            $userInfo = $usersInfo[$one['user_id']];
            $info = [];
            $info['apply_id'] = $one['id'];
            $info['user_id'] = $userInfo['id'];
            $info['user_name'] = User::baseInfo($userInfo['id']);
            $info['user_home_id'] = $userInfo['home_id'];
            $info['user_avatar'] = Image::getUserFaceUrl($userInfo['avatar'], 80);
            //TODO
            $info['grade'] = ''; //经验等级
            $info['grade_name'] = $userInfo['level'];//等级名称
            $info['address'] = Ip::getAddressByIp(long2ip($userInfo['last_login_ip']));//地址
            $info['intro'] = $userInfo['intro'];//简介
            $info['apply_time'] = DateFormat::formatTime($one['apply_time']);
            $list[] = $info;
        }

        $return['list'] = $list;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        $return['pagination'] = $pagination;
        return $return;
    }

    /** 系统消息
     * @param $page
     * @param int $perpage
     */
    public function getSystemMsg($page, $perpage = 20)
    {

    }

    /** 私信
     * @param $page
     * @param int $perpage
     */
    public function getPrivateMsg($page, $perpage = 20)
    {

    }

    /** 收货地址
     * @param $page
     * @param int $perpage
     */
    public function getAddressList($page, $perpage = 20)
    {
        $query = UserAddress::find()->where(['uid'=>$this->id]);
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
        $query->orderBy('id desc');
        $result = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        foreach ($result as &$r) {
            $address = Area::find()->where(['id' => [$r['prov'], $r['city'], $r['area']]])->indexBy('id')->asArray()->all();
            $r['provName'] = $address[$r['prov']]['name'];
            $r['cityName'] = $address[$r['city']]['name'];
            $r['areaName'] = $address[$r['area']]['name'];
        }

        $return['list'] = $result;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        return $return;
    }

    /** 虚拟物品收货地址
     * @param $page
     * @param int $perpage
     */
    public function getVirtualAddressList($page, $perpage = 20)
    {
        $query = UserVirtualAddress::find()->where(['user_id'=>$this->id]);
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
        $query->orderBy('id desc');
        $result = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        $return['list'] = $result;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        return $return;
    }

    /**
     *  隐私设置信息
     */
    public function getPrivacySettings()
    {

    }

    /**
     *  接收消息设置
     */
    public function getNoticeSettings()
    {


    }

    /**
     * 转账记录
     * @param $startTime
     * @param $endTime
     * @param $page
     * @param int $perpage
     * @return mixed
     */
    public function getTransferRecord($startTime, $endTime, $page, $perpage = 20)
    {
        $query = UserTransferAccount::find()->where(['user_id' => $this->id])->orWhere(['to_userid' => $this->id]);
        if ($startTime != '') {
            $query->andWhere(['>', 'created_at', $startTime]);
        }
        if ($endTime != '') {
            $query->andWhere(['<', 'created_at', $endTime]);
        }
        $query->andWhere(['<>', 'account', 0]);

        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
        $query->orderBy('created_at desc');
        $records = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        foreach ($records as &$record) {
            if ($record['user_id'] == $this->id) {
                $record['payment'] = "转出";
                $userInfo = UserModel::findOne(['id' => $record['to_userid']]);
                $record['to_account'] = $userInfo['phone'] ? User::privatePhone($userInfo['phone']) : User::privateEmail($userInfo['email']);
                $record['money'] = '-' . $record['account'];
            } else {
                $record['payment'] = "转入";
                $userInfo = UserModel::findOne(['id' => $record['user_id']]);
                $record['to_account'] = $userInfo['phone'] ? User::privatePhone($userInfo['phone']) : User::privateEmail($userInfo['email']);
                $record['money'] = $record['account'];
            }
        }

        $totalOutQuery = UserTransferAccount::find()->where(['user_id' => $this->id])->select('SUM(account) as totalMoney')->asArray()->one();
        $totalInQuery = UserTransferAccount::find()->where(['to_userid' => $this->id])->select('SUM(account) as totalMoney')->asArray()->one();

        $return['list'] = $records;
        $return['totalInMoney'] = intval($totalInQuery['totalMoney']);
        $return['totalOutMoney'] = intval($totalOutQuery['totalMoney']);
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        return $return;
    }

    //本周最火达人
    public function hotOrderList($limit = 100)
    {
        //本周时间
        $date=date('Y-m-d');
        $first=1;
        $w=date('w',strtotime($date));
        $now_start=date('Y-m-d',strtotime("$date -".($w ? $w - $first : 6).' days'));
        $now = strtotime($now_start);
        $now_end=date('Y-m-d',strtotime("$now_start +7 days"));
        $end = strtotime($now_end);

        $conn = \Yii::$app->db;
        $command = $conn->createCommand("select *,count(*) as num from orders where create_time >=".$now." and create_time <=".$end." group by user_id order by num desc limit ".$limit);
        $find = $command->queryAll();
        $count = count($find);

        $arr = [];
        if($count > 0){
            if($count < 4){
                $arr = array_rand($find, $count);
            }else{
                $arr = array_rand($find, 4);
            }
        }

        $return = [];
        if($count == 1){
            $return[$arr] = $find[$arr];
        }else{
            foreach($arr as $key){
                $return[$key] = $find[$key];
            }
        }

        $returnArr = [];
        foreach ( $return as $key => $val ) {
            $userInfo = User::allInfo($val['user_id']);
            $baseInfo = User::baseInfo($val['user_id']);
            $avatar = Image::getUserFaceUrl($baseInfo['avatar'], 80);
            $existFriend = Friend::findOne(['user_id'=>$this->id, 'friend_userid'=>$val['user_id']]);
            $returnArr[$key]['user_id'] = $val['user_id'];
            $returnArr[$key]['home_id'] = $userInfo['home_id'];
            $returnArr[$key]['username'] = $baseInfo['username'];
            $returnArr[$key]['user_avatar'] = $avatar;
            $returnArr[$key]['grade_name'] = $baseInfo['level'];
            $returnArr[$key]['friend'] = $existFriend['id'];
            if($val['user_id'] == Yii::$app->user->id) $self = 1;
            else $self = 0;
            $returnArr[$key]['self'] = $self;
        }

        return $returnArr;
    }

    private function setKeyValue($key, $max)
    {
        $value = Yii::$app->cache->get($key);
        if ($value && $value >= $max) {
            return false;
        }
        $value = intval($value) + 1;
        $duration = strtotime(date("y-m-d", strtotime("+1 day"))) - 1 - time();
        Yii::$app->cache->set($key, $value, $duration);
        return true;
    }

    /**
     * 圈子热门话题 24小时内回复最多的5个话题
     * @param int $limit
     * @return array|yii\db\ActiveRecord[]
     */
    public function getTopic($limit = 5){
        $query = GroupTopicComment::find();
        $query->select(['topic_id', 'COUNT(*) as comment_num', 'g.*'])->groupBy('topic_id')->leftJoin('group_topics g', 'group_topic_comments.topic_id=g.id');
        $query->andWhere(['group_topic_comments.status' => 1]);
        $query->andWhere(['>', 'group_topic_comments.created_at', strtotime('-1 day')]);

        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'defaultPageSize' => $limit]);

        $result = $query->orderBy('comment_num DESC')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
        return $result;
    }

    /**
     * 检查订单数据
     * @return [type] [description]
     */
    public function checkOrder()
    {
        $userInfo = $this->getBaseInfo();
        $redis = new MyRedis();
        $keys = $redis->keys(Pay::USER_PERIOD_BUY_LIST_KEY . $this->id . '_*');
        foreach ($keys as $key) {
            $info = $redis->sget($key, 'all');
            foreach ($info as $orderId) {
                $paymentOrder = PaymentOrderDistribution::findByTableId($userInfo['home_id'])->where(['id' => $orderId])->one();
                if (empty($paymentOrder)) {
                    $trans = Yii::$app->db->beginTransaction();
                    try {
                        //插入payment_orders
                        $orderInfo = json_decode($redis->hget(Pay::ORDER_LIST_KEY, $orderId), true);
                        $orderTableId = PaymentOrderDistribution::getTableIdByOrderId($orderId);
                        //订单详情
                        $orderSave = new PaymentOrderDistribution($orderTableId);
                        $orderSave->id = $orderInfo['id'];
                        $orderSave->user_id = $orderInfo['user_id'];
                        $orderSave->status = $orderInfo['status'];
                        $orderSave->payment = $orderInfo['payment'];
                        $orderSave->bank = $orderInfo['bank'];
                        $orderSave->money = $orderInfo['money'];
                        $orderSave->point = $orderInfo['point'];
                        $orderSave->total = $orderInfo['total'];
                        $orderSave->user_point = $orderInfo['point'];
                        $orderSave->ip = $orderInfo['ip'];
                        $orderSave->source = $orderInfo['source'];
                        $orderSave->create_time = $orderInfo['create_time'];
                        $orderSave->buy_time = $orderInfo['buy_time'];
                        $orderSave->recharge_orderid = $orderInfo['recharge_orderid'];
                        $result = $orderSave->save();
                        if (!$result) {
                            $trans->rollback();
                            continue;
                        }

                        //插入payment_order_items
                        $orderItems = $redis->hget(Pay::ORDER_ITEMS_KEY . $orderId, 'all');
                        //订单详情
                        $db = \Yii::$app->db;
                        $orderItemField = ['payment_order_id','product_id','period_id','period_number','post_nums','nums','codes','item_buy_time'];
                        $orderItemValue = [];

                        foreach ($orderItems as $key => $value) {
                            $v = json_decode($value,true);
                            $orderItemValue[] = [$v['payment_order_id'],$v['product_id'],$v['period_id'],$v['period_number'],$v['post_nums'],$v['nums'],$v['codes'],$v['item_buy_time']];
                        }
                        $orderItem = new PaymentOrderItemDistribution($orderTableId);
                        $itemsResult = $db->createCommand()->batchInsert($orderItem::tableName(),$orderItemField,$orderItemValue)->execute();

                        //插入period_buylist
                        $periodResult = 0;
                        foreach ($orderItems as $key => $value) {
                            $v = json_decode($value,true);
                            $periodInfo = CurrentPeriod::findOne($v['period_id']);
                            if (!$periodInfo) {
                                $periodInfo = PeriodModel::findOne($v['period_id']);
                            }
                            $tableId = $periodInfo->table_id;
                            if ($v['nums'] > 0) {
                                $periodBuyList = new PeriodBuylistDistribution($tableId);
                                $periodBuyList->product_id = $v['product_id'];
                                $periodBuyList->period_id = $v['period_id'];
                                $periodBuyList->user_id = $this->id;
                                $periodBuyList->buy_num = $v['nums'];
                                $periodBuyList->codes = $v['codes'];
                                $periodBuyList->ip = $orderInfo['ip'];
                                $periodBuyList->source = $orderInfo['source'];
                                $periodBuyList->buy_time = $orderInfo['buy_time'];
                                $periodResult = $periodBuyList->save(false);
                                if (!$periodResult) {
                                    break;
                                }
                            }
                        }

                        $trans->commit();
                        
                        //删除$orderId
                        $redis->hdel(Pay::ORDER_LIST_KEY, $orderId);
                        $redis->del(Pay::ORDER_ITEMS_KEY . $orderId);
                        $redis->sdel($key, $orderId);
                    } catch (Exception $e) {
                        $trans->rollBack();
                    }
                    
                }
            }
        }
        return ['code' => 100];
    }


}
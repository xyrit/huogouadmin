<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/9/25
 * Time: 下午3:16
 */

namespace app\services;

use app\helpers\DateFormat;
use app\models\CurrentPeriod;
use app\models\FriendApply;
use app\models\GroupUser;
use app\models\LoginLog;
use app\models\PaymentOrderDistribution;
use app\models\PaymentOrderItemDistribution;
use app\models\PointFollowDistribution;
use app\models\Product as ProductModel;
use app\models\RechargeOrderDistribution;
use app\models\UserPrivateMessage;
use app\models\UserSystemMessage;
use app\models\UserTransferAccount;
use app\models\ProductCategory;
use app\models\UserBuylistDistribution;
use yii\base\Object;
use yii\data\Pagination;

use yii;
use yii\helpers\ArrayHelper;

use app\models\Invite;
use app\models\InviteCommission;
use app\models\Friend;
use app\models\Group;
use app\models\UserAddress;
use app\models\GroupTopic;
use app\models\GroupTopicComment;

use app\models\ShareTopic;
use app\models\Period;
use app\models\Order;
use app\models\MemberIntegral;

class AdminMember extends Object
{
	public $id;
	
	/**
	 *  获取会员基本信息
	 */
	public function getBaseInfo()
	{
		return User::baseInfo($this->id);
	}
	
	/**
	 * 伙购记录
	 * @param $condition
	 * @param $page
	 * @param $pageSize
	 * @return mixed
	 */
	public function getBuyList($condition, $page, $pageSize)
	{
		$baseInfo = $this->getBaseInfo();
		$homeId = $baseInfo['home_id'];
		$order = new PaymentOrderDistribution($homeId);
		$orderTable = $order::tableName();
		$item = new PaymentOrderItemDistribution($homeId);
		$query = PaymentOrderDistribution::findByTableId($homeId)->select('*')->where([$orderTable . '.user_id' => $this->id]);
		
		$query->leftJoin($item::tableName() . ' as i', $orderTable . '.id=i.payment_order_id');
		if ($condition['startTime']) {
			$query->andWhere(['>', 'buy_time', strtotime($condition['startTime'])]);
		}
		if ($condition['endTime']) {
			$query->andWhere(['<', 'buy_time', strtotime($condition['endTime'])]);
		}
		
		$order = 'buy_time desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		$buylist = array();
		foreach ($result as $one) {
			$productId = $one['product_id'];
			$periodId = $one['period_number'];
			$periodInfo = Period::findone(['id' => $one['period_id']]);
			if (isset($periodInfo['lucky_code'])) $info['product_status'] = ($periodInfo['lucky_code'] > 0) ? '已揭晓' : '揭晓中';
			else $info['product_status'] = '进行中';
			$productInfo = Product::info($productId);
			$category = ProductCategory::findOne($productId);
			$info['payment_order_id'] = $one['payment_order_id'];
			$info['goods_name'] = $productInfo['name'];
			$info['goods_price'] = sprintf('%.2f', $productInfo['price']);
			$info['user_buy_num'] = $one['nums'];
			$info['product_id'] = $productId;
			$info['period_number'] = $periodId;
			$info['product_id'] = $productInfo['id'];
			$info['limit_num'] = ($productInfo['limit_num'] == 0) ? '非限购' : '限购';
			if ($productInfo['buy_unit'] == 10) $info['limit_num'] = '十元专区';
			$info['user_buy_time'] = $one['create_time'];
			$info['category_name'] = isset($category['name']) ? $category['name'] : '未知';
			$info['status'] = $one['status'];
			switch ($one['source']) {
				case 1:
					$info['source'] = 'PC';
					break;
				case 2:
					$info['source'] = '微信';
					break;
				case 3:
					$info['source'] = 'Ios';
					break;
				case 4:
					$info['source'] = 'Android';
					break;
				case 5:
					$info['source'] = '触屏版';
					break;
			}
			$buylist[] = $info;
		}
		
		$return['rows'] = $buylist;
		$return['total'] = $totalCount;
		return $return;
	}
	
	/**
	 * 中奖记录
	 * @param $condition
	 * @param $page
	 * @param $pageSize
	 * @return mixed
	 */
	public function getOrderList($condition, $page, $pageSize)
	{
		$query = Order::find()->where(['user_id' => $this->id]);
		if ($condition['startTime']) {
			$query->andWhere(['>', 'create_time', strtotime($condition['startTime'])]);
		}
		if ($condition['endTime']) {
			$query->andWhere(['<', 'create_time', strtotime($condition['endTime'])]);
		}
		$order = 'create_time desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$orderList = array();
		foreach ($result as $one) {
			$productId = $one['product_id'];
			$periodId = $one['period_id'];
			
			$productInfo = Product::info($productId);
			$category = ProductCategory::findOne($productId);
			$periodInfo = Period::findOne($periodId);
			
			$info['payment_order_id'] = $one['order_no'];
			$info['goods_name'] = $productInfo['name'];
			$info['goods_price'] = sprintf('%.2f', $productInfo['price']);
			$info['lucky_code'] = $periodInfo['lucky_code'];
			$info['product_id'] = $productId;
			$info['user_order_time'] = $one['create_time'];
			$info['category_name'] = $category['name'];
			$info['status'] = $one['status'];
			$info['status_name'] = Order::$status_name[$one['status']];
			$info['period_number'] = $periodInfo['period_number'];
			$info['delivery'] = ProductModel::$deliveries[$productInfo['delivery_id']];
			
			$orderList[] = $info;
		}
		
		$return['rows'] = $orderList;
		$return['total'] = $totalCount;
		return $return;
	}
	
	/**
	 * 晒单记录
	 * @param $condition
	 * @param $page
	 * @param $pageSize
	 * @return mixed
	 */
	public function getShareList($condition, $page, $pageSize)
	{
		$query = ShareTopic::find()->leftJoin('orders o', 'share_topics.period_id=o.period_id')->select('share_topics.*, o.order_no')->where(['share_topics.user_id' => $this->id]);
		if ($condition['startTime']) {
			$query->andWhere(['>', 'share_topics.created_at', strtotime($condition['startTime'])]);
		}
		if ($condition['endTime']) {
			$query->andWhere(['<', 'share_topics.created_at', strtotime($condition['endTime'])]);
		}
		
		$order = 'share_topics.created_at DESC';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$shareList = array();
		foreach ($result as $one) {
			$productId = $one['product_id'];
			$periodId = $one['period_id'];
			
			$productInfo = Product::info($productId);
			$category = ProductCategory::findOne($productId);
			$periodInfo = Period::findOne($periodId);
			
			$info['payment_order_id'] = $one['order_no'];
			$info['goods_name'] = $productInfo['name'];
			$info['goods_price'] = sprintf('%.2f', $productInfo['price']);
			$info['product_id'] = $productId;
			$info['user_share_time'] = $one['created_at'];
			$info['category_name'] = $category['name'];
			$info['status'] = $one['is_pass'];
			$info['period_number'] = $periodInfo['period_number'];
			$info['point'] = $one['point'];
			$info['is_recommend'] = $one['is_recommend'];
			$info['is_digest'] = $one['is_digest'];
			
			$shareList[] = $info;
		}
		
		$return['rows'] = $shareList;
		$return['total'] = $totalCount;
		return $return;
	}
	
	/**
	 * 充值明细
	 * @param $page
	 * @param $pageSize
	 * @return mixed
	 */
	public function getRechargeList($page, $pageSize)
	{
		$baseInfo = $this->getBaseInfo();
		$homeId = $baseInfo['home_id'];
		$query = RechargeOrderDistribution::findByTableId($homeId)->where(['user_id' => $this->id, 'status' => 1]);
		$order = 'pay_time desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$list = array();
		foreach ($result as $one) {
			$info['payment_order_id'] = $one['id'];
			$info['money'] = '+' . $one['money'];
			$info['content'] = '充值' . $one['money'] . '元，订单号为“' . $one['id'] . '”';
			$info['created_at'] = $one['pay_time'];
			$info['type'] = '充值';
			$list[] = $info;
		}
		
		$return['rows'] = $list;
		$return['total'] = $totalCount;
		return $return;
	}
	
	/**
	 * 转账明细
	 * @param int $page
	 * @param int $pageSize
	 * @return mixed
	 */
	public function getTransferList($page = 1, $pageSize = 10)
	{
		$query = UserTransferAccount::find()->where(['or', 'user_id=' . $this->id, 'to_userid=' . $this->id]);
		
		$order = 'created_at desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$list = array();
		foreach ($result as $one) {
			if ($one['user_id'] == $this->id) { //转出
				$type = '转出';
				$user = \app\models\User::findOne($one['to_userid']);
				$userAccount = $user['phone'] ? $user['phone'] : $user['email'];
			} else { //转入
				$type = '转入';
				$user = \app\models\User::findOne($one['user_id']);
				$userAccount = $user['phone'] ? $user['phone'] : $user['email'];
			}
			$info['payment_order_id'] = $one['id'];
			$info['money'] = $one['account'];
			$info['content'] = $type . $one['account'] . '元，订单号为“' . $one['id'] . '”,对方账号为' . $userAccount;
			$info['created_at'] = $one['created_at'];
			$info['type'] = $type;
			$list[] = $info;
		}
		
		$return['rows'] = $list;
		$return['total'] = $totalCount;
		return $return;
	}
	
	/**
	 * 佣金明细
	 * @param $condition
	 * @param $page
	 * @param $pageSize
	 * @return mixed
	 */
	public function getCommission($condition, $page, $pageSize)
	{
		$baseInfo = $this->getBaseInfo();
		$query = InviteCommission::find()->where(['user_id' => $this->id]);
		
		$totalQuery = clone $query;
		$totalCommission = $totalQuery->select('SUM(commission) as totalCommission')->andWhere(['type' => 1])->asArray()->one();
		
		if ($condition['startTime']) {
			$query->andWhere(['>', 'created_time', strtotime($condition['startTime'])]);
		}
		if ($condition['endTime']) {
			$query->andWhere(['<', 'created_time', strtotime($condition['endTime'])]);
		}
		if ($condition['type'] != 'all') {
			if ($condition['type'] == 0) {
				$query->andWhere(['<', 'commission', 0]);
			} else {
				$query->andWhere(['>', 'commission', 0]);
			}
		}
		
		$order = 'created_time desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$userids = ArrayHelper::getColumn($result, 'action_user_id');
		$userinfos = User::baseInfo($userids);
		
		$list = array();
		foreach ($result as $one) {
			$info['user_name'] = $userinfos[$one['action_user_id']]['username'];
			if ($one['type'] == 1) {
				$desc = unserialize($one['desc']);
				$periodInfo = \app\services\Period::info($desc['periodId']);
				if (empty($periodInfo)) {
					$periodInfo = CurrentPeriod::findOne($desc['periodId'])->toArray();
					$productInfo = \app\models\Product::findOne($periodInfo['product_id']);
					$periodInfo['goods_name'] = $productInfo['name'];
				}
				$info['desc'] = "(第{$periodInfo['period_number']}期){$periodInfo['goods_name']}";
			} elseif ($one['type'] == 2) {
				$info['desc'] = $one['desc'];
			} else {
				$desc = unserialize($one['desc']);
				$info['desc'] = "用户佣金提取到银行账户({$desc['bank']} {$desc['bank_number']})";
			}
			$info['money'] = $one['money'];
			$info['commission'] = sprintf('%.2f', $one['commission'] / 100);
			$info['created_at'] = $one['created_time'];
			
			$list[] = $info;
		}
		
		$return['rows'] = $list;
		$return['total'] = $totalCount;
		$return['totalCommission'] = sprintf('%.2f', $totalCommission['totalCommission'] / 100);
		$return['commission'] = sprintf('%.2f', $baseInfo['commission'] / 100);
		return $return;
	}
	
	/**
	 * 积分明细
	 * @param $condition
	 * @param $page
	 * @param $pageSize
	 * @return mixed
	 */
	public function getPointsList($condition, $page, $pageSize)
	{
		$baseInfo = $this->getBaseInfo();
		$homeId = $baseInfo['home_id'];
		
		$query = PointFollowDistribution::findByUserHomeId($homeId)->where(['user_id' => $this->id]);
		if ($condition['startTime']) {
			$query->andWhere(['>', 'created_at', strtotime($condition['startTime'])]);
		}
		if ($condition['endTime']) {
			$query->andWhere(['<', 'created_at', strtotime($condition['endTime'])]);
		}
		if ($condition['type'] != 'all') {
			if ($condition['type'] == 0) {
				$query->andWhere(['<', 'point', 0]);
			} else {
				$query->andWhere(['>', 'point', 0]);
			}
		}
		$order = 'created_at desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$return['rows'] = $result;
		$return['total'] = $totalCount;
		$return['point'] = $baseInfo['point'];
		return $return;
	}
	
	/**
	 * 邀请列表
	 * @param $condition
	 * @param $page
	 * @param $pageSize
	 * @return mixed
	 */
	public function getInviteList($condition, $page, $pageSize)
	{
		$query = Invite::find()->leftJoin('invite_commission i', 'invite.invite_uid=i.action_user_id')->where(['invite.user_id' => $this->id]);
		
		$totalQuery = clone $query;
		$totalCommission = $totalQuery->select('SUM(i.commission) as commission')->asArray()->one();
		
		$query->select('invite.*, SUM(i.money) as money, SUM(i.commission) as commission')->groupBy('invite.invite_uid');
		if ($condition['startTime']) {
			$query->andWhere(['>', 'invite.invite_time', strtotime($condition['startTime'])]);
		}
		if ($condition['endTime']) {
			$query->andWhere(['<', 'invite.invite_time', strtotime($condition['endTime'])]);
		}
		
		$order = 'invite.invite_time desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$uids = ArrayHelper::getColumn($result, 'invite_uid');
		$usersInfo = User::baseInfo($uids);
		
		foreach ($result as &$one) {
			$one['nickname'] = $usersInfo[$one['invite_uid']]['nickname'];
			$one['created_at'] = $usersInfo[$one['invite_uid']]['created_at'];
			$one['phone'] = $usersInfo[$one['invite_uid']]['phone'];
			$one['email'] = $usersInfo[$one['invite_uid']]['email'];
			$one['commission'] = isset($one['commission']) ? sprintf('%.2f', $one['commission'] / 100) : 0;
			$one['money'] = isset($one['money']) ? sprintf('%.2f', $one['money']) : 0;
			$one['commission_percent'] = '6%';
			$one['reg_terminal'] = Order::getSource($usersInfo[$one['invite_uid']]['reg_terminal'])['name'];
			$one['login_num'] = LoginLog::findByHomeId($usersInfo[$one['invite_uid']]['home_id'])->where(['user_id' => $one['invite_uid'], 'action' => 0])->count();
		}
		
		$return['rows'] = $result;
		$return['total'] = $totalCount;
		$return['totalCommission'] = isset($totalCommission['commission']) ? sprintf('%.2f', $totalCommission['commission'] / 100) : 0;
		return $return;
	}
	
	/**
	 * 好友列表
	 * @param $condition
	 * @param $page
	 * @param $pageSize
	 * @return mixed
	 */
	public function getFriendList($condition, $page, $pageSize)
	{
		$query = Friend::find()->where(['user_id' => $this->id]);
		if ($condition['startTime']) {
			$query->andWhere(['>', 'dateline', strtotime($condition['startTime'])]);
		}
		if ($condition['endTime']) {
			$query->andWhere(['<', 'dateline', strtotime($condition['endTime'])]);
		}
		$order = 'dateline desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$uids = ArrayHelper::getColumn($result, 'friend_userid');
		
		$usersInfo = User::baseInfo($uids);
		
		$list = array();
		foreach ($result as $one) {
			$info['user_name'] = $usersInfo[$one['friend_userid']]['username'];
			$info['level_name'] = $usersInfo[$one['friend_userid']]['level']['name'];
			$info['created_at'] = $one['dateline'];
			
			$list[] = $info;
		}
		
		$return['rows'] = $list;
		$return['total'] = $totalCount;
		return $return;
	}
	
	/**
	 * 收货地址
	 * @param int $page
	 * @param int $perpage
	 * @return mixed
	 */
	public function getAddress($page = 1, $perpage = 20)
	{
		$query = UserAddress::find()->where(['uid' => $this->id]);
		
		$order = 'update desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$return['rows'] = $result;
		$return['total'] = $totalCount;
		return $return;
	}
	
	/**
	 * 圈子
	 * @param int $page
	 * @param int $perpage
	 * @return mixed
	 */
	public function getGroupList($page = 1, $perpage = 10)
	{
		$query = GroupUser::find()->leftJoin('groups g', 'group_users.group_id=g.id')->select('*')->where(['group_users.user_id' => $this->id]);
		
		$order = 'group_users.created_at desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$return['rows'] = $result;
		$return['total'] = $totalCount;
		return $return;
	}
	
	
	/**
	 * 话题
	 * @param $condition
	 * @param int $page
	 * @param int $perpage
	 * @return mixed
	 */
	public function getTopicList($condition, $page = 1, $perpage = 10)
	{
		$query = GroupTopic::find()->leftJoin('groups g', 'group_topics.group_id=g.id')->select('group_topics.*, g.name')->where(['group_topics.user_id' => $this->id]);
		if ($condition['startTime']) {
			$query->andWhere(['>', 'group_topics.created_at', strtotime($condition['startTime'])]);
		}
		if ($condition['endTime']) {
			$query->andWhere(['<', 'group_topics.created_at', strtotime($condition['endTime'])]);
		}
		$order = 'group_topics.created_at desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$return['rows'] = $result;
		$return['total'] = $totalCount;
		return $return;
	}
	
	/**
	 * 话题评论
	 * @param $condition
	 * @param int $page
	 * @param int $perpage
	 * @return mixed
	 */
	public function getTopicCommentList($condition, $page = 1, $perpage = 10)
	{
		$query = GroupTopicComment::find()->leftJoin('group_topics g', 'group_topic_comments.topic_id=g.id')
			->leftJoin('groups s', 'g.group_id=s.id')
			->select('group_topic_comments.*, g.subject, s.name')->where(['group_topic_comments.user_id' => $this->id]);
		if ($condition['startTime']) {
			$query->andWhere(['>', 'group_topic_comments.created_at', strtotime($condition['startTime'])]);
		}
		if ($condition['endTime']) {
			$query->andWhere(['<', 'group_topic_comments.created_at', strtotime($condition['endTime'])]);
		}
		
		$order = 'group_topic_comments.created_at desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$return['rows'] = $result;
		$return['total'] = $totalCount;
		return $return;
	}
	
	/**
	 * 系统消息
	 * @param $condition
	 * @param int $page
	 * @param int $perpage
	 * @return mixed
	 */
	public function getMessageList($condition, $page = 1, $perpage = 10)
	{
		$query = UserSystemMessage::find()->where(['to_userid' => $this->id]);
		if ($condition['startTime']) {
			$query->andWhere(['>', 'created_at', strtotime($condition['startTime'])]);
		}
		if ($condition['endTime']) {
			$query->andWhere(['<', 'created_at', strtotime($condition['endTime'])]);
		}
		$order = 'created_at desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$return['rows'] = $result;
		$return['total'] = $totalCount;
		return $return;
	}
	
	/**
	 * 私信
	 * @param $condition
	 * @param int $page
	 * @param int $perpage
	 * @return mixed
	 */
	public function getPrivateMessageList($condition, $page = 1, $perpage = 10)
	{
		$query = UserPrivateMessage::find()->where(['or', 'user_id=' . $this->id, 'reply_userid=' . $this->id]);
		if ($condition['startTime']) {
			$query->andWhere(['>', 'created_at', strtotime($condition['startTime'])]);
		}
		if ($condition['endTime']) {
			$query->andWhere(['<', 'created_at', strtotime($condition['endTime'])]);
		}
		$order = 'created_at desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$userids = ArrayHelper::getColumn($result, 'user_id');
		$userids = array_merge($userids, ArrayHelper::getColumn($result, 'reply_userid'));
		$userids = array_unique($userids);
		
		$userInfos = User::baseInfo($userids);
		
		foreach ($result as &$one) {
			if ($one['user_id'] == $this->id) { //发送
				$one['type'] = '发送';
				$one['username'] = $userInfos[$one['reply_userid']]['username'];
			} else {
				$one['type'] = '接受';
				$one['username'] = $userInfos[$one['user_id']]['username'];
			}
		}
		
		$return['rows'] = $result;
		$return['total'] = $totalCount;
		return $return;
	}
	
	/**
	 * 好友请求
	 * @param $condition
	 * @param int $page
	 * @param int $perpage
	 * @return mixed
	 */
	public function getFriendApplyList($condition, $page = 1, $perpage = 10)
	{
		$query = FriendApply::find()->where(['apply_userid' => $this->id]);
		if ($condition['startTime']) {
			$query->andWhere(['>', 'apply_time', strtotime($condition['startTime'])]);
		}
		if ($condition['endTime']) {
			$query->andWhere(['<', 'apply_time', strtotime($condition['endTime'])]);
		}
		$order = 'apply_time desc';
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $perpage]);
		$result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$userids = ArrayHelper::getColumn($result, 'user_id');
		
		$userInfos = User::baseInfo($userids);
		
		foreach ($result as &$one) {
			$one['username'] = $userInfos[$one['user_id']]['username'];
		}
		
		$return['rows'] = $result;
		$return['total'] = $totalCount;
		return $return;
	}
	
	
	/**
	 * 获取用户信息
	 */
	public static function getUser($uid)
	{
		$user_info = Member_m::getOneself($uid, 1);
		return json_encode($user_info[0]);
	}
	
	/**
	 * 消费纪录
	 * @param $page
	 * @param $pageSize
	 * @return mixed
	 */
	public function getPayRecord($page, $pageSize)
	{
		$baseInfo = $this->getBaseInfo();
		$tableId = PaymentOrderDistribution::getTableIdByUserHomeId($baseInfo['home_id']);
		$query = PaymentOrderDistribution::findByTableId($tableId)->where(['user_id' => $this->id]);
		$query->andWhere(['=', 'status', PaymentOrderDistribution::STATUS_PAID]);
		$query->andWhere(['<>', 'money', 0]);
		
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		$pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
		$query->orderBy('create_time desc');
		$result = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
		
		$list = array();
		foreach ($result as $one) {
			$info['money'] = '-' . $one['money'];
			$info['content'] = '消费' . $one['money'] . '元，订单号为“' . $one['id'] . '”';
			$info['created_at'] = $one['create_time'];
			$info['type'] = '消费';
			$list[] = $info;
		}
		
		$return['rows'] = $list;
		$return['total'] = $totalCount;
		return $return;
	}
	
	
}

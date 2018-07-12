<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/9/21
 * Time: 上午11:01
 */

namespace app\controllers;

use app\models\Area;
use app\models\User;
use app\models\UserLimit;
use app\models\UserNotice;
use app\models\UserSystemMessage;
use app\models\UserTransferAccount;
use app\services\AdminMember;
use app\services\User as serviceUser;
use Yii;
use app\helpers\Ex;
use yii\helpers\Json;

class MemberController extends BaseController
{
	public function actionIndex()
	{
		$request = Yii::$app->request;

		if ($request->isAjax || $request->get('excel') == 'member') {
			$get = $request->get();
			$condition = [];
			$condition['startTime'] = $request->get('startTime', '');
			$condition['endTime'] = $request->get('endTime', '');
			$condition['status'] = $request->get('status', 'all');
			$condition['account'] = $request->get('account', '');
			$condition['level'] = $request->get('level', 'all');
			$condition['from'] = $request->get('from', 'all');
			$condition['superior'] = $request->get('superior', '');
			$page = $request->get('page', 1);
			if (isset($get['excel']) && $get['excel'] == 'member') {
				
				ini_set('memory_limit', '1000M');
				$perpage = 5000;
				$list = User::getList($condition, 1, 1);//获取总条数
				$maxPage = ceil($list['total'] / $perpage);//获取最大页数
				$newData = [];
				$condition['excel'] = 1;
				for ($i = 0; $i < $maxPage; $i++) {
					$result = User::getList($condition, $i, $perpage);
					foreach ($result['rows'] as $k => &$v) {
						$newData[] = $v;
					}
				}
				$data[0] = ['id' => '编号', 'username' => '会员名', 'nickname' => '昵称', 'money' => '账户余额', 'point' => '福分余额',
					'commission' => '佣金余额', 'superior' => '上级', 'invite_num' => '邀请人数', 'level' => '等级', 'total_payment' => '消费总额', 'totalRecharge' => '充值总额', 'firstRecharge' => '首冲金额', 'total_order' => '中奖次数', 'status' => '状态', 'reg_terminal' => '终端', 'reg_ip' => '注册区域', 'created_at' => '注册时间', 'updated_at' => '最近登录时间'];
				
				foreach ($newData as $key => $val) {
					$key = $key + 1;
					$data[$key]['id'] = $val['id'];
					$data[$key]['username'] = isset($val['phone']) ? $val['phone'] : $val['email'];
					$data[$key]['nickname'] = $val['nickname'];
					$data[$key]['money'] = $val['money'];
					$data[$key]['point'] = $val['point'];
					$data[$key]['commission'] = $val['commission'];
					$data[$key]['superior'] = $val['superior'];
					$data[$key]['invite_num'] = $val['invite_num'];
					$data[$key]['level'] = $val['level'];
					$data[$key]['total_payment'] = $val['total_payment'];
					$data[$key]['totalRecharge'] = $val['totalRecharge'];
					$data[$key]['firstRecharge'] = $val['firstRecharge'];
					$data[$key]['total_order'] = $val['total_order'];
					$data[$key]['status'] = $val['status'];
					$data[$key]['reg_terminal'] = $val['reg_terminal'];
					$data[$key]['reg_ip'] = $val['reg_ip'];
					$data[$key]['created_at'] = $val['created_at'];
					$data[$key]['updated_at'] = $val['updated_at'];
					
				}
				$excel = new Ex();
				$excel->download($data, '会员数据' . date('Y-m-d H:i:s') . '.xls');
				unset($data);
				
			}
			$pageSize = $request->get('rows', 10);
			$data = User::getList($condition, $page, $pageSize);
			return $data;
		}
		
		$params['status'] = $this->checkPrivilege($this->getUniqueId() . '/change-status');
		$params['send'] = $this->checkPrivilege($this->getUniqueId() . '/send-message');
		$params['view'] = $this->checkPrivilege($this->getUniqueId() . '/view');
		return $this->render('index', $params);
	}
	
	public function actionEdit()
	{
		$request = Yii::$app->request;
		
		if ($request->isPost) {
			$userId = $request->get('id');
			$model = User::findOne($userId);
			if (!$model) {
				return Json::encode(['error' => 1, 'message' => '该用户不存在']);
			}
			
			$post = $request->post();
			if (empty($post['User']['nickname'])) unset($post['User']['nickname']);
			if (empty($post['User']['phone'])) unset($post['User']['phone']);
			if (empty($post['User']['email'])) unset($post['User']['email']);
			if (empty($post['User']['password'])) unset($post['User']['password']);
			$oldPassword = $model->password;
			if (($model->load($post) && $model->validate())) {
				if ($oldPassword == $model->password) {
					$model->password = $oldPassword;
				} else {
					$model->password = Yii::$app->security->generatePasswordHash($model->password);
				}
				
				if ($model->save()) {
					return Json::encode(['error' => 0, 'message' => '编辑用户成功']);
				}
				return Json::encode(['error' => 1, 'message' => '编辑用户失败']);
			} else {
				foreach ($model->errors as $message) {
					return Json::encode(['error' => 1, 'message' => $message]);
				}
			}
		}
	}
	
	public function actionChangeStatus()
	{
		$request = Yii::$app->request;
		
		if ($request->isAjax) {
			$id = $request->post('id');
			$status = $request->post('status');
			$ids = explode(',', $id);
			if (User::updateAll(['status' => $status], ['id' => $ids])) {
				$message = $status == 0 ? '解冻成功' : '冻结成功';
				return ['error' => 0, 'message' => $message];
			}
			$message = $status == 0 ? '解冻失败' : '冻结失败';
			return ['error' => 1, 'message' => $message];
		}
	}
	
	/**
	 * 发送站内信
	 */
	public function actionSendMessage()
	{
		$request = Yii::$app->request;
		if ($request->isPost) {
			$userid = $request->post('id');
			$content = $request->post('content');
			
			$model = new UserSystemMessage();
			$model->to_userid = $userid;
			$model->message = $content;
			$model->created_at = time();
			if ($model->save()) {
				return Json::encode(['error' => 0, 'message' => '发送成功']);
			} else {
				foreach ($model->errors as $message) {
					return Json::encode(['error' => 1, 'message' => $message]);
				}
			}
		}
	}
	
	/**
	 * @pass
	 * 查看用户
	 * @return string
	 */
	public function actionView()
	{
		$request = Yii::$app->request;
		$params = [];
		$id = $request->get('id');
		if ($id) {
			$userInfo = serviceUser::allInfo($id);
			if ($userInfo['live_city']) {
				$split = explode(',', $userInfo['live_city']);
				$one = Area::findOne([$split[0]]);
				$two = Area::findOne([$split[1]]);
				$userInfo['live_city'] = $one['name'] . $two['name'];
			}
			$userInfo['reg_ip'] = long2ip($userInfo['reg_ip']);
			$inTotal = UserTransferAccount::find()->select('SUM(account) AS account')->where(['to_userid' => $id])->asArray()->one();
			$outTotal = UserTransferAccount::find()->select('SUM(account) AS account')->where(['user_id' => $id])->asArray()->one();
			$userInfo['inTotal'] = $inTotal['account'];
			$userInfo['outTotal'] = $outTotal['account'];
			$invite = serviceUser::getInviteUser($id);
			$userInfo['invite'] = $invite['user_name'];
			$userInfo['totalPayment'] = serviceUser::getTotalPayment($id);
			$userInfo['totalRecharge'] = serviceUser::getTotalRecharge($id);
			$userInfo['firstRecharge'] = serviceUser::getFirstRecharge($id);
			$limit = UserLimit::findOne(['user_id' => $id]);
			$notice = UserNotice::findOne($id);
			$userInfo['last_login_ip'] = long2ip($userInfo['last_login_ip']);
			$params['userInfo'] = $userInfo;
			$params['limit'] = $limit;
			$params['notice'] = $notice;
		}
		return $this->render('view', $params);
	}
	
	/**
	 * @pass
	 * 伙购记录
	 * @return mixed|string
	 */
	public function actionBuy()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		
		if ($request->isAjax) {
			$condition = [];
			$condition['startTime'] = $request->get('startTime', '');
			$condition['endTime'] = $request->get('endTime', '');
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$adminMember = new AdminMember(['id' => $id]);
			$data = $adminMember->getBuyList($condition, $page, $pageSize);
			return $data;
		}
		
		return $this->render('buy', ['id' => $id]);
	}
	
	/**
	 * @pass
	 * 中奖记录
	 * @return mixed|string
	 */
	public function actionWinning()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		
		if ($request->isAjax) {
			$condition = [];
			$condition['startTime'] = $request->get('startTime', '');
			$condition['endTime'] = $request->get('endTime', '');
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$adminMember = new AdminMember(['id' => $id]);
			$data = $adminMember->getOrderList($condition, $page, $pageSize);
			return $data;
		}
		
		return $this->render('winning', ['id' => $id]);
	}
	
	/**
	 * @pass
	 * 晒单记录
	 * @return mixed|string
	 */
	public function actionShare()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		
		if ($request->isAjax) {
			$condition = [];
			$condition['startTime'] = $request->get('startTime', '');
			$condition['endTime'] = $request->get('endTime', '');
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$adminMember = new AdminMember(['id' => $id]);
			$data = $adminMember->getShareList($condition, $page, $pageSize);
			return $data;
		}
		
		return $this->render('share', ['id' => $id]);
	}
	
	/**
	 * @pass
	 * 账户明细
	 * @return mixed|string
	 */
	public function actionMoney()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		
		if ($request->isAjax) {
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$type = $request->get('type', 1);
			
			$adminMember = new AdminMember(['id' => $id]);
			if ($type == 1) {
				$data = $adminMember->getRechargeList($page, $pageSize);
			} elseif ($type == 2) {
				$data = $adminMember->getPayRecord($page, $pageSize);
			} elseif ($type == 3) {
				$data = $adminMember->getTransferList($page, $pageSize);
			}
			
			return $data;
		}
		
		$user = User::findOne($id);
		
		return $this->render('money', ['user' => $user]);
	}
	
	/**
	 * @pass
	 * 佣金明细
	 * @return mixed|string
	 */
	public function actionCommission()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		
		if ($request->isAjax) {
			$condition = [];
			$condition['startTime'] = $request->get('startTime', '');
			$condition['endTime'] = $request->get('endTime', '');
			$condition['type'] = $request->get('type', 'all');
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$adminMember = new AdminMember(['id' => $id]);
			$data = $adminMember->getCommission($condition, $page, $pageSize);
			
			return $data;
		}
		
		return $this->render('commission', ['id' => $id]);
	}
	
	/**
	 * @pass
	 * 积分明细
	 * @return mixed|string
	 */
	public function actionPoint()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		
		if ($request->isAjax) {
			$condition = [];
			$condition['startTime'] = $request->get('startTime', '');
			$condition['endTime'] = $request->get('endTime', '');
			$condition['type'] = $request->get('type', 'all');
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$adminMember = new AdminMember(['id' => $id]);
			$data = $adminMember->getPointsList($condition, $page, $pageSize);
			
			return $data;
		}
		
		return $this->render('point', ['id' => $id]);
	}
	
	/**
	 * @pass
	 * 邀请列表
	 * @return mixed|string
	 */
	public function actionInvite()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		
		if ($request->isAjax) {
			$condition = [];
			$condition['startTime'] = $request->get('startTime', '');
			$condition['endTime'] = $request->get('endTime', '');
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$adminMember = new AdminMember(['id' => $id]);
			$data = $adminMember->getInviteList($condition, $page, $pageSize);
			
			return $data;
		}
		
		return $this->render('invite', ['id' => $id]);
	}
	
	/**
	 * @pass
	 * 好友列表
	 * @return mixed|string
	 */
	public function actionFriend()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		
		if ($request->isAjax) {
			$condition = [];
			$condition['startTime'] = $request->get('startTime', '');
			$condition['endTime'] = $request->get('endTime', '');
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$adminMember = new AdminMember(['id' => $id]);
			$data = $adminMember->getFriendList($condition, $page, $pageSize);
			return $data;
		}
		
		return $this->render('friend', ['id' => $id]);
	}
	
	/**
	 * @pass
	 * 收货地址
	 * @return mixed|string
	 */
	public function actionAddress()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		
		if ($request->isAjax) {
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$adminMember = new AdminMember(['id' => $id]);
			$data = $adminMember->getAddress($page, $pageSize);
			foreach ($data['rows'] as &$one) {
				$areas = Area::find()->where(['id' => [$one['prov'], $one['city'], $one['area']]])->indexBy('id')->asArray()->all();
				$one['prov'] = $areas[$one['prov']]['name'];
				$one['city'] = $areas[$one['city']]['name'];
				$one['area'] = $areas[$one['area']]['name'];
			}
			return $data;
		}
		return $this->render('address', ['id' => $id]);
	}
	
	/**
	 * @pass
	 * 圈子
	 * @return mixed|string
	 */
	public function actionGroup()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		
		if ($request->isAjax) {
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$adminMember = new AdminMember(['id' => $id]);
			$data = $adminMember->getGroupList($page, $pageSize);
			return $data;
		}
		
		return $this->render('group', ['id' => $id]);
	}
	
	/**
	 * @pass
	 * 话题
	 * @return mixed|string
	 */
	public function actionTopic()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		
		if ($request->isAjax) {
			$condition = [];
			$condition['startTime'] = $request->get('startTime', '');
			$condition['endTime'] = $request->get('endTime', '');
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$type = $request->get('type', 1);
			$adminMember = new AdminMember(['id' => $id]);
			if ($type == 1) {
				$data = $adminMember->getTopicList($condition, $page, $pageSize);
			} else {
				$data = $adminMember->getTopicCommentList($condition, $page, $pageSize);
			}
			return $data;
		}
		
		return $this->render('topic', ['id' => $id]);
	}
	
	/**
	 * @pass
	 * 消息
	 * @return mixed|string
	 */
	public function actionMessage()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		$type = $request->get('type', 1);
		
		if ($request->isAjax) {
			$condition = [];
			$condition['startTime'] = $request->get('startTime', '');
			$condition['endTime'] = $request->get('endTime', '');
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 10);
			$adminMember = new AdminMember(['id' => $id]);
			if ($type == 1) {
				$data = $adminMember->getMessageList($condition, $page, $pageSize);
			} elseif ($type == 2) {
				$data = $adminMember->getPrivateMessageList($condition, $page, $pageSize);
			} else {
				$data = $adminMember->getFriendApplyList($condition, $page, $pageSize);
			}
			return $data;
		}
		
		return $this->render('message', ['id' => $id, 'type' => $type]);
	}
	
	
	//获取用户信息
	public function actionUser()
	{
		$request = Yii::$app->request;
		$id = $request->post('user_id');
		return json_encode(User::baseInfo($id));
	}
	
	//更新用户信息
	public function actionUpdate()
	{
		$request = Yii::$app->request;
		$id = $request->post('user_id');
		echo UserRelate::getUser($id);
	}
	
	//站内信
	public function actionSysmsg()
	{
		$request = Yii::$app->request;
		$startTime = $request->get('start_time', '');
		$endTime = $request->get('end_time', '');
		$account = $request->get('account', '');
		$user = ModelUser::find()->where(['or', 'email="' . $account . '"', 'phone="' . $account . '"'])->one();
		$condition = ['account' => $account, 'start_time' => $startTime, 'end_time' => $endTime];
		$where = ['to_userid' => $user['id'], 'starttime' => strtotime($startTime), 'endtime' => strtotime($endTime . " 23:59:59")];
		
		$list = UserSystemMessage::systemMsg($where);
		foreach ($list['list'] as $key => $user) {
			$list['list'][$key]['to_userid'] = ModelUser::findOne($user['to_userid']);
		}
		
		return $this->render('sysmessage', [
			'list' => $list,
			'condition' => $condition,
		]);
	}
	
}
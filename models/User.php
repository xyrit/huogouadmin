<?php

namespace app\models;

use app\helpers\Ip;
use app\models\Keyword;
use app\validators\MobileValidator;
use Yii;
use yii\helpers\ArrayHelper;
use app\helpers\Rename;
use yii\validators\EmailValidator;
use yii\web\IdentityInterface;
use yii\data\Pagination;
use app\services\User as serviceUser;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property integer $home_id
 * @property string $password
 * @property string $email
 * @property string $phone
 * @property string $nickname
 * @property string $avatar
 * @property integer $money
 * @property integer $commission
 * @property integer $point
 * @property integer $experience
 * @property string $pay_password
 * @property string $password_reset_token
 * @property string $token
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $micro_pay
 * @property integer $last_login_ip
 * @property integer $protected_status
 * @property integer $reg_terminal
 * @property integer $reg_ip
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
	private static $level = [
		1 => [
			'name' => '伙购新兵',
			'experience' => '10000'
		],
		2 => [
			'name' => '伙购少将',
			'experience' => '50000'
		],
		3 => [
			'name' => '伙购中将',
			'experience' => '200000'
		],
		4 => [
			'name' => '伙购上将',
			'experience' => '500000'
		],
		5 => [
			'name' => '伙购大将',
			'experience' => '1000000'
		],
		6 => [
			'name' => '伙购元帅',
			'experience' => '1000000'
		],
	];
	
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'users';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['home_id', 'password', 'created_at', 'updated_at'], 'required'],
			[['home_id', 'money', 'commission', 'point', 'experience', 'status', 'created_at', 'updated_at'], 'integer'],
			[['password', 'email', 'avatar', 'pay_password', 'password_reset_token', 'token'], 'string', 'max' => 255],
			[['phone'], 'string', 'max' => 11],
			[['nickname'], 'string', 'max' => 60],
			[['home_id'], 'unique'],
			[['email'], 'unique'],
			[['phone'], 'unique'],
			[['token'], 'unique'],
			[['nickname'], 'unique']
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'home_id' => 'Home ID',
			'password' => 'Password',
			'email' => 'Email',
			'phone' => 'Phone',
			'nickname' => 'Nickname',
			'avatar' => 'Avatar',
			'money' => 'Money',
			'commission' => 'Commission',
			'point' => 'Point',
			'experience' => 'Experience',
			'pay_password' => 'Pay Password',
			'password_reset_token' => 'Password Reset Token',
			'token' => 'Token',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}
	
	public static function findIdentity($id)
	{
		return static::findOne($id);
	}
	
	public static $accessTokenEncryptKey = 'huogou_access_token_encrypt_key_';
	
	public static function findIdentityByAccessToken($accessToken, $type = null)
	{
		if (!static::isAccessTokenValid($type, $accessToken)) {
			return null;
		}
		$accessToken = base64_decode($accessToken);
		$accessToken = Yii::$app->security->decryptByKey($accessToken, static::$accessTokenEncryptKey);
		$parts = explode('_', $accessToken);
		return static::findOne(['token' => $parts[0]]);
	}
	
	public static function isAccessTokenValid($type, $accessToken)
	{
		if (empty($accessToken)) {
			return false;
		}
		$accessToken = base64_decode($accessToken);
		if (!$accessToken) {
			return false;
		}
		$accessToken = Yii::$app->security->decryptByKey($accessToken, static::$accessTokenEncryptKey);
		if (!$accessToken) {
			return false;
		}
		if ($type) {
			$expire = 15552000;
		} else {
			$expire = Yii::$app->user->tokenExpire;
		}
		$parts = explode('_', $accessToken);
		$timestamp = (int)end($parts);
		return $timestamp + $expire >= time();
	}
	
	public function getAccessToken()
	{
		$accessToken = $this->token . '_' . time();
		$accessToken = Yii::$app->security->encryptByKey($accessToken, static::$accessTokenEncryptKey);
		return base64_encode($accessToken);
	}
	
	public function generateToken()
	{
		$this->token = static::createToken();
	}
	
	public static function createToken()
	{
		$token = microtime(true);
		$token = 'huogou_token_pre_key_' . (string)$token . mt_rand(10000000, 99999999);
		return md5($token);
	}
	
	public static function findByAccount($account)
	{
		$validator = new MobileValidator();
		$valid = $validator->validate($account);
		if ($valid && $user = static::findByPhone($account)) {
			return $user;
		}
		$validator = new EmailValidator();
		$valid = $validator->validate($account);
		if ($valid && $user = static::findByEmail($account)) {
			return $user;
		}
		return false;
	}
	
	/**
	 * Finds user by phone
	 *
	 * @param string $phone
	 * @return \app\models\User |null
	 */
	public static function findByPhone($phone)
	{
		return static::findOne(['phone' => $phone]);
	}
	
	/**
	 * Finds user by email
	 *
	 * @param string $email
	 * @return \app\models\User |null
	 */
	public static function findByEmail($email)
	{
		return static::findOne(['email' => $email]);
	}
	
	/**
	 * Finds user by password reset token
	 *
	 * @param string $token password reset token
	 * @return \app\models\User|null
	 */
	public static function findByPasswordResetToken($token)
	{
		if (!static::isPasswordResetTokenValid($token)) {
			return null;
		}
		return static::findOne([
			'password_reset_token' => $token,
		]);
	}
	
	/**
	 * Generates home ID
	 */
	public static function generateHomeId($userId)
	{
		$tableId = mt_rand(100, 109);
		return (string)$tableId . (string)$userId;
	}
	
	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return boolean if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return Yii::$app->security->validatePassword($password, $this->password);
	}
	
	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password
	 */
	public function setPassword($password)
	{
		$this->password = Yii::$app->security->generatePasswordHash($password);
	}
	
	/**
	 * Finds out if password reset token is valid
	 *
	 * @param string $token password reset token
	 * @return boolean
	 */
	public static function isPasswordResetTokenValid($token)
	{
		if (empty($token)) {
			return false;
		}
		$expire = Yii::$app->params['user.passwordResetTokenExpire'];
		$parts = explode('_', $token);
		$timestamp = (int)end($parts);
		return $timestamp + $expire >= time();
	}
	
	/**
	 * Generates new password reset token
	 */
	public function generatePasswordResetToken()
	{
		$this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
	}
	
	/**
	 * Removes password reset token
	 */
	public function removePasswordResetToken()
	{
		$this->password_reset_token = null;
	}
	
	/**
	 * Returns an ID that can uniquely identify a user identity.
	 * @return string|integer an ID that uniquely identifies a user identity.
	 */
	public function getId()
	{
		return $this->id;
	}
	
	
	public function getAuthKey()
	{
		return md5('user_auth_key_' . $this->id);
	}
	
	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}
	
	public static function getList($condition, $page, $pageSize)
	{
		$query = User::find()->leftJoin('invite', 'users.id = invite.invite_uid')->select(['users.*', 'invite.user_id as superior']);

		if ($condition['startTime'] && $condition['endTime']) {
			$query->andWhere(['between', 'users.created_at', strtotime($condition['startTime']), strtotime($condition['endTime'])]);
		}
		if ($condition['status'] != 'all') {
			$query->andWhere(['users.status' => $condition['status']]);
		}
		if ($condition['account']) {
			$query->andWhere(['or', 'users.phone="' . $condition['account'] . '"', 'users.email="' . $condition['account']
				. '"', 'users.nickname="' . $condition['account'] . '"']);
		}
		if ($condition['level'] != 'all') {
			if ($condition['level'] == 1) {
				$query->andWhere(['<', 'users.experience', self::$level[$condition['level']]['experience']]);
			} elseif ($condition['level'] > 1 && $condition['level'] < 6) {
				$query->andWhere(['between', 'users.experience', self::$level[$condition['level'] - 1]['experience'], self::$level[$condition['level']]['experience']]);
			} elseif ($condition['level'] == 6) {
				$query->andWhere(['>', 'users.experience', self::$level[$condition['level']]['experience']]);
			}
		}
		
		if ($condition['from'] != 'all') {
			$query->andWhere(['and', 'users.from="' . $condition['from'] . '"']);
		}
		if ($condition['superior']) {
			$user = User::find()->where(['or', 'phone="' . $condition['superior'] . '"', 'email="' . $condition['superior'] . '"'])->asArray()->all();
			$ids = ArrayHelper::getColumn($user, 'id');
			$query->andWhere(['invite.superior' => $ids]);
		}
		
		$countQuery = clone $query;
		$pagination = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'defaultPageSize' => $pageSize]);

		if (isset($condition['excel']) && ($condition['excel'] == 1)) {
			$pageNum = $page * $pageSize;
			$list = $query->offset($pageNum)
				->orderBy('created_at desc')
				->limit($pageSize)
				->asArray()
				->all();
		} else {
			$list = $query->offset($pagination->offset)
				->orderBy('created_at desc')
				->limit($pagination->limit)
				->asArray()
				->all();
		}
		//echo $query->createCommand()->getRawSql();exit;
		foreach ($list as &$item) {
			//等级
			$item['level'] = self::$level[self::judgeLevel($item['experience'])]['name'];
			$item['level'] = Rename::duobao($item['from'], $item['level']);
			//邀请人数
			$item['invite_num'] = self::getInviteNumber($item['id']);
			//消费总额
			$item['total_payment'] = self::getTotalPayment($item['id'], $item['home_id']);
			//中奖次数
			$item['total_order'] = self::getTotalOrder($item['id']);
			//终端
			$item['reg_terminal'] = Order::getSource($item['reg_terminal'])['name'];
			//注册区域
			$item['reg_ip'] = Ip::getAddressByIp(long2ip($item['reg_ip']));
			
			//上级
			$item['superior'] = $item['superior'] ?: $item['spread_source'];
			//截至目前累计消费
			//$item['totalPayment'] = serviceUser::getTotalPayment($item['id']);
			//截至目前累计充值
			$item['totalRecharge'] = serviceUser::getTotalRecharge($item['id']) ?: serviceUser::getTotalRecharge($item['id']);
			//首次充值
			$item['firstRecharge'] = serviceUser::getFirstRecharge($item['id']);
		}
		
		return ['rows' => $list, 'total' => $pagination->totalCount];
	}
	
	private static function judgeLevel($experience)
	{
		foreach (self::$level as $key => $val) {
			if ($experience < $val['experience']) {
				return $key;
			}
		}
		return $key;
	}
	
	private static function getTotalPayment($userId, $homeId)
	{
		$tableId = PaymentOrderDistribution::getTableIdByUserHomeId($homeId);
		$query = PaymentOrderDistribution::findByTableId($tableId)->where(['user_id' => $userId]);
		$query->andWhere(['=', 'status', PaymentOrderDistribution::STATUS_PAID]);
		
		// 消费总额
		$totalMoney = $query->select('SUM(money) as totalMoney')->asArray()->one();
		return $totalMoney['totalMoney'] ? $totalMoney['totalMoney'] : 0;
	}
	
	private static function getTotalOrder($userId)
	{
		return Order::find()->where(['user_id' => $userId])->count();
	}
	
	private static function getInviteNumber($userId)
	{
		return Invite::find()->where(['user_id' => $userId])->count();
	}
	
	public static function userName($id)
	{
		$user = User::find()->where(['id' => $id])->asArray()->one();
		if ($user) {
			if ($user['nickname']) {
				$user['username'] = $user['nickname'];
			} elseif ($user['phone']) {
				$user['username'] = $user['phone'];
			} elseif ($user['email']) {
				$user['username'] = $user['email'];
			}
		}
		return $user;
	}
	
	//用户相关统计信息
	public static function userCount($home_id, $user_id)
	{
		$table_id = substr($home_id, 2, 1);
		$conn = \Yii::$app->db;
		$command = $conn->createCommand('SELECT buy_num FROM user_buylist_10' . $table_id . ' WHERE user_id=' . $user_id);
		$findAll = $command->queryAll();
		$num = 0;
		foreach ($findAll as $val) {
			$num += $val['buy_num'];
		}
		
		$command = $conn->createCommand('SELECT count(*) as orderNum FROM orders WHERE user_id=' . $user_id);
		$order = $command->queryOne();
		
		$user['order'] = $order['orderNum'];
		$user['comsume'] = $num;
		$user['invite'] = Invite::find()->where(['user_id' => $user_id])->count();
		return $user;
	}
	
	//是否是邀请用户
	public static function isInvite($id)
	{
		$result = Invite::findOne(['invite_uid' => $id]);
		return $result['user_id'];
	}
	
	/**
	 * 用户购买记录
	 */
	public static function userBuyList($id, $where = [], $perpage = 10)
	{
		
	}
	
	public static function checkNickName($nickname, $userId)
	{
		$user = User::find()->where(['nickname' => $nickname])->andWhere(['<>', 'id', $userId])->one();
		
		if ($user) {
			return ['code' => 101, 'msg' => '该昵称已存在'];
		}
		
		$keywords = Keyword::findAll(['type' => 2]);
		$keywords = ArrayHelper::getColumn($keywords, 'content');
		
		foreach ($keywords as $keyword) {
			if (strstr($nickname, $keyword) !== false) {
				return ['code' => 101, 'msg' => '昵称请不要设置为与官方有关的词汇'];
			}
		}
		
		return ['code' => 100, 'msg' => '该昵称不存在'];
	}
	
}

<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/12/17
 * Time: 上午9:40
 */
namespace app\queue;

use app\models\MpUser;
use app\models\NoticeMessage;
use app\models\NoticeTemplate;
use app\models\User;
use app\models\UserNotice;
use app\models\UserSystemMessage;
use app\validators\MobileValidator;
use yii\validators\EmailValidator;

class SendMessageQueue extends BaseQueue
{

	/** 内置字符替换 与 变量名 对应 关系
	 * @var array
	 */
	public static $replace = [
		'{验证码}' => '{$code}',
		'{会员昵称}' => '{$nickname}',
		'{对方会员昵称}' => '{$oppositeNickname}',
		'{商品名称}' => '{$goodsName}',
		'{快递公司}' => '{$expressCompany}',
		'{快递单号}' => '{$expressNo}',
		'{话题标题}' => '{$topicTitle}',
		'{经验数额}' => '{$experience}',
		'{等级变量}' => '{$level}',
		'{消费排名}' => '{$consumeRank}',
		'{订单号}' => '{$orderNo}',
		'{时间}' => '{$time}',
		'{金额}' => '{$money}',
		'{邮箱}' => '{$email}',
		'{收货地址}' => '{$address}',
		'{商品ID}' => '{$goodsId}',
		'{验证邮箱}' => '{$checkEmail}',
		'{账号}' => '{$account}',
		'{IP}' => '{$ip}',
		'{客户端}' => '{$client}',
		'{手机号}' => '{$phone}',
		'{期数}' => '{$periodNumber}',
		'{晒单驳回原因}' => '{$shareReason}',
		'{活动名称}' => '{$activeName}',
		'{类型}' => 'type',
		'{卡号}' => '{$card}',
		'{密码}' => '{$pwd}'
	];

	public function run()
	{
		$args = $this->args;
		$type = $args['type'];
		$to = $args['to'];
		$data = $args['data'];
		$this->send($type, $to, $data);
	}


	public function send($type, $to, $data)
	{
		$noticeInfo = $this->noticeInfo($type);
		if (!$noticeInfo) {
			return false;
		}

		$status = $noticeInfo['status'];
		if ($status == 0) {
			return false;
		}
		$ways = $noticeInfo['ways'];

		$mobileValidator = new MobileValidator();
		$valid = $mobileValidator->validate($to);
		if ($valid && in_array(NoticeTemplate::WAY_SMS, $ways)) {
			$this->sendSms($to, $noticeInfo, $data);
			return true;
		}
		$emailValidator = new EmailValidator();
		$valid = $emailValidator->validate($to);
		if ($valid && in_array(NoticeTemplate::WAY_EMAIL, $ways)) {
			$this->sendEmail($to, $noticeInfo, $data);
			return true;
		}

		$user = \app\models\User::find()->where(['id' => $to])->asArray()->one();
		if ($user) {
			$uid = $user['id'];
			$phone = $user['phone'];
			$email = $user['email'];
			$data['__userInfo__'] = $user;
			if (in_array(NoticeTemplate::WAY_SMS, $ways)) {
				if ($phone) {
					$this->sendSms($phone, $noticeInfo, $data);
				}
			}
			if (in_array(NoticeTemplate::WAY_EMAIL, $ways)) {
				if ($email) {
					$this->sendEmail($email, $noticeInfo, $data);
				}
			}
			if (in_array(NoticeTemplate::WAY_SYSMSG, $ways)) {
				$this->sendSysMsg($uid, $noticeInfo, $data);
			}
			if (in_array(NoticeTemplate::WAY_WECHAT, $ways)) {
				$this->sendWechat($uid, $noticeInfo, $data);
			}

			return true;
		}

		return false;
	}

	public function replaceContent($content, $data)
	{
		$replaceContent = strtr($content, static::$replace);
		extract($data);
		$replaceContent = "\$returnContent=\"" . $replaceContent . "\";";
		eval($replaceContent);
		if (!empty($returnContent)) {
			return $returnContent;
		}
		return '';
	}

	public function sendSms($phone, $noticeInfo, $data)
	{

		$title = $noticeInfo['title'];
		$content = $noticeInfo['smsContent'];
		$desc = $noticeInfo['desc'];

		$content = static::replaceContent($content, $data);
		if (empty($content)) {
			return;
		}


		\Yii::$app->sms->send($phone, $content);

		NoticeMessage::addMessage($phone, 1, $desc, $content);

	}

	public function sendEmail($email, $noticeInfo, $data = [])
	{

		$data['email'] = $email;

		$title = $noticeInfo['title'];
		$content = $noticeInfo['emailContent'];
		$desc = $noticeInfo['desc'];

		$content = static::replaceContent($content, $data);
		if (empty($title) || empty($content)) {
			return;
		}

		\Yii::$app->email->send($email, $title, $content);

		NoticeMessage::addMessage($email, 2, $desc, $content);

	}

	public function sendSysMsg($uid, $noticeInfo, $data = [])
	{

		$title = $noticeInfo['title'];
		$content = $noticeInfo['sysmsgContent'];
		$desc = $noticeInfo['desc'];

		$content = static::replaceContent($content, $data);
		if (empty($title) || empty($content)) {
			return;
		}
		$user = User::findOne($uid);
		if ($user) {
			$sysMsg = new UserSystemMessage();
			$sysMsg->to_userid = $uid;
			$sysMsg->message = $content;
			$sysMsg->created_at = time();
			$sysMsg->status = 0;
			$sysMsg->save();
			NoticeMessage::addMessage($uid, 3, $desc, $content);
		}

	}

	public function sendWechat($uid, $noticeInfo, $data = [])
	{
		$typeId = $noticeInfo['id'];
		if ($typeId == 10) {
			if (!empty($data['__userInfo__'])) {
				$userInfo = $data['__userInfo__'];
				$protectedStatus = $userInfo['protected_status'];
				if ($protectedStatus == 0) {
					return;
				}
			}
		}

		$title = $noticeInfo['title'];
		$content = $noticeInfo['wechatContent'];
		$desc = $noticeInfo['desc'];
		$content = addslashes($content);
		$content = static::replaceContent($content, $data);
		if (empty($title) || empty($content)) {
			return;
		}

		$content = strtr($content, ['[time]' => date('Y-m-d H:i:s')]);
		$mpUser = MpUser::findOne(['user_id' => $uid]);
		if (!$mpUser) {
			return;
		}
		if (empty($mpUser->open_id)) {
			return;
		}
		$openId = $mpUser->open_id;
		$postData = [];
		$postData['wid'] = 1;
		$postData['open_id'] = $openId;
		$postData['data'] = $content;
		$url = 'http://chat.huogou.com/wechat/api/sendtplmsg';
		$result = $this->do_post($url, $postData);

		NoticeMessage::addMessage($uid, 4, $desc, $content);
	}

	/**
	 * @param int $type
	 * @return bool
	 */
	public function noticeInfo($type)
	{
		$notice = NoticeTemplate::find()->where(['id' => $type])->asArray()->one();
		if ($notice) {
			$id = $notice['id'];
			$title = $notice['title'];
			$smsContent = $notice['sms_content'];
			$emailContent = $notice['email_content'];
			$sysmsgContent = $notice['sysmsg_content'];
			$wechatContent = $notice['wechat_content'];
			$noticeWay = $notice['notice_way'];
			$ways = explode(',', $noticeWay);
			$status = $notice['status'];
			$desc = $notice['desc'];
			return [
				'id' => $id,
				'title' => $title,
				'status' => $status,
				'smsContent' => $smsContent,
				'emailContent' => $emailContent,
				'sysmsgContent' => $sysmsgContent,
				'wechatContent' => $wechatContent,
				'ways' => $ways,
				'desc' => $desc,
			];
		}
		return [];
	}

	function do_post($url, $data = '')
	{
		$ch = curl_init(); //初始化curl
		curl_setopt($ch, CURLOPT_URL, $url); //抓取指定网页
		curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_POST, 1); //post提交方式

		if (!empty($data)) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		$data = curl_exec($ch); //运行curl
		curl_close($ch);
		return $data;
	}
}
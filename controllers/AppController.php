<?php
/**
 * @category  huogou.com
 * @name  AppController
 * @version 1.0
 * @date 2015-12-29
 * @author  keli <liwanglai@gmail.com>
 *
 */
namespace app\controllers;

use app\models\Image;
use Yii;
use app\models\AppConfig;
use yii\helpers\Json;
use app\models\UploadForm;
use yii\web\UploadedFile;

class AppController extends BaseController
{
	public static $noticeType = [
		'public_notice' => '默认公告',
		'activity_notice' => '活动消息'
	];
	
	//开机图片
	public function actionImageList()
	{
		$request = Yii::$app->request;
		if ($request->isAjax) {
			$list = AppConfig::find()->where(['type' => 'image'])->orderBy('sort desc, id desc')->all();
			$return = [];
			foreach ($list as $key => $val) {
				$content = Json::decode($val['content']);
				$return[$key]['id'] = $val['id'];
				$return[$key]['status'] = $val['status'];
				$return[$key]['system'] = $val['system'];
				$return[$key]['from'] = $val['from'];
				$return[$key]['link'] = $content['image_link'];
				$return[$key]['title'] = $content['image_title'];
				$return[$key]['img'] = isset($content['image_src']) ? $content['image_src'] : '';
				$return[$key]['start'] = $content['start_time'];
				$return[$key]['end'] = $content['end_time'];
			}
			
			return ['total' => 100, 'rows' => $return];
		}
		
		return $this->render('image-list');
	}
	
	//开机图片添加
	public function actionAddImage()
	{
		$request = Yii::$app->request;
		if ($request->isPost) {
			$post = $request->post();
			if (!empty($_FILES['picture']['name'])) {
				$imagModel = new UploadForm();
				$imagModel->imageFile = UploadedFile::getInstanceByName('picture');
				$uploadData = $imagModel->uploadShareInfo();
				$post['content']['image_src'] = "http://img." . IMG_DOMAIN . "/userpost/share/" . $uploadData["basename"];
			} else {
				return ['code' => 1, 'message' => '图片不能为空'];
			}
			$content = Json::encode($post['content']);
			$status = isset($post['status']) ? 1 : 0;
			$result = AppConfig::addConfig($post['from'], 'image', $content, $status, $post['system']);
			if ($result) {
				$this->addTips('新增开机图片', 0, '操作成功');
			} else {
				$this->addTips('新增开机图片失败', 1, '操作失败');
			}
		}
		
		return $this->render('add-image');
	}
	
	/**
	 * @pass
	 *  首页button设置
	 */
	public function actionIndexBtn()
	{
		$request = Yii::$app->request;
		if ($request->isAjax) {
			$list = AppConfig::find()->where(['type' => 'index-btn'])->orderBy('sort desc, id desc')->all();
			$return = [];
			foreach ($list as $key => $val) {
				$content = Json::decode($val['content']);
				$return[$key]['id'] = $val['id'];
				$return[$key]['status'] = $val['status'];
				$return[$key]['from'] = $val['from'];
				$return[$key]['system'] = $val['system'];
				
				$return[$key]['type'] = $content['type'];
				$return[$key]['url'] = $content['url'];
				$return[$key]['text'] = $content['text'];
				$return[$key]['img'] = $content['img'];
				$return[$key]['img_hover'] = $content['img_hover'];
				$return[$key]['index'] = $content['index'];
			}
			
			return ['total' => count($return), 'rows' => $return];
		}
		
		return $this->render('index-btn', [
			'targetTypes' => AppConfig::$targetTypes,
		]);
	}
	
	/**
	 * @pass
	 *  新增首页button
	 */
	public function actionAddIndexBtn()
	{
		$request = Yii::$app->request;
		if ($request->isPost) {
			$post = $request->post();
			if (!empty($_FILES['picture']['name'])) {
				$imagModel = new UploadForm();
				$imagModel->imageFile = UploadedFile::getInstanceByName('picture');
				$uploadData = $imagModel->uploadTempImg(250, 250);
			} else {
				$uploadData['basename'] = '';
			}
			$post['content']['img'] = "http://img." . IMG_DOMAIN . "/temp/org/" . $uploadData["basename"];
			if (!empty($_FILES['picture2']['name'])) {
				$imagModel = new UploadForm();
				$imagModel->imageFile = UploadedFile::getInstanceByName('picture2');
				$uploadData = $imagModel->uploadTempImg(250, 250);
			} else {
				$uploadData['basename'] = '';
			}
			$post['content']['img_hover'] = "http://img." . IMG_DOMAIN . "/temp/org/" . $uploadData["basename"];
			$content = Json::encode($post['content']);
			$status = isset($post['status']) ? 1 : 0;
			$result = AppConfig::addConfig($post['from'], 'index-btn', $content, $status, $post['system']);
			if ($result != 0) {
				$this->addTips('新增icon成功', 0, '操作成功');
			} else {
				$this->addTips('新增icon失败', 1, '操作失败');
			}
		}
		
		return $this->render('add-index-btn', [
			'targetTypes' => AppConfig::$targetTypes,
		]);
	}
	
	/**
	 * @pass
	 *  首页button设置
	 */
	public function actionFooterBar()
	{
		$request = Yii::$app->request;
		if ($request->isAjax) {
			$list = AppConfig::find()->where(['type' => 'footer-bar'])->orderBy('sort desc, id desc')->all();
			$return = [];
			foreach ($list as $key => $val) {
				$content = Json::decode($val['content']);
				$return[$key]['id'] = $val['id'];
				$return[$key]['status'] = $val['status'];
				$return[$key]['from'] = $val['from'];
				$return[$key]['system'] = $val['system'];
				
				$return[$key]['type'] = $content['type'];
				$return[$key]['url'] = $content['url'];
				$return[$key]['text'] = $content['text'];
				$return[$key]['img'] = $content['img'];
				$return[$key]['img_hover'] = $content['img_hover'];
				$return[$key]['index'] = $content['index'];
			}
			
			return ['total' => count($return), 'rows' => $return];
		}
		
		return $this->render('footer-bar', [
			'targetTypes' => AppConfig::$targetTypes,
		]);
	}
	
	/**
	 * @pass
	 *  新增首页button
	 */
	public function actionAddFooterBar()
	{
		$request = Yii::$app->request;
		if ($request->isPost) {
			$post = $request->post();
			if (!empty($_FILES['picture']['name'])) {
				$imagModel = new UploadForm();
				$imagModel->imageFile = UploadedFile::getInstanceByName('picture');
				$uploadData = $imagModel->uploadTempImg(250, 250);
			} else {
				$uploadData['basename'] = '';
			}
			$post['content']['img'] = "http://img." . IMG_DOMAIN . "/temp/org/" . $uploadData["basename"];
			if (!empty($_FILES['picture2']['name'])) {
				$imagModel = new UploadForm();
				$imagModel->imageFile = UploadedFile::getInstanceByName('picture2');
				$uploadData = $imagModel->uploadTempImg(250, 250);
			} else {
				$uploadData['basename'] = '';
			}
			$post['content']['img_hover'] = "http://img." . IMG_DOMAIN . "/temp/org/" . $uploadData["basename"];
			$content = Json::encode($post['content']);
			$status = isset($post['status']) ? 1 : 0;
			$result = AppConfig::addConfig($post['from'], 'footer-bar', $content, $status, $post['system']);
			if ($result != 0) {
				$this->addTips('新增icon成功', 0, '操作成功');
			} else {
				$this->addTips('新增icon失败', 1, '操作失败');
			}
		}
		
		return $this->render('add-footer-bar', [
			'targetTypes' => AppConfig::$targetTypes,
		]);
	}
	
	
	//支付设置
	public function actionSdkList()
	{
		$request = Yii::$app->request;
		if ($request->isAjax) {
			$list = AppConfig::find()->where(['type' => 'sdk'])->orderBy('sort desc, id desc')->all();
			$return = [];
			foreach ($list as $key => $val) {
				$content = Json::decode($val['content']);
				$return[$key]['id'] = $val['id'];
				$return[$key]['status'] = $val['status'];
				$return[$key]['from'] = $val['from'];
				$return[$key]['system'] = $val['system'];
				$return[$key]['name'] = $content['sdk_name'];
				$return[$key]['type'] = $content['sdk_type'];
			}
			
			return ['total' => 100, 'rows' => $return];
		}
		
		return $this->render('sdk-list');
	}
	
	//新增支付
	public function actionAddSdk()
	{
		$request = Yii::$app->request;
		if ($request->isPost) {
			$post = $request->post();
			$content = Json::encode($post['content']);
			$status = isset($post['status']) ? 1 : 0;
			$result = AppConfig::addConfig($post['from'], 'sdk', $content, $status, $post['system']);
			if ($result != 0) {
				$this->addTips('新增sdk成功', 0, '操作成功');
			} else {
				$this->addTips('新增sdk失败', 1, '操作失败');
			}
		}
	}
	
	public function actionEdit()
	{
		$id = Yii::$app->request->get('id');
		$type = Yii::$app->request->get('type');
		$model = AppConfig::findOne($id);
		if (!$model['id']) return ['code' => '2', 'message' => 'id不存在'];
		
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if ($type == 'image') {
				if (isset($_FILES['picture']['size']) && $_FILES['picture']['size']) {
					$imagModel = new UploadForm();
					$imagModel->imageFile = UploadedFile::getInstanceByName('picture');
					$uploadData = $imagModel->uploadShareInfo();
					$post['content']['image_src'] = "http://img." . IMG_DOMAIN . "/userpost/share/" . $uploadData["basename"];
					
				} else {
					$contents = Json::decode($model['content']);
					$post['content']['image_src'] = $contents['image_src'];
				}
			} elseif ($type == 'index-btn') {
				if (isset($_FILES['picture']['size']) && $_FILES['picture']['size']) {
					$imagModel = new UploadForm();
					$imagModel->imageFile = UploadedFile::getInstanceByName('picture');
					$uploadData = $imagModel->uploadTempImg(250, 250);
					$post['content']['img'] = "http://img." . IMG_DOMAIN . "/temp/org/" . $uploadData["basename"];
					
				} else {
					$contents = Json::decode($model['content']);
					$post['content']['img'] = $contents['img'];
				}
				if (!empty($_FILES['picture2']['name'])) {
					$imagModel = new UploadForm();
					$imagModel->imageFile = UploadedFile::getInstanceByName('picture2');
					$uploadData = $imagModel->uploadTempImg(250, 250);
					$post['content']['img_hover'] = "http://img." . IMG_DOMAIN . "/temp/org/" . $uploadData["basename"];
				} else {
					$contents = Json::decode($model['content']);
					$post['content']['img_hover'] = $contents['img_hover'];
				}
			} elseif ($type == 'footer-bar') {
				
				if (!empty($_FILES['picture']['name'])) {
					$imagModel = new UploadForm();
					$imagModel->imageFile = UploadedFile::getInstanceByName('picture');
					$uploadData = $imagModel->uploadTempImg(250, 250);
					$post['content']['img'] = "http://img." . IMG_DOMAIN . "/temp/org/" . $uploadData["basename"];
				} else {
					$contents = Json::decode($model['content']);
					$post['content']['img'] = $contents['img'];
				}
				if (!empty($_FILES['picture2']['name'])) {
					$imagModel = new UploadForm();
					$imagModel->imageFile = UploadedFile::getInstanceByName('picture2');
					$uploadData = $imagModel->uploadTempImg(250, 250);
					$post['content']['img_hover'] = "http://img." . IMG_DOMAIN . "/temp/org/" . $uploadData["basename"];
				} else {
					$contents = Json::decode($model['content']);
					$post['content']['img_hover'] = $contents['img_hover'];
				}
			}
			
			$post['content'] = !empty($post['content']) ? $post['content'] : [];
			$content = Json::encode($post['content']);
			$status = isset($post['status']) ? 1 : 0;
			$model->content = $content;
			$model->time = date('Y-m-d H:i:s', time());
			$model->status = $status;
			$model->system = isset($post['system']) ? $post['system'] : '';
			$model->from = $post['from'];
			if ($model->save()) {
				$this->addTips('修改' . $type . '成功', 0, '操作成功');
			} else {
				$this->addTips('修改' . $type . '失败', 1, '操作失败');
			}
		}
		$model['content'] = Json::decode($model['content']);
		
		return $this->render('edit-' . $type, [
			'model' => $model,
			'targetTypes' => AppConfig::$targetTypes,
		]);
	}
	
	//设置排序
	public function actionTop()
	{
		$id = Yii::$app->request->get('id');
		$model = AppConfig::findOne($id);
		$model->sort = $model['sort'] + 1;
		if ($model->save()) {
			$this->addTips('上移成功', 0, '操作成功');
		} else {
			$this->addTips('上移失败', 1, '操作失败');
		}
	}
	
	//升级提醒
	public function actionUpgrade()
	{
		$request = Yii::$app->request;
		if ($request->isPost) {
			$post = $request->post();
			$id = $post['id'];
			if ($post['system'] != 'ios') {
				$post['content']['up_isauto'] = isset($post['content']['up_isauto']) ? 1 : 0;
			}
			$content = Json::encode($post['content']);
			$type = 'upgrade';
			$status = isset($post['status']) ? 1 : 0;
			$system = $post['system'];
			if ($id) {
				$result = AppConfig::editConfig($id, $post['from'], $type, $content, $status, $system);
			} else {
				$result = AppConfig::addConfig($post['from'], $type, $content, $status, $system);
			}
			if ($result != 0) {
				$this->addTips('新增升级成功', 0, '操作成功');
			} else {
				$this->addTips('新增升级失败', 1, '操作失败');
			}
		}
		
		$huogouAndroidModel = AppConfig::find()->where(['from' => 1, 'system' => 'android', 'type' => 'upgrade'])->orderBy('id desc')->one();
		$huogouAndroidModel['content'] = Json::decode($huogouAndroidModel['content']);
		$huogouIosModel = AppConfig::find()->where(['from' => 1, 'system' => 'ios', 'type' => 'upgrade'])->orderBy('id desc')->one();
		$huogouIosModel['content'] = Json::decode($huogouIosModel['content']);
		
		$didiAndroidModel = AppConfig::find()->where(['from' => 2, 'system' => 'android', 'type' => 'upgrade'])->orderBy('id desc')->one();
		$didiAndroidModel['content'] = Json::decode($didiAndroidModel['content']);
		$didiIosModel = AppConfig::find()->where(['from' => 2, 'system' => 'ios', 'type' => 'upgrade'])->orderBy('id desc')->one();
		$didiIosModel['content'] = Json::decode($didiIosModel['content']);
		return $this->render('upgrade', [
			'huogouAndroidModel' => $huogouAndroidModel,
			'huogouIosModel' => $huogouIosModel,
			'didiAndroidModel' => $didiAndroidModel,
			'didiIosModel' => $didiIosModel,
		]);
	}


	//启动公告
	public function actionAnnounce()
	{
		$request = Yii::$app->request;
		if ($request->isPost) {
			$post = $request->post();
			$id = $post['id'];

			$post['content']['an_code'] =  isset($post['content']['an_code'])? $post['content']['an_code'] : 0;

			$content = Json::encode($post['content']);
			$type = 'announce';
			$status = isset($post['status']) ? 1 : 0;
			$system = $post['system'];

			if ($id) {
				$result = AppConfig::editConfig($id, $post['from'], $type, $content, $status, $system);
			} else {
				$result = AppConfig::addConfig($post['from'], $type, $content, $status, $system);
			}
			if ($result != 0) {
				$this->addTips('新增启动公告成功', 0, '操作成功');
			} else {
				$this->addTips('新增启动公告失败', 1, '操作失败');
			}
		}

		$huogouAndroidModel = AppConfig::find()->where(['from' => 1, 'system' => 'android', 'type' => 'announce'])->orderBy('id desc')->one();
		$huogouAndroidModel['content'] = Json::decode($huogouAndroidModel['content']);
		$huogouIosModel = AppConfig::find()->where(['from' => 1, 'system' => 'ios', 'type' => 'announce'])->orderBy('id desc')->one();
		$huogouIosModel['content'] = Json::decode($huogouIosModel['content']);

		$didiAndroidModel = AppConfig::find()->where(['from' => 2, 'system' => 'android', 'type' => 'announce'])->orderBy('id desc')->one();
		$didiAndroidModel['content'] = Json::decode($didiAndroidModel['content']);
		$didiIosModel = AppConfig::find()->where(['from' => 2, 'system' => 'ios', 'type' => 'announce'])->orderBy('id desc')->one();
		$didiIosModel['content'] = Json::decode($didiIosModel['content']);
		return $this->render('announce', [
			'huogouAndroidModel' => $huogouAndroidModel,
			'huogouIosModel' => $huogouIosModel,
			'didiAndroidModel' => $didiAndroidModel,
			'didiIosModel' => $didiIosModel,
		]);
	}

	//推送更新消息到ios
	function actionPushUpmsg($id)
	{
		$model = AppConfig::findOne($id);
		$content = Json::decode($model['content']);
		$this->push(3, $content['up_code'], $content['up_des'], "{type:'app',id:1}", []);
		/*Yii::$app->session->setFlash("success", "保存成功");
		$this->goBack();*/
	}
	
	/** 消息推送
	 * @return string
	 */
	function actionPush()
	{
		$request = Yii::$app->request;
		if ($request->isPost) {
			$from = $request->post('from');
			$title = $request->post('title');
			$content = $request->post('content');
			
			$productId = $request->post('productId');
			$msg_do = $request->post('msg_do');
			$remindType = $request->post('remindType');
			$pushOs = $request->post('os');
			
			$result = [];
			foreach ($pushOs as $os) {
				$msg_do = Json::encode(['type' => $msg_do, 'id' => $productId]);
				$result[] = $this->push($from, $os, $title, $content, $msg_do, $remindType);
			}
			print_r($result);
			
			$this->addLog('消息推送: title:' . $title . ', content:' . $content);
			Yii::$app->end();
		}
		
		return $this->render('app-push');
	}
	
	protected function push($from, $source, $title, $content, $customInfo, $remindType)
	{
		if ($from == 2) { //来源是滴滴夺宝,替换文字
			$getuiConfig = require(\Yii::getAlias('@app/config/didi_getui.php'));
			$getui = \Yii::createObject($getuiConfig);
			$logo = 'app_icon.png';
		} else {
			$getui = \Yii::$app->getui;
			$logo = 'logo.png';
		}
		if ($source == 3) {
			//ios发送
			$req = $getui->setTemplate('Transmission', [
				'transmissionType' => '2',//透传消息类型
				'transmissionContent' => $customInfo,//透传内容
			])->setAPNPayload([
				'body' => $content,
				'title' => $title,
				'badge' => 0,
				'customMsg' => [
					'url' => $customInfo,
				],
			])->pushApp(['IOS']);
		} elseif ($source == 4) {
			//Android发送
			$req = $getui->setTemplate('Notification', [
				'transmissionType' => '2',//透传消息类型
				'transmissionContent' => $customInfo,//透传内容
				'title' => $title,
				'text' => $content,
				'badge' => 0,
				'logo' => $logo,
				'isRing' => in_array('isRing', $remindType),
				'isVibrate' => in_array('isVibrate', $remindType),
				'isClearable' => in_array('isClearable', $remindType),
			])->pushApp(['ANDROID']);
		}
		return $req;
	}
	
	//分享设置
	public function actionShareList()
	{
		if (Yii::$app->request->isAjax) {
			$list = AppConfig::find()->where(['type' => 'share'])->orderBy('sort desc, id desc')->all();
			$return = [];
			foreach ($list as $key => $val) {
				$content = Json::decode($val['content']);
				$return[$key]['name'] = $content['share_name'];
				$return[$key]['link'] = $content['share_link'];
				$return[$key]['type'] = $content['share_type'];
				if (isset($content['share_only_link'])) {
					$return[$key]['only_link'] = $content['share_only_link'];
				} else {
					$return[$key]['only_link'] = 1;
				}
				$return[$key]['from'] = $val['from'];
				$return[$key]['status'] = $val['status'];
				$return[$key]['system'] = $val['system'];
				$return[$key]['id'] = $val['id'];
			}
			return ['total' => 100, 'rows' => $return];
		}
		
		return $this->render('share-list');
	}
	
	/**
	 * @pass
	 **/
	//新增虚拟
	public function actionAddShare()
	{
		$request = Yii::$app->request;
		if ($request->isPost) {
			$post = $request->post();
			if (!isset($post['content']['share_type'])) $post['content']['share_type'] = 0;
			$content = Json::encode($post['content']);
			$status = isset($post['status']) ? 1 : 0;
			$result = AppConfig::addConfig($post['from'], 'share', $content, $status, $post['system']);
			if ($result != 0) {
				$this->addTips('新增分享成功', 0, '操作成功');
			} else {
				$this->addTips('新增分享失败', 1, '操作失败');
			}
		}
	}
	
	//第三方登陆
	public function actionLogin()
	{
		$request = Yii::$app->request;
		if ($request->isPost) {
			$post = $request->post();
			if (!isset($post['content']['login_qq']) && !isset($post['content']['login_wechat'])) {
				$post['content'] = [
					'login_qq' => 0,
					'login_wechat' => 0,
					'version' => $post['content']['version']
				];
			}
			$from = $post['from'];
			$content = Json::encode($post['content']);
			$model = AppConfig::find()->where(['from' => $from, 'type' => 'login', 'system' => $post['system']])->one();
			if ($model) {
				$model->content = $content;
				$model->save();
			} else {
				AppConfig::addConfig($post['from'], 'login', $content, 1, $post['system']);
			}
		}
		$type = 'login';
		
		$huogouAndroidModel = AppConfig::find()->where(['from' => 1, 'system' => 'android', 'type' => $type])->orderBy('id desc')->one();
		$huogouAndroidModel['content'] = Json::decode($huogouAndroidModel['content']);
		$huogouIosModel = AppConfig::find()->where(['from' => 1, 'system' => 'ios', 'type' => $type])->orderBy('id desc')->one();
		$huogouIosModel['content'] = Json::decode($huogouIosModel['content']);
		
		$didiAndroidModel = AppConfig::find()->where(['from' => 2, 'system' => 'android', 'type' => $type])->orderBy('id desc')->one();
		$didiAndroidModel['content'] = Json::decode($didiAndroidModel['content']);
		$didiIosModel = AppConfig::find()->where(['from' => 2, 'system' => 'ios', 'type' => $type])->orderBy('id desc')->one();
		$didiIosModel['content'] = Json::decode($didiIosModel['content']);
		return $this->render('login', [
			'huogouAndroidModel' => $huogouAndroidModel,
			'huogouIosModel' => $huogouIosModel,
			'didiAndroidModel' => $didiAndroidModel,
			'didiIosModel' => $didiIosModel,
		]);
	}
	
	//虚拟支付
	public function actionVirtualList()
	{
		if (Yii::$app->request->isAjax) {
			$list = AppConfig::find()->where(['type' => 'virtual'])->orderBy('sort desc, id desc')->all();
			$return = [];
			foreach ($list as $key => $val) {
				$content = Json::decode($val['content']);
				$return[$key]['name'] = $content['virtual_name'];
				$return[$key]['icon'] = $content['virtual_icon'];
				$return[$key]['type'] = $content['virtual_type'];
				$return[$key]['status'] = $val['status'];
				$return[$key]['system'] = $val['system'];
				$return[$key]['from'] = $val['from'];
				$return[$key]['id'] = $val['id'];
			}
			
			return ['total' => 100, 'rows' => $return];
		}
		
		
		return $this->render('virtual-list', [
		]);
	}
	
	//新增虚拟
	public function actionAddVirtual()
	{
		$request = Yii::$app->request;
		if ($request->isPost) {
			$post = $request->post();
			$content = Json::encode($post['content']);
			$status = isset($post['status']) ? 1 : 0;
			$result = AppConfig::addConfig($post['from'], 'virtual', $content, $status, $post['system']);
			if ($result != 0) {
				$this->addTips('新增虚拟成功', 0, '操作成功');
			} else {
				$this->addTips('新增虚拟失败', 1, '操作失败');
			}
		}
	}
	
	//删除虚拟支付
	public function actionDel()
	{
		$id = Yii::$app->request->get('id');
		$model = AppConfig::findOne($id);
		if (!$model) return ['error' => 1, 'message' => '不存在'];
		
		if ($model->delete()) {
			$this->addTips('删除成功', 0, '操作成功');
		} else {
			$this->addTips('删除失败', 1, '操作失败');
		}
	}
	
	//网页支付
	public function actionH5pay()
	{
		if (Yii::$app->request->isPost) {
			$status = Yii::$app->request->post('status', 0);
			$from = Yii::$app->request->post('from');
			$content = Yii::$app->request->post('content');
			$exist = AppConfig::findOne(['type' => 'h5pay', 'from' => $from]);
			if ($exist) {
				$exist->content = json_encode($content);
				$exist->status = $status;
				$exist->save();
			} else {
				AppConfig::addConfig($from, 'h5pay', json_encode($content), $status, '');
			}
		}
		
		$huogou = AppConfig::findOne(['type' => 'h5pay', 'from' => 1]);
		$huogou['content'] = json_decode($huogou['content']);
		$didi = AppConfig::findOne(['type' => 'h5pay', 'from' => 2]);
		$didi['content'] = json_decode($didi['content']);
		return $this->render('h5pay', [
			'huogou' => $huogou,
			'didi' => $didi,
		]);
	}
	
	//公告列表
	public function actionPublicNotice()
	{
		if (Yii::$app->request->isAjax) {
			$list = AppConfig::find()->where(['or', ['type' => 'public_notice'], ['type' => 'activity_notice']])->orderBy('sort desc,id desc')->all();
			$return = [];
			foreach ($list as $key => $val) {
				$content = Json::decode($val['content']);
				$return[$key]['title'] = $content['notice_title'];
				$return[$key]['desc'] = $content['notice_desc'];
				$return[$key]['icon'] = $content['notice_icon'];
				$return[$key]['type'] = $content['notice_type'];
				$return[$key]['status'] = $val['status'];
				$return[$key]['system'] = $val['system'];
				$return[$key]['from'] = $val['from'];
				$return[$key]['id'] = $val['id'];
				$return[$key]['type'] = self::$noticeType[$val['type']];
			}
			
			return ['total' => count($list), 'rows' => $return];
		}
		
		
		return $this->render('public-notice', [
		]);
	}
	
	//添加公告
	public function actionAddPublicNotice()
	{
		$request = Yii::$app->request;
		if ($request->isPost) {
			$post = $request->post();
			$content = Json::encode($post['content']);
			$status = isset($post['status']) ? 1 : 0;
			$type = isset($post['type']) ? $post['type'] : 'public_notice';
			$result = AppConfig::addConfig($post['from'], $type, $content, $status, '');
			if ($result != 0) {
				\app\models\UserAppInfo::updateAll(['new_pm' => 1]);
				$this->addTips('新增公告成功', 0, '操作成功');
			} else {
				$this->addTips('新增公告失败', 1, '操作失败');
			}
		}
	}
}

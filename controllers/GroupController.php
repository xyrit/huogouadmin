<?php
/**
 * Created by PhpStorm.
 * User: zhangjicheng
 * Date: 15/9/18
 * Time: 14:54
 */

namespace app\controllers;

use app\helpers\DateFormat;
use app\models\GroupTopic;
use app\models\GroupTopicComment;
use app\models\GroupUser;
use app\models\User;
use app\models\Keyword;
use app\models\UserAppInfo;
use Yii;
use app\models\Group;
use app\models\UserSystemMessage;
use yii\base\Exception;
use yii\data\Pagination;
use app\models\UploadForm;
use yii\helpers\Json;
use yii\web\UploadedFile;
use app\services\Member;

class GroupController extends BaseController
{
	//圈子列表
	public function actionIndex()
	{
		$request = Yii::$app->request;
		if ($request->isAjax) {
			$query = Group::find();
			$countQuery = clone $query;
			$pagination = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => 10]);
			$list = $query->offset($pagination->offset)
				->limit($pagination->limit)
				->all();
			$data['rows'] = $list;
			$data['total'] = $pagination->totalCount;
			return $data;
		}

		return $this->render('index');
	}

	public function actionTopic()
	{
		$request = \Yii::$app->request;

		if ($request->isAjax) {
			$query = GroupTopic::find();
			$get = $request->get();
			$page = $request->get('page', 0);
			$pageSize = $request->get('rows', 25);
			if (isset($get['digest']) && $get['digest'] != 2) $query->where(['is_digest' => $get['digest']]);
			if (isset($get['status']) && $get['status'] != 3) $query->where(['status' => $get['status']]);
			$start = strtotime("today");
			$end = strtotime(date("Y-m-d", strtotime("+1 day")));
			if (isset($get['today']) && $get['today'] == 1) $query->where(['and', 'created_at>=' . $start, 'created_at<' . $end]);
			if (isset($get['start']) && $get['start'] != '') {
				$gt = ['>=', 'created_at', strtotime($get['start'])];
				$query->andWhere($gt);
			}
			if (isset($get['end']) && $get['end'] != '') {
				$lt = ['<=', 'created_at', strtotime($get['end'])];
				$query->andWhere($lt);
			}

			$countQuery = clone $query;
			$pagination = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
			$list = $query->offset($pagination->offset)
				->limit($pagination->limit)
				->orderBy('id desc')
				->all();
			$groups = Group::getGroup();
			$data = [];
			foreach ($list as $key => $val) {
				$userInfo = User::findOne($val['user_id']);
				$data[$key]['id'] = $val['id'];
				$data[$key]['email'] = $userInfo['email'];
				$data[$key]['phone'] = $userInfo['phone'];
				$data[$key]['nickname'] = $userInfo['nickname'];
				$data[$key]['subject'] = $val['subject'];
				$data[$key]['group_id'] = $groups[$val['group_id']];
				$data[$key]['top'] = $val['is_top'];
				$data[$key]['digest'] = $val['is_digest'];
				$data[$key]['view_count'] = $val['view_count'];
				$data[$key]['status'] = $val['status'];
				$data[$key]['comment_count'] = $val['comment_count'];
				$data[$key]['created_at'] = DateFormat::microDate($val['created_at']);
			}
			return ['rows' => $data, 'total' => $pagination->totalCount];
		}

		$params['del_topic'] = $this->checkPrivilege($this->getUniqueId() . '/del-topic');
		$params['verify'] = $this->checkPrivilege($this->getUniqueId() . '/verify');
		$params['edit'] = $this->checkPrivilege($this->getUniqueId() . '/topic-edit');
		return $this->render('topic', $params);
	}

	//回帖列表
	public function actionComment()
	{
		$request = Yii::$app->request;
		if ($request->isAjax) {
			$page = $request->get('page', 1);
			$perpage = $request->get('rows', 25);
			$query = \app\models\GroupTopicComment::find()
				->select('group_topic_comments.*, t.subject')
				->leftJoin('group_topics t', 't.id = group_topic_comments.topic_id')
				->where(['is_topic' => 0]);
			$countQuery = clone $query;
			$pagination = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'defaultPageSize' => $perpage]);
			$list = $query->offset($pagination->offset)
				->limit($pagination->limit)
				->orderBy('id desc')
				->all();

			$data = [];
			foreach ($list as $key => $val) {
				$data[$key]['content'] = GroupTopicComment::commentDeal($val['message']);
				$data[$key]['id'] = $val['id'];
				$data[$key]['status'] = $val['status'];
				$userinfo = User::findOne($val['user_id']);
				$data[$key]['email'] = $userinfo['email'];
				$data[$key]['phone'] = $userinfo['phone'];
				$data[$key]['created_at'] = DateFormat::microDate($val['created_at']);
			}

			return ['rows' => $data, 'total' => $pagination->totalCount];
		}
		$params['del_comment'] = $this->checkPrivilege($this->getUniqueId() . '/del-comment');
		$params['verify'] = $this->checkPrivilege($this->getUniqueId() . '/verify-comment');
		return $this->render('comment', $params);
	}

	// 新增圈子
	public function actionAdd()
	{
		$model = new Group();
		$userModel = new GroupUser();
		$request = \Yii::$app->request;
		$model->group_closed = 0;
		$model->comment_closed = 0;
		$model->topic_closed = 0;
		$model->verify_status = 0;

		if ($request->isPost) {
			$post = $request->post();

			if (!empty($_FILES['imageFile']['name'])) {
				$imagModel = new UploadForm();
				$imagModel->imageFile = UploadedFile::getInstanceByName('imageFile');
				$uploadData = $imagModel->uploadGroupIcon();
			} else {
				$uploadData['basename'] = '';
			}

			if ($model->load($post) && $model->validate()) {
				$model->user_count = 1;
				$model->picture = $uploadData['basename'];
				$model->created_at = time();

				if ($model->save()) {
					$adminuser = User::find()->where(['or', 'email=' . $model->adminuser, 'phone=' . $model->adminuser]);
					$exist = GroupUser::find()->where(['user_id' => $adminuser['id'], 'group_id' => $id = $model->primaryKey])->one();
					if (!$exist) {
						$userModel->user_id = $adminuser['id'];
						$userModel->group_id = $model->id;
						$userModel->created_at = time();
						$userModel->save();
					}

					$this->redirect('index');
				}
			}
		}

		return $this->render('add', [
			'model' => $model,
		]);

	}

	///圈子修改
	public function actionEdit()
	{
		$request = \Yii::$app->request;
		$id = $request->get('id');
		$model = Group::findOne($id);
		if (!$model) {
			throw new NotFoundHttpException("页面未找到");
		}

		if ($request->isPost) {
			$uploadData['basename'] = '';
			$post = $request->post();
			$trans = Yii::$app->db->beginTransaction();
			try {
				if ($post['Group']['adminuser'] != $model['adminuser']) {
					$find = User::find()->where(['or', 'email="' . $model['adminuser'] . '"', 'phone="' . $model['adminuser'] . '"'])->one();
					if ($find) {
						$ont = GroupUser::find()->where(['and', 'user_id=' . $find['id'], 'group_id=' . $model['id']])->one();
						if ($ont['id']) $ont->delete();
					}

					$postuser = User::find()->where(['or', 'email="' . $post['Group']['adminuser'] . '"', 'phone="' . $post['Group']['adminuser'] . '"'])->one();
					$exist = GroupUser::find()->where(['and', 'user_id=' . $postuser['id'], 'group_id=' . $model['id']])->one();

					if (!$exist) {
						$userModel = new GroupUser();
						$userModel->user_id = $postuser['id'];
						$userModel->group_id = $model['id'];
						$userModel->created_at = time();
						if (!$userModel->save()) {
							$trans->rollBack();
							$this->addLog('修改圈子失败' . $model['name'] . '，圈主保存失败');
							echo json_encode(['error' => 1, 'message' => '保存失败']);
							Yii::$app->end();
						}
					}
				}
				if ($model->load($request->post()) && $model->validate()) {
					$model->picture = $uploadData['basename'];
					if ($model->save()) {
						$trans->commit();
						$this->addLog('修改圈子成功' . $model['name']);
						echo json_encode(['error' => 0, 'message' => '保存成功']);
						Yii::$app->end();
					} else {
						$trans->rollBack();
						$this->addLog('修改圈子失败' . $model['name']);
						echo json_encode(['error' => 2, 'message' => '保存失败']);
						Yii::$app->end();
					}
				}
			} catch (Exception $e) {
				$trans->rollBack();
				echo json_encode(['error' => 3, 'message' => '保存失败']);
				Yii::$app->end();
			}
		}
	}

	//圈子删除
	public function actionDel()
	{
		$id = \Yii::$app->request->post('id');
		$response = \Yii::$app->response;
		$model = Group::findOne($id);
		GroupUser::deleteAll(['group_id' => $id]);
		GroupTopic::deleteAll(['group_id' => $id]);
		$topics = GroupTopic::findAll(['group_id' => $id]);
		foreach ($topics as $key => $val) {
			GroupTopicComment::deleteAll(['topic_id' => $val['id']]);
		}
		$delete = $model->delete();
		$response->format = \yii\web\Response::FORMAT_JSON;
		if ($delete) {
			return [
				'error' => 0,
				'message' => '删除成功'
			];
		}
		return [
			'error' => 1,
			'message' => '删除失败'
		];
	}

	//话题删除
	public function actionDelTopic()
	{
		$request = Yii::$app->request;
		$response = Yii::$app->response;
		if ($request->isPost) {
			$id = $request->post('id');
			$model = GroupTopic::findOne($id);
			if ($model) {
				$member = new Member(['id' => $model['user_id']]);
				$member->editExperience(-100, 5, '管理员删除话题');
				GroupTopicComment::deleteAll(['topic_id' => $id]);
				$subject = $model['subject'];
				$delete = $model->delete();
				$response->format = \yii\web\Response::FORMAT_JSON;
				if ($delete) {
					if ($model['status'] == 1) {
						$group = Group::findOne(['id' => $model['group_id']]);
						if (($group['topic_count'] - 1) < 0) $num = 0; else $num = $group['topic_count'] - 1;
						$group->topic_count = $num;
						$group->save();
					}
					$this->addLog('删除话题成功-' . $subject);
					return [
						'error' => 0,
						'message' => '删除成功'
					];
				}
				$this->addLog('删除话题失败-' . $subject);
				return [
					'error' => 1,
					'message' => '删除失败'
				];
			}
		}
	}

	//获取话题内容
	public function actionTopicMess()
	{
		$id = Yii::$app->request->post('id');
		$mess = GroupTopicComment::find()->where(['topic_id' => $id, 'is_topic' => 1])->one();
		return GroupTopicComment::topicContentDeal($mess['message']);
	}

	//话题审核
	public function actionVerify()
	{
		$id = Yii::$app->request->get('id');
		$model = GroupTopic::findOne($id);
		if ($model) {
			$status = Yii::$app->request->get('status');
			$commentModel = GroupTopicComment::find()->where(['topic_id' => $model['id'], 'is_topic' => 1])->one();
			$MessageModel = new UserSystemMessage();
			$MessageModel->to_userid = intval($model['user_id']);
			$MessageModel->message = '对不起，您的“发帖标题”因违法本站相关规定，审核不予通过，请您重新再试';
			$MessageModel->created_at = time();
			if ($status) {
				$model->status = $status;
				$model->save();
				if ($status == 1) {
					Group::groupTopciCount($model['group_id']);
					$commentModel->status = 1;
					$commentModel->save();
					$member = new Member();
					$member->editExperience(50, 5, '发表话题成功');
				} else {
					$commentModel->status = 2;
					$commentModel->save();
					$MessageModel->save();
					UserAppInfo::updateAll(['new_pm' => 1], ['uid' => intval($model['user_id'])]);
				}
				$this->addLog('审核话题成功-' . $model['subject']);
				return 1;
			} else {//已通过
				if ($model['status'] == 1) {
					$model->status = 2;
					Group::groupTopciCount($model['group_id'], 2);
					$commentModel->status = 2;
					$commentModel->save();
					$MessageModel->save();
					UserAppInfo::updateAll(['new_pm' => 1], ['uid' => intval($model['user_id'])]);
				} elseif ($model['status'] == 2) {
					$model->status = 1;
					Group::groupTopciCount($model['group_id']);
					$commentModel->status = 1;
					$commentModel->save();
				}
				$model->save();
				$this->addLog('审核话题成功-' . $model['subject']);
				return 1;
			}
		}
	}

	//回帖审核
	public function actionVerifyComment()
	{
		$id = Yii::$app->request->get('id');
		$model = GroupTopicComment::findOne($id);
		if ($model) {
			$status = Yii::$app->request->get('status');
			$MessageModel = new UserSystemMessage();
			$MessageModel->to_userid = intval($model['user_id']);
			$MessageModel->message = '对不起，您的回复内容因违法本站相关规定，审核不予通过，请您重新再试';
			$MessageModel->created_at = time();

			if ($status) {
				$model->status = $status;
				if ($status == 1) {
					$member = new Member();
					$member->editExperience(5, 7, '回复成功');
				}
				if ($model->save()) {
					if ($status == 0) $MessageModel->save();
					UserAppInfo::updateAll(['new_pm' => 1], ['uid' => intval($model['user_id'])]);
					GroupTopic::groupTopciCommentCount($id, $model['topic_id'], $status);
				}
				return 1;
			} else {
				if ($model['status'] == 1 || $status == 0) {
					$model->status = 2;
					$MessageModel->save();
					UserAppInfo::updateAll(['new_pm' => 1], ['uid' => intval($model['user_id'])]);
					GroupTopic::groupTopciCommentCount($id, $model['topic_id'], 2);
				} elseif ($model['status'] == 2) {
					$model->status = 1;
					GroupTopic::groupTopciCommentCount($id, $model['topic_id']);
				}
				$model->save();
				$this->addLog('审核回帖成功-' . $model['message']);
				return 1;
			}

		}
	}

	//获取回帖内容
	public function actionCommentMess()
	{
		$id = Yii::$app->request->post('id');
		$mess = GroupTopicComment::findOne($id);
		return GroupTopicComment::commentDeal($mess['message']);
	}

	//删除回帖
	public function actionDelComment()
	{
		$id = Yii::$app->request->post('id');
		$mess = GroupTopicComment::findOne($id);
		$member = new Member(['id' => $mess['user_id']]);
		$member->editExperience(-20, 7, '管理员删除回复');
		$comment = $mess['message'];
		$del = $mess->delete();
		if ($del) {
			$topic = GroupTopic::findOne($mess['topic_id']);
			$topic->comment_count = $topic['comment_count'] - 1;
			$topic->save();

			$this->addLog('删除回帖成功-' . $comment);
			return 1;
		} else {
			$this->addLog('删除回帖失败-' . $comment);
			return 0;
		}
	}

	//关键字过滤
	public function actionKeywords()
	{
		$list = Keyword::find()->orderBy('id desc')->all();

		return $this->render('keywords', [
			'list' => $list,
		]);
	}

	//新增关键字
	public function actionAddKeyword()
	{
		$request = Yii::$app->request;
		if ($request->isPost) {
			$post = $request->post('Keywords');
			$model = new Keyword;
			$model->type = $post['type'];
			$model->content = $post['content'];
			if ($model->save()) {
				return $this->redirect(['group/keywords']);
			}
		}

		return $this->render('add-keyword');
	}

	//新增关键字
	public function actionEditKeyword()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		$model = Keyword::findOne($id);
		if (!$model) {
			throw new NotFoundHttpException("页面未找到");
		}

		if ($request->isPost) {
			$post = $request->post('Keywords');
			$model->type = $post['type'];
			$model->content = $post['content'];
			if ($model->save()) {
				return $this->redirect(['group/keywords']);
			}
		}

		return $this->render('edit-keyword', [
			'model' => $model,
		]);
	}

	//删除关键字
	public function actionDelKeyword()
	{
		$id = Yii::$app->request->post();
		$model = Keyword::findOne($id);
		if ($model) {
			$delete = $model->delete();
			if ($delete) return 0;
			else return 1;
		}
	}

	public function actionTopicEdit()
	{
		$request = Yii::$app->request;

		if ($request->isPost) {
			$post = $request->post();
			$model = GroupTopic::findOne($post['id']);
			$model->subject = $post['subject'];
			$model->is_digest = $post['digest'];
			$model->is_top = $post['top'];
			if ($model->save()) {
				$msg = GroupTopicComment::find()->where(['topic_id' => $model['id'], 'is_topic' => 1])->one();
				$msg->message = $post['content'];
				//BackstageLog::addLog(Yii::$app->admin->id, 10, '修改话题（'.$model['subject'].')');
				if ($msg->save()) return 1;
				else return 0;
			} else {
				return 0;
			}
		}

		$id = $request->get('id');
		$model = GroupTopic::findOne($id);
		if (!$model) return;
		$msg = GroupTopicComment::find()->where(['topic_id' => $model['id'], 'is_topic' => 1])->one();
		$message = GroupTopicComment::topicContentDeal($msg['message']);
		return $this->render('topic-edit', [
			'model' => $model,
			'message' => $message
		]);
	}

	public $enableCsrfValidation = false;

	public function actionUploadTopicImg()
	{
		$model = new UploadForm();

		if (Yii::$app->request->isPost) {
			$model->imageFile = UploadedFile::getInstanceByName('imgFile');
			if ($uploadData = $model->uploadGroupInfo()) {
				// file is uploaded successfully
				echo Json::encode($uploadData);
			}
		}
	}
}
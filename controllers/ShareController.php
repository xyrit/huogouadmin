<?php
/**
 * User: chenyi
 * Date: 15/9/24
 * Time: 17:54
 */

namespace app\controllers;

use app\helpers\DateFormat;
use app\helpers\Excel;
use app\helpers\ImagickHelper;
use app\helpers\MyRedis;
use app\models\Admin;
use app\models\Order;
use app\models\Period;
use app\models\Product;
use app\models\ProductCategory;
use app\models\ShareComment;
use app\models\ShareReply;
use app\models\User;
use Yii;
use yii\web\NotFoundHttpException;
use app\models\ShareTopic;
use app\models\ShareTopicImage;
use yii\helpers\ArrayHelper;
use app\models\Image;
use app\services\User as ServiceUser;
use app\helpers\Ex;
use yii\helpers\Json;

class ShareController extends BaseController
{
	const SWITCH_SHARE = 'switch_share';

	/**
	 * 晒单列表
	 */
	public function actionIndex()
	{
		$request = Yii::$app->request;
		if ($request->isAjax || $request->get('excel') == 'share') {
			$is_pass = $request->get('is_pass', 'all');
			$start_time = $request->get('start_time', '');
			$end_time = $request->get('end_time', '');
			$account = $request->get('account', '');
			$is_recommend = $request->get('is_recommend', 'all');
			$get = $request->get();
			if ($start_time != '') {
				$start_time = strtotime($start_time);
			}
			if ($end_time != '') {
				$end_time = strtotime($end_time);
			}
			$pageSize = $request->get('rows', 25);
			$page = $request->get('page', 1);

			$where = ['is_pass' => $is_pass, 'start_time' => $start_time, 'end_time' => $end_time, 'is_recommend' => $is_recommend, 'account' => $account];

			if (isset($get['excel']) && $get['excel'] == 'share') {
				$data = [];
				$list = ShareTopic::adminShareTopicList($where, $page, PHP_INT_MAX);
				$data[0] = ['id' => 'ID', 'name' => '商品名称', 'period_no' => '当前期号', 'phone' => '手机', 'email' => '邮箱', 'point' => '奖励福分', 'up_num' => '羡慕', 'comment_num' => '回复', 'recommand' => '推荐', 'digest' => '精华', 'status' => '状态', 'time' => '时间'];
				foreach ($list['list'] as $key => $val) {
					$key = $key + 1;
					$data[$key]['id'] = $val['id'];
					$data[$key]['name'] = $val['name'];
					$data[$key]['period_no'] = $val['period_no'];
					$data[$key]['phone'] = $val['phone'];
					$data[$key]['email'] = $val['email'];
					$data[$key]['point'] = $val['point'];
					$data[$key]['up_num'] = $val['up_num'];
					$data[$key]['comment_num'] = $val['comment_num'];
					if ($val['is_recommend'] == 1) $is_recommend = '是'; else $is_recommend = '否';
					$data[$key]['recommand'] = $is_recommend;
					if ($val['is_digest'] == 1) $is_digest = '是'; else $is_digest = '否';
					$data[$key]['digest'] = $is_digest;
					if ($val['is_pass'] == 0) {
						$pass = '待审核';
					} elseif ($val['is_pass'] == 1) {
						$pass = '完成';
					} elseif ($val['is_pass'] == 2) {
						$pass = '未通过';
					}
					$data[$key]['status'] = $pass;
					$data[$key]['time'] = DateFormat::microDate($val['created_at']);
				}
				$excel = new Ex();
				$excel->download($data, '晒单订单-' . date('Y-m-d H:i:s') . '.xls');
			}

			$shareTopicList = ShareTopic::adminShareTopicList($where, $page, $pageSize);

			$redis = new MyRedis();
			foreach ($shareTopicList['list'] as &$one) {
				$key = ShareComment::NEW_TIPS . $one['id'];
				$one['new_tips'] = $redis->get($key) ? 1 : 0;
			}

			return ['rows' => $shareTopicList['list'], 'total' => $shareTopicList['total']];
		}
		$redis = new MyRedis();
		$key = self::SWITCH_SHARE;
		$status = $redis->get($key);
		$params['swtich_status'] = $status ? 1 : 0;
		return $this->render('index', $params);
	}

	//晒单详情
	public function actionView()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		$model = ShareTopic::findOne($id);

		if (!$model) {
			throw new NotFoundHttpException("页面未找到");
		}

		if ($request->isPost) {
			$post = $request->post();
			$result = ShareTopic::check($id, $post);
			if (is_array($result)) {
				return Json::encode(['error' => 1, 'message' => $result['msg']]);
			} elseif ($result === true) {
				return Json::encode(['error' => 0, 'message' => '保存成功']);
			} else {
				return Json::encode(['error' => 1, 'message' => '保存失败']);
			}
		}

		//获取图片
		$shareTopicImage = ShareTopicImage::findAll(['share_topic_id' => $id]);
		$shareTopicImage = ArrayHelper::toArray($shareTopicImage);
		foreach ($shareTopicImage as &$image) {
			$image['url'] = Image::getShareInfoUrl($image['basename'], 'share');
		}

		//获取商品信息
		$data['productInfo'] = Product::findOne($model->product_id);
		//获取分类信息
		$data['categoryInfo'] = ProductCategory::findOne($model->cat_id);
		//获取期数信息
		$data['periodInfo'] = Period::findOne($model->period_id);
		//订单信息
		$data['orderInfo'] = Order::findOne(['period_id' => $model->period_id]);
		//用户信息
		$data['userInfo'] = User::findOne($model->user_id);
		$data['pictures'] = $shareTopicImage;
		$data['pictures_num'] = count($shareTopicImage) + 1;
		$data['shareTopicInfo'] = $model;
		//审核人
		if ($model->admin_id) {
			$admin = Admin::findOne($model->admin_id);
			$data['admin'] = $admin['username'];
		}

		return $this->render('view', $data);
	}

	/**
	 * @pass
	 * @return string
	 */
	public function actionShowPicture()
	{
		$request = Yii::$app->request;
		$id = $request->get('id');
		$basename = $request->get('basename');
		$url = Image::getShareInfoUrl($basename, 'share');
		$imagePath = Image::getShareInfoFullPath($basename, 'share');
		$imagePath = \Yii::$app->sftp->getSFtpPath($imagePath);
		$sourceSize = getimagesize($imagePath);
		$width = 300;
		$height = ceil($sourceSize[1] * $width / $sourceSize['0']);
		return $this->render('picture', [
				'share_topic_id' => $id,
				'basename' => $basename,
				'url' => $url,
				'height' => $height,
				'width' => $width,
				'orgheight' => $sourceSize[1],
				'orgwidth' => $sourceSize[0]]
		);
	}

	//晒单删除
	public function actionDel()
	{
		$id = Yii::$app->request->post('id');
		$model = ShareTopic::findOne($id);
		$delete = $model->delete();
		if ($delete) {
			echo json_encode(['error' => 0, 'message' => '删除成功']);
		} else {
			echo json_encode(['error' => 1, 'message' => '删除成功']);
		}
	}

	/**
	 * @pass
	 * 晒单推荐
	 * @return array
	 */
	public function actionSetRecommend()
	{
		$request = Yii::$app->request;

		if ($request->isAjax) {
			$id = $request->get('id');

			$model = ShareTopic::findOne($id);
			if ($model->is_recommend == 0 && !$model->recommend_image) {
				return ['error' => 1, 'message' => '请先设置推荐图'];
			}

			if ($model) {
				if ($model->is_recommend == 1) {
					$model->is_recommend = 0;
				} else {
					$model->is_recommend = 1;
					$model->recommended_at = time();
				}

				if (!$model->save()) {
					foreach ($model->errors as $message) {
						return ['error' => 1, 'message' => $message];
					}
				}
				$message = $model->is_recommend == 1 ? '推荐成功' : '取消推荐成功';
				return ['error' => 0, 'message' => $message];
			}
		}
	}

	/**
	 * @pass
	 * 晒单精华
	 * @return array
	 */
	public function actionSetDigest()
	{
		$request = Yii::$app->request;

		if ($request->isAjax) {
			$id = $request->get('id');

			$model = ShareTopic::findOne($id);

			if ($model) {
				if ($model->is_digest == 1) {
					$model->is_digest = 0;
				} else {
					$model->is_digest = 1;
					$model->digested_at = time();
				}

				if (!$model->save()) {
					foreach ($model->errors as $message) {
						return ['error' => 1, 'message' => $message];
					}
				}
				$message = $model->is_digest == 1 ? '精华成功' : '取消精华成功';
				return ['error' => 0, 'message' => $message];
			}
		}
	}

	/**
	 * @pass
	 * 晒单显示
	 * @return array
	 */
	public function actionSetShow()
	{
		$request = Yii::$app->request;

		if ($request->isAjax) {
			$id = $request->get('id');

			$model = ShareTopic::findOne($id);

			if ($model) {
				if ($model->is_show == 1) {
					$model->is_show = 0;
				} else {
					$model->is_show = 1;
				}

				if (!$model->save()) {
					foreach ($model->errors as $message) {
						return ['error' => 1, 'message' => $message];
					}
				}
				$message = $model->is_show == 1 ? '显示成功' : '隐藏成功';
				return ['error' => 0, 'message' => $message];
			}
		}
	}

	//晒单审核
	public function actionVerify()
	{
		$id = Yii::$app->request->get('id');
		$model = ShareTopic::findOne($id);
		if ($model) {
			$isPass = Yii::$app->request->get('is_pass');
			if ($isPass) {
				$model->is_pass = $isPass;
				$model->save();
				return $this->redirect(Yii::$app->request->referrer);
			} else {
				if ($model['is_pass'] == 1) {
					$model->is_pass = 2;
				} elseif ($model['is_pass'] == 2) {
					$model->is_pass = 1;
				}
				$model->save();
				return $this->redirect(Yii::$app->request->referrer);
			}

		}
	}

	/**
	 * @pass
	 * @return string
	 */
	public function actionCommentList()
	{
		$request = Yii::$app->request;
		$shareTopicId = $request->get('id');

		if ($request->isAjax) {
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 20);

			$condition['account'] = $request->get('account');
			$condition['startTime'] = $request->get('startTime');
			$condition['endTime'] = $request->get('endTime');

			$data = ShareComment::getList($shareTopicId, $condition, $page, $pageSize);
			$redis = new MyRedis();
			foreach ($data['rows'] as &$one) {
				$key = ShareReply::NEW_TIPS . $one['id'];
				$one['new_tips'] = $redis->get($key) ? 1 : 0;
			}
			$redis->del(ShareComment::NEW_TIPS . $shareTopicId);
			return $data;
		}

		return $this->render('commentlist', ['share_topic_id' => $shareTopicId]);
	}

	/**
	 * @pass
	 * @return string
	 */
	public function actionReplyList()
	{
		$request = Yii::$app->request;
		$shareCommentId = $request->get('id');

		if ($request->isAjax) {
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 20);

			$condition['account'] = $request->get('account');
			$condition['startTime'] = $request->get('startTime');
			$condition['endTime'] = $request->get('endTime');

			$data = ShareReply::adminReplyList($shareCommentId, $condition, $page, $pageSize);
			$redis = new MyRedis();
			$redis->del(ShareReply::NEW_TIPS . $shareCommentId);
			return $data;
		}

		return $this->render('replylist', ['share_comment_id' => $shareCommentId]);
	}

	/**
	 * @pass
	 * @return string
	 */
	public function actionSetPicture()
	{
		$basename = Yii::$app->request->get('basename');//图片名称
		$shareTopicId = Yii::$app->request->get('share_topic_id');//晒单id
		$size = Yii::$app->request->get('size');//图片通途，主图、滚动图、推荐图
		$sourceFilePath = Image::getShareInfoFullPath($basename, 'share');//原图路径
		$sourceFilePath = Yii::$app->sftp->getSFtpPath($sourceFilePath);
		$params['angle'] = Yii::$app->request->get('angle');//
		$params['x'] = Yii::$app->request->get('x');//x轴偏移、定位
		$params['y'] = Yii::$app->request->get('y');//y轴偏移、定位
		$params['w'] = Yii::$app->request->get('w');//图片宽度
		$params['h'] = Yii::$app->request->get('h');//图片高度

		$newbasename = Image::generateName() . '.jpg';
		$trans = Yii::$app->db->beginTransaction();
		try {
			$shareTopicImage = ShareTopicImage::findOne(['basename' => $basename, 'share_topic_id' => $shareTopicId]);
			$shareTopic = ShareTopic::findOne($shareTopicId);

			if ($size == 'main') {
				$delname = $shareTopic->header_image;
				$shareTopic->header_image = $newbasename;
				$shareTopicImage->main = 1;
			} elseif ($size == 'roll') {
				$delname = $shareTopic->roll_image;
				$shareTopic->roll_image = $newbasename;
				$shareTopicImage->roll = 1;
			} elseif ($size == 'recommend') {
				$delname = $shareTopic->recommend_image;
				$shareTopic->recommend_image = $newbasename;
				$shareTopicImage->recommend = 1;
			} elseif ($size == 'mobile') {
				$shareTopicImage->mobile = 1;
			}

			ShareTopicImage::updateAll([$size => 0], ['share_topic_id' => $shareTopicId]);

			if (!$shareTopic->save()) {
				$trans->rollBack();

				return 0;
			}

			if (!$shareTopicImage->save()) {
				$trans->rollBack();
				return 0;
			}

			if ($delname) {
				Image::deleteShareInfoImage($delname);
			}

			Image::createShareInfoImage($sourceFilePath, $newbasename, $size, $params);
			$trans->commit();
			return 1;
		} catch (\Exception $e) {
			$trans->rollBack();
			return 0;
		}
	}

	/**
	 * @pass
	 * @return string
	 */
	public function actionEditComment()
	{
		$shareCommentId = Yii::$app->request->get('id');
		$shareComment = ShareComment::findOne($shareCommentId);

		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			$shareComment->content = $post['content'];
			if ($shareComment->save()) {
				return 1;
			} else {
				return 0;
			}
		}

		return $this->render('editcomment', ['shareComment' => $shareComment]);
	}

	/**
	 * @pass
	 * @return string
	 */
	public function actionEditReply()
	{
		$shareReplyId = Yii::$app->request->get('id');
		$shareReply = ShareReply::findOne($shareReplyId);

		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			$shareReply->content = $post['content'];
			if ($shareReply->save()) {
				return 1;
			} else {
				return 0;
			}
		}

		return $this->render('editreply', ['shareReply' => $shareReply]);
	}

	/**
	 * @pass
	 * @return string
	 */
	public function actionDeleteComment()
	{
		$request = Yii::$app->request;
		if ($request->isAjax) {
			$id = $request->get('id');
			$ids = explode(',', $id);
			foreach ($ids as $commentId) {
				$trans = Yii::$app->db->beginTransaction();
				try {
					$comment = ShareComment::find()->where(['id' => $commentId])->one();
					if ($comment) {
						$shareTopicId = $comment['share_topic_id'];
						if (!$comment->delete()) {
							$trans->rollBack();
						}

						ShareReply::deleteAll(['share_comment_id' => $commentId]);

						$shareTopic = ShareTopic::find()->where(['id' => $shareTopicId])->one();
						if ($shareTopic->comment_num) {
							$shareTopic->comment_num -= 1;
							if (!$shareTopic->save()) {
								$trans->rollBack();
							}
						}
					}

					$trans->commit();
				} catch (\Exception $e) {
					$trans->rollBack();
				}
			}
			return ['error' => 0, 'message' => '删除成功'];
		}
	}

	/**
	 * @pass
	 * @return string
	 */
	public function actionDeleteReply()
	{
		$shareReplyId = Yii::$app->request->get('id');
		ShareReply::deleteAll(['id' => $shareReplyId]);
		return ['error' => 0, 'message' => '删除成功'];
	}

	/**
	 * @pass
	 * @return string
	 */
	public function actionCommentReply()
	{
		$request = Yii::$app->request;

		if ($request->isAjax) {
			ShareReply::addReply($request->post());
			return ['error' => 0, 'message' => '回复成功'];
		}
	}

	/**
	 * @pass
	 * @return string
	 */
	public function actionShowPic()
	{
		$request = Yii::$app->request;

		if ($request->isAjax) {
			$is_show = $request->get('is_show');
			$basename = $request->get('basename');
			ShareTopicImage::updateAll(['is_show' => $is_show], ['basename' => $basename]);
			return ['error' => 0, 'message' => '设置成功'];
		}
	}

	/**
	 * @pass
	 */
	public function actionSwitch()
	{
		$request = Yii::$app->request;

		if ($request->isAjax) {
			$redis = new MyRedis();
			$key = self::SWITCH_SHARE;
			$status = $redis->get($key);
			if ($status) {
				$redis->set($key, 0);
			} else {
				$redis->set($key, 1);
			}
			return ['error' => 0, 'message' => '设置成功'];
		}
	}

	/**
	 * @pass
	 */
	public function actionApproveComment()
	{
		$request = Yii::$app->request;

		if ($request->isAjax) {
			$id = $request->post('id');
			$ids = explode(',', $id);
			foreach ($ids as $commentid) {
				$comment = ShareComment::findOne($commentid);
				$shareTopic = ShareTopic::findOne($comment['share_topic_id']);
				if ($comment['status'] == 1) {
					$comment->status = 0;
					$shareTopic->comment_num && $shareTopic->comment_num -= 1;
				} else {
					$comment->status = 1;
					$shareTopic->comment_num += 1;
				}
				$comment->save();
				$shareTopic->save();
			}
			return ['error' => 0, 'message' => '审核成功'];
		}
	}

	/**
	 * @pass
	 */
	public function actionApproveReply()
	{
		$request = Yii::$app->request;

		if ($request->isAjax) {
			$id = $request->post('id');
			$ids = explode(',', $id);
			foreach ($ids as $replyid) {
				$reply = ShareReply::findOne($replyid);
				if ($reply['status'] == 1) {
					$reply->status = 0;
				} else {
					$reply->status = 1;
				}
				$reply->save();
			}
			return ['error' => 0, 'message' => '审核成功'];
		}
	}

	/**
	 * @pass
	 * @return string
	 */
	public function actionAllComment()
	{
		$request = Yii::$app->request;

		if ($request->isAjax) {
			$page = $request->get('page', 1);
			$pageSize = $request->get('rows', 20);

			$condition['account'] = $request->get('account');
			$condition['startTime'] = $request->get('startTime');
			$condition['endTime'] = $request->get('endTime');
			$condition['status'] = $request->get('status');

			$data = ShareComment::getList('', $condition, $page, $pageSize);
			$redis = new MyRedis();
			foreach ($data['rows'] as &$one) {
				$key = ShareReply::NEW_TIPS . $one['id'];
				$one['new_tips'] = $redis->get($key) ? 1 : 0;
				$redis->del(ShareComment::NEW_TIPS . $one['share_topic_id']);
			}
			return $data;
		}

		return $this->render('allcomment');
	}
}
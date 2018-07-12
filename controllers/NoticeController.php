<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/11/9
 * Time: 下午3:11
 */
namespace app\controllers;

use Yii;
use app\helpers\Message;
use app\models\NoticeTemplate;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class NoticeController extends BaseController
{

    public function actionIndex()
    {

        if (Yii::$app->request->isAjax) {

            $page = Yii::$app->request->get('page', '1');
            $perpage = Yii::$app->request->get('rows', '20');


//        $query = NoticeTemplate::find();
//        $countQuery = clone $query;
//        $totalCount = $countQuery->count();
//        $pagination = new Pagination(['totalCount'=>$totalCount, 'defaultPageSize'=>20]);
//        $list = $query->orderBy('id asc')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();


            //	$users = User::find()->select('count(1) as count,spread_source')->groupBy('spread_source')->asArray()->all();

            $query = NoticeTemplate::find();
            $countQuery = clone $query;
            //$users = new Pagination(['defaultPageSize' => $perpage, 'totalCount' => $query->count(), 'page' => $page - 1]);
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $perpage]);
            $list = $query->offset($pages->offset)->limit($perpage)->asArray()->all();

        foreach ($list as &$one) {
            $ways = explode(',', $one['notice_way']);
            $one['ways'] = '';
            if (in_array(NoticeTemplate::WAY_SMS, $ways)) {
                $one['ways'] .= '短信&';
            }

            if (in_array(NoticeTemplate::WAY_EMAIL, $ways)) {
                $one['ways'] .= '邮箱&';
            }
            if (in_array(NoticeTemplate::WAY_SYSMSG, $ways)) {
                $one['ways'] .= '站内信&';
            }
            if (in_array(NoticeTemplate::WAY_WECHAT, $ways)) {
                $one['ways'] .= '微信&';
            }
            if (in_array(NoticeTemplate::WAY_APP, $ways)) {
                $one['ways'] .= 'APP&';
            }
            $one['ways'] = rtrim($one['ways'], '&');
            if ($one['status']) {
                $one['statusname'] = '启用';
            } else {
                $one['statusname'] = '禁用';
            }
        }
            /*****/

            $data['total'] = $countQuery->count();
            $data['rows'] = array_values($list);;
            return $data;


        } else {
            return $this->render('index');
        }
    }

    public function actionEdit()
    {
        $request = \Yii::$app->request;
        $id = $request->get('id');
        $model = NoticeTemplate::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('页面找不到');
        }
        if ($request->isPost) {
            if ($model->load($request->post())) {
                $model->notice_way = implode(',', $model->notice_way);
                $model->op_user = \Yii::$app->admin->id;
                $model->updated_at = time();
                if ($model->validate()) {
                    $model->save(false);
                    $noticeTypesKey = '__notice_template_types_arr__';
                    $cache = Yii::$app->cache;
                    $cache->delete($noticeTypesKey);
                    \Yii::$app->session->setFlash('success', '保存成功');
                    return $this->refresh();
                }
            }
        }
        $model->notice_way = explode(',', $model->notice_way);
        return $this->render('edit', [
            'model' => $model
        ]);
    }

    public function actionParams()
    {
        $params = Message::$replace;
        return $this->render('params', [
            'params' => $params,
        ]);
    }


}
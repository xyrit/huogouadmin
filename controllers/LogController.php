<?php
/**
 * Created by PhpStorm.
 * User: zhangjicheng
 * Date: 15/9/18
 * Time: 14:54
 */

namespace app\controllers;

use app\helpers\Ip;
use app\models\Admin;
use app\models\BackstageLog;
use app\models\LoginLog;
use app\models\Menu;
use app\models\NoticeMessage;
use app\models\NoticeTemplate;
use app\models\User;
use yii\data\Pagination;
use Yii;
use yii\helpers\ArrayHelper;

class LogController extends BaseController
{
    public function actionLoginLog()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $page = $request->get('page', 0);
            $pageSize = $request->get('rows', 25);
            $where['startTime'] = $request->get('startTime', '');
            $where['endTime'] = $request->get('endTime', '');
            $where['content'] = $request->get('content', '');
            $where['type'] = $request->get('type', 'all');
            $list = LoginLog::fetchAllRecords($where, $page, $pageSize);
            $userids = ArrayHelper::getColumn($list['rows'], 'user_id');
            $userInfos = \app\services\User::baseInfo($userids);

            foreach($list['rows'] as &$val){
                $val['phone'] = $userInfos[$val['user_id']]['phone'];
                $val['email'] = $userInfos[$val['user_id']]['email'];
                $val['ip'] = long2ip($val['ip']);
            }

            return $list;
        }

        return $this->render('login-log');
    }

    //后台操作日志
    public function actionBackstageLog()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $page = $request->get('page', 0);
            $pageSize = $request->get('rows', 20);
            $where['startTime'] = $request->get('startTime', '');
            $where['endTime'] = $request->get('endTime', '');
            $where['content'] = $request->get('content', '');
            $where['module'] = $request->get('module', 'all');
            $list = BackstageLog::fetchAllRecords($where, $page, $pageSize);
            foreach ($list['rows'] as &$val) {
                $admin = Admin::findOne($val['admin_id']);
                $val['admin'] = $admin['real_name'];
            }

            return $list;
        }

        return $this->render('backstage-log');
    }

    //通知发送日志
    public function actionMessageLog()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $page = $request->get('page', 0);
            $pageSize = $request->get('rows', 25);
            $where['startTime'] = $request->get('startTime', '');
            $where['endTime'] = $request->get('endTime', '');
            $where['content'] = $request->get('content', '');
            $where['status'] = $request->get('status', 'all');
            $where['type'] = $request->get('type', 'all');
            $where['type_name'] = $request->get('type_name', '');
            $list = NoticeMessage::getList($where, $page, $pageSize);

            foreach ($list['rows'] as &$val) {
                $userinfo = User::find()->where(['or', 'email="'.$val['user_id'].'"', 'phone="'.$val['user_id'].'"', 'id="'.$val['user_id'].'"'])->one();
                $val['phone'] = $userinfo['phone'];
                $val['email'] = $userinfo['email'];
            }

            return $list;
        }

        return $this->render('message-log');
    }

    /**
     * @pass
     * 获取通知日志类型
     * @return array
     */
    public function actionGetLogType()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $noticeTemplate = NoticeTemplate::find()->all();

            $list = [];
            foreach ($noticeTemplate as $notice) {
                $tmp['id'] = $notice['desc'];
                $tmp['text'] = $notice['desc'];
                $list[] = $tmp;
            }

            return $list;
        }
    }

    /**
     * @pass
     * @return array
     */
    public function actionGetModule()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $menus = Menu::find()->asArray()->all();
            $menuTree = Menu::menuTree($menus);

            $tree = [['id' => 0, 'text' => '所有']];
            $tmp1 = [];
            foreach ($menuTree as $key => $menu) {
                $tmp2 = [];
                $tmp2['id'] = $menu['id'];
                $tmp2['text'] = $menu['text'];
                foreach ($menu['children'] as $m) {
                    $tmp3 = [];
                    $tmp3['id'] = $m['id'];
                    $tmp3['text'] = $m['text'];
                    $tmp3['children'] = [];
                    $tmp2['children'][] = $tmp3;
                }
                $tmp1[] = $tmp2;
            }
            $tree[0]['children'] = $tmp1;

            return $tree;
        }
    }

}
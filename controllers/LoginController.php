<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/9/18
 * Time: 下午5:51
 */

namespace app\controllers;

use app\helpers\Message;
use app\models\LoginForm;
use app\models\Admin;
use app\models\NoticeTemplate;
use app\models\IpBlacklist;
use app\services\User;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;

class LoginController extends Controller
{

    public function actionIndex()
    {
        $admin = Yii::$app->admin;
        $request = Yii::$app->request;
        if (!$admin->isGuest) {
            return $this->redirect(['default/index']);
        }
        $smscode = $request->post('yzm');
        //根据用户查询手机号
        $name = $request->post('LoginForm')['username'];

        $admininfo = Admin::find()->where(['username' => $name])->asArray()->one();



        $model = new LoginForm();
        if (Yii::$app->request->post()) {
            if ($model->load(Yii::$app->request->post())) {

                $code = $this->getCode($admininfo['phone'], 1);


                if ($this->_isProEnv(DOMAIN)) {
                    if (!$smscode || $smscode != $code) {
                        $model->addError('username', '验证码错误');
                        return $this->render('index', [
                            'model' => $model,
                        ]);
                    }
                }
                    if ($model->login()) {
                        $ip = Yii::$app->request->AdminIP;
                        //登录成功 修改登录时间与登录地址
                        $adminObj = Admin::findOne($model->getAdmin()->id);
                        $adminObj->login_at = time();
                        $adminObj->login_ip = $ip;
                        $adminObj->updated_at = time();
                        $adminObj->save(false);
                        return $this->redirect($admin->returnUrl);

                }

            }
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }
    public function actionCode()
    {
        $request = \Yii::$app->request;
        //根据用户查询手机号
        $type = 1;
        $name = $request->get('account');
        $admininfo = Admin::find()->where(['username' => $name])->asArray()->one();
        $data['code'] = mt_rand(100000, 999999);
        $data['from'] = 1;
        $phone = $admininfo['phone'];

        $cache = \Yii::$app->cache;
        $cylcleKey = __CLASS__ . '__verifyCodeCylcle__' . $phone;
        $cylcleKey = md5($cylcleKey);
        $cylcle = $cache->get($cylcleKey) ?: 0;
        $cylcleDuration = 120;
        $duration = 1800;
        $key = __CLASS__ . '__verifyCode__' . $phone . '_' . $type;
        $key = md5($key);

        $codeInfo = $cache->get($key);
        if (!$codeInfo || !isset($codeInfo['num'])) {
            $codeInfo = [];
            $codeInfo['num'] = 0;
            $codeInfo['code'] = $data['code'];
        }


        //发送频率120s
        if ($cylcle) {
            $arr['code'] = 200;
            $arr['info'] = '发送频率过高';
            echo json_encode($arr);
            exit;
        }
        if ($phone) {

            Message::send($type, $phone, $data);
            $cache->set($cylcleKey, 1, $cylcleDuration);
            $codeInfo['num'] += 1;
            $codeInfo['code'] = $data['code'];
            $cache->set($key, $codeInfo, $duration);

            $arr['code'] = 200;
            $arr['info'] = '发送成功,验证码已发送到手机:' . User::privatePhone($phone);
        } else {
            $arr['code'] = 101;
            $arr['info'] = '发送失败,手机号码或帐号不存在';
        }
        echo json_encode($arr);
    }


    /** 获取验证码
     * @param $to
     * @return bool|mixed
     */
    public static function getCode($to, $type)
    {
        if (empty($to) || empty($type)) {
            return false;
        }
        $key = __CLASS__ . '__verifyCode__' . $to . '_' . $type;
        $key = md5($key);
        $cache = \Yii::$app->cache;
        $codeInfo = $cache->get($key);
        if (empty($codeInfo)) {
            return false;
        }
        $num = $codeInfo['num'];
        $code = $codeInfo['code'];
        return $code;
    }


    private function _isProEnv($domain)
    {

        $ddDomains = [
            'newadmin.huogou.com',
        ];
        if (in_array($domain, $ddDomains)) {
            return true;
        } else {
            return false;
        }
    }



}
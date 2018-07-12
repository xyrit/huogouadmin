<?php
/**
 * Created by PhpStorm.
 * User: zhangjicheng
 * Date: 15/9/18
 * Time: 15:04
 */

namespace app\controllers;

use app\models\BackstageLog;
use app\models\Menu;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;

class BaseController extends Controller
{
    public $enableCsrfValidation = false;
    public $privilege = true;

    public function init()
    {
        parent::init();
        Yii::$app->errorHandler->errorAction = '/error/index';
        $admin = Yii::$app->admin;
        if ($admin->isGuest) {
            return $admin->loginRequired();
        }

        if (Yii::$app->request->isAjax) {
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
        }
    }

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        $route = $this->getRoute();
        $check = $this->checkPrivilege($route);
        if (!$check) {
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            Yii::$app->response->data = array(
                'error' => 1,
                'message' => '暂无权限'
            );

            return false;
        }

        return true;
    }

    public function render($view, $params = [])
    {
        $params['add'] = $this->checkPrivilege($this->getUniqueId() . '/add');
        $params['edit'] = $this->checkPrivilege($this->getUniqueId() . '/edit');
        $params['del'] = $this->checkPrivilege($this->getUniqueId() . '/del');
        return parent::render($view, $params);
    }

    public function checkPrivilege($route)
    {
        if (!Yii::$app->admin->identity) {
            return 0;
        }
        if (Yii::$app->admin->identity->username != 'admin') {
            $module = $this->module;
            $id = $module->controller->id;
            $ids = explode('-', $id);
            $controllerName = '';
            foreach ($ids as $one) {
                $controllerName .= ucfirst($one);
            }
            $controller = $module->controllerNamespace . '\\' . $controllerName . 'Controller';
            $action = $module->requestedAction->actionMethod;
            $func = new \ReflectionMethod($controller, $action);
            $tmp = $func->getDocComment();
            if (strstr($tmp, '@pass')) {
                return 1;
            }
            $privilege = Yii::$app->admin->identity->privilege;
            $menu = Menu::find()->where(['id' => explode(',', $privilege)])->orWhere(['pass' => 0])->all();
            $routes = ArrayHelper::getColumn($menu, 'route');
            if ($this->getUniqueId() != 'default' && !in_array($route, $routes)) {
                return 0;
            }
        }
        return 1;
    }

    public function addLog($content, $admin_id = '')
    {
        $route = $this->getRoute();
        $menu = Menu::findOne(['route' => $route]);
        if (!$menu) {
            $module_id = 0;
        } else {
            $module_id = $menu['parent_id'];
        }
        !$admin_id && $admin_id = Yii::$app->admin->id;
        $model = new BackstageLog($admin_id);
        $model->admin_id = $admin_id;
        $model->module = $module_id;
        $model->content = $content;
        $model->created_at = time();
        $model->save();
    }

    public function addTips($content, $num, $message){
        $this->addLog($content);
        echo json_encode(['error'=>$num ,'message'=>$message]);
        \Yii::$app->end();
    }
}
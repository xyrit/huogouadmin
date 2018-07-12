<?php
/**
 * Created by PhpStorm.
 * User: suyan
 * Date: 2015/10/13
 * Time: 17:26
 */

namespace app\controllers;

use app\models\ProductCategory;
use app\models\Route;
use app\models\Menu;
use yii\data\Pagination;
use yii;
use yii\web\NotFoundHttpException;

class AuthController extends BaseController
{
    public function actionAdd()
    {
        $request = \Yii::$app->request;

        if($request->isPost){
            $model = new Menu();
            $post = $request->post();
            if($model->load($post) && $model->validate()){
                $model->updated_at = time();
                if($model->save()){
                    echo json_encode(['error' => 0,'message' => '新增菜单成功']);
                    Yii::$app->end();
                }
            }
            foreach ($model->errors as $message) {
                echo json_encode(['error' => 1, 'message' => $message]);
                Yii::$app->end();
            }
        }
    }

    public function actionEdit()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = Menu::findOne($id);

        if($request->isPost){
            $post = $request->post();
            if($model->load($post) && $model->validate()){
                $model->updated_at = time();
                if($model->save()){
                    echo json_encode(['error' => 0,'message' => '编辑菜单成功']);
                    Yii::$app->end();
                }
            }
            foreach ($model->errors as $message) {
                echo json_encode(['error' => 1, 'message' => $message]);
                Yii::$app->end();
            }
        }
    }

    public function actionDel()
    {
        $request = \Yii::$app->request;
        if ($request->isAjax) {
            $id = $request->get('id');
            $menu = Menu::findOne($id);

            if (!$menu) {
                return [
                    'error' => 1,
                    'message' => '该菜单不存在'
                ];
            } else {
                $menuChild = Menu::findOne(['parent_id' => $id]);
                if ($menuChild) {
                    return [
                        'error' => 1,
                        'message' => '该菜单有子类，不能删除'
                    ];
                }
                $delete = Menu::deleteAll(['id' => $id]);
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
        }
    }

    public function actionIndex()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 25);
            $condition['status'] = $request->get('status', 'all');
            $condition['url'] = $request->get('url', '');
            $condition['id'] = $request->get('id', '');

            $query = Menu::find();

            if($condition['status'] != 'all') $query->where(['status' => $condition['status']]);
            if($condition['url']) $query->where(['route' => $condition['url']]);
            if($condition['id']) $query->where(['id' => $condition['id']])->orWhere(['parent_id' => $condition['id']]);

            $countQuery = clone $query;
            $pagination = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
            $list = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

            $data['rows'] = $list;
            $data['total'] = $pagination->totalCount;

            return $data;
        }

        return $this->render('index');
    }

    public function actionAddUrl()
    {
        $model = new Route();
        $request = \Yii::$app->request;
        $urllist = Route::findUrl();

        if($request->isPost){
            $post = $request->post();
            if($model->load($post) && $model->validate()){
                $model->created_at = time();
                if($model->save()){
                    return $this->refresh();
                }
            }
        }

        return $this->render('add-url', [
            'model' => $model,
            'urllist' => $urllist,
        ]);
    }

    public function actionMenuList()
    {
        $menu = Menu::find()->where(['pass' => 1])->asArray()->all();
        $menutree = Menu::menuTree($menu);
        $menuItems[] = ['id' => '0', 'text' => '顶级', 'children' => $menutree];
        return $menuItems;
    }

    public function actionRouteList()
    {
        $route = Route::findUrl();
        $routeItems = [];
        foreach ($route as $key => $r) {
            $tmp['id'] = $r;
            $tmp['text'] = $r;
            $routeItems[] = $tmp;
        }
        return $routeItems;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: zhangjicheng
 * Date: 15/9/18
 * Time: 14:54
 */

namespace app\controllers;


use app\models\Brand;
use app\models\TypeBrand;
use Yii;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use app\models\BackstageLog;

class BrandController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $query = Brand::find();
            $keywords = $request->get('keywords', '');
            if ($keywords) {
                $query->where('name like :keywords', [':keywords' => '%' . $keywords . '%']);
                $query->orWhere('alias like :keywords', [':keywords' => '%' . $keywords . '%']);
            }
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 10);
            $pages = new Pagination([
                'defaultPageSize' => $pageSize,
                'totalCount' => $query->count(),
                'page' => $page - 1,
            ]);

            $brands = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
            return ['rows' => $brands, 'total' => $pages->totalCount];
        }

        return $this->render('index');
    }

    // 新增品牌
    public function actionAdd()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $model = new Brand();
            if ($model->load($request->post()) && $model->validate()) {
                $model->create_name = Yii::$app->admin->identity->username;
                $model->created_at = time();
                if ($model->save()) {
                    $name = Yii::$app->request->post('Brand');
                    BackstageLog::addLog(\Yii::$app->admin->id, 4, '新增品牌'.$name['name']);
                    echo json_encode(['error' => 0,'message' => '新增品牌成功']);
                    Yii::$app->end();
                }
            }

            foreach ($model->errors as $message) {
                echo json_encode(['error' => 1, 'message' => $message]);
                Yii::$app->end();
            }
        }

        return $this->render('add');
    }

    // 编辑品牌
    public function actionEdit($id)
    {
        $request = Yii::$app->request;
        $model = Brand::findOne($id);
        if ($request->isPost) {
            if (!$model) {
                echo json_encode(['error' => 1,'message' => '该品牌不存在']);
                Yii::$app->end();
            }

            if ($model->load($request->post()) && $model->validate()) {
                if ($model->save()) {
                    $name = Yii::$app->request->post('Brand');
                    BackstageLog::addLog(\Yii::$app->admin->id, 4, '修改品牌'.$name['name']);
                    echo json_encode(['error' => 0,'message' => '修改品牌成功']);
                    Yii::$app->end();
                }
            }

            foreach ($model->errors as $message) {
                echo json_encode(['error' => 1, 'message' => $message]);
                Yii::$app->end();
            }
        }

        return $this->render('edit', ['brand' => $model]);
    }

    // 删除品牌
    public function actionDel()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            if ($id = $request->get('id')) {
                $model = Brand::findOne($id);

                if (Brand::deleteAll(['id' => $id])) {
                    BackstageLog::addLog(\Yii::$app->admin->id, 4, '删除品牌'.$model['name']);
                    return ['error' => 0, 'message' => '删除品牌成功'];
                }
            }
        }

        return ['error' => 1, 'message' => '删除品牌失败'];
    }

    public function actionList()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $brand = Brand::find()->all();

            $list = [];
            foreach ($brand as $b) {
                $tmp['id'] = $b['id'];
                $tmp['text'] = $b['name'];
                $list[] = $tmp;
            }

            return $list;
        }
    }
}
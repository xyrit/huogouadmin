<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/9/19
 * Time: 上午10:41
 */
namespace app\controllers;

use app\models\ActivityProducts;
use app\models\ProductCategory;
use app\models\ProductCategoryForm;
use app\services\Product;
use yii\web\NotFoundHttpException;
use Yii;
use app\models\BackstageLog;

class ProductCategoryController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $id = $request->get('cat_id', 0);
            $allOrderList = ProductCategory::allOrderList($id);
            if ($allOrderList) {
                if ($id) {
                    $currentCat = ProductCategory::find()->where(['id' => $id])->asArray()->one();
                    if (!$currentCat) {
                        throw new NotFoundHttpException("页面未找到");
                    }
                    array_unshift($allOrderList, $currentCat);
                }
                foreach ($allOrderList as &$cat) {
                    $cat['line'] = ProductCategory::getTrim($cat['level']);
                    $cat['parent_id'] != 0 && $cat['_parentId'] = $cat['parent_id'];
                    $cat['orderId'] = $cat['id'];
                }
            }
            return ['rows' => $allOrderList, 'total' => count($allOrderList)];
        }

        return $this->render('index');
    }

    public function actionAdd()
    {
        $request = \Yii::$app->request;
        $pid = $request->get('pid', 0);

        $formModel = new ProductCategoryForm();
        $formModel->parent_id = $pid;
        if ($request->isPost) {
            if ($formModel->load($request->post()) && $formModel->validate()) {
                $model = new ProductCategory();
                $model->name = $formModel->name;
                $model->parent_id = $formModel->parent_id;
                $model->updated_at = time();
                $model->level = ProductCategory::getLevelByPid($formModel->parent_id);
                if ($model->level > 3) {
                    echo json_encode(['error' => 1,'message' => ['error' => '您所设置的分类已超过三级，请重新设置']]);
                    Yii::$app->end();
                }
                $model->top_id = ProductCategory::getTopIdByPid($formModel->parent_id);
                $orderBy =$request->post('ProductCategoryForm');
                $model->list_order = $orderBy['list_order'];
                if ($model->save()) {
                    BackstageLog::addLog(\Yii::$app->admin->id, 3, '新增分类'.$formModel->name);
                    echo json_encode(['error' => 0,'message' => '新增分类成功']);
                    Yii::$app->end();
                }
            }
            foreach ($model->errors as $message) {
                echo json_encode(['error' => 1, 'message' => $message]);
                Yii::$app->end();
            }
        }
        return $this->render('add', [
            'formModel' => $formModel
        ]);
    }

    public function actionEdit()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $get = $request->get();
            $model = ProductCategory::findOne($get['id']);
            $model->list_order = $get['order'];
            $model->name = $get['name'];
            if ($model->save()) {
                return 0;
            }
        }
    }

    public function actionDel()
    {
        $request = \Yii::$app->request;
        if ($request->isAjax) {
            $id = $request->get('id');
            $children = ProductCategory::children($id);
            if ($children) {
                return [
                    'error' => 1,
                    'message' => '该分类有子类，不能删除'
                ];
            }
            //查询分类下是否有商品
            $products=\app\models\Product::find()->where(['cat_id'=>$id])->asArray()->all();
            if($products)
            {
                return [
                'error' => 1,
                'message' => '该分类下还有商品，不能删除'
            ];
            }
            $activityproducts=ActivityProducts::find()->where(['cat_id'=>$id])->asArray()->all();
            if($activityproducts){
                return [
                    'error' => 1,
                    'message' => '该分类下还有活动商品，不能删除'
                ];
            }

                $delete = ProductCategory::deleteAll(['id' => $id]);
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

    public function actionFirstLevelCategory()
    {
        $category = ProductCategory::firstLevel();

        $data[] = ['id' => 0, 'text' => '所有'];

        foreach ($category as $cate) {
            $tmp['id'] = $cate['id'];
            $tmp['text'] = $cate['name'];
            $data[] = $tmp;
        }

        return $data;
    }

    public function actionAllList()
    {
        $categoryList = ProductCategory::allOrderList();
        $category = ProductCategory::getCategory($categoryList);
        $categoryItems[] = ['id' => 0, 'text' => '所有', 'children' => $category];

        return $categoryItems;
    }

}
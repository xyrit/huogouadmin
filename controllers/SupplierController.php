<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2016/1/14
 * Time: 15:43
 * 供应商管理
 */

namespace app\controllers;

use app\models\Supplier;
use app\models\SupplierProduct;
use Yii;
use yii\helpers\Json;

class SupplierController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 20);
            $condition['name'] = $request->get('name');

            $data = Supplier::getList($condition, $page, $pageSize);
            return $data;
        }

        $params['view'] = $this->checkPrivilege($this->getUniqueId() . '/view');
        return $this->render('index', $params);
    }

    public function actionAdd()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $model = new Supplier();
            $post = $request->post();

            if ($model->load($post) && $model->validate()) {
                $trans = Yii::$app->db->beginTransaction();
                try {
                    $product = $post['Product'];
                    $model->admin_id = Yii::$app->admin->id;
                    $model->created_at = time();
                    $model->product_num = count($product);
                    if (!$model->save()) {
                        $trans->rollBack();
                        foreach ($model->errors as $message) {
                            return Json::encode(['error' => 1, 'message' => $message]);
                        }
                    }

                    foreach ($product as $product_id => $price) {
                        $supplierPorduct = new SupplierProduct();
                        $supplierPorduct->supplier_id = $model->id;
                        $supplierPorduct->product_id = $product_id;
                        $supplierPorduct->price = $price;
                        if (!$supplierPorduct->save()) {
                            $trans->rollBack();
                            foreach ($supplierPorduct->errors as $message) {
                                return Json::encode(['error' => 1, 'message' => $message]);
                            }
                        }
                    }

                    $trans->commit();
                    $this->addLog('新增供应商，编号-' . $model['id']);
                    return Json::encode(['error' => 0,'message' => '新增供应商成功']);
                } catch (\Exception $e) {
                    $trans->rollBack();
                    return Json::encode(['error' => 1, 'message' => $e->getMessage()]);
                }

            }
            foreach ($model->errors as $message) {
                return Json::encode(['error' => 1, 'message' => $message]);
            }
        }

        return $this->render('add');
    }

    public function actionEdit()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = Supplier::findOne($id);

        if ($request->isPost) {
            $post = $request->post();

            if ($model->load($post) && $model->validate()) {
                $trans = Yii::$app->db->beginTransaction();
                try {
                    $product = $post['Product'];
                    $model->product_num = count($product);
                    if (!$model->save()) {
                        $trans->rollBack();
                        foreach ($model->errors as $message) {
                            return Json::encode(['error' => 1, 'message' => $message]);
                        }
                    }

                    //删除
                    SupplierProduct::deleteAll(['supplier_id' => $id]);
                    foreach ($product as $product_id => $price) {
                        $supplierPorduct = new SupplierProduct();
                        $supplierPorduct->supplier_id = $id;
                        $supplierPorduct->product_id = $product_id;
                        $supplierPorduct->price = $price;
                        if (!$supplierPorduct->save()) {
                            $trans->rollBack();
                            foreach ($supplierPorduct->errors as $message) {
                                return Json::encode(['error' => 1, 'message' => $message]);
                            }
                        }
                    }

                    $trans->commit();
                    $this->addLog('编辑供应商，编号-' . $model['id']);
                    return Json::encode(['error' => 0,'message' => '编辑供应商成功']);
                } catch (\Exception $e) {
                    $trans->rollBack();
                    return Json::encode(['error' => 1, 'message' => $e->getMessage()]);
                }
            }
            foreach ($model->errors as $message) {
                return Json::encode(['error' => 1, 'message' => $message]);
            }
        }

        $supplierProduct = SupplierProduct::find()->leftJoin('products', 'supplier_products.product_id=products.id')->select(['supplier_products.*', 'products.name as product_name'])->where(['supplier_products.supplier_id' => $id])->asArray()->all();

        return $this->render('edit', ['model' => $model, 'product' => $supplierProduct]);
    }

    public function actionDel()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $id = $request->post('id');
            $supplier = Supplier::findOne($id);

            if (!$supplier) {
                return ['error' => 1, 'message' => '该菜单不存在'];
            } else {
                $trans = Yii::$app->db->beginTransaction();
                try {
                    if (!$supplier->delete()) {
                        $trans->rollBack();
                        return ['error' => 1, 'message' => '删除供应商失败'];
                    }
                    SupplierProduct::deleteAll(['supplier_id' => $id]);
                    $trans->commit();
                    $this->addLog('删除供应商，编号-' . $id);
                    return ['error' => 0, 'message' => '删除供应商成功'];
                } catch (\Exception $e) {
                    return ['error' => 1, 'message' => $e->getMessage()];
                }
            }
        }
    }

    public function actionView()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = Supplier::findOne($id);
        $supplierProduct = SupplierProduct::find()->leftJoin('products', 'supplier_products.product_id=products.id')->select(['supplier_products.*', 'products.name as product_name'])->where(['supplier_products.supplier_id' => $id])->asArray()->all();

        return $this->render('view', ['model' => $model, 'product' => $supplierProduct]);
    }

    public function actionList()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $supplier = Supplier::find()->all();
            $data = [];
            foreach ($supplier as $one) {
                $tmp['id'] = $one['id'];
                $tmp['name'] = $one['name'];
                $data[] = $tmp;
            }

            return $data;
        }
    }

    public function actionProductList()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $id = $request->get('id');
            $supplierProduct = SupplierProduct::find()->leftJoin('products', 'supplier_products.product_id=products.id')->select(['supplier_products.*', 'products.name as product_name'])->where(['supplier_products.supplier_id' => $id])->asArray()->all();
            $data = [];
            foreach ($supplierProduct as $one) {
                $tmp['id'] = $one['product_id'];
                $tmp['name'] = $one['product_name'];
                $data[] = $tmp;
            }

            return $data;
        }
    }

    public function actionProductPrice()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $supplierId = $request->post('supplier_id');
            $productId = $request->post('product_id');
            $supplierProduct = SupplierProduct::findOne(['supplier_id' => $supplierId, 'product_id' => $productId]);

            $data['price'] = $supplierProduct ? $supplierProduct['price'] : 0;
            return $data;
        }
    }
}
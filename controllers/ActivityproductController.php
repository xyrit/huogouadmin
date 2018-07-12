<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/9/19
 * Time: 上午10:38
 */
namespace app\controllers;

use app\models\Admin;
use app\models\CategoryBrand;
use app\models\ActivityProducts;
use app\models\PkProductImages;
use app\models\ProductCategory;
use app\models\Image;
use app\models\ProductStoreLog;
use app\models\UploadForm;
use app\services\Category;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\Response;
use yii\web\UploadedFile;
use app\models\BackstageLog;

class ActivityproductController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $condition = [];
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 10);
            $condition['bn'] = $request->get('bn', '');
            $condition['name'] = $request->get('name', '');
            $condition['cat_id'] = $request->get('cat_id', '');
            $condition['marketable'] = $request->get('marketable', 'all');
            $condition['allow_share'] = $request->get('allow_share', 'all');
            $condition['sort'] = $request->get('sort', '');
            $condition['order'] = $request->get('order', '');

            $data = ActivityProducts::getList($condition, $page, $pageSize);

            $cate = ProductCategory::find()->indexBy('id')->asArray()->all();
            foreach ($data['rows'] as &$one) {
                $one['cat_name'] = $cate[$one['cat_id']]['name'];
            }

            return $data;
        }

        return $this->render('index');
    }

    public function actionAdd()
    {
        $allCat = ProductCategory::allOrderList();
        $categoryItems = [];
        if ($allCat) {
            foreach ($allCat as $cat) {
                $categoryItems[$cat['id']] = ProductCategory::getLine($cat['level']) . $cat['name'];
            }
        }
        $model = new ActivityProducts();
        $model->marketable = 2;
        $model->allow_share = 1;
        $model->is_recommend = 0;
        $model->list_order = 0;

        $request = Yii::$app->request;
        if ($request->isPost) {
            $post = $request->post();
            $model->display = $post['ActivityProducts']['display'];
            $post['ActivityProducts']['delivery_id'] = isset($post['ActivityProducts']['delivery_id']) ? implode(',', $post['ActivityProducts']['delivery_id']) : '';
            $post['ActivityProducts']['activity_id'] = isset($post['ActivityProducts']['activity_id']) ? implode(',', $post['ActivityProducts']['activity_id']) : '';
            if ($model->load($post)) {
                $trans = Yii::$app->db->beginTransaction();
                try {
                    if ($post['ActivityProducts']['activity_id'] = 1 && ($post['ActivityProducts']['price'] % 2 == 1)) {
                        return Json::encode(['error' => 1, 'message' => '价格请填写偶数']);
                    }

                    $album = $request->post('album');
                    $time = time();
                    $model->updated_at = $time;
                    $model->created_at = $time;

                    if ($model->validate()) {

                        $model->save();
                        if ($album) {
                            $this->addProductImages($model->id, $album);
                        }
                        //添加到商品分类关联表
                        $post = $request->post('ActivityProducts');
                        $brandModel = CategoryBrand::find()->where(['and', 'cat_id=' . $post['cat_id'], 'brand_id=' . $post['brand_id']])->one();
                        if ($brandModel) {
                            $brandModel->product_num = $brandModel['product_num'] + 1;
                            if (!$brandModel->save()) {
                                $trans->rollBack();
                                foreach ($brandModel->errors as $message) {
                                    return Json::encode(['error' => 1, 'message' => $message]);
                                }
                            }
                        } else {
                            $categoryBrand = new CategoryBrand();
                            $categoryBrand->cat_id = $post['cat_id'];
                            $categoryBrand->brand_id = $post['brand_id'];
                            $categoryBrand->product_num = 1;
                            if (!$categoryBrand->save()) {
                                $trans->rollBack();
                                foreach ($categoryBrand->errors as $message) {
                                    return Json::encode(['error' => 1, 'message' => $message]);
                                }
                            }
                        }
                        $trans->commit();
                        $this->addLog('新增产品' . $post['name'], Yii::$app->admin->id);
                        return Json::encode(['error' => 0, 'message' => '新增产品成功']);
                    } else {
                        $trans->rollBack();
                        foreach ($model->errors as $message) {
                            return Json::encode(['error' => 1, 'message' => $message]);
                        }
                    }
                } catch (\Exception $e) {
                    $trans->rollBack();
                    return Json::encode(['error' => 1, 'message' => $e->getMessage()]);
                }
            } else {
                var_dump($model->getErrors());
                exit;
            }
        }
        return $this->render('add', [
            'deliveryItems' => ActivityProducts::$deliveries,
            'virtualdeliverieItems' => ActivityProducts::$virtual_deliveries         //虚拟
        ]);
    }

    private function addProductImages($productId, $pictures)
    {
        foreach ($pictures as $pic) {
            $pkproductImage = new PkProductImages();
            $pkproductImage->basename = $pic;
            $pkproductImage->product_id = $productId;
            $pkproductImage->save();
        }
    }

    public function actionEdit()
    {

        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = ActivityProducts::findOne($id);
        if (!$model) {
            return Json::encode(['error' => 1, 'message' => '该商品不存在']);
        }

        $productImage = PkProductImages::findAll(['product_id' => $model->id]);
        if ($productImage) {
            $pictures = ArrayHelper::getColumn($productImage, 'basename');
            $info = [];
            foreach ($pictures as $basename) {
                $info[] = [
                    'basename' => $basename,
                    'url' => Image::getProductUrl($basename, 200, 200),
                ];
            }
            $pictures = $info;
        } else {
            $pictures = [];
        }

        $request = Yii::$app->request;
        if ($request->isPost) {
            $post = $request->post('ActivityProducts');

            if ($post['activity_id'] = 1 && ($post['price'] % 2 == 1)) {
                return Json::encode(['error' => 1, 'message' => '价格请填写偶数']);
            }

            $trans = Yii::$app->db->beginTransaction();
            try {
                //更新商品分类关联表
                if (($post['cat_id'] != $model['cat_id'] || $post['brand_id'] != $model['brand_id'])) {
                    $productModel = CategoryBrand::find()->where(['and', 'cat_id=' . $model['cat_id'], 'brand_id=' . $model['brand_id']])->one();

                    if ($productModel) {
                        $num = $productModel['product_num'] - 1;
                        $num = $num < 0 ? 0 : $num;
                        $productModel->product_num = $num;
                        if (!$productModel->save()) {
                            $trans->rollBack();
                            foreach ($productModel->errors as $message) {
                                return Json::encode(['error' => 1, 'message' => $message]);
                            }
                        }
                    }
                    $brandModel = CategoryBrand::find()->where(['and', 'cat_id=' . $post['cat_id'], 'brand_id=' . $post['brand_id']])->one();

                    if ($brandModel) {
                        $brandModel->product_num = $brandModel['product_num'] + 1;
                        if (!$brandModel->save()) {
                            $trans->rollBack();
                            foreach ($brandModel->errors as $message) {
                                return Json::encode(['error' => 1, 'message' => $message]);
                            }
                        }
                    } else {
                        $categoryBrand = new CategoryBrand();
                        $categoryBrand->cat_id = $post['cat_id'];
                        $categoryBrand->brand_id = $post['brand_id'];
                        $categoryBrand->product_num = 1;
                        if (!$categoryBrand->save()) {
                            $trans->rollBack();
                            foreach ($categoryBrand->errors as $message) {
                                return Json::encode(['error' => 1, 'message' => $message]);
                            }
                        }
                    }
                } else {
                    $productModel = CategoryBrand::find()->where(['and', 'cat_id=' . $model['cat_id'], 'brand_id=' . $model['brand_id']])->one();
                    if (!$productModel) {
                        $categoryBrand = new CategoryBrand();
                        $categoryBrand->cat_id = $model['cat_id'];
                        $categoryBrand->brand_id = $model['brand_id'];
                        $categoryBrand->product_num = 1;
                        if (!$categoryBrand->save()) {
                            $trans->rollBack();
                            foreach ($categoryBrand->errors as $message) {
                                return Json::encode(['error' => 1, 'message' => $message]);
                            }
                        }
                    }
                }

                $post = $request->post();
                $post['ActivityProducts']['delivery_id'] = isset($post['ActivityProducts']['delivery_id']) ? implode(',', $post['ActivityProducts']['delivery_id']) : '';
                $post['ActivityProducts']['activity_id'] = isset($post['ActivityProducts']['activity_id']) ? implode(',', $post['ActivityProducts']['activity_id']) : '';
                if ($model->load($post)) {
                    $model->updated_at = time();
                    if ($model->validate()) {
                        if (!$model->save()) {
                            $trans->rollBack();
                            foreach ($model->errors as $message) {
                                return Json::encode(['error' => 1, 'message' => $message]);
                            }
                        }
                        if ($album = $request->post('album')) {
                            $this->addProductImages($model->id, $album);
                        }
                        $trans->commit();
                        $this->addLog('修改产品' . $model['name'], Yii::$app->admin->id);

                        return Json::encode(['error' => 0, 'message' => '编辑商品成功']);

                    } else {
                        $trans->rollBack();
                        foreach ($model->errors as $message) {
                            return Json::encode(['error' => 1, 'message' => $message]);
                        }
                    }
                }
            } catch (\Exception $e) {
                return Json::encode(['error' => 1, 'message' => $e->getMessage()]);
            }
        }

        $data = [
            'model' => $model,
            'delivery' => $model['delivery_id'],
            'pictures' => $pictures,
            'page' => $request->get('page'),
            'deliveryItems' => ActivityProducts::$deliveries,
            'virtualdeliverieItems' => ActivityProducts::$virtual_deliveries         //虚拟
        ];
        return $this->render('edit', $data);
    }

    public function actionDel()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $id = $request->post('id');
            $model = ActivityProducts::findOne($id);
            if ($model->marketable != 2) {
                return [
                    'error' => 1,
                    'message' => '只有新增商品才能删除'
                ];
            }
            $trans = Yii::$app->db->beginTransaction();
            try {
                $brandModel = CategoryBrand::find()->where(['and', 'cat_id=' . $model['cat_id'], 'brand_id=' . $model['brand_id']])->one();

                if (($brandModel['product_num'] - 1) <= 0) $num = 0;
                else $num = $brandModel['product_num'] - 1;
                $brandModel->product_num = $num;
                if (!$brandModel->save()) {
                    $trans->rollBack();
                    foreach ($brandModel->errors as $message) {
                        return ['error' => 1, 'message' => $message];
                    }
                }

                if (!ActivityProducts::deleteAll(['id' => $id])) {
                    $trans->rollBack();
                    return ['error' => 1, 'message' => '删除失败'];
                }

                $trans->commit();
                $this->addLog('删除产品' . $model['name'], Yii::$app->admin->id);
                return ['error' => 0, 'message' => '删除成功'];
            } catch (\Exception $e) {
                return ['error' => 1, 'message' => $e->getMessage()];
            }
        }
    }

    // 上、下架
    public function actionMarket()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $id = $request->post('id');
            $market = $request->post('market');
            $marketMsg = $market ? '上架' : '下架';

            $product = ActivityProducts::findOne($id);
            if (!$product) {
                return ['error' => 1, 'message' => '该商品不存在'];
            }

            if ($product->marketable == $market) {
                return ['error' => 1, 'message' => '该商品已' . $marketMsg];
            }

            if (!ActivityProducts::market($product, $market)) {
                return ['error' => 1, 'message' => $marketMsg . '失败', 'id' => $id];
            }

            $this->addLog($marketMsg . '产品' . $product['name'], Yii::$app->admin->id);
            return ['error' => 0, 'message' => $marketMsg . '成功'];
        }
    }

    //验证推荐
    public function actionCheckRecommand()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $count = ActivityProducts::find()->where(['is_recommend' => 1])->count();
            if ($count > 9) {
                return [
                    'error' => 1,
                    'message' => '推荐数已超过9个',
                ];
            }
        }
    }

    public function actionUploadImage()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstanceByName('imageFile');
            if ($uploadData = $model->uploadProduct()) {
                // file is uploaded successfully
                $response = Yii::$app->response;
                $response->format = Response::FORMAT_JSON;
                return Json::encode($uploadData);
            }
        }
    }

    public function actionUploadInfoImage()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstanceByName('imgFile');
            if ($uploadData = $model->uploadProductInfo()) {
                // file is uploaded successfully
                echo Json::encode($uploadData);
            }
        }
    }

    public function actionDeleteProductImage()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $productId = $request->post('product_id', 0);
            $picture = $request->post('picture', 0);
            $productImage = PkProductImages::findOne(['product_id' => $productId, 'basename' => $picture]);

            if ($productImage) {
                Image::deleteProductImage($picture);
                $product = PkProductImages::findOne(['id' => $productId, 'basename' => $picture]);
                if ($product) {
                    $product->picture = '';
                    $product->save(false);
                }
                $productImage->delete();
            }
        }
        return true;
    }

    public function actionDeleteImage()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $picture = $request->post('picture', 0);
            if ($picture) {
                Image::deleteProductImage($picture);
            }

        }
        return true;
    }

    // 库存清单
    public function actionStoreList()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $condition = [];
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 10);
            $condition['id'] = $request->get('id', '');
            $condition['name'] = $request->get('name', '');
            $condition['cat_id'] = $request->get('cat_id', '');
            $condition['marketable'] = $request->get('marketable', 'all');
            $condition['allow_share'] = $request->get('allow_share', 'all');
            $condition['sort'] = $request->get('sort', '');
            $condition['order'] = $request->get('order', '');
            $data = ActivityProducts::getList($condition, $page, $pageSize);

            foreach ($data['rows'] as &$val) {
                $val['cat_id'] = Category::getCatName($val['cat_id'], 1);
            }

            return $data;
        }
        $params['edit'] = $this->checkPrivilege($this->getUniqueId() . '/edit-store');
        return $this->render('store_list');
    }

    // 修改库存
    public function actionEditStore()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $id = $request->post('id');
            $model = ActivityProducts::findOne($id);
            $beforeTotal = $model['total'];
            if (!$model) {
                echo json_encode(['error' => 1, 'message' => '商品不存在']);
                Yii::$app->end();
            }
            $model->total = $request->post('total');
            if ($model->save()) {
                ProductStoreLog::insertRecord($model['id'], 3, 0, $beforeTotal, '将库存由' . $beforeTotal . '修改为' . $request->post('total'));
                echo json_encode(['error' => 0, 'message' => '保存成功']);
                Yii::$app->end();
            } else {
                echo json_encode(['error' => 2, 'message' => '保存失败']);
                Yii::$app->end();
            }
        }
    }

    // 库存详情
    public function actionStoreView()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = ActivityProducts::findOne($id);
        if (!$model) {
            echo json_encode(['error' => 1, 'message' => '商品不存在']);
            Yii::$app->end();
        }
        if ($request->isAjax) {
            $page = $request->get('page', 1);
            $perpage = $request->get('rows', 10);
            $type = $request->get('type', 'all');
            $start = $request->get('start', '');
            $end = $request->get('end', '');
            $query = ProductStoreLog::find()->where('product_id = ' . $id);
            if ($type != 'all') $query->andWhere(['type' => $type]);
            if ($start) $query->andWhere(['>', 'created_at', strtotime($start)]);
            if ($end) $query->andWhere(['<', 'created_at', strtotime($end)]);
            $pagination = new Pagination(['totalCount' => $query->count(), 'page' => $page - 1, 'defaultPageSize' => $perpage]);
            $list = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->asArray()
                ->all();
            foreach ($list as &$val) {
                $admin = Admin::findOne($val['admin_id']);
                $val['admin_id'] = $admin['real_name'];
            }
            return ['rows' => $list, 'total' => $pagination->totalCount];
        }

        $model['picture'] = Image::getProductUrl($model['picture'], 38, 38);
        return $this->render('store-view', [
            'model' => $model
        ]);
    }

    public function actionList()
    {
        $product = ActivityProducts::find()->distinct('name')->asArray()->all();
        $result = [];
        foreach ($product as $p) {
            $tmp['id'] = $p['id'];
            $tmp['name'] = $p['name'];
            $result[] = $tmp;
        }
        return $result;
    }

    public function actionSearch()
    {
        $keywords = Yii::$app->request->post('keywords');
        $sn = Yii::$app->request->post('sn');

        if (!$keywords && !$sn) {
            return [];
        }

        $where = "1 = 1";

        if ($keywords) {
            $where .= " and name like '%" . $keywords . "%' or tag like '%" . $keywords . "%'";
        }

        if ($sn) {
            $where .= " and bn like '%" . $sn . "%'";
        }

        $list = ActivityProducts::find()->where($where)->asArray()->all();

        return $list;
        Yii::$app->end();
    }

    public function actionGetInfo()
    {
        $id = Yii::$app->request->get('pid');
        return ActivityProducts::find()->where(['id' => $id])->asArray()->one();
    }

    public function actionDeliveryItems()
    {
        $val = Yii::$app->request->post('val');
        if ($val == 1) {
            $data['deliveryItems'] = ActivityProducts::$virtual_deliveries;
            $data['code'] = 200;

        } else {
            $data['deliveryItems'] = ActivityProducts::$deliveries;
            $data['code'] = 200;
        }
        return $data;
    }

    /**
     * @pass
     * @return array|\yii\db\ActiveRecord[]
     * @throws \yii\base\ExitException
     */
    public function actionPkSearch()
    {
        $keywords = Yii::$app->request->post('keywords');
        $sn = Yii::$app->request->post('sn');

        if (!$keywords && !$sn) {
            return [];
        }

        $where = "1 = 1";
        if ($keywords) {
            $where .= " and name like '%".$keywords."%' ";
        }
        if ($sn) {
            $where .= " and bn like '%".$sn."%'";
        }

        $list = ActivityProducts::find()->where($where)->asArray()->all();

        return $list;
        Yii::$app->end();
    }

}
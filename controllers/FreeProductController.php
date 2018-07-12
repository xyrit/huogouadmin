<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 16/3/7
 * Time: 上午11:57
 */
namespace app\controllers;

use app\helpers\MyRedis;
use app\models\FreeCurrentPeriod;
use app\models\FreePeriod;
use app\models\FreePeriodBuylistDistribution;
use app\models\FreeProduct;
use app\models\FreeProductImage;
use app\models\Image;
use app\models\UploadForm;
use app\services\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Response;
use yii\web\UploadedFile;
use Yii;

class FreeProductController extends BaseController
{

    public function actionIndex()
    {
        $request = \Yii::$app->request;
        if ($request->isAjax) {
            $condition = [];
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 10);
            $condition['marketable'] = $request->get('marketable','all');
            $data = FreeProduct::getList($condition, $page, $pageSize);
            return $data;
        }

        return $this->render('index');
    }

    public function actionAdd()
    {
        $request = \Yii::$app->request;
        $model = new FreeProduct();
        $model->marketable = 2;
        $model->list_order = 0;
        if ($request->isPost) {
            $post = $request->post();
            $post['FreeProduct']['delivery_id'] = isset($post['FreeProduct']['delivery_id']) ? implode(',', $post['FreeProduct']['delivery_id']) : '';
            if ($post['FreeProduct']['start_type']>1) {
                $post['FreeProduct']['start_time'] = $post['startNum'].$post['FreeProduct']['start_time'];
            }
            if ($model->load($post)) {
                $time = time();
                $model->updated_at = $time;
                $model->created_at = $time;

                if ($model->validate()) {
                    $model->admin_id = \Yii::$app->admin->id;
                    $model->save();
                    if ($album = $request->post('album')) {
                        $this->addProductImages($model->id, $album);
                    }
                    if ($model->marketable==1) {
                        $this->initCurrentPeriod(ArrayHelper::toArray($model));
                    }
                    $this->addLog('新增零元购产品' . $post['FreeProduct']['name'], \Yii::$app->admin->id);
                    return Json::encode(['error' => 0,'message' => '新增产品成功']);
                } else {
                    return Json::encode(['error' => 1, 'message' => current($model->getFirstErrors())]);
                }
            }
        }
        return $this->render('add');
    }

    private function addProductImages($productId, $pictures)
    {
        foreach ($pictures as $pic) {
            $productImage = new FreeProductImage();
            $productImage->basename = $pic;
            $productImage->product_id = $productId;
            $productImage->save();
        }
    }

    public function actionEdit()
    {

        $request = \Yii::$app->request;
        $id = $request->get('id');
        $model = FreeProduct::findOne($id);
        if (!$model) {
            return Json::encode(['error' => 1, 'message' => '该商品不存在']);
        }

        $productImage = FreeProductImage::findAll(['product_id'=>$model->id]);
        if ($productImage) {
            $pictures = ArrayHelper::getColumn($productImage, 'basename');
            $info = [];
            foreach ($pictures as $basename) {
                $info[] = [
                    'basename' => $basename,
                    'url' => Image::getActiveInfoUrl($basename, 'small'),
                ];
            }
            $pictures = $info;
        } else {
            $pictures = [];
        }
        if ($request->isPost) {
            $post = $request->post();
            $post['FreeProduct']['delivery_id'] = isset($post['FreeProduct']['delivery_id']) ? implode(',', $post['FreeProduct']['delivery_id']) : '';
            if ($post['FreeProduct']['start_type']>1) {
                $post['FreeProduct']['start_time'] = $post['startNum'].$post['FreeProduct']['start_time'];
            }
            if ($model->load($post)) {
                $time = time();
                $model->updated_at = $time;

                if ($model->validate()) {
                    $model->save();
                    if ($album = $request->post('album')) {
                        $this->addProductImages($model->id, $album);
                    }
                    if ($model->marketable==1) {
                        $this->initCurrentPeriod(ArrayHelper::toArray($model));
                    }
                    $this->addLog('修改零元购产品' . $post['FreeProduct']['name'], \Yii::$app->admin->id);
                    return Json::encode(['error' => 0,'message' => '修改零元购产品成功']);
                } else {
                    return Json::encode(['error' => 1, 'message' => current($model->getFirstErrors())]);
                }
            }
        }

        $deliveryIds = explode(',', $model['delivery_id']);
        foreach ($deliveryIds as $deliveryId) {
            $delivery[$deliveryId] = $deliveryId;
        }

        $arrStartTime = explode(' ',$model->start_time);
        if ($model->start_type!=0) {
            $model->start_time = ' ' .$arrStartTime[1];
        }
        $startNum = $arrStartTime[0];
        return $this->render('edit',[
            'model' => $model,
            'startNum'=>$startNum,
            'delivery' => $delivery,
            'pictures' => $pictures,
        ]);
    }

    // 上、下架
    public function actionMarket()
    {
        $request = \Yii::$app->request;

        if ($request->isAjax) {
            $id = $request->post('id');
            $market = $request->post('market');
            $marketMsg = $market ? '上架' : '下架';

            $product = FreeProduct::findOne($id);
            if (!$product) {
                return ['error' => 1, 'message' => '该商品不存在'];
            }

            if ($product->marketable == $market) {
                return ['error' => 1, 'message' => '该商品已' . $marketMsg];
            }
            FreeProduct::market($product, $market);
            if ($market==1) {
                $productArr = ArrayHelper::toArray($product);
                $productArr['marketable'] = 1;
                $this->initCurrentPeriod($productArr);
            }
            $this->addLog($marketMsg . '零元购产品' . $product['name'], \Yii::$app->admin->id);
            return ['error' => 0, 'message' => $marketMsg . '成功'];
        }
    }



    public function actionView()
    {

    }

    public function actionLotteryRecord()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $periodNum = $request->get('pnum');

        $product = FreeProduct::findOne($id);
        $productPic = Image::getActiveInfoUrl($product['picture'],'small');

        $currentPeriod = FreeCurrentPeriod::find()->where(['product_id'=>$id])->asArray()->one();
        $periods = FreePeriod::find()->where(['product_id'=>$id])->orderBy('id desc')->asArray()->all();
        if ($currentPeriod) {
            array_unshift($periods,$currentPeriod);
        }
        if (!$periods) {
            echo '没有开奖记录';
            Yii::$app->end();
        }
        if (!$periodNum) {
            $period = $periods[0];
        } else {
            $period = FreeCurrentPeriod::find()->where(['product_id'=>$id,'period_number'=>$periodNum])->asArray()->one();
            if (!$period) {
                $period = FreePeriod::find()->where(['product_id'=>$id,'period_number'=>$periodNum])->asArray()->one();
            }
        }
        $lotteryUser = isset($period['user_id']) ? User::baseInfo($period['user_id']) : [];
        if ($request->isAjax) {
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 10);
            $list = [];
            $total = 0;
            if ($period) {
                $buyList = FreePeriodBuylistDistribution::getBuylist($period['table_id'], $period['id'], $page, $pageSize);
                $list = $buyList['list'];
                foreach($list as &$one) {
                    $user = User::baseInfo($one['user_id']);
                    $one['user'] = $user['phone'] . '<br>' . $user['email'];
                }
                $total = $buyList['total'];
            }
            $data['rows'] = $list;
            $data['total'] = $total;
            return $data;
        }
        return $this->render('lotteryRecord',[
            'get'=>$request->get(),
            'product'=>$product,
            'productPic'=>$productPic,
            'user'=>$lotteryUser,
            'periods'=>$periods,
        ]);
    }

    public function actionUploadImage()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstanceByName('imageFile');
            if ($uploadData = $model->uploadActiveInfo()) {
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
            $productImage = FreeProductImage::findOne(['product_id'=>$productId, 'basename'=>$picture]);
            if ($productImage) {
                $product = FreeProduct::findOne(['id'=>$productId, 'picture'=>$picture]);
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

        return true;
    }

    private function initCurrentPeriod($product)
    {
        $startType = $product['start_type'];
        $startTime = $product['start_time'];
        $afterEnd = $product['after_end'];

        if ($startType == 0) { //具体时间

            $nowTime = strtotime(date('Y-m-d H:00:00'));
            $thisTime = strtotime(date('Y-m-d H:00:00',strtotime($startTime)));
            if ($nowTime>$thisTime) {
                $start = strtotime('+1 hour',$nowTime);
            } else {
                $start = $thisTime;
            }
            $end = $start + 3600 * $afterEnd;
        } elseif ($startType == 1) { //每天
            preg_match('/([0-9]{2}):[0-9]{2}:[0-9]{2}/', $startTime, $matches);
            if (isset($matches[1])) {
                $hour = $matches[1];

                $nowTime = strtotime(date('Y-m-d H:00:00'));
                $thisTime = strtotime(date('Y-m-d '.$hour.':00:00'));

                if ($nowTime>$thisTime) {
                    $start = strtotime('+1 day',$thisTime);
                } else {
                    $start = $thisTime;
                }

                $end = $start + 3600 * $afterEnd;
            }
        } elseif ($startType == 2) { //每周
            preg_match('/([0-6])\s([0-9]{2}):[0-9]{2}:[0-9]{2}/', $startTime, $matches);
            if (isset($matches[1]) && isset($matches[2])) {
                $week = $matches[1];
                $hour = $matches[2];

                $weeks = ['sunday','monday','tuesday','wednesday','thursday','friday','saturday'];
                $nowTime = strtotime(date('Y-m-d H:00:00'));
                $thisTime = strtotime(date('Y-m-d '.$hour.':00:00', strtotime('this '.$weeks[$week])));
                if ($nowTime>$thisTime) {
                    $startTime = date('Y-m-d ' . $hour . ':00:00', strtotime('next '.$weeks[$week]));
                    $start = strtotime($startTime);
                }else {
                    $start = $thisTime;
                }
                $end = $start + 3600 * $afterEnd;

            }
        } elseif ($startType == 3) { //每月
            preg_match('/([1-28])\s([0-9]{2}):[0-9]{2}:[0-9]{2}/', $startTime, $matches);
            if (isset($matches[1]) && isset($matches[2])) {
                $day = $matches[1];
                $hour = $matches[2];

                $nowTime = strtotime(date('Y-m-d H:00:00'));
                $thisTime = strtotime(date('Y-m-'.$day.' '.$hour.':00:00'));
                if ($nowTime>$thisTime) {
                    $startTime = date('Y-m-d ' . $hour . ':00:00', strtotime('next month', $thisTime));
                    $start = strtotime($startTime);
                }else {
                    $start = $thisTime;
                }
                $end = $start + 3600 * $afterEnd;

            }
        }

        $this->startNew($start, $end, $product);
    }

    private function startNew($start, $end, $product)
    {
        //不是上架状态 不进行下一期
        if ($product['marketable'] != 1) {
            return;
        }
        $currentPeriod = FreeCurrentPeriod::find()->where(['product_id' => $product['id']])->asArray()->one();
        if ($currentPeriod) {
            return;
        }
        $oldPeriod = FreePeriod::find()->where(['product_id' => $product['id']])->orderBy('id desc')->asArray()->one();

        if ($oldPeriod) {
            $periodNumber = $oldPeriod['period_number'] + 1;
        } else {
            $periodNumber = 1;
        }
        //达到总期数 进行下架
        if ($periodNumber > $product['total_period']) {
            FreeProduct::updateAll(['marketable'=>0],['id'=>$product['id']]);
            return;
        }


        $model = new FreeCurrentPeriod();
        $model->table_id = FreeCurrentPeriod::generateTableId();
        $model->product_id = $product['id'];
        $model->period_number = $periodNumber;
        $model->sales_num = 0;
        $model->start_time = $start;
        $model->end_time = $end;
        $save = $model->save();

        if ($save) {
            $periodId = $model->id;
            $redis = new MyRedis();
            $redis->set('FREE_PERIOD_CODE_' . $periodId, 10000001);
        }

        return $save;
    }


}
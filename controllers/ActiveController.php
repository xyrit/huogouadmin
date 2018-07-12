<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2016/2/24
 * Time: 13:59
 */

namespace app\controllers;

use app\helpers\DateFormat;
use app\models\Active;
use app\models\Coupon;
use app\models\Image;
use app\models\Packet;
use Yii;
use app\models\UploadForm;
use yii\helpers\Json;
use yii\web\UploadedFile;

class ActiveController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            $active = Active::find()->orderBy('list_order desc, id desc')->all();

            foreach ($active as $one) {
                $one['icon'] = Image::getActiveInfoUrl($one['icon'], 'small');
                $one['created_at'] = DateFormat::microDate($one['created_at']);
            }
            return ['total'=>count($active), 'rows'=>$active];
        }

        return $this->render('index');
    }

    public function actionAdd()
    {
        $request = Yii::$app->request;
        if($request->isPost){
            $post = $request->post();
            $imagModel = new UploadForm();
            $imagModel->imageFile = UploadedFile::getInstanceByName('picture');
            $uploadData = $imagModel->uploadActiveInfo();
            $post['Active']['icon'] = $uploadData['basename'];
            $post['Active']['created_at'] = time();
            $model = new Active();
            if($model->load( $post ) && $model->validate()){
                if($model->save()) $this->addTips('新增活动配置成功', 0, '保存成功');
                else $this->addTips('新增活动配置失败', 2, '保存失败');
            }else{
                $this->addTips('新增活动配置失败', 1, '验证失败');
            }
        }
    }

    public function actionEdit()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = Active::findOne($id);
        if(!$model) return ['error'=>1, 'message'=>'记录不存在'];

        if($request->isPost){
            $post = $request->post();
            if($_FILES['picture']['name']){
                $imagModel = new UploadForm();
                $imagModel->imageFile = UploadedFile::getInstanceByName('picture');
                $uploadData = $imagModel->uploadActiveInfo();
            }
            $post['Active']['icon'] = isset($uploadData['basename']) ? $uploadData['basename'] : $model['icon'];
            $post['Active']['created_at'] = time();
            if($model->load( $post ) && $model->validate()){
                if($model->save()) $this->addTips('修改活动配置成功', 0, '保存成功');
                else $this->addTips('修改活动配置失败', 2, '保存失败');
            }else{
                $this->addTips('修改活动配置失败', 1, '验证失败');
            }
        }

        $model['icon'] = Image::getActiveInfoUrl($model['icon'], 'small');
        return $this->render('edit',['model'=>$model]);
    }

    public function actionDel()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = Active::findOne($id);
        if(!$model) return ['error'=>1, 'message'=>'记录不存在'];

        $name = $model['title'];
        if($model->delete()) $this->addTips('删除活动成功-'.$name, 0, '操作成功');
        else  $this->addTips('删除活动失败-'.$name, 2, '操作失败');
    }

    // 红包列表
    public function actionPacketList()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $packet = Packet::find()->all();

            $list = [];
            foreach ($packet as $one) {
                $tmp['id'] = $one['id'];
                $tmp['name'] = $one['name'];
                $list[] = $tmp;
            }

            return $list;
        }
    }

    // 红包详情
    public function actionPacketDetail()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $id = $request->get('id');

            $packet = Packet::findOne($id);
            if ($packet) {
                $data = [];
                $content = Json::decode($packet['content']);
                $couponIds = array_keys($content);
                $coupons = Coupon::find()->where(['in', 'id', $couponIds])->select(['id', 'name', 'desc'])->indexBy('id')->asArray()->all();
                foreach ($content as $couponId => $num) {
                    $data[$couponId]['name'] = $coupons[$couponId]['name'] . ' * ' . $num;
                    $data[$couponId]['desc'] = $coupons[$couponId]['desc'];
                }
                return $data;
            }
        }
    }
}
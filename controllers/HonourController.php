<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2016/2/24
 * Time: 13:59
 */

namespace app\controllers;

use app\models\HonourDesc;
use Yii;
use app\models\Image;
use app\models\UploadForm;
use yii\web\UploadedFile;

class HonourController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            $active = HonourDesc::find()->all();

            foreach ($active as $one) {
                $one['icon'] = Image::getActiveInfoUrl($one['icon'], 'small');
            }
            return ['total'=>100, 'rows'=>$active];
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
            $post['HonourDesc']['icon'] = $uploadData['basename'];
            $post['HonourDesc']['created_at'] = time();
            $model = new HonourDesc();
            if($model->load( $post ) && $model->validate()){
                if($model->save()) $this->addTips('新增荣誉说明成功', 0, '保存成功');
                else $this->addTips('新增荣誉说明失败', 2, '保存失败');
            }else{
                $this->addTips('新增荣誉说明失败', 1, '验证失败');
            }
        }
    }

    public function actionEdit()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = HonourDesc::findOne($id);
        if(!$model) return ['error'=>1, 'message'=>'记录不存在'];

        if($request->isPost){
            $post = $request->post();
            if($_FILES['picture']['name']){
                $imagModel = new UploadForm();
                $imagModel->imageFile = UploadedFile::getInstanceByName('picture');
                $uploadData = $imagModel->uploadActiveInfo();
            }
            $post['Honour']['icon'] = isset($uploadData['basename']) ? $uploadData['basename'] : $model['icon'];
            $post['Honour']['created_at'] = time();
            if($model->load( $post ) && $model->validate()){
                if($model->save()) $this->addTips('修改荣誉说明成功', 0, '保存成功');
                else $this->addTips('修改荣誉说明失败', 2, '保存失败');
            }else{
                $this->addTips('修改荣誉说明失败', 1, '验证失败');
            }
        }

        $model['icon'] = Image::getActiveInfoUrl($model['icon'], 'small');
        return $this->render('edit',['model'=>$model]);
    }

    public function actionDel()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = HonourDesc::findOne($id);
        if(!$model) return ['error'=>1, 'message'=>'记录不存在'];

        $name = $model['title'];
        if($model->delete()) $this->addTips('删除荣誉说明成功-'.$name, 0, '操作成功');
        else  $this->addTips('删除荣誉说明失败-'.$name, 2, '操作失败');
    }
}
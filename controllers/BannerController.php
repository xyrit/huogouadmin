<?php
/**
 * Created by PhpStorm.
 * User: suyan
 * Date: 2015/10/13
 * Time: 17:26
 */

namespace app\controllers;

use app\helpers\DateFormat;
use app\models\BackstageLog;
use app\models\Banner;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\data\Pagination;
use app\models\Image;
use yii\web\NotFoundHttpException;
use app\models\FriendLink;

class BannerController extends BaseController
{
    public function actionIndex()
    {
        $request = \Yii::$app->request;
        if($request->isAjax){
            $page = $request->get('page', 1);
            $perpage = $request->get('row', 10);
            $query = Banner::find();
            $countQuery = clone $query;
            $pagination = new Pagination(['totalCount' => $countQuery->count(),'page'=>$page - 1, 'defaultPageSize' =>$perpage ]);
            $list = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->orderBy('id desc')
                ->all();

            foreach($list as $key => $val){
                $list[$key]['picture'] = Image::getBannerInfoUrl($val['picture'], 'small');
                $list[$key]['source'] = Banner::getSource($val['source']);
            }

            return ['total'=>$pagination->totalCount, 'rows'=>$list];
        }


        return $this->render('index');
    }


    public function actionAdd()
    {
        $model = new Banner();
        $request = \Yii::$app->request;
        if($request->isPost){
            $post = $request->post();
            if(!empty($_FILES['picture']['name'])){
                $pic['width'] = $post['Banner']['width'];
                $pic['height'] = $post['Banner']['height'];
                $imagModel = new UploadForm();
                $imagModel->imageFile = UploadedFile::getInstanceByName('picture');
                $uploadData = $imagModel->uploadBannerInfo($pic);
            }else{
                $uploadData['basename'] = '';
            }

            if ($model->load( $post) && $model->validate()) {
                $model->picture = $uploadData['basename'];
                if($post['Banner']['starttime'] == '') $start = 0;else $start = strtotime($post['Banner']['starttime']);
                if($post['Banner']['endtime'] == '') $end = 0;else $end = strtotime($post['Banner']['endtime']);
                $model->starttime = $start;
                $model->endtime = $end;
                $model->source = $post['Banner']['source'];
                $model->status = $post['Banner']['status'];
                $model->created_at = time();

                if($model->save()){
                    $this->addLog('新增banner成功，编号'.$model->primaryKey);
                    echo json_encode(['error'=>0, 'message'=>'保存成功']);
                    \Yii::$app->end();
                }else{
                    $this->addLog('新增banner失败');
                    echo json_encode(['error'=>2, 'message'=>'保存失败']);
                    \Yii::$app->end();
                }
            }else{
                $this->addLog('新增banner，加载或验证失败');
                echo json_encode(['error'=>1, 'message'=>'验证不通过']);
                \Yii::$app->end();
            }
        }

        return $this->render('add', [
            'model' => $model,
        ]);
    }

    public function actionEdit()
    {
        $request = \Yii::$app->request;
        $id = $request->get('id');
        $model = Banner::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException("页面未找到");
        }

        if($request->isPost){
            $post = $request->post();
            if(!empty($_FILES['picture']['name'])){
                $pic['width'] = $post['Banner']['width'];
                $pic['height'] = $post['Banner']['height'];
                $imagModel = new UploadForm();
                $imagModel->imageFile = UploadedFile::getInstanceByName('picture');
                $uploadData = $imagModel->uploadBannerInfo($pic);
            }else{
                $uploadData['basename'] = $model->picture;
            }

            if($model->load( $post) && $model->validate()){
                $model->picture = $uploadData['basename'];
                if($post['Banner']['starttime'] == '') $start = 0;else $start = strtotime($post['Banner']['starttime']);
                if($post['Banner']['endtime'] == '') $end = 0;else $end = strtotime($post['Banner']['endtime']);
                $model->starttime = $start;
                $model->endtime = $end;
                $model->source = $post['Banner']['source'];
                $model->status = $post['Banner']['status'];
                $model->updated_at = time();
                if($model->save()){
                    $this->addLog('修改banner成功，编号'.$model['id']);
                    echo json_encode(['error'=>0 ,'message'=>'保存成功']);
                    \Yii::$app->end();
                }else{
                    $this->addLog('修改banner失败，编号'.$model['id']);
                    echo json_encode(['error'=>2 ,'message'=>'保存失败']);
                    \Yii::$app->end();
                }
            }else{
                $this->addLog('修改banner，加载或验证错误，编号'.$model['id']);
                echo json_encode(['error'=>1, 'message'=>'载入数据出错']);
                \Yii::$app->end();
            }
        }

        $image = Image::getBannerInfoUrl($model['picture'], 'small');

        return $this->render('edit', [
            'model' => $model,
            'image' => $image,
        ]);
    }

    public function actionDel()
    {
        $request = \Yii::$app->request;
        if($request->isGet){
            $id = $request->get('id');
            $model = Banner::findOne($id);
            if(!$model){
                throw new NotFoundHttpException('页面未找到');
            }

            $this->addLog('删除banner成功，编号'.$model['id']);
            if($model->delete()){
                echo json_encode(['error'=>0, 'message'=>'删除成功']);
                \Yii::$app->end();
            }else{
                echo json_encode(['error'=>1, 'message'=>'删除失败']);
                \Yii::$app->end();
            }
        }
    }
}
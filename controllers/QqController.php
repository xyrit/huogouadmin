<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2015/12/29
 * Time: 10:48
 */

namespace app\controllers;

use Yii;
use app\models\Qq;

class QqController extends BaseController
{
    //qq列表
    public function actionIndex()
    {
        $req = Yii::$app->request;
        if($req->isAjax){
            $page = $req->get('page', 1);
            $pageSize = $req->get('rows', 10);
            $list = Qq::getList($pageSize, $page);

            return $list;
        }

        $params['default'] = $this->checkPrivilege($this->getUniqueId() . '/set-default');
        return $this->render('index', $params);
    }

    public function actionAdd()
    {
        $request = Yii::$app->request;
        if($request->isPost){
            $post = $request->post();
            $model = new Qq();
            if($model->load($post) && $model->validate()){
                $model->created_at = time();
                $model->admin_id = Yii::$app->admin->id;
                if($model->save()){
                    $this->addTips('新增qq群', 0, '保存成功');
                }else{
                    $this->addTips('新增qq群', 1, '保存失败');
                }
            }
        }
        return $this->render('add');
    }

    public function actionEdit()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = Qq::findOne($id);
        if(!$model){
            echo json_decode(['error'=>1, 'message'=>'该qq号不存在']);
            Yii::$app->end();
        }

        if($request->isPost){
            $post = $request->post();
            if($model->validate() && $model->load($post)){
                $model->created_at = time();
                $model->admin_id = Yii::$app->admin->id;
                if($model->save()){
                    $this->addTips('修改qq群', 0, '保存成功');
                }else{
                    $this->addTips('修改qq群', 1, '保存失败');
                }
            }
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    public function actionSetDefault()
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            $id = $request->get('id');
            $model = Qq::findOne($id);
            if(!$model){
                echo json_encode(['error'=>1, 'message'=>'该qq群不存在']);
                Yii::$app->end();
            }

            if($model['default'] == 1){
                $default = 0;
                $tips = '取消默认';
            }elseif($model['default'] == 0){
                $default = 1;
                $tips = '设置默认';
            }

            $model->default = $default;
            if($model->save()){
                return ['error'=>0, 'message'=>$tips.'成功'];
            }else{
                return ['error'=>1, 'message'=>$tips.'失败'];
            }
        }
    }

    public function actionDel()
    {
        $request = Yii::$app->request;
        if($request->isGet){
            $id = $request->get('id');
            $model = Qq::findOne($id);
            if(!$model){
                echo json_encode(['error'=>1, 'message'=>'该qq群不存在']);
                Yii::$app->end();
            }
            if($model->delete()){
                echo json_encode(['error'=>0, 'message'=>'删除成功']);
                Yii::$app->end();
            }else{
                echo json_encode(['error'=>2, 'message'=>'删除失败']);
                Yii::$app->end();
            }
        }
    }
}

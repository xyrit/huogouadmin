<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2015/12/29
 * Time: 10:48
 */

namespace app\controllers;

use app\models\ActRichLog;
use app\models\Config;
use app\models\Packet;
use app\models\PeriodBuylistDistribution;
use app\models\UploadForm;
use app\models\User;
use Yii;
use app\models\RichSet;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\UploadedFile;

class RichController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            $page = $request->get('page', 1);
            $perpage = $request->get('rows', 10);
            $list = RichSet::getList($page, $perpage);

            return $list;
        }

        return $this->render('index');
    }

    public function actionAdd()
    {
        $request = Yii::$app->request;
        if($request->isPost){
            /*$exist = RichSet::find()->count();
            if($exist != 0){
                echo json_encode(['error'=>6, 'message'=>'只能有一个配置']);
                Yii::$app->end();
            }*/
            $post = $request->post();
            $model = new RichSet();
            if(!isset($post['RichSet']['time_type']) || $post['RichSet']['time_type'] == 0){
                $post['RichSet']['start_time'] = strtotime($post['RichSet']['start_time']);
                $post['RichSet']['end_time'] = strtotime($post['RichSet']['end_time']);
            }
            if($model->load($post) && $model->validate()){
                $model->created_at = time();
                if($model->save()){
                    $this->addLog('新增土豪榜配置成功--'.$post['RichSet']['name']);
                    echo json_encode(['error'=>0, 'message'=>'保存成功']);
                    Yii::$app->end();
                }else{
                    $this->addLog('新增土豪榜配置失败'.$post['RichSet']['name']);
                    echo json_encode(['error'=>1, 'message'=>'保存失败']);
                    Yii::$app->end();
                }
            }else{
                echo json_encode(['error'=>2, 'message'=>'验证失败']);
                Yii::$app->end();
            }
        }

    }

    /**
     * @pass
     **/
    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $model = RichSet::findOne($id);
        if(!$model){
            echo json_encode(['error'=>1, 'message'=>'该活动不存在']);
            Yii::$app->end();
        }

        $request = \Yii::$app->request;
        if($request->isAjax){
            $page = $request->get('page', 1);
            $perpage = $request->get('row', 10);
            $query = ActRichLog::find()->where(['type'=>$model['time_type']]);
            $countQuery = clone $query;
            $pagination = new Pagination(['totalCount' => $countQuery->count(),'page'=>$page - 1, 'defaultPageSize' =>$perpage ]);
            $list = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->orderBy('id desc')
                ->all();

            foreach($list as &$val){
                $val['user_id'] = User::findOne($val['user_id']);
            }

            return ['total'=>$pagination->totalCount, 'rows'=>$list];
        }

        return $this->render('view', [
            'id' => $id
        ]);
    }

    public function actionDel()
    {
        $id = Yii::$app->request->get('id');
        $model = RichSet::findOne($id);
        if(!$model){
            return ['error'=>1, 'message'=>'该活动不存在'];
        }
        $name = $model['name'];
        if($model->delete()){
            $this->addLog('删除土豪榜配置--'.$name.'成功');
            return ['error'=>0, 'message'=>'删除成功'];
        }else{
            $this->addLog('删除土豪榜配置--'.$name.'失败');
            return ['error'=>2, 'message'=>'删除失败'];
        }
    }

    /**
     * @pass
     **/
    public function actionEditReward()
    {
        $request = Yii::$app->request;
        $type = $request->get('type');
        $model = Config::find()->where('`key`="'.$type.'"')->one();

        if($request->isPost){
            $post = $request->post();
            $model->value = $post['content'];
            if($model->save()){
                $this->addTips('修改土豪榜奖品配置成功', 0, '操作成功');
            }else{
                $this->addTips('修改土豪榜奖品配置失败', 1, '操作失败');
            }
        }

        $content = Json::decode(($model['value']));
        $rewards = [];
        foreach($content as $key => $object){
            $type = $object['type'];
            if ($type==1) {
                $name = $object['name'];
            } elseif ($type==2) {
                $name = '伙购币'.$object['name'].'个';
            } elseif ($type==3) {
                $name = '返现'.$object['name'].'%';
            } elseif ($type==4) {
                $packet = Packet::findOne($object['name']);
                $name = $packet['name'];
            }
            $rewards[$key]['displayText'] = $name;
            $rewards[$key]['type'] = $object['type'];
            $rewards[$key]['name'] = $object['name'];
            $rewards[$key]['rank'] = $object['rank'];
            $rewards[$key]['picture'] = $object['picture'];

        }

        return $this->render('edit', [
            'rewards' => $rewards,
            'model' => $model
        ]);
    }

    /**
     * @pass
     **/
    public function actionRewardConfig()
    {
        $request = Yii::$app->request;
        if($request->isPost){
            $post = $request->post();
            $exist = Config::findOne(['key'=>$post['key']]);
            if($exist){
                echo json_encode(['error'=>2 ,'message'=>'类型已存在']);
                \Yii::$app->end();
            }
            $model = new Config();
            $model->key = $post['key'];
            $model->value = $post['content'];
            if($model->save()){
                $this->addTips('添加土豪榜奖品配置成功', 0, '操作成功');
            }else{
                $this->addTips('加土豪榜奖品配置失败', 1, '操作失败');
            }
        }

        if($request->isAjax){
            $key = ['richdayconfig', 'richmonthconfig', 'richseasonconfig'];
            $list = Config::find()->where(['key'=>$key])->asArray()->all();

            $return = [];
            $link = '';
            foreach($list as $key => $val){
                $json = Json::decode(($val['value']));
                foreach($json as $object){
                    $type = $object['type'];
                    if ($type==1) {
                        $name = $object['name'];
                    } elseif ($type==2) {
                        $name = '伙购币'.$object['name'].'个';
                    } elseif ($type==3) {
                        $name = '返现'.$object['name'].'%';
                    } elseif ($type==4) {
                        $packet = Packet::findOne($object['name']);
                        $name = $packet['name'];
                    }
                    $link .= '第'.$object['rank'].'名 '.$name.'<br /> ';
                }
                $return[$key]['name'] = $link;
                $link = '';
                $return[$key]['type'] = $val['key'];
            }

            return ['rows' => $return, 'total' => 10];
        }

        return $this->render('config');
    }

    /**
     * @pass
     **/
    public function actionDelConfig()
    {
        $type  = Yii::$app->request->post('type');
        $model = Config::find()->where('`key` = "'.$type.'"')->one();
        if(!$model) return ['error'=>1, 'message'=>'删除项不存在'];
        if($model->delete()){
            $this->addTips('删除土豪榜配置成功', 0, '操作成功');
        }else{
            $this->addTips('删除土豪版配置失败', 2, '操作失败');
        }
    }

    /**
     * @pass
     **/
    public function actionUpload()
    {
        $file = $_FILES['file'];
        if(!empty($file)){
            $imagModel = new UploadForm();
            $imagModel->imageFile = UploadedFile::getInstanceByName('file');
            $uploadData = $imagModel->uploadActiveInfo();
            return $uploadData['basename'];
        }
    }
}

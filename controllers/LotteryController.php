<?php
/**
 * Created by PhpStorm.
 * User: zhangjicheng
 * Date: 15/9/18
 * Time: 14:54
 */

namespace app\controllers;

use app\helpers\DateFormat;
use app\models\Image;
use app\models\LoginLog;
use app\models\Lottery;
use app\models\LotteryLog;
use app\models\LotteryRewardLog;
use app\models\Reward;
use app\models\User;
use Yii;
use app\models\UploadForm;
use yii\helpers\Json;
use yii\web\UploadedFile;

class LotteryController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 10);
            $list = Lottery::getList($page, $pageSize);
            $arr = [];
            foreach($list['rows'] as $key => $val) {
                $arr[$key]['name'] = $val['name'];
                $arr[$key]['time'] = date('Y-m-d H:i:s', $val['start_time']) . ' 至 ' . date('Y-m-d H:i:s', $val['end_time']);
                $rewards = json_decode($val['content']);
                $name = $val['name'];
                $left = '';
                foreach($rewards as $v){
                    $rewardModel = Reward::find()->where(['id'=>$v, 'del'=>0])->one();
                    $names = Json::decode(($rewardModel['content']));
                    if ($names) {
                        foreach($names as $vals){
                            $name .= '/'.$vals.'<br />';
                        }
                    }

                    $left .= $rewardModel['name'].' '.$rewardModel['left'].'/'.$rewardModel['num'].'<br />';
                }
                $arr[$key]['reward'] = $name;
                $arr[$key]['left'] = $left;
                $arr[$key]['status'] = $val['status'];
                $arr[$key]['id'] = $val['id'];
            }
            return ['rows'=>$arr, 'total'=>$list['total']];
        }

        $params['join'] = $this->checkPrivilege($this->getUniqueId() . '/join');
        $params['lottery'] = $this->checkPrivilege($this->getUniqueId() . '/lottery');
        return $this->render('index', $params);
    }

    //抽奖配置
    public function actionAdd()
    {
        $request = Yii::$app->request;
        if($request->isPost){
            $post = $request->post();
            $post['Lottery']['content'] = $post['content'];
            $post['Lottery']['created_at'] = time();
            $post['Lottery']['start_time'] = strtotime($post['Lottery']['start_time']);
            $post['Lottery']['end_time'] = strtotime($post['Lottery']['end_time']);
            $post['Lottery']['validity_start'] = strtotime($post['Lottery']['validity_start']);
            $post['Lottery']['validity_end'] = strtotime($post['Lottery']['validity_end']);
            $model = new Lottery();
            if($model->load($post) && $model->validate()){
                $trans = Yii::$app->db->beginTransaction();
                try{
                    if($model->save()){
                        $arr = json_decode($post['content']);
                        foreach($arr as $key => $val){
                            $rewardModel = Reward::findOne($val);
                            $rewardModel->lottery_id = $model->primaryKey;
                            if(!$rewardModel->save()) {
                                $trans->rollBack();
                                $this->addTips('新增抽奖配置失败', 5, '保存失败');
                            }
                        }
                        Lottery::createLogTable($model->primaryKey);
                        $trans->commit();
                        $this->addTips('新增抽奖配置成功，编号'.$model->primaryKey, 0, '保存成功');
                    }else{
                        $trans->rollBack();
                        $this->addTips('新增抽奖配置失败', 2, '保存失败');
                    }
                }catch (Exception $e){
                    $trans->rollBack();
                    $this->addTips('新增抽奖配置失败', 4, '保存失败');
                }
            }else{
                $this->addTips('添加配置失败，加载或验证错误', 1, '载入数据出错');
            }
        }

        return $this->render('add');
    }

    //添加奖品
    public function actionReward()
    {
        $request = Yii::$app->request;
        if($request->isPost){
            $post = $request->post();
            $imagModel = new UploadForm();
            $imagModel->imageFile = UploadedFile::getInstanceByName('picture');
            $uploadData = $imagModel->uploadActiveInfo();
            $post['Reward']['basename'] = $uploadData['basename'];
            $imagModel->imageFile = UploadedFile::getInstanceByName('icon');
            $uploadData = $imagModel->uploadActiveInfo();
            $post['Reward']['icon'] = $uploadData['basename'];
            $post['Reward']['content'] = $post['content'];
            $post['Reward']['created_at'] = time();
            $post['Reward']['left'] = $post['Reward']['num'];
            $post['Reward']['lottery_id'] = 0;
            $post['Reward']['type'] = $post['type'];
            $model = new Reward();
            if($model->load( $post ) && $model->validate()){
                if($model->save()){
                    $this->addLog('新增奖品成功，编号'.$model->primaryKey);
                    echo json_encode(['error'=>0 ,'message'=>'保存成功', 'name'=>$post['Reward']['name'], 'id'=>$model->primaryKey]);
                    \Yii::$app->end();
                }else{
                    $this->addLog('新增奖品失败');
                    echo json_encode(['error'=>2 ,'message'=>'保存失败']);
                    \Yii::$app->end();
                }
            }else{
                $this->addLog('添加奖品失败，加载或验证错误');
                echo json_encode(['error'=>1, 'message'=>'载入数据出错']);
                \Yii::$app->end();
            }
        }
    }

    //删除奖品  id
    public function actionDelReward()
    {
        $request = Yii::$app->request;
        if($request->isPost){
            $id = $request->post('id');
            $model = Reward::findOne($id);
            if(!$model){
                echo json_encode(['error'=>1 ,'message'=>'该奖品不存在']);
                \Yii::$app->end();
            }
            $model->del = 1;
            if($model->save()){
                $this->addTips('删除奖品'.$model['name'].'成功', 0, '删除成功');
            }else{
                $this->addTips('删除奖品'.$model['name'].'失败', 2, '删除失败');
            }
        }
    }

    //卡片列表
    public function actionCardList()
    {

    }

    public function actionEdit()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = Lottery::findOne($id);
        if(!$model){
            echo json_encode(['error'=>1, 'message'=>'该配置不存在']);
            Yii::$app->end();
        }

        if($request->isPost){
            $post = $request->post();
            $post['Lottery']['content'] = $post['content'];
            $post['Lottery']['created_at'] = time();
            $post['Lottery']['start_time'] = strtotime($post['Lottery']['start_time']);
            $post['Lottery']['end_time'] = strtotime($post['Lottery']['end_time']);
            $post['Lottery']['validity_start'] = strtotime($post['Lottery']['validity_start']);
            $post['Lottery']['validity_end'] = strtotime($post['Lottery']['validity_end']);
            $post['Lottery']['consume'] = $post['consume'];
            if($model->load($post) && $model->validate()){
                $trans = Yii::$app->db->beginTransaction();
                try{
                    if($model->save()){
                        $arr = json_decode($post['content']);
                        foreach($arr as $key => $val){
                            $rewardModel = Reward::findOne($val);
                            if($rewardModel['del'] == 0){
                                $rewardModel->lottery_id = $model['id'];
                                if(!$rewardModel->save()) {
                                    $trans->rollBack();
                                    $this->addTips('修改抽奖配置失败', 5, '保存失败');
                                }
                            }
                        }
                        //Reward::deleteAll(['del'=>1, 'lottery_id'=>$model['id']]);
                        $trans->commit();
                        $this->addTips('修改抽奖配置成功，编号'.$model['id'], 0, '保存成功');
                    }else{
                        $trans->rollBack();
                        $this->addTips('修改抽奖配置失败', 2, '保存失败');
                    }
                }catch (Exception $e){
                    $trans->rollBack();
                    $this->addTips('修改抽奖配置失败', 4, '保存失败');
                }
            }else{
                $this->addTips('修改配置失败，加载或验证错误', 1, '载入数据出错');
            }
        }

        $rewards = Reward::find()->select('id,name')->where(['lottery_id'=>$model['id'], 'del'=>0])->asArray()->all();
        return $this->render('edit', [
            'model' => $model,
            'rewards' => $rewards,
        ]);
    }

    //取消则删除添加的reward
    public function actionCancel()
    {
        Reward::deleteAll(['lottery_id'=>'0']);
        $id = Yii::$app->request->get('id');
        $model = Lottery::findOne($id);
        Reward::updateAll(['del'=>0], 'del=1 and lottery_id = '.$model['id']);
    }

    public function actionSetDel()
    {
        $id = Yii::$app->request->get('id');
        $model = Reward::findOne($id);
        $model->del = 1;
        $model->save();
    }

    /**
     * @pass
     **/
    public function actionRewardEdit()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = Reward::findOne($id);
        if(!$model){
            echo json_decode(['error'=>1, 'message'=>'该奖品不存在']);
            Yii::$app->end();
        }

        if($request->isPost){
            $post = $request->post();

            if($_FILES['picture']['name']){
                $imagModel = new UploadForm();
                $imagModel->imageFile = UploadedFile::getInstanceByName('picture');
                $uploadData = $imagModel->uploadActiveInfo();
                $model->basename = $uploadData['basename'];
            }
            if($_FILES['icon']['name']){
                $imagModel = new UploadForm();
                $imagModel->imageFile = UploadedFile::getInstanceByName('icon');
                $uploadData = $imagModel->uploadActiveInfo();
                $model->icon = $uploadData['basename'];
            }
            $model->name = $post['name'];
            $model->num = $post['num'];
            $model->probability = $post['probability'];
            $model->left = $post['num'];
            if($model->save()){
                $this->addLog('编辑奖品成功，编号'.$model['id']);
                echo json_encode(['error'=>0 ,'message'=>'保存成功', 'name'=>$post['name'], 'id'=>$model['id']]);
                \Yii::$app->end();
            }else{
                $this->addTips('修改奖品失败', 2, '保存失败');
            }
        }

        return $this->render('reward-edit', [
            'model' => $model,
        ]);
    }

    public function actionVirtual()
    {
        //$coupon =

        return $this->render('virtual');
    }

    public function actionJoin()
    {
        $request = Yii::$app->request;
        $get = $request->get();

        if($request->isAjax){
            $page = $request->get('page', 1);
            $perpage = $request->get('rows', 30);
            $list = LotteryLog::getList($get['id'], $page, $perpage);
            foreach($list['rows'] as &$val){
                $user = User::findOne($val['user_id']);
                $val['user_id'] = $user['phone'].'<br />'.$user['email'];
                $val['reward_id'] = Reward::findOne($val['reward_id']);
            }
            return $list;
        }

        return $this->render('join', [
            'id' => $get['id'],
        ]);
    }

    public function actionLottery()
    {
        $request = Yii::$app->request;
        $get = $request->get();

        if($request->isAjax){
            $page = $request->get('page', 1);
            $perpage = $request->get('rows', 30);
            $list = LotteryRewardLog::getList($get['id'], $page, $perpage);
            $arr = [];
            foreach($list['rows'] as $key => $val){
                $user = User::findOne($val['user_id']);
                $reward = Reward::findOne($val['reward_id']);
                $content = '';
                foreach(json_decode($reward['content']) as $vals){
                    $content .= $vals.'<br />';
                }
                $arr[$key]['username'] = $user['phone'].'<br />'.$user['email'];
                $arr[$key]['name'] = $reward['name'];
                $arr[$key]['time'] = $val['created_at'];
                $arr[$key]['id'] = $val['id'];
                $arr[$key]['content'] = $content;
            }
            return ['rows'=>$arr, 'total'=>$list['total']];
        }

        return $this->render('lottery', [
            'id' => $get['id'],
        ]);
    }
}
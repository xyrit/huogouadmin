<?php
/**
 * 充值送红包
 * @authors hechen
 * @date    2016-03-25 14:19:20
 * @version $Id$
 */

namespace app\controllers;

use yii;
use app\models\Config;
use app\models\Packet;
use app\models\RechargeReward;
use yii\data\Pagination;

class RechargerewardController extends BaseController {
    
    public function actionIndex()
    {
    	$request = Yii::$app->request;
    	if ($request->isAjax) {
    		$page = $request->get('page', 1);
            $perpage = $request->get('rows', 30);

	    	$query = RechargeReward::find();
		    $pages = new Pagination(['defaultPageSize' => $perpage, 'totalCount' => $query->count(), 'page' => $page - 1]);

		    $list = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();

		    foreach ($list as $key => &$value) {
		    	$value['start_time'] = date("Y-m-d H:i:s",$value['start_time']);
		    	$value['end_time'] = date("Y-m-d H:i:s",$value['end_time']);
		    	if ($value['status'] == 1) {
		    		$value['status'] = '开启';
		    	}else{
		    		$value['status'] = '关闭';
		    	}
		    }

		    return ['rows' => $list, 'total' => $pages->totalCount];
    	}

    	return $this->render('index');
    }

   	public function actionEdit()
   	{
   		$request = Yii::$app->request;
   		if ($request->isPost) {
   			$id = $request->post('id');
   			$condition1 = $request->post('condition1');
			$condition2 = $request->post('condition2');
			$max = $request->post('max');
			$min = $request->post('min');
			$prizeName = $request->post('prizename');
			$giveTime = $request->post('givetime');
			$packets = $request->post('packets');
			$status = $request->post('status');
			$condition = [];
			foreach ($request->post('condition') as $key => $value) {
				$condition[] = [
					'condition' => $value,
					'condition1' => $condition1[$key],
					'condition2' => $condition2[$key],
					'max' => $max[$key],
					'min' => $min[$key],
					'prizename' => $prizeName[$key],
					'givetime' => $giveTime[$key],
					'packets' => $packets[$key]
				];
			}

			if ($id) {
				$model = RechargeReward::findOne(['id'=>$id]);
				$model->name = $request->post('name');
				$model->intr = $request->post('intr');
				$model->start_time = strtotime($request->post('start_time'));
				$model->end_time = strtotime($request->post('end_time'));
				$model->status = $status;
				$model->prizes = json_encode($condition);
				$model->update_time = time();				
			}else{
				$model = new RechargeReward();
				$model->name = $request->post('name');
				$model->intr = $request->post('intr');
				$model->start_time = strtotime($request->post('start_time'));
				$model->end_time = strtotime($request->post('end_time'));
				$model->status = $status;
				$model->prizes = json_encode($condition);
				$model->create_time = time();
				$model->update_time = time();
			}
			$rs = $model->save(false);
			$ra_id = $model->attributes['id'];
			if ($rs) {
				if ($status == 1) {
					$config = Config::getValueByKey('rechargeconfig');
					if ($config) {
						if (isset($config['status']) && $config['status'] == 1) {
							if (isset($config['ra_id']) && $config['ra_id'] == $ra_id) {
								return json_encode(['code'=>100,'msg'=>'保存成功']);
							}else{
								return json_encode(['code'=>1,'msg'=>'保存成功，活动开启失败，已有活动处于开启状态']);
							}
						}else{
							Config::updateAll(['value'=>json_encode(['status'=>1,'ra_id'=>$ra_id])],['key'=>'rechargeconfig']);
						}
					}else{
						$configModel = new Config();
						$configModel->key = 'rechargeconfig';
						$configModel->value = json_encode(['status'=>1,'ra_id'=>$ra_id]);
						$configModel->save();
					}
				}
				return json_encode(['code'=>100,'msg'=>'保存成功']);
			}
			return json_encode(['code'=>0,'msg'=>'保存失败']);
   		}
   		$packets = Packet::find()->asArray()->all();
   		return $this->render('edit',['packets'=>$packets]);
   	}
}
<?php

namespace app\controllers;

use yii;
use app\models\Config;
use app\models\Packet;
use app\helpers\MyRedis;

/**
 * 配置
 */
class JdcardActionController extends BaseController
{

    public function actionIndex()
    {
        $config = Config::getValueByKey('jdcardactionconfig');
        if ($config) {
        $config['endtime'] = date('Y-m-d H:i:s', $config['endtime']);
        $config['starttime'] = date('Y-m-d H:i:s', $config['starttime']);
        }
        $request = Yii::$app->request;
        if ($request->isPost) {
            $data = [
                'status' => $request->post('status'),
                'starttime' => strtotime($request->post('starttime')),
                'endtime' => strtotime($request->post('endtime')),
//                'intr' => $request->post('intr'),
//                'terminal' => $request->post('terminal'),
//                'conduit' => $request->post('conduit'),
//                'packet_id' => $request->post('packet')
            ];
            $value = json_encode($data);
            if ($config) {
                $rs = Config::updateAll(['value' => $value], ['key' => 'jdcardactionconfig']);
            } else {
                $configModel = new Config();
                $configModel->key = 'jdcardactionconfig';
                $configModel->value = $value;
                $rs = $configModel->save();
            }

            if ($rs) {
                $redis = new MyRedis();
                $redis->hset(Config::CONFIG_KEY, ['jdcardactionconfig' => $value]);
                return json_encode(['code' => 100, 'msg' => '保存成功']);
            }
            return json_encode(['code' => 0, 'msg' => '保存失败']);
        }

        $packets = Packet::find()->asArray()->all();
        return $this->render('index', ['packets' => $packets, 'config' => $config]);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2016/2/22
 * Time: 10:08
 */
namespace app\controllers;

use app\helpers\MyRedis;
use app\models\Packet;
use app\models\Sign;
use app\models\StatsTask;
use app\models\Task;
use app\models\User;
use app\models\UserTask;
use Yii;
use yii\helpers\Json;

class UserTaskController extends BaseController
{
    public function actionIndex()
    {
        $data = [];
        $data['sign'] = Sign::find()->asArray()->all();
        foreach ($data['sign'] as &$one) {
            if ($one['type'] == 3) {
                $packet = Packet::findOne([$one['num']]);
                if ($packet) {
                    $one['packetName'] = $packet['name'];
                }
            }
        }
        $redis = new MyRedis();
        $key = Sign::SIGN_LIST;
        $data['content'] = $redis->hget($key, 'content');
        $data['new_task'] = $redis->get(UserTask::USER_TASK . '1');
        $data['daily_task'] = $redis->get(UserTask::USER_TASK . '2');
        $data['grow_task'] = $redis->get(UserTask::USER_TASK. '3');

        $data['task'] = Task::find()->orderBy('cate asc, num asc, id asc')->asArray()->all();
        foreach ($data['task'] as &$one) {
            if ($one['award_type'] == 3) {
                $packet = Packet::findOne([$one['award_num']]);
                if ($packet) {
                    $one['packetName'] = $packet['name'];
                }
            }
        }

        return $this->render('index', $data);
    }

    public function actionEdit()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $post = $request->post();
            $trans = Yii::$app->db->beginTransaction();
            try {
                foreach ($post['UserTask'] as $key => $one) {
                    $sign = Sign::findOne(['days' => $key]);
                    if (!$sign) {
                        $sign = new Sign();
                    }
                    $sign->days = $key;
                    $sign->type = $one['type'];
                    $sign->num = $one['num'];
                    if (!$sign->save()) {
                        $trans->rollBack();
                        foreach ($sign->errors as $message) {
                            return Json::encode(['error' => 1, 'message' => $message]);
                        }
                    }
                }

                if (isset($post['Task'])) {
                    foreach ($post['Task'] as $taskId => $one) {
                        Task::updateAll($one, ['id' => $taskId]);
                    }
                }

                $trans->commit();
                $redis = new MyRedis();
                $key = Sign::SIGN_LIST;
                $list = Sign::find()->asArray()->all();
                foreach ($list as &$one) {
                    switch ($one['type']) {
                        case 1:
                            $one['name'] = $one['num'] . "福分";
                            break;
                        case 2:
                            $one['name'] = $one['num'] . "伙购币";
                            break;
                        case 3:
                            $packet = Packet::findOne($one['num']);
                            $one['name'] = $packet['name'];
                            break;
                    }
                }
                $redis->hset($key, ['list' => Json::encode($list), 'content' => $post['content']]);
                $redis->set(UserTask::USER_TASK . '1', $post['new_task']);
                $redis->set(UserTask::USER_TASK . '2', $post['daily_task']);
                $redis->set(UserTask::USER_TASK . '3', $post['grow_task']);
                return Json::encode(['error' => 0, 'message' => '保存成功']);
            } catch (\Exception $e) {
                $trans->rollBack();
                return Json::encode(['error' => 1, 'message' => $e->getMessage()]);
            }
        }
    }

    public function actionView()
    {
        return $this->render('view');
    }

    /**
     * @pass
     */
    public function actionList()
    {
        $request = Yii::$app->request;
        $type = $request->get('type');

        if ($request->isAjax) {
            $condition['type'] = $type;
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 20);
            return StatsTask::getList($condition, $page, $pageSize);
        }

        return $this->render('list', ['type' => $type]);
    }

    /**
     * @pass
     */
    public function actionGloryList()
    {
        $gloryTask = Task::find()->select('num')->where(['type' => 3, 'level' => 1, 'cate' => 1])->orderBy('num asc')->asArray()->all();
        $gloryStatsTask = StatsTask::find()->select('num, SUM(count) as count')->where(['type' => 4, 'level' => 1, 'cate' => 1])
            ->groupBy('num')->orderBy('num asc')->indexBy('num')->asArray()->all();
        foreach ($gloryTask as $one) {
            !isset($gloryStatsTask[$one['num']]) && $gloryStatsTask[$one['num']] = [];
        }

        $richTask = Task::find()->select('num')->where(['type' => 3, 'level' => 1, 'cate' => 2])->orderBy('num asc')->asArray()->all();
        $richStatsTask = StatsTask::find()->select('num, SUM(count) as count')->where(['type' => 4, 'level' => 1, 'cate' => 2])
            ->groupBy('num')->orderBy('num asc')->indexBy('num')->asArray()->all();
        foreach ($richTask as $one) {
            !isset($richStatsTask[$one['num']]) && $richStatsTask[$one['num']] = [];
        }

        $firstTask = Task::find()->select('num')->where(['type' => 3, 'level' => 1, 'cate' => 3])->orderBy('num asc')->asArray()->all();
        $firstStatsTask = StatsTask::find()->select('num, SUM(count) as count')->where(['type' => 4, 'level' => 1, 'cate' => 3])
            ->groupBy('num')->orderBy('num asc')->indexBy('num')->asArray()->all();
        foreach ($firstTask as $one) {
            !isset($firstStatsTask[$one['num']]) && $firstStatsTask[$one['num']] = [];
        }

        $endTask = Task::find()->select('num')->where(['type' => 3, 'level' => 1, 'cate' => 3])->orderBy('num asc')->asArray()->all();
        $endStatsTask = StatsTask::find()->select('num, SUM(count) as count')->where(['type' => 4, 'level' => 1, 'cate' => 3])
            ->groupBy('num')->orderBy('num asc')->indexBy('num')->asArray()->all();
        foreach ($endTask as $one) {
            !isset($endStatsTask[$one['num']]) && $endStatsTask[$one['num']] = [];
        }
        return $this->render('glory-list', [
            'gloryTask' => $gloryStatsTask,
            'richTask' => $richStatsTask,
            'firstTask' => $firstStatsTask,
            'endTask' => $endStatsTask
        ]);
    }

    /**
     * @pass
     */
    public function actionLevelList()
    {
        $task = Task::find()->select('name,num')->where(['type' => 3, 'level' => 3])->orderBy('num asc')->asArray()->all();
        $statsTask = StatsTask::find()->select('num, SUM(count) as count')->where(['type' => 4, 'level' => 3])
            ->groupBy('num')->orderBy('num asc')->indexBy('num')->asArray()->all();
        foreach ($task as $one) {
            !isset($statsTask[$one['num']]) && $statsTask[$one['num']] = [];
            $statsTask[$one['num']]['name'] = mb_substr($one['name'], 4, 4, 'utf8');
        }
        return $this->render('level-list', ['task' => $statsTask]);
    }

    /**
     * @pass
     */
    public function actionGrowList()
    {
        $task = Task::find()->select('name,num')->where(['type' => 3, 'level' => 2])->orderBy('num asc')->asArray()->all();
        $statsTask = StatsTask::find()->select('num, SUM(count) as count')->where(['type' => 4, 'level' => 2])
            ->groupBy('num')->orderBy('num asc')->indexBy('num')->asArray()->all();
        foreach ($task as $one) {
            !isset($statsTask[$one['num']]) && $statsTask[$one['num']] = [];
        }
        return $this->render('grow-list', ['task' => $statsTask]);
    }

    /**
     * @pass
     * @return array|string
     */
    public function actionDetail()
    {
        $request = Yii::$app->request;
        $condition['date'] = $request->get('date', 0);
        $condition['type'] = $request->get('type', 0);
        $condition['level'] = $request->get('level', 0);
        $condition['cate'] = $request->get('cate', 0);
        $condition['num'] = $request->get('num', 0);
        $condition['title'] = $request->get('title', '');

        if ($request->isAjax) {
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 20);
            $condition['source'] = $request->get('source', 0);
            $condition['startTime'] = $request->get('startTime', 0);
            $condition['endTime'] = $request->get('endTime', 0);
            $account = $request->get('account', '');
            if ($account) {
                $user = User::find()->where(['or', 'phone="' . $account . '"', 'email="' . $account . '"'])->one();
                if ($user) {
                    $condition['user_id'] = $user['id'];
                }
            }
            return StatsTask::getDetail($condition, $page, $pageSize);
        }

        return $this->render('detail', $condition);
    }
}
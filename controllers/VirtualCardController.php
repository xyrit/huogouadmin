<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2016/4/22
 * Time: 20:49
 */

namespace app\controllers;

use app\helpers\Excel;
use app\models\Admin;
use app\models\VirtualDepotJd;
use Yii;
use yii\data\Pagination;

class VirtualCardController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 20);

            $query = VirtualDepotJd::find();
            $countQuery = clone $query;
            $pagination = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
            $list = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
            $admins = Admin::find()->indexBy('id')->asArray()->all();
            foreach ($list as &$row) {
                $row['admin_name'] = isset($admins[$row['admin_id']]) ? $admins[$row['admin_id']]['username'] : '';
            }
            $data['rows'] = $list;
            $data['total'] = $pagination->totalCount;

            return $data;
        }

        $params['import'] = $this->checkPrivilege($this->getUniqueId() . '/import');
        return $this->render('index', $params);
    }

    public function actionImport()
    {
        $tmp_file = $_FILES['import']['tmp_name'];
        $file_types = explode ( ".", $_FILES['import']['name'] );
        $file_type = $file_types[count($file_types) - 1];

        /*判别是不是.xls文件，判别是不是excel文件*/
        if (!in_array(strtolower($file_type), ['xlsx', 'xls'])) {
            echo json_encode(['error' => 1, 'message' => '不是Excel文件，重新上传']);
            Yii::$app->end();
        }

        $data = Excel::readExcel($tmp_file, $file_type);
        if (!empty($data)) {
            unset($data[1]);
            $data = array_values($data);
            try {
                $db = Yii::$app->db;
                $nums = count($data);
                for ($i = 0; $i < $nums; $i++) {
                    $card = $data[$i][0];
                    $pwd = $data[$i][1];
                    $value = $data[$i][2];
                    $status = 0;
                    $created_at = time();
                    $admin_id = Yii::$app->admin->id;
                    $list[] = [$card, $pwd, $value, $status, $created_at, $admin_id];
                    if (($nums - 1 == $i) || ($i % 10000 == 0)) {
                        file_put_contents('sql.txt', print_r($list, true).PHP_EOL, FILE_APPEND);
                        $db->createCommand()->batchInsert('virtual_depot_jd', ['card', 'pwd', 'par_value', 'status', 'created_at', 'admin_id'], $list)->execute();
                        $list = [];
                    }
                }
                echo json_encode(['error' => 0, 'message' => '导入成功']);
                Yii::$app->end();
            } catch (\Exception $e) {
                echo json_encode(['error' => 1, 'message' => $e->getMessage()]);
                Yii::$app->end();
            }
        }
    }
}
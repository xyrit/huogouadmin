<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2016/1/4
 * Time: 10:14
 */

namespace app\controllers;

use app\helpers\Ex;
use app\models\Keyword;
use Yii;
use yii\base\Exception;
use yii\data\Pagination;
use app\helpers\Excel;

class KeywordsController extends BaseController
{
    public function actionIndex()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $page = $request->get('page', 1);
            $pageSize = $request->get('rows', 25);

            $query = Keyword::find();
            $countQuery = clone $query;
            $pagination = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
            $list = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
            $data['rows'] = $list;
            $data['total'] = $pagination->totalCount;

            return $data;
        }

        $params['export'] = $this->checkPrivilege($this->getUniqueId() . '/export');
        $params['import'] = $this->checkPrivilege($this->getUniqueId() . '/import');
        return $this->render('index', $params);
    }

    public function actionAdd()
    {
        $request = Yii::$app->request;

        if($request->isPost){
            $content = $request->post('content');
            $type = $request->post('add_type');
            if ($content && $type) {
                $type = implode(',', $type);
                $content = explode(',', $content);
                $trans = Yii::$app->db->beginTransaction();
                try {
                    foreach ($content as $c) {
                        $model = new Keyword();
                        $model->content = $c;
                        $model->type = $type;

                        if (!$model->save()) {
                            $trans->rollBack();
                            foreach ($model->errors as $message) {
                                echo json_encode(['error' => 1, 'message' => $message]);
                                Yii::$app->end();
                            }
                        }
                    }
                    $trans->commit();
                    echo json_encode(['error' => 0,'message' => '新增菜单成功']);
                    Yii::$app->end();
                } catch (\Exception $e) {
                    $trans->rollBack();
                    echo json_encode(['error' => 1, 'message' => $e->getMessage()]);
                    Yii::$app->end();
                }
            }
        }
    }

    public function actionEdit()
    {
        $request = Yii::$app->request;

        if($request->isPost){
            $id = $request->get('id');
            $content = $request->post('content');
            $type = $request->post('edit_type');
            if ($type) {
                $type = implode(',', $type);
            }
            $model = Keyword::findOne($id);
            $model->content = $content;
            $model->type = $type;
            if ($model->validate()) {
                if ($model->save()) {
                    echo json_encode(['error' => 0,'message' => '新增菜单成功']);
                    Yii::$app->end();
                }
            }
            foreach ($model->errors as $message) {
                echo json_encode(['error' => 1, 'message' => $message]);
                Yii::$app->end();
            }
        }
    }

    public function actionDel()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $id = $request->get('id');
            $keyword = Keyword::findOne($id);

            if (!$keyword) {
                return [
                    'error' => 1,
                    'message' => '该关键字不存在'
                ];
            } else {
                $delete = Keyword::deleteAll(['id' => $id]);
                if ($delete) {
                    return [
                        'error' => 0,
                        'message' => '删除成功'
                    ];
                }
                return [
                    'error' => 1,
                    'message' => '删除失败'
                ];
            }
        }
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
            $trans = Yii::$app->db->beginTransaction();
            try {
                foreach ($data as $d) {
                    $model = Keyword::findOne(['content' => $d[1]]);
                    if (!$model) {
                        $model = new Keyword();
                    }
                    $model->content = $d[1];
                    $model->type = $d[0];
                    if (!$model->save()) {
                        $trans->rollBack();
                        foreach ($model->errors as $message) {
                            echo json_encode(['error' => 1, 'message' => $message]);
                            Yii::$app->end();
                        }
                    }
                }
                $trans->commit();
                echo json_encode(['error' => 0, 'message' => '导入成功']);
                Yii::$app->end();
            } catch (\Exception $e) {
                $trans->rollBack();
                echo json_encode(['error' => 1, 'message' => $e->getMessage()]);
                Yii::$app->end();
            }
        }
    }

    public function actionExport()
    {
        //if (Yii::$app->request->isAjax) {
            $query = Keyword::find();
            $countQuery = clone $query;
            $pagination = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => PHP_INT_MAX, 'pageSizeLimit'=>[0, PHP_INT_MAX]]);
            $list = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
            $data[0] = ['type' => '过滤类型', 'content' => '关键字内容'];
            foreach ($list as $key => $val) {
                $key = $key + 1;
                $data[$key]['type'] = $val['type'];
                $data[$key]['content'] = $val['content'];
            }

            $excel = new Ex();
            $excel->download($data, '关键字数据' . date('Y-m-d H:i:s') . '.xlsx');
        //}
    }
}
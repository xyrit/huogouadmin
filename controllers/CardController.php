<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 16/2/27
 * Time: 下午2:49
 */
namespace app\controllers;

class CardController extends BaseController
{
    /**
     * 充值卡批次列表
     */
    public function actionIndex()
    {
        $params = [];
        return $this->render('index',$params);
    }

    /**
     * 充值卡批次详情
     */
    public function actionBatchInfo()
    {

    }

    /**
     * 充值卡申请
     */
    public function actionApply()
    {

    }

    /**
     * 充值卡审核
     */
    public function actionExamine()
    {

    }


    /**
     * 充值卡导出
     */
    public function actionExport()
    {

    }

    /**
     * 充值卡导出历史
     */
    public function actionExportHistory()
    {

    }

    /**
     * 充值卡列表
     */
    public function actionList()
    {

    }

    /**
     * 充值卡详情
     */
    public function actionInfo()
    {

    }


}
<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2015/12/23
 * Time: 10:37
 */

namespace app\controllers;

use Yii;

class MenuController extends BaseController
{
    public function actionAjaxMenu()
    {
        $id = Yii::$app->request->get('id');
        $menuList = [];
        if ($id == 0) {
            $menuList = [
                [
                    'id' => 1,
                    'name' => '系统设置',
                    'iconCls' => 'icon-sys',
                    'attributes' => ''
                ]
            ];
        } elseif ($id == 1) {
            $menuList = [
                [
                    'id' => 2,
                    'name' => '账号管理',
                    'iconCls' => 'icon-nav',
                    'attributes' => [
                    ]
                ]
            ];
        } elseif ($id == 2) {
            $menuList = [
                [
                    'id' => 3,
                    'name' => '新增员工',
                    'iconCls' => 'icon-nav',
                    'attributes' => []
                ],
                [
                    'id' => 4,
                    'name' => '编辑',
                    'iconCls' => 'icon-nav',
                    'attributes' => [],
                ]
            ];
        }
        echo json_encode($menuList);
        Yii::$app->end();
    }
}
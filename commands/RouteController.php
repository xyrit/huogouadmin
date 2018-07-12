<?php
/**
 * Created by PhpStorm.
 * User: suyan
 * Date: 2015/10/13
 * Time: 17:26
 */

namespace app\commands;

use app\models\Route;
use yii\console\Controller;

class RouteController extends Controller
{
    public function actionIndex()
    {
        $result = Route::findUrl();
        echo count($result);
    }

}
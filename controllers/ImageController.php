<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2015/12/25
 * Time: 18:35
 */

namespace app\controllers;

use app\models\Image;
use Yii;
use yii\helpers\FileHelper;
use yii\imagine\Image as Imagine;
use yii\web\Controller;
use yii\web\Response;

class ImageController extends Controller
{
    public function showImage($fullPath, $defaultImagePath = '')
    {
        return $this->redirectImage($fullPath);
    }

    private function renderImage($fullPath) {
        $imagine = Imagine::getImagine();
        $mimeType = FileHelper::getMimeType($fullPath);
        $extensions = FileHelper::getExtensionsByMimeType($mimeType);
        $formats = ['gif', 'jpeg', 'png', 'wbmp', 'xbm'];
        $format = array_intersect($extensions, $formats);
        $format = array_pop($format);
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        return $imagine->open($fullPath)->show($format);
    }

    private function redirectImage($fullPath)
    {
        $pos = strpos($fullPath, '/s1');
        $path = substr($fullPath, $pos+3);
        $url = 'http://s1.' . IMG_DOMAIN . '/' . trim($path, '/');
        return \Yii::$app->getResponse()->redirect($url, 301);
    }

    public function actionProductView()
    {
        $request = Yii::$app->request;
        $basename = $request->get('basename');
        $width = $request->get('width');
        $height = $request->get('height');
        $fullPath = Image::getProductFullPath($basename, $width, $height);
        return $this->showImage($fullPath);
    }

    public function actionProductInfo()
    {
        $request = Yii::$app->request;
        $basename = $request->get('basename');
        $fullPath = Image::getProductInfoFullPath($basename);
        return $this->showImage($fullPath);
    }

    public function actionBannerInfo()
    {
        $request = Yii::$app->request;
        $size = $request->get('size');
        $basename = $request->get('basename');
        $fullPath = Image::getBannerInfoFullPath($basename, $size);
        return $this->showImage($fullPath);
    }


    public function actionShareInfo()
    {
        $request = Yii::$app->request;
        $basename = $request->get('basename');
        $size = $request->get('size', 'share');
        $fullPath = Image::getShareInfoFullPath($basename, $size);
        return $this->showImage($fullPath);
    }

    public function actionGroupInfo()
    {
        $request = Yii::$app->request;
        $basename = $request->get('basename');
        $size = $request->get('size', 'org');
        $fullPath = Image::getGroupInfoFullPath($basename, $size);
        return $this->showImage($fullPath);
    }

    public function actionActiveInfo()
    {
        $request = Yii::$app->request;
        $basename = $request->get('basename');
        $size = $request->get('size', 'org');
        $fullPath = Image::getActiveInfoFullPath($basename, $size);
        return $this->showImage($fullPath);
    }
}
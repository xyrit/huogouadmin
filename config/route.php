<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/9/10
 * Time: 下午4:13
 */

return [



    'http://img.' . IMG_DOMAIN . '/pic-<width:[\d\w]+>-<height:[\d\w]+>/<basename:[\d_\.\w]+>' => '/image/product-view',
    'http://img.' . IMG_DOMAIN . '/goodsinfo/<basename:[\d_\.\w]+>' => '/image/product-info',
    'http://img.' . IMG_DOMAIN . '/userface/<width:[\d\w]+>/<basename:[\d_\.\w]+>' => '/image/user-face',
    'http://img.' . IMG_DOMAIN . '/groupicon/<basename:[\d_\.\w]+>' => '/image/group-icon',
    'http://img.' . IMG_DOMAIN . '/grouppic/<size:\w+>/<basename:[\d_\.\w]+>' => '/image/group-info',
    'http://img.' . IMG_DOMAIN . '/userpost/<size:\w+>/<basename:[\d_\.\w]+>' => '/image/share-info',
    'http://img.' . IMG_DOMAIN . '/banner/<size:\w+>/<basename:[\d_\.\w]+>' => '/image/banner-info',
    'http://img.' . IMG_DOMAIN . '/temp/<size:[\d\w]+>/<basename:[\d_\.\w]+>' => '/image/temp/view',
    'http://img.' . IMG_DOMAIN . '/temp/<basename:[\d_\.\w]+>' => '/image/temp-view',
    'http://img.' . IMG_DOMAIN . '/active/<size:\w+>/<basename:[\d_\.\w]+>' => '/image/active-info',



    'http://' . DOMAIN => '/',
    'http://' . DOMAIN . '/<controller:[\w-]+>' => '/<controller>',
    'http://' . DOMAIN . '/<controller:[\w-]+>/<action:[\w-]+>' => '/<controller>/<action>',
];
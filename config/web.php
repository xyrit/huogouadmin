<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => '伙购网',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Shanghai',
    'language' => 'zh-CN',
    'layout' => false,
    'defaultRoute' => 'default/index',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => require(__DIR__ . '/route.php'),
            'routeParam' => 'routeParam',
        ],
        'view' => require(__DIR__ . '/view.php'),
        'request' => [
            'class' => 'app\components\Request',
            'cookieValidationKey' => '__huogou__',
            'csrfParam' => '__admin_csrf',
            'csrfCookie' => ['httpOnly' => true, 'domain' => DOMAIN]
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
            'redis' => 'redis',
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'redis' => 'redis',
            'cookieParams' => ['domain' => DOMAIN, 'lifetime' => 0],//配置会话ID作用域 生命期和超时
            'timeout' => 1800,
        ],
        'admin' => [
            'class' => 'app\components\Admin',
            'identityClass' => 'app\models\Admin',
            'enableAutoLogin' => true,
            'autoRenewCookie' => false,
            'loginUrl' => ['/login/index'],
            'returnUrl' => ['/'],
            'identityCookie' => ['name' => '_admin_identity', 'httpOnly' => true, 'domain'=> DOMAIN, ],
            'idParam' => '__admin_uid',
        ],
        'errorHandler' => [
            'errorAction' => '/error/index',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'redis' => require(__DIR__ . '/redis.php'),
        'sms' => require(__DIR__ . '/sms.php'),
        'mailer' => require(__DIR__ . '/mailer.php'),
        'getui' =>require(__DIR__.'/getui.php'),
        'sftp' => require(__DIR__ . '/sftp.php'),
        'chatpay' => require(__DIR__ . '/chatpay.php'),
        'online' => require(__DIR__ . '/online.php'),
        'chinabank' => require(__DIR__ . '/chinabank.php'),
        'authClientCollection' => require(__DIR__ . '/authclient.php'),
        'email' => require(__DIR__ . '/email.php'),
        'wechat' => require(__DIR__ . '/wechat.php'),
        'iapppay' => require(__DIR__ . '/iapppay.php'),
        'zhifuka' => require(__DIR__.'/zhifuka.php'),
        'duiba' =>require(__DIR__.'/duiba.php'),
        'jdcard' => require(__DIR__ . '/jdcard.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;

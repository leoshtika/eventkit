<?php

use \yii\web\Request;
$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl' => $baseUrl,
            'csrfParam' => 'eventkit-csrf-front',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => 'eventkit-identity', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'eventkit-sid',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // If you don't use Vagrant or have a different path to the application, 
            // override the 'baseUrl' property in the 'main-local.php' file.
            'baseUrl' => '/',
        ],
        'urlManagerBackend' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // If you don't use Vagrant or have a different path to the application, 
            // override the 'baseUrl' property in the 'main-local.php' file.
            'baseUrl' => '/admin',
        ],
    ],
    'params' => $params,
];

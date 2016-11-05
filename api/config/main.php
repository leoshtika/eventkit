<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
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
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'user',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'OPTIONS login' => 'options',
                        'OPTIONS create' => 'options',
                        'OPTIONS account' => 'options',
                        'POST login' => 'login',
                        'POST create' => 'create',
                        'GET account' => 'account',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'speaker',
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'session',
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'question',
                    'extraPatterns' => [
                        'GET session/<id:\d+>' => 'index',
                        'POST create' => 'create',
                    ]
                ],
            ],
        ],
    ],
    'params' => $params,
];

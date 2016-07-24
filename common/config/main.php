<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    // The following 'language' is the default
    'language' => 'el-GR',
    'timeZone' => 'Europe/Athens',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
        ],
        'i18n' => [
            'translations' => [
                // Translations used in all app
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],
    ],
];

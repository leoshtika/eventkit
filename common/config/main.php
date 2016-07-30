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
        /*
         * Copy the following commented 'mailer' property to the 'main-local.php'
         * and configure the 'transport' property with your data
         * 
         * If you want to send the emails to 'common/mail' folder for debbuging
         * set 'useFileTransport' to false and delete transport property
         */
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'viewPath' => '@common/mail',
//            'useFileTransport' => false,
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'mail.xxxxxxxx.com',
//                'username' => 'xxx@xxxxxxxx.com',
//                'password' => 'xxxxxxxx',
//                'port' => '25'
//            ],
//        ],
    ],
];

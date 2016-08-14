<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class FontAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Roboto+Condensed&subset=latin,greek'
    ];
    public $cssOptions = [
        'type' => 'text/css',
    ];
}
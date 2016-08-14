<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

// Array of data used for the top menu
$menuData = [
    'home' => [
        'label' => Yii::t('app', 'Home'),
        'url' => ['/site/index'],
        'icon' => 'file',
    ],
    'contact' => [
        'label' => Yii::t('app', 'Contact'),
        'url' => ['/site/contact'],
        'icon' => 'envelope',
    ],
    'about' => [
        'label' => Yii::t('app', 'About'),
        'url' => ['/site/about'],
        'icon' => 'question-sign',
    ],
    'signup' => [
        'label' => Yii::t('app', 'Signup'),
        'url' => ['/site/signup'],
        'icon' => 'record',
    ],
    'login' => [
        'label' => Yii::t('app', 'Login'),
        'url' => ['/site/login'],
        'icon' => 'log-in',
    ],
    'logout' => [
        'label' => Yii::t('app', 'Logout'),
        'url' => ['/site/logout'],
        'icon' => 'off',
    ],
    'updateProfile' => [
        'label' => Yii::t('app', 'Update profile'),
        'url' => ['/user/account'],
        'icon' => 'cog',
    ],
    'backend' => [
        'label' => Yii::t('app', 'Backend'),
        'url' => Yii::$app->urlManagerBackend->createUrl(['site/index']),
        'icon' => 'folder-close',
    ],
];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    
    <?= $this->render('_nav-top', [
       'menuData' => $menuData,
    ]) ?>

    <div class="container">
        <div class="visible-xs">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
        </div>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-right">Developed by 
            <a href="http://leonard.shtika.info/" target="_blank">Leonard Shtika</a>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

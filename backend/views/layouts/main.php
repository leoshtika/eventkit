<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\models\User;
use common\models\Question;

AppAsset::register($this);

// Initialize BS3 tooltips
$js = <<< 'SCRIPT'
$(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
});
SCRIPT;
// Register tooltip initialization javascript
$this->registerJs($js);

// Init $menuItems for top navigation
$menuItems = [];

// Array of data used for the menu top or sidebar navigation
$menuData = [
    'dashboard' => [
        'label' => Yii::t('app', 'Dashboard'),
        'url' => ['site/index'],
        'icon' => 'tasks',
    ],
    'frontend' => [
        'label' => Yii::t('app', 'Frontend'),
        'url' => Yii::$app->urlManagerFrontend->createUrl(['/']),
        'icon' => 'folder-open',
    ],
    'login' => [
        'label' => Yii::t('app', 'Login'),
        'url' => ['site/login'],
        'icon' => 'log-in',
    ],
    'logout' => [
        'label' => Yii::t('app', 'Logout'),
        'url' => ['site/logout'],
        'icon' => 'off',
    ],
    'help' => [
        'label' => Yii::t('app', 'Help'),
        'url' => ['site/help'],
        'icon' => 'question-sign',
    ],
    'event' => [
        'label' => Yii::t('app', 'Events'),
        'url' => ['event/index'],
        'icon' => 'blackboard',
    ],
    'session' => [
        'label' => Yii::t('app', 'Sessions'),
        'url' => ['session/index'],
        'icon' => 'time',
    ],
    'speaker' => [
        'label' => Yii::t('app', 'Speakers'),
        'url' => ['speaker/index'],
        'icon' => 'bullhorn',
    ],
    'question' => [
        'label' => Yii::t('app', 'Questions'),
        'url' => ['question/index'],
        'icon' => 'question-sign',
        'badge' => Question::find()->where(['status' => Question::STATUS_NEW])->count(),
    ],
    'user' => [
        'label' => Yii::t('app', 'Users'),
        'url' => ['user/index'],
        'icon' => 'user',
    ],
    'settings' => [
        'label' => Yii::t('app', 'Settings'),
        'url' => '#',
        'icon' => 'cog',
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

    <div class="container-fluid">
        <div class="row">
            <?php // Load nav-sidebar only if the user is admin ?>
            <?php if (isset(Yii::$app->user->identity->email) && User::isAdmin(Yii::$app->user->identity->email)): ?>
            
                <div class="col-sm-1 col-md-2 sidebar">
                    <?= $this->render('_nav-sidebar', [
                        'menuData' => $menuData,
                    ]) ?>
                </div><!-- sidebar -->
                <div class="col-sm-11 col-sm-offset-1 col-md-10 col-md-offset-2 main">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div><!-- main -->

            <?php else: ?>

                <div class="main">
                    <?= $content ?>
                </div><!-- main -->

            <?php endif; ?>
        
        </div><!-- row -->
    </div><!-- container-fluid -->
</div><!-- wrap -->
    
<footer class="footer">
    <div class="container-fluid">
        <p class="pull-right">Developed by 
            <a href="http://leonard.shtika.info/" target="_blank">Leonard Shtika</a>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
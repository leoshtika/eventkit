<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'EventKit';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to EventKit!</h1>
        <p class="lead">A conference management framework</p>
        <?= Html::a('Get started here', ['site/about'], [
            'class' => 'btn btn-lg btn-primary',
        ])?>
        <br><br>
        <?= Html::a('View the GitHub project', 'https://github.com/leoshtika/eventkit') ?>
    </div>
    <div class="body-content text-center">
        <?= Html::img('@web/images/main.jpg') ?><br><br>
        <p>
        It has survived not only five centuries, but also the leap into electronic 
        typesetting, remaining essentially unchanged. 
        </p>
    </div>
</div>

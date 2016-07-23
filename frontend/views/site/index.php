<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome!</h1>

        <p class="lead">This application is under construction.</p>

        <p><a class="btn btn-lg btn-success" href="#">Get started here</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat.</p>
                <?= Html::a('<span class="glyphicon glyphicon-user"></span> '.Yii::t('app', 'Login'), ['site/login'], ['class' => 'btn btn-default']) ?>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat.</p>
                <?= Html::a('<span class="glyphicon glyphicon-info-sign"></span> '.Yii::t('app', 'About'), ['site/about'], ['class' => 'btn btn-default']) ?>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat.</p>
                <?= Html::a('<span class="glyphicon glyphicon-user"></span> '.Yii::t('app', 'Signup'), ['site/signup'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>

    </div>
</div>

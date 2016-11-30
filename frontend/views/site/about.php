<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app', 'What is EventKit?');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <br><br>
    <div class="row">
        <div class="col-md-7">
            <h2 class="featurette-heading"><?= Html::encode($this->title) ?></h2>
            <p class="lead">
                It was popularised in the 1960s with the release of Letraset 
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker 
                including versions of Lorem Ipsum.
            </p>
        </div>
        <div class="col-md-5">
            <?= Html::img('@web/images/web-app0.jpg', [
                'class' => 'featurette-image img-responsive center-block',
                'alt' => '',
            ]) ?>
        </div>
    </div>

    <hr class="featurette-divider hidden-xs">

    <div class="row">
        <div class="col-md-7 col-md-push-5">
            <h2 class="featurette-heading">Why do we use it?</h2>
            <p class="lead">
                It has survived not only five centuries, but also the leap into electronic 
                typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset 
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker 
                including versions of Lorem Ipsum.
            </p>
        </div>
        <div class="col-md-5 col-md-pull-7">
            <?= Html::img('@web/images/web-app1.jpg', [
                'class' => 'featurette-image img-responsive center-block',
                'alt' => '',
            ]) ?>
        </div>
    </div>

    <hr class="featurette-divider hidden-xs">

    <div class="row">
        <div class="col-md-7">
            <h2 class="featurette-heading">Where can I get some?</h2>
            <p class="lead">
                It has survived not only five centuries, but also the leap into electronic 
                typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset 
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker 
                including versions of Lorem Ipsum.
            </p>
        </div>
        <div class="col-md-5">
            <?= Html::img('@web/images/web-app2.jpg', [
                'class' => 'featurette-image img-responsive center-block',
                'alt' => '',
            ]) ?>
        </div>
    </div>
</div>

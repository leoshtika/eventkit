<?php

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use cebe\gravatar\Gravatar;

$this->title = Yii::t('app', 'Manage account');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-account">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <p>
        <?= Yii::t('app', 'Here you can change all your account details.') ?>
    </p>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-1 col-lg-push-5">
            <div>
            <div class="profile">
                <?= Gravatar::widget([
                        'email' => $model->email,
                        'defaultImage' => 'mm',
                        'options' => [
                            'alt' => $model->full_name,
                            'class' => 'img-rounded'
                        ],
                        'size' => 130
                ]); ?>
            </div>
            <div class="clearfix visible-xs"></div>
            <h2><?= $model->full_name ?></h2>
            <p>
                <?= Yii::t('app', 'Member since: <strong>{0, date}</strong>', $model->created_at) ?><br>
                <?= Yii::t('app', 'Last update: <strong>{0, date}</strong>', $model->updated_at) ?><br>
                <?= Yii::t('app', 'Role') ?>: <strong><?= $model->roleLabel ?></strong><br>
                <?= Yii::t('app', 'You can change your profile picture on {gravatar}', [
                    'gravatar' => Html::a('Gravatar', 'http://gravatar.com', ['target'=>'_blank']),
                ]) ?>
            </p>
            <div class="clearfix"></div>
            <hr class="hidden-lg">
            </div>
        </div>
        <div class="col-lg-5 col-lg-pull-7">
            <?php $form = ActiveForm::begin(); ?>
            
                <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'newPassword')->passwordInput([
                    'maxlength' => true,
                    'placeholder' => Yii::t('app', 'Leave this field empty if you do NOT want to change the password'),
                    'autocomplete' => 'off',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> '.Yii::t('app', 'Update'),[
                        'class' => 'btn btn-primary',
                    ]) ?>
                    <?= Html::resetButton('<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> '.Yii::t('app', 'Reset'), [
                        'class' => 'btn btn-default',
                    ]) ?>
                </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div><!-- row -->
</div>
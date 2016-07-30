<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <p><?= Yii::t('app', 'Please fill out the following fields to signup.') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'full_name', [
                    'inputOptions' => [
                        'autocomplete' => 'off',
                    ],
                ])->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email', [
                    'inputOptions' => [
                        'autocomplete' => 'off',
                    ],
                ]) ?>

                <?= $form->field($model, 'password', [
                    'inputOptions' => [
                        'autocomplete' => 'off',
                    ],
                ])->passwordInput() ?>
            
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-md-3 captcha">{image}</div><div class="col-md-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

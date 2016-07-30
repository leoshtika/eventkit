<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?php if ($model->isNewRecord) : ?>
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?php else : ?>
        <?= $form->field($model, 'newPassword')->passwordInput([
            'maxlength' => true,
            'placeholder' => Yii::t('app', 'Leave this field empty if you do NOT want to change the password'),
            'autocomplete' => 'off',
        ]) ?>
    <?php endif; ?>
    
    <?= $form->field($model, 'role')->radioList($model->getRoleList(), [
        'class' => 'radio_list',
    ]) ?>
    
    <?= $form->field($model, 'status')->radioList($model->getStatusList(), [
        'class' => 'radio_list',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 
                '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> '.Yii::t('app', 'Create') : 
                '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> '.Yii::t('app', 'Update'), 
            ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

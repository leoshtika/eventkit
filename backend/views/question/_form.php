<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'session_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'question')->textarea(['rows' => 6]) ?>

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

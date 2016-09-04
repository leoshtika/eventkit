<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Session;

/* @var $this yii\web\View */
/* @var $model common\models\Speaker */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="speaker-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'session_id')->dropDownList(ArrayHelper::map(Session::find()->all(), 'id', 'title'), [
        'prompt' => Yii::t('app', 'Select a session')
    ]) ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resume')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 
                '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> '.Yii::t('app', 'Create') : 
                '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> '.Yii::t('app', 'Update'), 
            ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

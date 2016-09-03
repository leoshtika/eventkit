<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'starts')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => Yii::t('app', 'Enter event start time')],
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]);
    ?>

    <?= $form->field($model, 'ends')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => Yii::t('app', 'Enter event end time')],
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]);
    ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 
                '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> '.Yii::t('app', 'Create') : 
                '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> '.Yii::t('app', 'Update'), 
            ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

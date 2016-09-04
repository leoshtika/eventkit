<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\Session;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SpeakerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Speakers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="speaker-index">
    <div class="row">
        <div class="col-sm-6 hidden-xs">
            <h1 class="allpages_title"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-sm-6 text-right allpages_buttons">
            <?= Html::a('<span class="glyphicon glyphicon-refresh"></span> '.Yii::t('app', 'Reset filters'), ['index'], ['class' => 'btn btn-default']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> '.Yii::t('app', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php Pjax::begin(); ?> <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'label' => '#',
                'headerOptions' => ['class' => 'column_id'],
                'contentOptions' => ['class' => 'column_id'],
            ],
            [
                'attribute' => 'session_id',
                'value' => function ($searchModel){
                    return $searchModel->session->title;
                },
                'filter' => Html::activeDropDownList($searchModel, 'session_id', ArrayHelper::map(Session::find()->asArray()->all(), 'id', 'title'), [
                    'prompt' => Yii::t('app', 'Show all'),
                    'class' => 'form-control',
                ]),
            ],
            'full_name',
            'email:email',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d/m/Y h:i'],
                'filter'=>false,
                'filterOptions' => ['class' => 'hidden-xs'],
                'headerOptions' => ['class' => 'hidden-xs'],
                'contentOptions' => ['class' => 'hidden-xs'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['class' => 'column_buttons'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

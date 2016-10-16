<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\Event;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sessions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="session-index">
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
            'title',
            [
                'attribute' => 'starts',
                'filter' => false,
            ],
            [
                'attribute' => 'ends',
                'filter' => false,
            ],
            [
                'header' => Yii::t('app', 'Speakers'),
                'value' => function($searchModel) {
                    return implode(', ', ArrayHelper::map($searchModel->speakers, 'id', 'full_name'));
                },
            ],
            [
                'attribute' => 'event_id',
                'value' => function ($searchModel){
                    return $searchModel->event->title;
                },
                'filter' => Html::activeDropDownList($searchModel, 'event_id', ArrayHelper::map(Event::find()->asArray()->all(), 'id', 'title'), [
                    'prompt' => '',
                    'class' => 'form-control',
                ]),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['class' => 'column_buttons'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

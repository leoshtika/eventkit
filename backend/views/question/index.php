<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\Session;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Questions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">
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
                    'prompt' => '',
                    'class' => 'form-control',
                ]),
            ],
            [
                'attribute' => 'user_id',
                'value' => function ($searchModel){
                    return $searchModel->user->full_name;
                },
                'filter' => Html::activeDropDownList($searchModel, 'user_id', ArrayHelper::map(User::find()->asArray()->all(), 'id', 'full_name'), [
                    'prompt' => '',
                    'class' => 'form-control',
                ]),
            ],
            'question:ntext',
            [
                'attribute' => 'status',
                'value' => 'statusLabel',
                'filter' => Html::activeDropDownList($searchModel, 'status', $searchModel->getStatusList(), [
                    'prompt' => '',
                    'class' => 'form-control',
                ]),
            ],
            [
                'attribute' => 'created_at',
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

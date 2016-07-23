<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
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
            'full_name',
            'email:email',
            [
                'attribute' => 'role',
                'value' => 'roleLabel',
                'filter' => Html::activeDropDownList($searchModel, 'role', $searchModel->getRoleList(), [
                    'prompt' => '',
                    'class' => 'form-control',
                ])
            ],
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

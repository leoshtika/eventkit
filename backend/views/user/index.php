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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
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
<?php Pjax::end(); ?></div>

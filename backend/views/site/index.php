<?php

use yii\helpers\Html;
use common\models\User;
use common\models\Event;
use common\models\Session;
use common\models\Speaker;
use common\models\Question;

/* @var $this yii\web\View */

$this->title = 'EventKit' . ' - ' . Yii::t('app', 'Backend');
?>
<div class="site-index">
    <div class="body-content">
        <h1 class="allpages_title"><?= Yii::t('app', 'Dashboard') ?></h1>
        <hr>
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-success">
                    <div class="panel-heading panel_dashboard_header">
                        <?= Event::find()->count() ?> 
                        <?= Yii::t('app', 'Events') ?>
                    </div>
                    <div class="panel-body">
                        <span class="glyphicon glyphicon-blackboard panel_dashboard_icon" aria-hidden="true"></span> 
                        <?= Yii::t('app', 'Upcoming') ?>: 
                        <?php if (Event::getUpcoming()) : ?>
                            <span class="text-muted"><?= date('M j, Y H:i', strtotime(Event::getUpcoming()->starts)) ?></span>
                            <div><?= Html::a(Event::getUpcoming()->title, ['event/view', 'id'=>Event::getUpcoming()->id]) ?></div>
                        <?php else: ?>
                            <?=  Yii::t('app', 'None') ?>
                        <?php endif; ?>
                    </div>
                    <div class="panel-footer text-right">
                        <?= Html::a(
                                Yii::t('app', 'Show all') . ' <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', 
                                ['event/index'])
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading panel_dashboard_header">
                        <?= Session::find()->count() ?> 
                        <?= Yii::t('app', 'Sessions') ?>
                    </div>
                    <div class="panel-body">
                        <span class="glyphicon glyphicon-time panel_dashboard_icon" aria-hidden="true"></span> 
                        <?= Yii::t('app', 'See all the sessions') ?>
                    </div>
                    <div class="panel-footer text-right">
                        <?= Html::a(
                                Yii::t('app', 'Show all') . ' <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', 
                                ['session/index'])
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading panel_dashboard_header">
                        <?= Speaker::find()->count() ?> 
                        <?= Yii::t('app', 'Speakers') ?>
                    </div>
                    <div class="panel-body">
                        <span class="glyphicon glyphicon-bullhorn panel_dashboard_icon" aria-hidden="true"></span> 
                        <?= Yii::t('app', 'See all the speakers') ?>
                    </div>
                    <div class="panel-footer text-right">
                        <?= Html::a(
                                Yii::t('app', 'Show all') . ' <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', 
                                ['speaker/index'])
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading panel_dashboard_header">
                        <?= Question::find()->count() ?> 
                        <?= Yii::t('app', 'Questions') ?>
                    </div>
                    <div class="panel-body">
                        <span class="glyphicon glyphicon-question-sign panel_dashboard_icon" aria-hidden="true"></span> 
                        <?= Yii::t('app', 'See all the questions') ?>
                    </div>
                    <div class="panel-footer text-right">
                        <?= Html::a(
                                Yii::t('app', 'Show all') . ' <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', 
                                ['question/index'])
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading panel_dashboard_header">
                        <?= User::find()->count() ?> 
                        <?= Yii::t('app', 'Users') ?>
                    </div>
                    <div class="panel-body">
                        <span class="glyphicon glyphicon-user panel_dashboard_icon" aria-hidden="true"></span> 
                        <?= Yii::t('app', 'See all the users') ?>
                    </div>
                    <div class="panel-footer text-right">
                        <?= Html::a(
                                Yii::t('app', 'Show all') . ' <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', 
                                ['user/index'])
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-warning">
                    <div class="panel-heading panel_dashboard_header">
                        <?= Yii::t('app', 'Settings') ?>
                    </div>
                    <div class="panel-body">
                        <span class="glyphicon glyphicon-cog panel_dashboard_icon" aria-hidden="true"></span> 
                        <?= Yii::t('app', 'See all framework settings') ?>
                    </div>
                    <div class="panel-footer text-right">
                        <?= Html::a(
                                Yii::t('app', 'Show all') . ' <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', 
                                '#')
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

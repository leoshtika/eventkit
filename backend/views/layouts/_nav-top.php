<?php

use yii\helpers\Html;
use common\models\User;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use cebe\gravatar\Gravatar;

/* @var $this yii\web\View */
/* @var $menuData Array of data used for the menu items */

NavBar::begin([
    'brandLabel' => '<i class="glyphicon glyphicon-cloud" style="font-size:24px;"></i>EventKit',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
    'renderInnerContainer' => false,
]);

if (Yii::$app->user->isGuest) {

    $menuItems[] = [
        'label' => $menuData['frontend']['label'],
        'url' => $menuData['frontend']['url'],
    ];
    $menuItems[] = [
        'label' => '<i class="glyphicon glyphicon-'.$menuData['login']['icon'].'"></i>'
        .$menuData['login']['label'],
        'url' => $menuData['login']['url'],
    ];

} else {

    // Show menu items only for admins
    if (User::isAdmin(Yii::$app->user->identity->email)) {

        $menuData['updateProfile'] = [
            'label' => Yii::t('app', 'Update profile'),
            'url' => ['user/update', 'id' => Yii::$app->user->identity->id],
            'icon' => 'cog',
        ];

        // Get avatar image from gravatar
        $gravatarImg = Html::a(
            Gravatar::widget([
                'email' => Yii::$app->user->identity->email,
                'defaultImage' => 'mm',
                'options' => [
                    'alt' => Yii::$app->user->identity->full_name,
                    'class' => 'img-circle'
                ],
                'size' => 70
            ]), ['user/view', 'id' => Yii::$app->user->identity->id]
        );

        // Menu for large screens (hidden in 'xs')
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-user"></i>' . Yii::$app->user->identity->full_name,
            'url' => '#',
            'options' => ['class' => 'hidden-xs'],
            'items' => [
                '<li class="profile">'
                    .$gravatarImg
                    .'<div class="role">'.Yii::$app->user->identity->roleLabel.'</div>'
                    .'<div class="email">'.Yii::$app->user->identity->email.'</div>'
                .'</li>',
                '<li class="divider"></li>',
                [
                    'label' => '<i class="glyphicon glyphicon-'.$menuData['updateProfile']['icon'].'"></i>'
                    .$menuData['updateProfile']['label'],
                    'url' => $menuData['updateProfile']['url'],
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-'.$menuData['help']['icon'].'"></i>'
                    .$menuData['help']['label'],
                    'url' => $menuData['help']['url'],
                ],

                [
                    'label' => '<i class="glyphicon glyphicon-'.$menuData['frontend']['icon'].'"></i>'
                    .$menuData['frontend']['label'],
                    'url' => $menuData['frontend']['url'],
                ],
                '<li class="divider"></li>',
                [
                    'label' => '<i class="glyphicon glyphicon-'.$menuData['logout']['icon'].'"></i>'
                    .$menuData['logout']['label'],
                    'url' => $menuData['logout']['url'],
                    'linkOptions' => ['data-method' => 'post'],
                ],
            ],
        ];

        // Menu for small screens (visible only in 'xs')
        $menuItems[] = 
            '<li class="profile visible-xs">'
                .$gravatarImg
                .'<div class="name">'.Yii::$app->user->identity->full_name.'</div>'
                .'<div class="email">'.Yii::$app->user->identity->email.'</div>'
                .'<div class="role">'.Yii::$app->user->identity->roleLabel.'</div>'
            .'</li>';
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-'.$menuData['dashboard']['icon'].'"></i>'
            .$menuData['dashboard']['label'], 
            'url' => $menuData['dashboard']['url'],
            'options' => ['class' => 'visible-xs'],
        ];
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-'.$menuData['event']['icon'].'"></i>'
            .$menuData['event']['label'], 
            'url' => $menuData['event']['url'],
            'options' => ['class' => 'visible-xs'],
        ];
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-'.$menuData['session']['icon'].'"></i>'
            .$menuData['session']['label'], 
            'url' => $menuData['session']['url'],
            'options' => ['class' => 'visible-xs'],
        ];
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-'.$menuData['speaker']['icon'].'"></i>'
            .$menuData['speaker']['label'], 
            'url' => $menuData['speaker']['url'],
            'options' => ['class' => 'visible-xs'],
        ];
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-'.$menuData['question']['icon'].'"></i>'
            .$menuData['question']['label'] . Html::tag('span', $menuData['question']['badge'], ['class' => 'badge']), 
            'url' => $menuData['question']['url'],
            'options' => ['class' => 'visible-xs'],
        ];
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-'.$menuData['user']['icon'].'"></i>'
            .$menuData['user']['label'], 
            'url' => $menuData['user']['url'],
            'options' => ['class' => 'visible-xs'],
        ];
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-'.$menuData['settings']['icon'].'"></i>'
            .$menuData['settings']['label'], 
            'url' => $menuData['settings']['url'],
            'options' => ['class' => 'visible-xs'],
        ];
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-'.$menuData['help']['icon'].'"></i>'
            .$menuData['help']['label'], 
            'url' => $menuData['help']['url'],
            'options' => ['class' => 'visible-xs'],
        ];
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-'.$menuData['frontend']['icon'].'"></i>'
            .$menuData['frontend']['label'], 
            'url' => $menuData['frontend']['url'],
            'options' => ['class' => 'visible-xs'],
        ];
        $menuItems[] = [
            'label' => '<i class="glyphicon glyphicon-'.$menuData['logout']['icon'].'"></i>'
            .$menuData['logout']['label'], 
            'url' => $menuData['logout']['url'],
            'linkOptions' => ['data-method' => 'post'],
            'options' => ['class' => 'visible-xs'],
        ];

    } else {
        // For users but not admins
        $menuItems[] = [
            'label' => $menuData['frontend']['label'],
            'url' => $menuData['frontend']['url'],
        ];
    }
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
    'encodeLabels' => false,
]);

NavBar::end();

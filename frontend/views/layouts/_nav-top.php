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
        'class' => 'navbar-default navbar-fixed-top',
    ],
]);

$menuItems = [];

/* Menu for large screens (hidden in 'xs') */
$menuItems[] = [
    'label' => $menuData['home']['label'],
    'url' => $menuData['home']['url'],
    'options' => ['class' => 'hidden-xs'],
];
$menuItems[] = [
    'label' => $menuData['about']['label'],
    'url' => $menuData['about']['url'],
    'options' => ['class' => 'hidden-xs'],
];
$menuItems[] = [
    'label' => $menuData['contact']['label'],
    'url' => $menuData['contact']['url'],
    'options' => ['class' => 'hidden-xs'],
];

if (Yii::$app->user->isGuest) {
    $menuItems[] = [
        'label' => $menuData['signup']['label'],
        'url' => $menuData['signup']['url'],
        'options' => ['class' => 'hidden-xs'],
    ]; 
    $menuItems[] = [
        'label' => '<i class="glyphicon glyphicon-'.$menuData['login']['icon'].'"></i>'
        .$menuData['login']['label'], 
        'url' => $menuData['login']['url'],
        'options' => ['class' => 'hidden-xs'],
    ];
} else {
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
        ]), $menuData['updateProfile']['url']
    );

    $menuItems[] = [
        'label' => '<i class="glyphicon glyphicon-user"></i>' . Yii::$app->user->identity->full_name,
        'url' => '#',
        'options' => ['class' => 'hidden-xs'],
        'items' => [
            '<li class="profile">'
            . $gravatarImg
            . '<div class="role">' . Yii::$app->user->identity->roleLabel . '</div>'
            . '<div class="email">' . Yii::$app->user->identity->email . '</div>'
            . '</li>',
            '<li class="divider"></li>',
            [
                'label' => '<i class="glyphicon glyphicon-' . $menuData['updateProfile']['icon'] . '"></i>'
                . $menuData['updateProfile']['label'],
                'url' => $menuData['updateProfile']['url'],
            ],
            [
                'label' => '<i class="glyphicon glyphicon-' . $menuData['backend']['icon'] . '"></i>'
                . $menuData['backend']['label'],
                'url' => $menuData['backend']['url'],
                'visible' => User::isAdmin(Yii::$app->user->identity->email),
            ],
            '<li class="divider"></li>',
            [
                'label' => '<i class="glyphicon glyphicon-' . $menuData['logout']['icon'] . '"></i>'
                . $menuData['logout']['label'],
                'url' => $menuData['logout']['url'],
                'linkOptions' => ['data-method' => 'post'],
            ],
        ],
    ]; 
}

/* Menu for small screens (visible only in 'xs') */
if (!Yii::$app->user->isGuest) {
    $menuItems[] = 
        '<li class="profile visible-xs">'
            .$gravatarImg
            .'<div class="name">'.Yii::$app->user->identity->full_name.'</div>'
            .'<div class="email">'.Yii::$app->user->identity->email.'</div>'
            .'<div class="role">'.Yii::$app->user->identity->roleLabel.'</div>'
        .'</li>';
}

$menuItems[] = [
    'label' => '<i class="glyphicon glyphicon-'.$menuData['about']['icon'].'"></i>'
    .$menuData['about']['label'], 
    'url' => $menuData['about']['url'], 
    'options' => ['class' => 'visible-xs'],
];
$menuItems[] = [
    'label' => '<i class="glyphicon glyphicon-'.$menuData['contact']['icon'].'"></i>'
    .$menuData['contact']['label'], 
    'url' => $menuData['contact']['url'], 
    'options' => ['class' => 'visible-xs'],
];

if (Yii::$app->user->isGuest) {
    $menuItems[] = [
        'label' => '<i class="glyphicon glyphicon-'.$menuData['signup']['icon'].'"></i>'
        .$menuData['signup']['label'], 
        'url' => $menuData['signup']['url'],
        'options' => ['class' => 'visible-xs'],
    ];
    $menuItems[] = [
        'label' => '<i class="glyphicon glyphicon-'.$menuData['login']['icon'].'"></i>'
        .$menuData['login']['label'], 
        'url' => $menuData['login']['url'],
        'options' => ['class' => 'visible-xs'],
    ];
} else {
    $menuItems[] = [
        'label' => '<i class="glyphicon glyphicon-'.$menuData['backend']['icon'].'"></i>'
        .$menuData['backend']['label'],
        'url' => $menuData['backend']['url'],
        'options' => ['class' => 'visible-xs'],
        'visible' => User::isAdmin(Yii::$app->user->identity->email),
    ];
    $menuItems[] = [
        'label' => '<i class="glyphicon glyphicon-'.$menuData['logout']['icon'].'"></i>'
        .$menuData['logout']['label'],
        'url' => $menuData['logout']['url'],
        'linkOptions' => ['data-method' => 'post'],
        'options' => ['class' => 'visible-xs'],
    ];
}
    
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
    'encodeLabels' => false,
]);
NavBar::end();

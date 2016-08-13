<?php 

use leoshtika\bootstrap\NavSidebar;

/* @var $this yii\web\View */
/* @var $menuData Array of data used for the menu items */

?>
<?= NavSidebar::widget([
    'items' => [
        $menuData['dashboard'],
        $menuData['event'],
        $menuData['session'],
        $menuData['speaker'],
        $menuData['question'],
        $menuData['user'],
    ]
]);
?>

<hr>

<?= NavSidebar::widget([
    'items' => [
        $menuData['settings'],
    ]
]);

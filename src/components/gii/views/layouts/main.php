<?php

use yii\widgets\Menu;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$asset = yii\gii\GiiAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="none">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<div class="page-container">
    <?php $this->beginBody() ?>
    <div class="container content-container">
        <?= $content ?>
    </div>
    <div class="footer-fix"></div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<style type="text/css">
    .content-container{
        padding-top: 0;
    }
</style>

<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $generators \yii\gii\Generator[] */
/* @var $activeGenerator \yii\gii\Generator */
/* @var $content string */

$generators = Yii::$app->controller->module->generators;
$activeGenerator = Yii::$app->controller->generator;
?>
<?php $this->beginContent('@vendor/myzero1/yii2-restbyconf/src/components/gii/views/layouts/main.php'); ?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <?= $content ?>
    </div>
</div>
<?php $this->endContent(); ?>

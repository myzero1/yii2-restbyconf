<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\module\Generator */

$asset = myzero1\restbyconf\assets\php\JsonEditorAsset::register($this);
$confDataPath = Yii::getAlias('@vendor/myzero1/yii2-restbyconf/src/components/conf/conf.json');
$confData = file_get_contents($confDataPath);

?>

<div class="rest-form">
    <?php
        $generator->conf = $confData;
        echo $form->field($generator, 'conf')->label('Api配置');
    ?>

    <div id="jsoneditor"></div>

    <div id="restbyconfoptions" style="display: none;">
        <?= $confData ?>
    </div>
</div>

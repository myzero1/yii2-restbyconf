<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\module\Generator */

$asset = myzero1\restbyconf\assets\php\JsonEditorAsset::register($this);
$confDataPathTmp = Yii::getAlias('@vendor/myzero1/yii2-restbyconf/src/components/conf/conf.json');
$confDataPathDefault = Yii::getAlias('@vendor/myzero1/yii2-restbyconf/src/components/conf/confDefault.json');

if (is_file($confDataPathTmp)) {
    $confDataTmp = file_get_contents($confDataPathTmp);
    if (empty($confDataTmp)) {
        $confDataInit = file_get_contents($confDataPathDefault);
    } else {
        $confDataInit = $confDataTmp;
    }
}

if ($generator->conf) {
    $confData = $generator->conf;
} else {
    $generator->conf = $confDataInit;
    $confData = $confDataInit;
}

?>

<style type="text/css">
    .modal.fade.show{
        opacity:1;
    }
</style>

<div class="rest-form">
    <?php
        echo $form->field($generator, 'conf')->label('Api configuration');
        // echo $form->field($generator, 'conf')->label('Api configuration')->hiddenInput();
    ?>

    <div id="jsoneditor"></div>

    <div id="restbyconfoptions" style="display: none;">
        <?= $confData ?>
    </div>
</div>

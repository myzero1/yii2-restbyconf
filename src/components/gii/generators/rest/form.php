<?php
use myzero1\restbyconf\components\rest\ApiHelper;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\module\Generator */

$asset = myzero1\restbyconf\assets\php\JsonEditorAsset::register($this);

$confDataInit = ApiHelper::getApiConf();

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

<?php
use myzero1\restbyconf\components\rest\ApiHelper;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\module\Generator */

$asset = myzero1\restbyconf\assets\php\JsonEditorAsset::register($this);

// basePath
if ($generator->conf) {
    $conf = json_decode($generator->conf, true);
    $moduleId = trim($conf['json']['basePath'], '/');
} else {
    $moduleId = 'v1';
}
$confDataInit = ApiHelper::getApiConf($moduleId);
// $confDataInit = '';

if ($generator->conf) {
    $confData = $generator->conf;
} else {
    $generator->conf = $confDataInit;
    $confData = $confDataInit;
}

if ($generator->position) {
    $position = $generator->position;
} else {
    $position = '["controllers"]';
}

?>

<style type="text/css">
    .modal.fade.show{
        opacity:1;
    }
</style>

<div class="rest-form">
    <?php
        // echo $form->field($generator, 'position');
        echo $form->field($generator, 'position')->label('')->hiddenInput();
        // echo $form->field($generator, 'conf')->label('Api configuration');
        echo $form->field($generator, 'conf')->label('Api configuration')->hiddenInput();
    ?>

    <div id="jsoneditor"></div>

    <div id="restbyconfoptions" style="display: none;">
        <?= $confData ?>
    </div>
    <div id="restbyconfposition" style="display: none;">
        <?= $position ?>
    </div>
</div>

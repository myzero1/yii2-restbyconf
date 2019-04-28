<?php
use myzero1\restbyconf\components\rest\ApiHelper;
use yii\helpers\Url;
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

$mId = ApiHelper::getRestModuleName();

?>

<style type="text/css">
    .modal.fade.show{
        opacity:1;
    }
    .restbyconfig .navbar-brand{
        line-height: 50px;
        margin-left: 0 !important;
    }
</style>

<div class="rest-form">

    <nav class="navbar navbar-default restbyconfig" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">The other menu of restbyconfig</a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <li><a target="_blank" href="<?=Url::to([sprintf('/%s/default/swagger', $mId), 'mId' => $moduleId])?>">Swagger</a></li>
                    <li><a target="_blank" href="<?=Url::to([sprintf('/%s/default/markdown', $mId), 'mId' => $moduleId])?>">Markdown</a></li>
                </ul>
            </div>
        </div>
    </nav>

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

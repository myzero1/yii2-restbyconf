<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\module\Generator */

$asset = myzero1\restbyconf\assets\php\JsonEditorAsset::register($this);
?>

<div class="rest-form">
<?php
    echo $form->field($generator, 'conf')->label('Api配置');
?>


    <div id="jsoneditor"></div>
</div>

<?php

$confPath = Yii::getAlias('@vendor/myzero1/yii2-restbyconf/src/components/conf');
$schemaFile = sprintf('%s/schema.json', $confPath);
$jsonFile = sprintf('%s/json.json', $confPath);
$templatesFile = sprintf('%s/templates.json', $confPath);

$json = file_get_contents($jsonFile);
$schema = file_get_contents($schemaFile);
$templates = file_get_contents($templatesFile);

$json = json_encode(json_decode($json,true));
$schema = json_encode(json_decode($schema,true));
$templates = json_encode(json_decode($templates,true));



?>



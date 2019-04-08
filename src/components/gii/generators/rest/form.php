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



    <div id="restbyconfoptions">
        



{"schema":{"title":"The configuration of restful api","type":"object","required":["swagger","tags"],"properties":{"swagger":{"title":"swagger version","type":"string","minLength":1,"maxLength":32,"examples":["2.0","2.1"]},"tags":{"$ref":"tags"}}},"schemaRefs":{"schema":{"title":"The configuration of restful api","type":"object","required":["swagger","tags"],"properties":{"swagger":{"title":"swagger version","type":"string","minLength":1,"maxLength":32,"examples":["2.0","2.1"]},"tags":{"$ref":"tags"}}},"tags":{"title":"restbyconf-obj-tags","type":"object","required":[],"properties":{"TagTemplate":{"$ref":"tag"}}},"tag":{"title":"restbyconf-obj-tag","type":"object","required":["name","paths"],"properties":{"name":{"type":"string","minLength":1,"maxLength":32,"examples":["user","log"]},"paths":{"$ref":"paths"}}},"paths":{"title":"Paths description","type":"object","required":[],"properties":{"create":{"$ref":"create"},"":{"$ref":""}}},"create":{"title":"restbyconf-obj-path","type":"object","required":["name"],"properties":{"name":{"type":"string","minLength":1,"maxLength":32,"examples":["create","update"]},"inputs":{"$ref":"inputs"},"outputs":{"$ref":"outputs"}}},"outputs":{"title":"restbyconf-obj-outputs","type":"object","required":[],"properties":{"out_str":{"$ref":"out_str"}}},"out_str":{"title":"restbyconf-obj-output","type":"object","required":["eg"],"properties":{"des":{"type":"string","maxLength":32,"examples":["user name"]},"eg":{"type":"string","minLength":1,"maxLength":64,"examples":["myzero1"]}}},"inputs":{"title":"restbyconf-obj-inputs","type":"object","required":[],"properties":{"in_str":{"$ref":"in_str"}}},"in_str":{"title":"restbyconf-obj-input","type":"object","required":["des"],"properties":{"des":{"type":"string","minLength":1,"maxLength":32,"examples":["user name"]},"required":{"type":"boolean","default":false},"type":{"enum":["path","query","body"]},"eg":{"type":"string","minLength":1,"maxLength":32,"examples":["myzero1"]},"rules":{"type":"string","minLength":1,"maxLength":32,"examples":["^w{1,32}$"]},"error_msg":{"type":"string","minLength":1,"maxLength":64,"examples":["You should input a-z,A-Z,0-9"]}}},"index":{"title":"restbyconf-obj-path","type":"object","required":["name"],"properties":{"name":{"type":"string","minLength":1,"maxLength":32,"examples":["create","update"]},"inputs":{"$ref":"inputs"}}},"update":{"title":"restbyconf-obj-path","type":"object","required":["name"],"properties":{"name":{"type":"string","minLength":1,"maxLength":32,"examples":["create","update"]},"inputs":{"$ref":"inputs"}}},"view":{"title":"restbyconf-obj-path","type":"object","required":["name"],"properties":{"name":{"type":"string","minLength":1,"maxLength":32,"examples":["create","update"]},"inputs":{"$ref":"inputs"}}},"delete":{"title":"restbyconf-obj-path","type":"object","required":["name"],"properties":{"name":{"type":"string","minLength":1,"maxLength":32,"examples":["create","update"]},"inputs":{"$ref":"inputs"}}}}}




    </div>
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



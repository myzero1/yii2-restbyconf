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

$json = file_get_contents($jsonFile);
$schema = file_get_contents($schemaFile);

function getUnEditablePath($json){
    $unEditable = [
        'swagger',
        'info',
        'host',
        'basePath',
        'externalDocs',
        'schemes',
        'securityDefinitions',
    ];
    $json = json_decode($json, true);
    // var_dump($json);exit;
    $unEditablePath = [];
    foreach ($json as $k => $v) {
        if (in_array($k, $unEditable)) {
            $unEditablePath[] = $k;
            if (is_array($v)) {
                foreach ($v as $k1 => $v1) {
                    $unEditablePath[] = $k . '-' . $k1;
                    if (is_array($v1)) {
                        foreach ($v1 as $k2 => $v2) {
                            $unEditablePath[] = $k . '-' . $k1 . '-' . $k2;
                        }
                    }
                }
            }
        }
    }
    $unEditablePath[] = 'paths';
    $unEditablePath = json_encode($unEditablePath);

    return $unEditablePath;
}
// var_dump($json);exit;
$unEditablePath = getUnEditablePath($json);

$json = json_encode(json_decode($json,true));
$schema = json_encode(json_decode($schema,true));
$js = <<<js
    var onEditable = function(node) {
        var unEditable = [
            'swagger',
        ];
        // console.log(unEditable);
        if (Array.isArray(node.path)) {
            var path = node.path.join('-');
            if (unEditable.indexOf(path) > -1) {
                return false;
            } else {
                return {
                  field: false,
                  value: true
                };
            }
        } else {
            return true;
        }
    }

    var onChangeJSON = function onChangeJSON(json) {
        var conf = document.getElementById('generator-conf');
            conf.setAttribute('value', JSON.stringify(json));
    }

    var schema = $schema;

    var options = {
        name: "Restfull api configuration",
        schema: schema['schema'],
        schemaRefs: schema,
        mode: 'tree',
        modes: ['view', 'tree'],
        onEditable: onEditable,
        onChangeJSON: onChangeJSON
    };

    // create the editor
    var container = document.getElementById('jsoneditor');
    var editor = new JSONEditor(container, options, $json);
js;
$this->registerJS($js);

?>



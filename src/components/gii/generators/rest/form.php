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
$js = <<<js
    var adjustBackground = function() {
        $('.jsoneditor-values').each(function() {
            var style = $(this).attr('style');
            if (style.indexOf('margin-left: 24px') > -1)  {
                $(this).css({'background':'rgba(245, 245, 245, 0.8)'});
            } else if(style.indexOf('margin-left: 48px') > -1){
                $(this).css({'background':'rgba(235, 235, 235, 0.8)'});
            } else if(style.indexOf('margin-left: 72px') > -1){
                 $(this).css({'background':'rgba(225, 225, 225, 0.8)'});
            } else if(style.indexOf('margin-left: 96px') > -1){
                 $(this).css({'background':'rgba(215, 215, 215, 0.8)'});
            } else if(style.indexOf('margin-left: 120px') > -1){
                $(this).css({'background':'rgba(205, 205, 205, 0.8)'});
            } else if(style.indexOf('margin-left: 144px') > -1){
                $(this).css({'background':'rgba(195, 195, 195, 0.8)'});
            } else if(style.indexOf('margin-left: 168px') > -1){
                $(this).css({'background':'rgba(185, 185, 185, 0.8)'});
            } else if(style.indexOf('margin-left: 192px') > -1){
                $(this).css({'background':'rgba(175, 175, 175, 0.8)'});
            } else if(style.indexOf('margin-left: 216px') > -1){
                $(this).css({'background':'rgba(165, 165, 165, 0.8)'});
            } else if(style.indexOf('margin-left: 240px') > -1){
                $(this).css({'background':'rgba(155, 155, 155, 0.8)'});
            } else if(style.indexOf('margin-left: 264px') > -1){
                $(this).css({'background':'rgba(145, 145, 145, 0.8)'});
            }
        });
    }
    var onEditable = function(node) {
        adjustBackground();
        var unEditable = [
            'swagger',
            'securityDefinitions-api_key-type',
            'securityDefinitions-api_key-in'
        ];
        // console.log(unEditable);
        if (Array.isArray(node.path)) {
            var path = node.path.join('-');
            if (unEditable.indexOf(path) > -1) {
                return false;
            } else {
                if(node.path.length == 2 && node.path[0] == 'tags'){
                    return true;
                } else if(node.path.length == 4 && node.path[0] == 'tags' && node.path[2] == 'paths'){
                    return true;
                } else {
                    return {
                      field: false,
                      value: true
                    };
                }
            }
        } else {
            return true;
        }
    }

    var onChangeJSON = function onChangeJSON(json) {
        var conf = document.getElementById('generator-conf');
            conf.setAttribute('value', JSON.stringify(json));
    }
    
    var onCreateMenu = function onCreateMenu(items, path) {
        // console.log(items);
        console.log(path);
        
        return items;
        return [];
    }

    var onEvent = function onEvent(node, event) {
        if (event.type == 'mouseout') {

            if(node.path.length == 2 && node.path[0] == 'tags'){
                console.log(node);

                var schema = this.schema;
                schema['properties'][node.field] = {
                  "\$ref": "tag"
                };

                editor.setSchema(schema,this.schemaRefs);

            }
            // console.log(node);
        }
    }

    var schema = $schema;

    var options = {
        name: "Restfull api configuration",
        schema: schema['schema'],
        schemaRefs: schema,
        templates: $templates,
        mode: 'tree',
        modes: ['view', 'tree'],
        onEditable: onEditable,
        onChangeJSON: onChangeJSON,
        onCreateMenu: onCreateMenu,
        onEvent: onEvent
    };

    // create the editor
    var container = document.getElementById('jsoneditor');
    var editor = new JSONEditor(container, options, $json);
    adjustBackground();
js;
$this->registerJS($js);

?>



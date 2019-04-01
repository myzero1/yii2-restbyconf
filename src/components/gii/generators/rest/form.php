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

$json = <<<'json'
{
    "firstName": "John",
    "lastName": "Doe",
    "gender": "null",
    "age": "28",
    "availableToHire": true,
    "job": {
      "company": "freelance",
      "role": "developer",
      "salary": 100
    }
}
json;
// $json = json_encode(json_decode($json,true));

$schema = <<<'json'
{
    "schema": {
        "title": "Example Schema",
        "type": "object",
        "properties": {
          "firstName": {
            "title": "First Name",
            "description": "The given name.",
            "examples": [
              "John"
            ],
            "type": "string"
          },
          "lastName": {
            "title": "Last Name",
            "description": "The family name.",
            "examples": [
              "Smith"
            ],
            "type": "string"
          },
          "gender": {
            "title": "Gender",
            "enum": ["male", "female"]
          },
          "availableToHire": {
            "type": "boolean",
            "default": false
          },
          "age": {
            "description": "Age in years",
            "type": "integer",
            "minimum": 0,
            "examples": [28, 32]
          },
          "job": {
            "$ref": "job"
          }
        },
        "required": ["firstName", "lastName"]
    },
    "job": {
        "title": "Job description",
        "type": "object",
        "required": ["address"],
        "properties": {
          "company": {
            "type": "string",
            "examples": [
              "ACME",
              "Dexter Industries"
            ]
          },
          "role": {
            "description": "Job title.",
            "type": "string",
            "examples": [
              "Human Resources Coordinator",
              "Software Developer"
            ],
            "default": "Software Developer"
          },
          "address": {
            "type": "string"
          },
          "salary": {
            "type": "number",
            "minimum": 120,
            "examples": [100, 110, 120]
          }
        }
    }
}
json;
// $schema = json_encode(json_decode($schema,true));
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
    function onEditable(node) {
        var unEditable = $unEditablePath;
        // console.log(unEditable);
        if (Array.isArray(node.path)) {
            var path = node.path.join('-');
            if (unEditable.indexOf(path) > -1) {
                return {
                  field: false,
                  value: true
                };
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    var schema = $schema;

    var options = {
        schema: schema['schema'],
        schemaRefs: {"job": schema['job']},
        mode: 'tree',
        modes: ['view', 'tree']
    };

    // create the editor
    var container = document.getElementById('jsoneditor');
    var editor = new JSONEditor(container, options, $json);
js;
$this->registerJS($js);

?>



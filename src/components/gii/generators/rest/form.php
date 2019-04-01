<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\module\Generator */

use kdn\yii2\JsonEditor;

$onEditable = <<<'js'
function onEditable(node) {
    var unEditable = [
        'swagger',
        'info',
        'host'
    ];
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
js;


$generator->conf = json_encode([
    'swagger' => '2.0',
    'info' => 'info',
    'host' => 'petstore.swagger.io',
    'basePath' => '/v2',
    'externalDocs' => [
            'description' => 'Find out more about Swagger',
            'url' => 'http://swagger.io',
    ],
    'schemes' => ['http', 'http'],
    'securityDefinitions' => [
        'api_key' => [
                'type' => 'apiKey',
                'name' => 'api_key',
                'in' => 'header',
        ],
    ],
    'paths' => 'paths',
]);



?>
<div class="rest-form">
<?php
    echo $form->field($generator, 'conf')->label('Api配置')->widget(
        '\kdn\yii2\JsonEditor',
        [
            'clientOptions' => [
                'modes' => ['tree', 'view'],
                'onEditable' => $onEditable,
            ],
        ]
    );
?>
</div>

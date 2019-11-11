<?php

use myzero1\restbyconf\components\rest\ApiHelper;

/**
 * This is the template for generating a controller class within a module.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */

$confAarray = json_decode($generator->conf, true);
$restModuleAlias = $confAarray['json']['restModuleAlias'];

$action = $generator->action;
$actionClass = ucwords($action) . 'Io';
$controllerV = $generator->controllerV;
$actions = array_keys($controllerV['actions']);
$moduleClass = $generator->moduleClass;
$processingClassNs = sprintf('%s\processing\%s\io', $restModuleAlias, $generator->controller);

$getInputs = $controllerV['actions'][$action]['inputs']['query_params'];
$getInputs = ApiHelper::rmNode($getInputs);

$pathInputs = $controllerV['actions'][$action]['inputs']['path_params'];
$pathInputsKeys = array_keys($pathInputs);

$getInputs = array_merge($getInputs, $pathInputs);
$getInputsKeys = array_keys($getInputs);

$getInputRules = [];
foreach ($getInputs as $key => $value) {
    if ($value['required']) {
        $getInputRules[] = sprintf("\$modelGet->addRule(['%s'], 'required');", $key);
    }

    if ($value['rules'] == 'safe') {
        $getInputRules[] = sprintf("\$modelGet->addRule(['%s'], 'safe');", $key, $value['rules']);
    } else {
        $getInputRules[] = sprintf("\$modelGet->addRule(['%s'], 'match', ['pattern' => '/%s/i', 'message' => '\'{attribute}\':%s']);", $key, $value['rules'], $value['error_msg']);
    }
}

$postInputs = $controllerV['actions'][$action]['inputs']['body_params'];
$postInputs = ApiHelper::rmNode($postInputs);
$postInputsKeys = array_keys($postInputs);
$postInputRules = [];

foreach ($postInputs as $key => $value) {
    if ($value['required']) {
        $postInputRules[] = sprintf("\$modelPost->addRule(['%s'], 'required');", $key);
    }

    if ($value['rules'] == 'safe') {
        $postInputRules[] = sprintf("\$modelPost->addRule(['%s'], 'safe');", $key, $value['rules']);
    } else {
        $postInputRules[] = sprintf("\$modelPost->addRule(['%s'], 'match', ['pattern' => '/%s/i', 'message' => '\'{attribute}\':%s']);", $key, $value['rules'], $value['error_msg']);
    }
}

$inputsKeys = array_merge($postInputsKeys, $getInputsKeys);

$outputs = $controllerV['actions'][$action]['outputs'];
$outputs = ApiHelper::rmNode($outputs);
$egOutputData = $outputs;

$templateParams = $generator->getApiIoProcessingParams();

echo "<?php\n";
?>
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace <?= $templateParams['namespace'] ?>;

use Yii;
use yii\base\DynamicModel;
use yii\web\ServerErrorHttpException;
use myzero1\restbyconf\components\rest\Helper;
use myzero1\restbyconf\components\rest\ApiCodeMsg;
use myzero1\restbyconf\components\rest\ApiHelper;
use myzero1\restbyconf\components\rest\ApiIoProcessing;

/**
 * implement the UpdateProcessing
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class <?= $templateParams['className'] ?> implements ApiIoProcessing
{

    /**
     * @param  array $input from the request body
     * @return array
     */
    public static function inputValidate($input)
    {
        $inputFields = [
<?php foreach ($templateParams['inputsKeys'] as $key => $value) { ?>
            '<?=$value?>',
<?php } ?>
            'sort',
            'page',
            'page_size',
        ];

        // get
        $modelGet = new DynamicModel($inputFields);

        $modelGet->addRule($inputFields, 'trim');
        $modelGet->addRule($inputFields, 'safe');

<?php foreach ($templateParams['getInputRules'] as $key => $value) { ?>
        <?=$value."\n"?>
<?php } ?>

        $modelGet->load($input['get'], '');

        if (!$modelGet->validate()) {
            return ApiHelper::getModelError($modelGet, ApiCodeMsg::BAD_REQUEST);
        }

        // post
        $modelPost = new DynamicModel($inputFields);

        $modelPost->addRule($inputFields, 'trim');
        $modelPost->addRule($inputFields, 'safe');

<?php foreach ($templateParams['postInputRules'] as $key => $value) { ?>
        <?=$value."\n"?>
<?php } ?>

        $modelPost->load($input['post'], '');

        if (!$modelPost->validate()) {
            return ApiHelper::getModelError($modelPost, ApiCodeMsg::BAD_REQUEST);
        }

        $getAttributes = Helper::inputFilter($modelGet->attributes);
        $postAttributes = Helper::inputFilter($modelPost->attributes);
        $attributes = array_merge($postAttributes, $getAttributes);

        return array_merge($modelGet->attributes, $attributes);
    }

    /**
     * @return array
     */
    public static function egOutputData()
    {
        $egOutputData = '<?=serialize($templateParams['egOutputData'])?>';

        return ApiHelper::filterEgOutputData($egOutputData);
    }
}
<?php

use myzero1\restbyconf\components\rest\ApiHelper;

/**
 * This is the template for generating a controller class within a module.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */

$action = $generator->action;
$actionClass = ucwords($action) . 'Io';
$controllerV = $generator->controllerV;
$actions = array_keys($controllerV['actions']);
$moduleClass = $generator->moduleClass;
$processingClassNs = sprintf('%s\processing\%s\io', dirname($moduleClass), $generator->controller);

$getInputs = $controllerV['actions'][$action]['inputs']['query_params'];
$getInputs = ApiHelper::rmNode($getInputs);

$pathInputs = $controllerV['actions'][$action]['inputs']['path_params'];
$pathInputsKeys = array_keys($pathInputs);

$getInputs = array_merge($getInputs, $pathInputs);
$getInputsKeys = array_keys($getInputs);

$getInputRules = [];
if (count($getInputs)) {
    $getInputRules[] = sprintf("\$modelGet->addRule(['%s'], 'trim');", implode("','", $getInputsKeys));
}
foreach ($getInputs as $key => $value) {
    if ($value['required']) {
        $getInputRules[] = sprintf("\$modelGet->addRule(['%s'], 'required');", $key);
    }
    $getInputRules[] = sprintf("\$modelGet->addRule(['%s'], 'match', ['pattern' => '/%s/i', 'message' => '\'{attribute}\':%s']);", $key, $value['rules'], $value['error_msg']);
}

$postInputs = $controllerV['actions'][$action]['inputs']['body_params'];
$postInputs = ApiHelper::rmNode($postInputs);
$postInputsKeys = array_keys($postInputs);
$postInputRules = [];

$inputsKeys = array_merge($postInputsKeys, $getInputsKeys);

if (count($postInputs)) {
    $postInputRules[] = sprintf("\$modelPost->addRule(['%s'], 'trim');", implode("','", $postInputsKeys));
}
foreach ($postInputs as $key => $value) {
    if ($value['required']) {
        $postInputRules[] = sprintf("\$modelPost->addRule(['%s'], 'required');", $key);
    }
    $postInputRules[] = sprintf("\$modelPost->addRule(['%s'], 'match', ['pattern' => '/%s/i', 'message' => '\'{attribute}\':%s']);", $key, $value['rules'], $value['error_msg']);
}

$outputs = $controllerV['actions'][$action]['outputs'];
$outputs = ApiHelper::rmNode($outputs);
$egOutputData = $outputs;


echo "<?php\n";
?>
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace <?=$processingClassNs?>;

use Yii;
use yii\base\DynamicModel;
use yii\web\ServerErrorHttpException;
use myzero1\restbyconf\components\rest\Helper;
use myzero1\restbyconf\components\rest\ApiCodeMsg;
use myzero1\restbyconf\components\rest\ApiIoProcessing;

/**
 * implement the UpdateProcessing
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class <?=$actionClass?> implements ApiIoProcessing
{

    /**
     * @param  array $input from the request body
     * @return array
     */
    public static function inputValidate($input)
    {
        $inputFields = [
<?php foreach ($inputsKeys as $key => $value) { ?>
            '<?=$value?>',
<?php } ?>
            'id',
            'sort',
            'page',
            'page_size',
        ];

        // get
        $modelGet = new DynamicModel($inputFields);

        $modelGet->addRule($inputFields, 'trim');
        $modelGet->addRule($inputFields, 'safe');

<?php foreach ($getInputRules as $key => $value) { ?>
        <?=$value."\n"?>
<?php } ?>

        $modelGet->load($input['get'], '');

        if (!$modelGet->validate()) {
            $errors = $modelGet->errors;
            return [
                'code' => ApiCodeMsg::CLIENT_ERROR,
                'msg' => Helper::getErrorMsg($errors),
                'data' => $errors,
            ];
        }

        // post
        $modelPost = new DynamicModel($inputFields);

        $modelPost->addRule($inputFields, 'trim');
        $modelPost->addRule($inputFields, 'safe');

<?php foreach ($postInputRules as $key => $value) { ?>
        <?=$value."\n"?>
<?php } ?>

        $modelPost->load($input['post'], '');

        if (!$modelPost->validate()) {
            $errors = $modelPost->errors;
            return [
                'code' => ApiCodeMsg::CLIENT_ERROR,
                'msg' => Helper::getErrorMsg($errors),
                'data' => $errors,
            ];
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
        $egOutputData = '<?=serialize($egOutputData)?>';

        return unserialize($egOutputData);
    }
}

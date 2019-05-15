<?php

use myzero1\restbyconf\components\rest\ApiHelper;

/**
 * This is the template for generating a controller class within a module.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */

$action = $generator->action;
$actionClass = ucwords($action);
$controllerV = $generator->controllerV;
$actions = array_keys($controllerV['actions']);
$moduleClass = $generator->moduleClass;
$processingClassNs = sprintf('%s\processing\%s', dirname($moduleClass), $generator->controller);
$ioClass = sprintf('%s\processing\%s\io\%sIo', dirname($moduleClass), $generator->controller, $actionClass);
$ioClassName = sprintf('%sIo', $actionClass);

$getInputs = $controllerV['actions'][$action]['inputs']['query_params'];
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
$postInputsKeys = array_keys($postInputs);
$postInputRules = [];

$pathInputs = $controllerV['actions'][$action]['inputs']['path_params'];
$pathInputsKeys = array_keys($pathInputs);
//var_dump($pathInputs);exit;
if (count($pathInputs)) {
    $getInputRules[] = sprintf("\$modelGet->addRule(['%s'], 'trim');", implode("','", $pathInputsKeys));
}
foreach ($pathInputs as $key => $value) {
    if ($value['required']) {
        $getInputRules[] = sprintf("\$modelGet->addRule(['%s'], 'required');", $key);
    }
    $getInputRules[] = sprintf("\$modelGet->addRule(['%s'], 'match', ['pattern' => '/%s/i', 'message' => '\'{attribute}\':%s']);", $key, $value['rules'], $value['error_msg']);
}

$inputsKeys = array_merge($postInputsKeys, $getInputsKeys, $pathInputsKeys);

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
use yii\web\ServerErrorHttpException;
use myzero1\restbyconf\components\rest\Helper;
use myzero1\restbyconf\components\rest\ApiHelper;
use myzero1\restbyconf\components\rest\ApiCodeMsg;
use myzero1\restbyconf\components\rest\ApiActionProcessing;
use <?=$ioClass?>;

/**
 * implement the ActionProcessing
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class <?=$actionClass?> implements ApiActionProcessing
{
    /**
     * @param $params mixed
     * @return array date will return to create action.
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function processing($params = null)
    {
        // the path and query params will geted by queryParams,and the path params will rewrite the query params.
        $input['get'] = Yii::$app->request->queryParams;
        $input['post'] = Yii::$app->request->bodyParams;
        $validatedInput = $this->inputValidate($input);
        if (Helper::isReturning($validatedInput)) {
            return $validatedInput;
        } else {
            /*$in2dbData = $this->mappingInput2db($validatedInput);
            $completedData = $this->completeData($in2dbData);
            $handledData = $this->handling($completedData);

            if (Helper::isReturning($handledData)) {
                return $handledData;
            }

            $db2outData = $this->mappingDb2output($handledData);*/
            $db2outData = <?=$ioClassName?>::egOutputData(); // for demo
            $result = $this->completeResult($db2outData);
            return $result;
        }
    }

    /**
     * @param  array $input from the request body
     * @return array
     */
    public function inputValidate($input)
    {
        return <?=$ioClassName?>::inputValidate($input); // for demo
    }

    /**
     * @param  array $validatedInput validated data
     * @return array
     */
    public function mappingInput2db($validatedInput)
    {
        $inputFieldMap = [
            'demo_name' => 'name',
            'demo_description' => 'description',
        ];
        $in2dbData = ApiHelper::input2DbField($validatedInput, $inputFieldMap);

        return $in2dbData;
    }

    /**
     * @param  array $in2dbData mapped data form input
     * @return array
     */
    public function completeData($in2dbData)
    {
        $in2dbData['updated_at'] = time();
        $in2dbData['is_del'] = 1;

        $in2dbData = ApiHelper::inputFilter($in2dbData); // You should comment it, when in search action.

        return $in2dbData;
    }

    /**
     * @param  array $completedData completed data
     * @return array
     * @throws ServerErrorHttpException
     */
    public function handling($completedData)
    {
        $model = ApiHelper::findModel('\myzero1\restbyconf\example\models\Demo', $completedData['id']);

        $model->load($completedData, '');

        $trans = Yii::$app->db->beginTransaction();
        try {
            $flag = true;
            if (!($flag = $model->save())) {
                $trans->rollBack();
                return ApiHelper::getModelError($model, ApiCodeMsg::INTERNAL_SERVER);
            }

            if ($flag) {
                $trans->commit();
            } else {
                $trans->rollBack();
                throw new ServerErrorHttpException('Failed to save commit reason.');
            }
 
            return $model->attributes;
        } catch (Exception $e) {
            $trans->rollBack();
            throw new ServerErrorHttpException('Failed to save all models reason.');
        }
    }

    /**
     * @param  array $savedData saved data
     * @return array
     */
    public function mappingDb2output($handledData)
    {
        $outputFieldMap = [
            'name' => 'demo_name',
            'description' => 'demo_description',
        ];
        $db2outData = ApiHelper::db2OutputField($handledData, $outputFieldMap);

        $db2outData['created_at'] = ApiHelper::time2string($db2outData['created_at']);
        $db2outData['updated_at'] = ApiHelper::time2string($db2outData['updated_at']);

        return $db2outData;
    }

    /**
     * @param  array $db2outData completed data form database
     * @return array
     */
    public function completeResult($db2outData = [])
    {
        $result = [
            'code' => ApiCodeMsg::SUCCESS,
            'msg' => ApiCodeMsg::SUCCESS_MSG,
            'data' => is_null($db2outData) ? new \stdClass() : $db2outData,
        ];

        return $result;
    }

    /**
     * @return array
     */
    public function egOutputData()
    {
        return <?=$ioClassName?>::egOutputData(); // for demo
    }
}

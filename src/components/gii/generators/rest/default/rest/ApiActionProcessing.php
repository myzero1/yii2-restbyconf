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

$getInputs = $controllerV['actions'][$action]['inputs']['query_params'];
$getInputs = ApiHelper::rmNode($getInputs);
$getInputsKeys = array_keys($getInputs);
$getInputRules = [];
if (count($getInputs)) {
    $getInputRules[] = sprintf("\$modelGet->addRule(['%s'], 'trim');", implode("','", $getInputsKeys));
}
foreach ($getInputs as $key => $value) {
    if ($value['required']) {
        $getInputRules[] = sprintf("\$modelGet->addRule(['%s'], 'required');", $key);
    }
    $getInputRules[] = sprintf("\$modelGet->addRule(['%s'], 'match', ['pattern' => '/%s/i', 'message' => '%s']);", $key, $value['rules'], $value['error_msg']);
}

$postInputs = $controllerV['actions'][$action]['inputs']['body_params'];
$postInputs = ApiHelper::rmNode($postInputs);
$postInputsKeys = array_keys($postInputs);
$postInputRules = [];
if (count($postInputs)) {
    $postInputRules[] = sprintf("\$modelPost->addRule(['%s'], 'trim');", implode("','", $postInputsKeys));
}
foreach ($postInputs as $key => $value) {
    if ($value['required']) {
        $postInputRules[] = sprintf("\$modelPost->addRule(['%s'], 'required');", $key);
    }
    $postInputRules[] = sprintf("\$modelPost->addRule(['%s'], 'match', ['pattern' => '/%s/i', 'message' => '%s']);", $key, $value['rules'], $value['error_msg']);
}

$outputs = $controllerV['actions'][$action]['outputs'];
$outputs = ApiHelper::rmNode($outputs);
$egOutputData = [];
foreach ($outputs as $key => $value) {
    $egOutputData[] = sprintf("'%s' => '%s',", $key, $value['eg']);
}


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
use myzero1\restbyconf\components\rest\CodeMsg;
use myzero1\restbyconf\components\rest\ApiActionProcessing;

/**
 * implement the UpdateProcessing
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class <?=$actionClass?> implements ApiActionProcessing
{
    /**
     * @param $id mixed
     * @return array date will return to create action.
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function processing($id=null)
    {
        // the path and query params will geted by queryParams,and the path params will rewrite the query params.
        $input['get'] = Yii::$app->request->queryParams;
        $input['post'] = Yii::$app->request->bodyParams;
        $validatedInput = $this->inputValidate($input);
        if (Helper::isReturning($validatedInput)) {
            return $validatedInput;
        } else {
            // $in2dbData = $this->mappingInput2db($validatedInput);
            // $completedData = $this->completeData($in2dbData);
            // $handledData = $this->handling($completedData);
            // $db2outData = $this->mappingDb2output($handledData);
            $db2outData = $this->egOutputData();// for demo
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
        // get
        $modelGet = new DynamicModel([
<?php foreach ($getInputsKeys as $key => $value) { ?>
            '<?=$value?>',
<?php } ?>
        ]);

<?php foreach ($getInputRules as $key => $value) { ?>
        <?=$value."\n"?>
<?php } ?>

        $modelGet->load($input['get'], '');

        if (!$modelGet->validate()) {
            $errors = $modelGet->errors;
            return [
                'code' => CodeMsg::CLIENT_ERROR,
                'msg' => Helper::getErrorMsg($errors),
                'data' => $errors,
            ];
        }

        // post
        $modelPost = new DynamicModel([
<?php foreach ($postInputsKeys as $key => $value) { ?>
            '<?=$value?>',
<?php } ?>
        ]);

<?php foreach ($postInputRules as $key => $value) { ?>
        <?=$value."\n"?>
<?php } ?>

        $modelPost->load($input['post'], '');

        if (!$modelPost->validate()) {
            $errors = $modelPost->errors;
            return [
                'code' => CodeMsg::CLIENT_ERROR,
                'msg' => Helper::getErrorMsg($errors),
                'data' => $errors,
            ];
        }

        return array_merge($modelGet->attributes, $modelPost->attributes);
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
        $in2dbData = Helper::input2DbField($validatedInput, $inputFieldMap);

        return $in2dbData;
    }

    /**
     * @param  array $in2dbData mapped data form input
     * @return array
     */
    public function completeData($in2dbData)
    {
        $time = time();
        $in2dbData['updated_at'] = $time;

        return $in2dbData;
    }

    /**
     * @param  array $completedData completed data
     * @return array
     * @throws ServerErrorHttpException
     */
    public function handling($completedData)
    {

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
        $db2outData = Helper::db2OutputField($handledData, $outputFieldMap);

        $db2outData['created_at'] = Helper::time2string($db2outData['created_at']);
        $db2outData['updated_at'] = Helper::time2string($db2outData['updated_at']);

        return $db2outData;
    }

    /**
     * @param  array $db2outData completed data form database
     * @param  array $extra
     * @return array
     */
    public function completeResult($db2outData=[], $extra = [])
    {
        $result = [
            'code' => CodeMsg::SUCCESS,
            'msg' => CodeMsg::SUCCESS_MSG,
            'data' => $db2outData,
            'extra' => $extra,
        ];

        return $result;
    }

    /**
     * @param  array $db2outData completed data form database
     * @param  array $extra
     * @return array
     */
    public function getSort($validatedInput, $fields, $defafult)
    {
        if (isset($validatedInput['sort'])) {
            $sortInfo = Helper::getSort($validatedInput['sort'], $fields, $defafult);
        } else {
            $sortInfo = Helper::getSort('+myzeroqtest', $fields, $defafult);
        }

        return $sortInfo;
    }

    /**
     * @param  array $db2outData completed data form database
     * @param  array $extra
     * @return array
     */
    public function getPagination($validatedInput)
    {
        $pagination = [];
        if (isset($validatedInput['page'])) {
            $validatedInput['page'] = $validatedInput['page'];
        } else {
            $pagination['page'] = 1;
        }
        if (isset($validatedInput['page_size'])) {
            $pagination['page_size'] = $validatedInput['page_size'];
        } else {
            $pagination['page_size'] = 30;
        }

        return $pagination;
    }

    /**
     * @return array
     */
    public function egOutputData()
    {
        return [
<?php foreach ($egOutputData as $key => $value) { ?>
            <?=$value . "\n"?>
<?php } ?>
        ];
    }
}

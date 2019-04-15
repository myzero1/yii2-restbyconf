<?php

use myzero1\restbyconf\components\rest\ApiHelper;
/**
 * This is the template for generating a controller class within a module.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */

$controller = ucwords($generator->controller);
$controllerV = $generator->controllerV;
$controllerV['actions'] = ApiHelper::rmNode($controllerV['actions']);
$actions = array_keys($controllerV['actions']);
$moduleClass = $generator->moduleClass;
$controlerClass = sprintf('%s\controllers', dirname($moduleClass));
$processingClassNs = sprintf('%s\processing\%s', $controlerClass, $controller);
$searchClass = sprintf('\%s\models\search\%sSearch', dirname($moduleClass), $controller);

$inputs = $controllerV['actions']['create']['inputs'];
$inputsKeys = array_keys($controllerV['actions']['create']['inputs']);

$inputRules = [];
$inputRules[] = sprintf("\$model->addRule(['%s'], 'trim');", implode("','", $inputsKeys));

foreach ($inputs as $key => $value) {
    if ($value['required']) {
        $inputRules[] = sprintf("\$model->addRule(['%s'], 'required');", $key);
    }
    $inputRules[] = sprintf("\$model->addRule(['%s'], 'match', ['pattern' => '/%s/i', 'message' => '%s']);", $key, $value['rules'], $value['error_msg']);
}

$egOutputData = [];
foreach ($controllerV['actions']['create']['outputs'] as $key => $value) {
    $egOutputData[] = sprintf("'%s' => '%s',", $key, $value['eg']);
}

$outputs = $controllerV['actions']['create']['outputs'];

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
use myzero1\restbyconf\components\rest\CreateProcessing;
use myzero1\restbyconf\models\Demo as Model;

/**
 * implement the CreateProcessing
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class Create implements CreateProcessing
{
    /**
     * @return array date will return to create action.
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function processing($id)
    {
        $input = Yii::$app->getRequest()->getBodyParams();
        $validatedInput = $this->inputValidate($input);
        if (Helper::isReturning($validatedInput)) {
            return $validatedInput;
        } else {
            $in2dbData = $this->mappingInput2db($validatedInput);
            $completedData = $this->completeData($in2dbData);
            // $savedData = $this->save($completedData);
            // $db2outData = $this->mappingDb2output($savedData);
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
        $model = new DynamicModel([
<?php foreach ($inputsKeys as $key => $value) { ?>
            '<?=$value?>',
<?php } ?>
        ]);

<?php foreach ($inputRules as $key => $value) { ?>
        <?=$value."\n"?>
<?php } ?>


        $model->load($input, '');

        if ($model->validate()) {
            return $input;
        } else {
            $errors = $model->errors;
            return [
                'code' => CodeMsg::CLIENT_ERROR,
                'msg' => Helper::getErrorMsg($errors),
                'data' => $errors,
            ];
        }
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
        $in2dbData['created_at'] = $time;
        $in2dbData['updated_at'] = $time;

        return $in2dbData;
    }

    /**
     * @param  array $completedData completed data
     * @return array
     * @throws ServerErrorHttpException
     */
    public function save($completedData)
    {
        $model = new Model();
        $model->load($completedData, '');
        if ($model->save()) {
            $savedData = $model->attributes;
            return $savedData;
        } elseif ($model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for validation reason.');
        } else {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }
    }

    /**
     * @param  array $savedData saved data
     * @return array
     */
    public function mappingDb2output($savedData)
    {
        $outputFieldMap = [
            'name' => 'demo_name',
            'description' => 'demo_description',
        ];
        $db2outData = Helper::db2OutputField($savedData, $outputFieldMap);

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
     * @return array
     */
    public function egOutputData()
    {
        return [
<?php foreach ($egOutputData as $key => $value) { ?>
            <?=$value."\n"?>
<?php } ?>
        ];
    }
}

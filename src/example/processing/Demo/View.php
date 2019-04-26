<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\example\processing\demo;

use Yii;
use yii\base\DynamicModel;
use yii\web\ServerErrorHttpException;
use myzero1\restbyconf\components\rest\Helper;
use myzero1\restbyconf\components\rest\ApiCodeMsg;
use myzero1\restbyconf\components\rest\ApiActionProcessing;

/**
 * implement the UpdateProcessing
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class View implements ApiActionProcessing
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
            /*
            $in2dbData = $this->mappingInput2db($validatedInput);
            $completedData = $this->completeData($in2dbData);
            $handledData = $this->handling($completedData);

            if (Helper::isReturning($handledData)) {
                return $handledData;
            }
            
            $db2outData = $this->mappingDb2output($handledData);
            */
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
        $inputFields = [
            'id',
            'name',
            'des',

            'sort',
            'page',
            'page_size',
        ];

        // get
        $modelGet = new DynamicModel($inputFields);
        $modelGet->addRule($inputFields, 'trim');
        $modelGet->addRule($inputFields, 'safe');
        $modelGet->load($input['get'], '');
        if (!$modelGet->validate()) {
            $errors = $modelGet->errors;
            return [
                'code' => ApiCodeMsg::BAD_REQUEST,
                'msg' => Helper::getErrorMsg($errors),
                'data' => $errors,
            ];
        }

        // post
        $modelPost = new DynamicModel($inputFields);
        $modelPost->addRule($inputFields, 'trim');
        $modelPost->addRule($inputFields, 'safe');
        $modelPost->addRule(['name'], 'required');
        $modelPost->addRule(['name'], 'match', ['pattern' => '/^\w{1,32}$/i', 'message' => 'You should input a-z,A-Z,0-9']);
        $modelPost->addRule(['des'], 'match', ['pattern' => '/^\w{1,32}$/i', 'message' => 'You should input a-z,A-Z,0-9']);
        $modelPost->load($input['post'], '');
        if (!$modelPost->validate()) {
            $errors = $modelPost->errors;
            return [
                'code' => ApiCodeMsg::BAD_REQUEST,
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
        $demo = Update::findModel($completedData['id']);

        return $demo;
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
    public function completeResult($db2outData = [], $extra = [])
    {
        $result = [
            'code' => ApiCodeMsg::OK,
            'msg' => ApiCodeMsg::OK_MSG,
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
        $egOutputData = 'a:3:{s:4:"code";i:200;s:3:"msg";s:3:"msg";s:4:"data";a:3:{s:2:"id";i:1;s:4:"name";s:4:"name";s:3:"des";s:3:"des";}}';

        return unserialize($egOutputData);
    }
}

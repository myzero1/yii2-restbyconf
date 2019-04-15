<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace app\modules\v1\controllers\processing\UserDemo;

use Yii;
use yii\base\DynamicModel;
use yii\web\ServerErrorHttpException;
use myzero1\restbyconf\components\rest\Helper;
use myzero1\restbyconf\components\rest\CodeMsg;
use myzero1\restbyconf\components\rest\ApiActionProcessing;
use myzero1\restbyconf\models\Demo as Model;

/**
 * implement the UpdateProcessing
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class Update implements UpdateProcessing
{
    /**
     * @param $id mixed
     * @return array date will return to create action.
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function processing($id)
    {
        // the path and query params will geted by queryParams,and the path params will rewrite the query params.
        $input['get'] = Yii::$app->getRequest()->queryParams();
        $input['body'] = Yii::$app->getRequest()->getBodyParams();
        $validatedInput = $this->inputValidate($input);
        if (Helper::isReturning($validatedInput)) {
            return $validatedInput;
        } else {
            $in2dbData = $this->mappingInput2db($validatedInput);
            $completedData = $this->completeData($in2dbData);
            // $savedData = $this->save($id, $completedData);
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
        // get
        $modelGet = new DynamicModel([
            'in_str',
        ]);

        $modelGet->addRule(['in_str'], 'trim');
        $modelGet->addRule(['in_str'], 'match', ['pattern' => '/^w{1,32}$/i', 'message' => 'You should input a-z,A-Z,0-9']);


        $modelGet->load($input['get'], '');

        if (!$modelGet->validate()) { else {
            $errors = $modelGet->errors;
            return [
                'code' => CodeMsg::CLIENT_ERROR,
                'msg' => Helper::getErrorMsg($errors),
                'data' => $errors,
            ];
        }

        // post
        $modelPost = new DynamicModel([
            'in_str',
        ]);

        $modelPost->addRule(['in_str'], 'trim');
        $modelPost->addRule(['in_str'], 'match', ['pattern' => '/^w{1,32}$/i', 'message' => 'You should input a-z,A-Z,0-9']);


        $modelPost->load($input['get'], '');

        if (!$modelPost->validate()) { else {
            $errors = $modelPost->errors;
            return [
                'code' => CodeMsg::CLIENT_ERROR,
                'msg' => Helper::getErrorMsg($errors),
                'data' => $errors,
            ];
        }

        return [
            'get' => $modelGet->attributes,
            'post' => $modelPost->attributes,
        ];
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
    public function save($id, $completedData)
    {
        $model = $this->findModel($id);
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
     * @param integer $id
     * @return model the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        if (($model = Model::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return array
     */
    public function egOutputData()
    {
        return [
            'out_str' => 'myzero1',
        ];
    }
}

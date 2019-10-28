<?php
$templateParams = $generator->getApiActionProcessingParams();

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
use myzero1\restbyconf\components\rest\ApiHelper;
use myzero1\restbyconf\components\rest\ApiCodeMsg;
use myzero1\restbyconf\components\rest\ApiActionProcessing;
use myzero1\restbyconf\components\rest\ApiAuthenticator;
use myzero1\restbyconf\components\rest\HandlingHelper;
use <?= $templateParams['ioClass'] ?> as Io;

/**
 * implement the ActionProcessing
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class <?= $templateParams['className'] ?> implements ApiActionProcessing
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
            $in2dbData = $this->mappingInput2db($validatedInput);
            $completedData = $this->completeData($in2dbData);
            
            $completedData = HandlingHelper::before($completedData, Io::class);
            $handledData = $this->handling($completedData);
            $handledData = HandlingHelper::after($handledData);

            if (Helper::isReturning($handledData)) {
                return $handledData;
            }

            $db2outData = $this->mappingDb2output($handledData);
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
        return Io::inputValidate($input); // for demo
    }

    /**
     * @param  array $validatedInput validated data
     * @return array
     */
    public function mappingInput2db($validatedInput)
    {
        $inputFieldMap = [
            'demo_name' => 'name735',
            'demo_description' => 'description735',
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
        // $in2dbData['updated_at'] = time();

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
        $model = ApiAuthenticator::findByUsername($completedData['username']);

        if ( is_null($model) ) {
            return [
                'response_code' => 735461,
                'response_msg' => 'Incorrect username or password',
                'msg' => 'Incorrect username or password',
            ];
        }

        if (!ApiAuthenticator::apiTokenIsValid($model->api_token)) {
            $model->generateApiToken();
        }

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
            'name735' => 'demo_name',
            'description735' => 'demo_description',
        ];
        $db2outData = ApiHelper::db2OutputField($handledData, $outputFieldMap);

        // $db2outData['created_at'] = ApiHelper::time2string($db2outData['created_at']);
        // $db2outData['updated_at'] = ApiHelper::time2string($db2outData['updated_at']);

        return $db2outData;
    }

    /**
     * @param  array $db2outData completed data form database
     * @return array
     */
    public function completeResult($db2outData = [])
    {
        if ( isset($db2outData['response_code']) ) {
            $responseCode = $db2outData['response_code'];
            unset($db2outData['response_code']);
        } else {
            $responseCode = 735200;
        }

        if ( isset($db2outData['response_msg']) ) {
            $responseMsg = $db2outData['response_msg'];
            unset($db2outData['response_msg']);
        } else {
            $responseMsg = ApiCodeMsg::SUCCESS_MSG;
        }
        
        $result = [
            'code' => $responseCode,
            'msg' => $responseMsg,
            'data' => is_null($db2outData) ? new \stdClass() : $db2outData,
        ];

        return $result;
    }

    /**
     * @return array
     */
    public function egOutputData()
    {
        return Io::egOutputData(); // for demo
    }
}

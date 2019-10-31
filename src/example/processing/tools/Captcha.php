<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace example\processing\tools;

use Yii;
use yii\base\DynamicModel;
use yii\web\ServerErrorHttpException;
use myzero1\restbyconf\components\rest\Helper;
use myzero1\restbyconf\components\rest\ApiHelper;
use myzero1\restbyconf\components\rest\ApiCodeMsg;
use myzero1\restbyconf\components\rest\ApiActionProcessing;
use myzero1\restbyconf\components\rest\ApiAuthenticator;
use myzero1\restbyconf\components\rest\HandlingHelper;
use example\processing\tools\io\CaptchaIo as Io;

/**
 * implement the ActionProcessing
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class Captcha implements ApiActionProcessing
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
        $randStr = ApiHelper::getrandstr('1234567890', 6);
        $smsResult = Yii::$app->smser->send($completedData['mobile_phone'],  sprintf('【玩索得】您的验证码是: %s', $randStr));

        if($smsResult !== true){
            return [
                'code' => "735462",
                'msg' => '发送短信失败',
                'data' => $smsResult,
            ];
        }

        \Yii::$app->db->createCommand()->insert('z1_captcha', [  
            'mobile_phone' => $completedData['mobile_phone'],  
            'code' => $randStr,  
            'used_times' => 0,
            'created_at' => time(),  
        ])->execute();
        
        return [
            'code' => "735200",
            'msg' => '发送短信成功',
        ];
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

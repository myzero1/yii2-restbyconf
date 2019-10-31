<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace example\processing\authenticator\io;

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
class LoginIo implements ApiIoProcessing
{

    /**
     * @param  array $input from the request body
     * @return array
     */
    public static function inputValidate($input)
    {
        $inputFields = [
            'type',
            'username',
            'password',
            'captcha',
            'response_code',
            'sort',
            'page',
            'page_size',
        ];

        // get
        $modelGet = new DynamicModel($inputFields);

        $modelGet->addRule($inputFields, 'trim');
        $modelGet->addRule($inputFields, 'safe');

        $modelGet->addRule(['response_code'], 'match', ['pattern' => '/^.{0,32}$/i', 'message' => '\'{attribute}\':Input parameter error']);

        $modelGet->load($input['get'], '');

        if (!$modelGet->validate()) {
            return ApiHelper::getModelError($modelGet, ApiCodeMsg::BAD_REQUEST);
        }

        // post
        $modelPost = new DynamicModel($inputFields);

        $modelPost->addRule($inputFields, 'trim');
        $modelPost->addRule($inputFields, 'safe');

        $modelPost->addRule(['type'], 'required');
        $modelPost->addRule(['type'], 'match', ['pattern' => '/^.{0,32}$/i', 'message' => '\'{attribute}\':invalid type']);
        $modelPost->addRule(['username'], 'required');
        $modelPost->addRule(['username'], 'match', ['pattern' => '/^\d{11}$/i', 'message' => '\'{attribute}\':invalid mobile phone']);
        $modelPost->addRule(['password'], 'match', ['pattern' => '/^.{0,32}$/i', 'message' => '\'{attribute}\':invalid password']);
        $modelPost->addRule(['captcha'], 'match', ['pattern' => '/^.{0,32}$/i', 'message' => '\'{attribute}\':invalid captcha']);

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
        $egOutputData = 'a:3:{i:735200;a:3:{s:4:"code";i:735200;s:3:"msg";s:2:"Ok";s:4:"data";a:2:{s:12:"mobile_phone";d:12345678901;s:9:"api_token";s:12:"123456dsfe5w";}}i:735400;a:3:{s:4:"code";i:735400;s:3:"msg";s:24:"输入参数验证错误";s:4:"data";a:0:{}}i:735401;a:3:{s:4:"code";i:735401;s:3:"msg";s:12:"Unauthorized";s:4:"data";a:1:{s:3:"msg";s:12:"Unauthorized";}}}';

        return ApiHelper::filterEgOutputData($egOutputData);
    }
}

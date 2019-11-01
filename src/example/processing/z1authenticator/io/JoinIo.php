<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace example\processing\z1authenticator\io;

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
class JoinIo implements ApiIoProcessing
{

    /**
     * @param  array $input from the request body
     * @return array
     */
    public static function inputValidate($input)
    {
        $inputFields = [
            'username',
            'email',
            'mobile_phone',
            'captcha',
            'password',
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

        $modelPost->addRule(['username'], 'match', ['pattern' => '/^[\w\d\_]{6,20}$/i', 'message' => '\'{attribute}\':invalid username']);
        $modelPost->addRule(['email'], 'match', ['pattern' => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', 'message' => '\'{attribute}\':invalid email']);
        $modelPost->addRule(['mobile_phone'], 'match', ['pattern' => '/^0?(13|14|15|17|18|19)[0-9]{9}$/i', 'message' => '\'{attribute}\':invalid mobile phone']);
        $modelPost->addRule(['captcha'], 'match', ['pattern' => '/^.{0,32}$/i', 'message' => '\'{attribute}\':invalid captcha']);
        $modelPost->addRule(['password'], 'required');
        $modelPost->addRule(['password'], 'match', ['pattern' => '/^.{1,32}$/i', 'message' => '\'{attribute}\':invalid password']);

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
        $egOutputData = 'a:3:{i:735200;a:3:{s:4:"code";i:735200;s:3:"msg";s:2:"Ok";s:4:"data";a:1:{s:8:"username";s:7:"myzero1";}}i:735400;a:3:{s:4:"code";i:735400;s:3:"msg";s:24:"输入参数验证错误";s:4:"data";a:0:{}}i:735401;a:3:{s:4:"code";i:735401;s:3:"msg";s:12:"Unauthorized";s:4:"data";a:1:{s:3:"msg";s:12:"Unauthorized";}}}';

        return ApiHelper::filterEgOutputData($egOutputData);
    }
}

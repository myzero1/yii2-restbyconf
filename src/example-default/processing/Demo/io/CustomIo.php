<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\example\processing\demo\io;

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
class CustomIo implements ApiIoProcessing
{

    /**
     * @param  array $input from the request body
     * @return array
     */
    public static function inputValidate($input)
    {
        $inputFields = [
            'name',
            'id',
            'id',
            'sort',
            'page',
            'page_size',
        ];

        // get
        $modelGet = new DynamicModel($inputFields);

        $modelGet->addRule($inputFields, 'trim');
        $modelGet->addRule($inputFields, 'safe');

        $modelGet->addRule(['id'], 'required');
        $modelGet->addRule(['id'], 'match', ['pattern' => '/^\d{0,32}$/i', 'message' => '\'{attribute}\':Input parameter error']);

        $modelGet->load($input['get'], '');

        if (!$modelGet->validate()) {
            return ApiHelper::getModelError($modelGet, ApiCodeMsg::BAD_REQUEST);
        }

        // post
        $modelPost = new DynamicModel($inputFields);

        $modelPost->addRule($inputFields, 'trim');
        $modelPost->addRule($inputFields, 'safe');

        $modelPost->addRule(['name'], 'match', ['pattern' => '/^.{0,32}$/i', 'message' => '\'{attribute}\':Input parameter error']);

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
        $egOutputData = 'a:3:{s:4:"code";i:200;s:3:"msg";s:3:"msg";s:4:"data";a:5:{s:2:"id";i:1;s:4:"name";s:6:"rename";s:3:"des";s:11:"description";s:10:"created_at";s:19:"2019-04-28 11:11:11";s:10:"updated_at";s:19:"2019-04-28 11:11:11";}}';

        return unserialize($egOutputData);
    }
}

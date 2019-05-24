<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace example\processing\user\io;

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
class UpdateIo implements ApiIoProcessing
{

    /**
     * @param  array $input from the request body
     * @return array
     */
    public static function inputValidate($input)
    {
        $inputFields = [
            'username',
            'password',
            'status',
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
        $modelGet->addRule(['id'], 'match', ['pattern' => '/^\d+$/i', 'message' => '\'{attribute}\':Input parameter error']);

        $modelGet->load($input['get'], '');

        if (!$modelGet->validate()) {
            return ApiHelper::getModelError($modelGet, ApiCodeMsg::BAD_REQUEST);
        }

        // post
        $modelPost = new DynamicModel($inputFields);

        $modelPost->addRule($inputFields, 'trim');
        $modelPost->addRule($inputFields, 'safe');

        $modelPost->addRule(['username'], 'required');
        $modelPost->addRule(['username'], 'match', ['pattern' => '/^\w{1,32}$/i', 'message' => '\'{attribute}\':Input parameter error']);
        $modelPost->addRule(['password'], 'required');
        $modelPost->addRule(['password'], 'match', ['pattern' => '/^.{1,32}$/i', 'message' => '\'{attribute}\':Input parameter error']);
        $modelPost->addRule(['status'], 'required');
        $modelPost->addRule(['status'], 'match', ['pattern' => '/^\d{1,1}$/i', 'message' => '\'{attribute}\':Input parameter error']);

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
        $egOutputData = 'a:4:{s:8:"username";s:7:"myzero1";s:6:"status";i:1;s:10:"created_at";s:19:"2019-04-28 11:11:11";s:10:"updated_at";s:19:"2019-04-28 11:11:11";}';

        return unserialize($egOutputData);
    }
}

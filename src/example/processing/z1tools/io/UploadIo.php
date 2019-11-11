<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace example\processing\z1tools\io;

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
class UploadIo implements ApiIoProcessing
{

    /**
     * @param  array $input from the request body
     * @return array
     */
    public static function inputValidate($input)
    {
        $inputFields = [
            'directory',
            'extension',
            'file',
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

        $modelPost->addRule(['directory'], 'required');
        $modelPost->addRule(['directory'], 'match', ['pattern' => '/^[\w\d\_\-\/]{1,}$/i', 'message' => '\'{attribute}\':目录错误']);
        $modelPost->addRule(['extension'], 'required');
        $modelPost->addRule(['extension'], 'match', ['pattern' => '/^[\w\,]{1,}$/i', 'message' => '\'{attribute}\':扩展名错误']);
        $modelPost->addRule(['file'], 'required');
        $modelPost->addRule(['file'], 'safe');

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
        $egOutputData = 'a:3:{i:735200;a:3:{s:4:"code";i:735200;s:3:"msg";s:2:"Ok";s:4:"data";a:1:{s:3:"url";s:133:"http://imgsrc.baidu.com/forum/w=580/sign=4d5e01bdba389b5038ffe05ab534e5f1/8cca9b8fa0ec08fa2ab208045aee3d6d54fbda28.jpg---图片地址";}}i:735400;a:3:{s:4:"code";i:735400;s:3:"msg";s:24:"输入参数验证错误";s:4:"data";a:0:{}}i:735401;a:3:{s:4:"code";i:735401;s:3:"msg";s:12:"Unauthorized";s:4:"data";a:1:{s:3:"msg";s:12:"Unauthorized";}}}';

        return ApiHelper::filterEgOutputData($egOutputData);
    }
}

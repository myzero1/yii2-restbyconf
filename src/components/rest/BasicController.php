<?php

namespace myzero1\restbyconf\components\rest;

use yii\web\Response;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\RateLimiter;
use yii\filters\Cors;
use yii\base\InvalidConfigException;
use myzero1\restbyconf\components\Helper;

class BasicController extends ActiveController
{
    /**
     * @var string class name of the model which will be handled by this action.
     * The model class must implement [[ActiveRecordInterface]].
     * This property must be set.
     */
    public $modelClass = 'DemoModel';

    public function init()
    {
        \Yii::$app->request->parsers = [
            'application/json' => '\yii\web\JsonParser',
            'text/json' => '\yii\web\JsonParser',
        ];
        \Yii::$app->response->format = \Yii\web\Response::FORMAT_JSON;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;

        // 取消默认authenticator认证，以确保 cors 被首先处理。然后，我们在实施自己的认证程序之前，强制 cors 允许凭据。
        unset($behaviors['authenticator']);
        //设置跨域
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                // restrict access to
                'Origin' => ['*'],
                // restrict access to
                'Access-Control-Request-Method' => ['*'],
                // Allow only POST and PUT methods
                'Access-Control-Request-Headers' => ['*'],
                // Allow only headers 'X-Wsse'
                'Access-Control-Allow-Credentials' => false,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 3600,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],
        ];

        // $behaviors['authenticator'] = [
        //     'class' => HttpBearerAuth::className(),
        //     'optional' => [
        //         'login',  //认证排除登录接口
        //         'join', //认证排除注册用户
        //     ],
        //     'except' => ['options'], //认证排除OPTIONS请求
        // ];

        # rate limit部分，速度的设置是在
        #   app\models\User::getRateLimit($request, $action)
        /*  官方文档：
            当速率限制被激活，默认情况下每个响应将包含以下HTTP头发送 目前的速率限制信息：
            X-Rate-Limit-Limit: 同一个时间段所允许的请求的最大数目;
            X-Rate-Limit-Remaining: 在当前时间段内剩余的请求的数量;
            X-Rate-Limit-Reset: 为了得到最大请求数所等待的秒数。
            你可以禁用这些头信息通过配置 yii\filters\RateLimiter::enableRateLimitHeaders 为false, 就像在上面的代码示例所示。
        */
        // $behaviors['rateLimiter'] = [
        //     'class' => RateLimiter::className(),
        //     'enableRateLimitHeaders' => true,
        // ];

        unset($behaviors['rateLimiter']);

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();

        //设置固定options控制器
        $actions['options'] = [
            'class' => 'yii\rest\OptionsAction',
            // optional:
            'collectionOptions' => ['GET', 'POST', 'HEAD', 'OPTIONS'],
            'resourceOptions' => ['GET', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
        ];

        // 禁用""index,delete" 和 "create" 操作
        // unset($actions['index'], $actions['delete'], $actions['create'], $actions['view'], $actions['update']);

        return $actions;
    }

    public function response($code, $msg, $data)
    {
        \Yii::$app->response->statusCode = $code;
        \Yii::$app->response->statusText = $msg;
        \Yii::$app->response->data = $data;
    }
}

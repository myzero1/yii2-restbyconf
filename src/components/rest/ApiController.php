<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\components\rest;

use Yii;
use yii\web\Response;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\RateLimiter;
use yii\filters\Cors;
use yii\filters\VerbFilter;

class ApiController extends ActiveController
{
    public $apiActionClass = '\myzero1\restbyconf\components\rest\ApiAction';
    public $modelClass = '';
    public $optional = [
        'login',
        'join',
    ];
    //重写动作
    public $rewriteActions = [
        'update',
        'delete',
        'view',
        'create',
        'index',
        // 'options' //默认支持OPTIONS请求
    ];

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

        // ajax will send a options,after settting request header.
        $behaviors['verbFilter'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['GET', 'HEAD', 'OPTIONS'],
                'view' => ['GET', 'HEAD', 'OPTIONS'],
                'create' => ['POST', 'OPTIONS'],
                'update' => ['PUT', 'OPTIONS'],
                'delete' => ['DELETE', 'OPTIONS'],
                'patch' => ['PATCH', 'OPTIONS'],
            ],
        ];

        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => false,
            ],
        ];

        $moduleName = md5(get_class($this->module));
        $securityKey = Yii::$app->params['restbyconfAuthenticator_' . $moduleName];
        
        if ($securityKey != 'noAuthenticator') {
            $method = Yii::$app->request->method;
            $controllerId = Yii::$app->controller->id;
            $actionId = Yii::$app->controller->action->id;
            $uri  = sprintf('%s /%s/%s', strtolower($method), $controllerId, $actionId);
            $unAuthenticateActions = Yii::$app->params['restbyconfUnAuthenticateActions_' . $moduleName];

            if (in_array($uri, $unAuthenticateActions)) {
                $this->optional = [$actionId];
            } else {
                $this->optional = [];
            }

            $behaviors['authenticator'] = [
                'class' => CompositeAuth::className(),
                'optional' => $this->optional,//认证排除
                'except' => ['options'], //认证排除OPTIONS请求
                'authMethods' => [
                    [
                        'class' => HttpBasicAuth::className(),
                        // 如果未设置此属性，则用户名信息将被视为访问令牌。 而密码信息将被忽略。在 yii\web\User::loginByAccessToken() 将调用方法对用户进行身份验证和登录。
                        // 如果要使用用户名和密码对用户进行身份验证，您应该提供 $auth 功能例如：
                        'auth' => function ($username, $password) {
                            $user = ApiAuthenticator::find()->where(['username' => $username])->one();
                            if ($user && $user->validatePassword($password, $user->password_hash)) {
                                return $user;
                            }
                            return null;
                        },
                    ],
                    [
                        'class' => QueryParamAuth::className(),
                        'tokenParam' => 'token',
                    ],
                    [
                        'class' => HttpBearerAuth::className(),
                    ],
                ]
            ];
        }

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        //unset rewrite actions
        if (!empty($this->rewriteActions)) {
            foreach ($this->rewriteActions as $actionKey) {
                if (isset($actions[$actionKey]) && $actionKey != 'options') unset($actions[$actionKey]);
            }
        }
        //fix options action
        $actions['options'] = [
            'class' => 'yii\rest\OptionsAction',
            // optional:
            'collectionOptions' => ['GET', 'POST', 'HEAD', 'OPTIONS'],
            'resourceOptions' => ['GET', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
        ];
        return $actions;
    }

}
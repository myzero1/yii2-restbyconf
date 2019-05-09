<?php
/**
 * Api接口基类
 */
namespace myzero1\restbyconf\components\rest;

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

        /*$behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'optional' => $this->optional,//认证排除
            'except'=> ['options'] //认证排除OPTIONS请求
        ];*/

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'optional' => $this->optional,//认证排除
            'except'=> ['options'], //认证排除OPTIONS请求
            'authMethods' => [
//                [
//                    'class' => HttpBasicAuth::className(),
//                    'auth' => function($username, $password){
//                        $user = ApiAuthenticator::find()->where('username = :username', [':username' => $username])->one();
//                        return '';
//                        var_dump($user);exit;
//                        return $user;
//                    },
//                ],
                [
                    'class' => QueryParamAuth::className(),
                ],
//                [
//                    'class' => HttpBearerAuth::className(),
//                ],
            ]
        ];

        return $behaviors;
    }

    public function actions()
    {
        $actions =  parent::actions();
        //unset rewrite actions
        if(!empty($this->rewriteActions)){
            foreach ($this->rewriteActions as $actionKey)
            {
                if(isset($actions[$actionKey])&&$actionKey!='options') unset($actions[$actionKey]);
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
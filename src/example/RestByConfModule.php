<?php

namespace myzero1\restbyconf\example;

use Yii;
use yii\base\Module as BaseModule;
use yii\base\BootstrapInterface;
use myzero1\restbyconf\components\rest\ApiHelper;

/**
 * example module definition class
 */
class RestByConfModule extends BaseModule implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'example\controllers';
    public $apiTokenExpire = 86400; // 24h
    public $captchaExpire = 60 * 5; // 5m
    public $captchaMaxTimes = 3;
    public $runningAsDocActions = ['*' => '*']; // all action
    public $fixedUser = [ 'id' => 1, 'username' => 'myzero1', 'api_token' => 'myzero1ApiToken'];
    public $smsAndCacheComponents = [
                'captchaCache' => [
                    'class' => '\yii\caching\FileCache',
                    'cachePath' => '@runtime/captchaCache',
                ],
                'captchaSms' => [
                    // 腾讯云
                    'class' => 'myzero1\smser\QcloudsmsSmser',
                    'appid' => '140028081944', // appid
                    'appkey' => '23e167badfc804d97d454e32e258b7833', // 请替换成您的apikey
                    'smsSign' => '玩索得',
                    'expire' => '5',//分钟
                ],
            ];

    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            Yii::$app->params['restbyconfAuthenticator_ab6446ae49cf579a847bfab947702375'] = 'queryParamAuth';
            Yii::$app->params['restbyconfUnAuthenticateActions_ab6446ae49cf579a847bfab947702375'] = [
                'post /z1authenticator/login',
                'post /z1authenticator/join',
                'post /z1tools/captcha',
            ];
            $apiUrlRules = ApiHelper::getApiUrlRules($this->id);
            $app->getUrlManager()->addRules($apiUrlRules, $append = true);
        }

        Yii::setAlias('@example', '@vendor/myzero1/yii2-restbyconf/src/example');
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

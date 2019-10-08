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
    public $docToken = 'docTokenAsMyzero1';
    public $apiTokenExpire = 86400; // 24h
    public $runningAsDocActions = ['*' => '*']; // all action
    public $fixedUser = [ 'id' => 1, 'username' => 'myzero1',];

    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            Yii::$app->params['restbyconfAuthenticator_ab6446ae49cf579a847bfab947702375'] = 'httpBearerAuth';
            Yii::$app->params['restbyconfUnAuthenticateActions_ab6446ae49cf579a847bfab947702375'] = [
                'post /authenticator/login',
                'post /authenticator/join',
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

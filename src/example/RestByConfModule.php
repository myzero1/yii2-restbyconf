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

    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            Yii::$app->params['restbyconfAuthenticator_49691b7bb0de44ca6b0c53a8a0f4878e'] = 'httpBearerAuth';
            Yii::$app->params['restbyconfUnAuthenticateActions_49691b7bb0de44ca6b0c53a8a0f4878e'] = [
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

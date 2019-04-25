<?php

namespace myzero1\restbyconf\example;

use Yii;
use yii\base\Module as BaseModule;
use yii\base\BootstrapInterface;
use myzero1\restbyconf\components\rest\ApiHelper;

/**
 * v1 module definition class
 */
class Module extends BaseModule implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'myzero1\restbyconf\example\controllers';

    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            $apiUrlRules = require Yii::getAlias('@vendor/myzero1/yii2-restbyconf/src/example/apiUrlRules.php');
            $app->getUrlManager()->addRules($apiUrlRules, false);
        }
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

<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\components\rest;

use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\web\ForbiddenHttpException;

/**
 * ActiveController implements a common set of actions for supporting RESTful access to ActiveRecord.
 *
 * The class of the ActiveRecord should be specified via [[modelClass]], which must implement [[\yii\db\ActiveRecordInterface]].
 * By default, the following actions are supported:
 *
 * - `index`: list of models
 * - `view`: return the details of a model
 * - `create`: create a new model
 * - `update`: update an existing model
 * - `delete`: delete an existing model
 * - `options`: return the allowed HTTP methods
 *
 * You may disable some of these actions by overriding [[actions()]] and unsetting the corresponding actions.
 *
 * To add a new action, either override [[actions()]] by appending a new action class or write a new action method.
 * Make sure you also override [[verbs()]] to properly declare what HTTP methods are allowed by the new action.
 *
 * You should usually override [[checkAccess()]] to check whether the current user has the privilege to perform
 * the specified action against the specified model.
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class ActiveController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            // 'index' => [
            //     'class' => '\myzero1\restbyconf\components\restIndexAction',
            //     'processingClass' => $this->processingClass,
            //     'checkAccess' => [$this, 'checkAccess'],
            // ],
            // 'view' => [
            //     'class' => '\myzero1\restbyconf\components\ViewAction',
            //     'processingClass' => $this->processingClass,
            //     'checkAccess' => [$this, 'checkAccess'],
            // ],
            // 'create' => [
            //     'class' => '\myzero1\restbyconf\components\CreateAction',
            //     'processingClass' => $this->processingClass,
            //     'checkAccess' => [$this, 'checkAccess'],
            // ],
            // 'update' => [
            //     'class' => '\myzero1\restbyconf\components\UpdateAction',
            //     'processingClass' => $this->processingClass,
            //     'checkAccess' => [$this, 'checkAccess'],
            // ],
            // 'delete' => [
            //     'class' => '\myzero1\restbyconf\components\DeleteAction',
            //     'processingClass' => $this->processingClass,
            //     'checkAccess' => [$this, 'checkAccess'],
            // ],
            'options' => [
                'class' => '\myzero1\restbyconf\components\OptionsAction',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

    /**
     * Checks the privilege of the current user.
     *
     * This method should be overridden to check whether the current user has the privilege
     * to run the specified action against the specified data model.
     * If the user does not have access, a [[ForbiddenHttpException]] should be thrown.
     *
     * @param string $action the ID of the action to be executed
     * @param object $model the model to be accessed. If null, it means no specific model is being accessed.
     * @param array $params additional parameters
     * @throws ForbiddenHttpException if the user does not have access
     */
    public function checkAccess($action, $model = null, $params = [])
    {
    }
}

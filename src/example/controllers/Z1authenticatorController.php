<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */
namespace example\controllers;

use example\controllers\BasicController;

/**
 * Z1authenticatorController implements the CRUDI actions for the module.
 */
class Z1authenticatorController extends BasicController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        $parentActions = parent::actions();

        $overwriteActions = [
                'join' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\z1authenticator\Join',
            ],
            'login' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\z1authenticator\Login',
            ],
        ];

        $actions = array_merge($parentActions, $overwriteActions);

        return $actions;
    }
}

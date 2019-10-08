<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */
namespace example\controllers;

use example\controllers\BasicController;

/**
 * AuthenticatorController implements the CRUDI actions for the module.
 */
class AuthenticatorController extends BasicController
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
                'processingClass' => '\example\processing\authenticator\Join',
            ],
            'login' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\authenticator\Login',
            ],
        ];

        $actions = array_merge($parentActions, $overwriteActions);

        return $actions;
    }
}

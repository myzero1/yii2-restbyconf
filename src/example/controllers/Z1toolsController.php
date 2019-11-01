<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */
namespace example\controllers;

use example\controllers\BasicController;

/**
 * Z1toolsController implements the CRUDI actions for the module.
 */
class Z1toolsController extends BasicController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        $parentActions = parent::actions();

        $overwriteActions = [
                'captcha' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\z1tools\Captcha',
            ],
            'upload' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\z1tools\Upload',
            ],
        ];

        $actions = array_merge($parentActions, $overwriteActions);

        return $actions;
    }
}

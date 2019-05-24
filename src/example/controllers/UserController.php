<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */
namespace example\controllers;

use example\controllers\BasicController;

/**
 * UserController implements the CRUDI actions for the module.
 */
class UserController extends BasicController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        $parentActions = parent::actions();

        $overwriteActions = [
                'create' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\user\Create',
            ],
            'update' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\user\Update',
            ],
            'view' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\user\View',
            ],
            'delete' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\user\Delete',
            ],
            'index' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\user\Index',
            ],
            'export' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\user\Export',
            ],
            'status' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\user\Status',
            ],
        ];

        $actions = array_merge($parentActions, $overwriteActions);

        return $actions;
    }
}

<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */
namespace example\controllers;

use example\controllers\BasicController;

/**
 * Z1userController implements the CRUDI actions for the module.
 */
class Z1userController extends BasicController
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
                'processingClass' => '\example\processing\z1user\Create',
            ],
            'update' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\z1user\Update',
            ],
            'view' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\z1user\View',
            ],
            'delete' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\z1user\Delete',
            ],
            'index' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\z1user\Index',
            ],
            'export' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\z1user\Export',
            ],
            'status' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\example\processing\z1user\Status',
            ],
        ];

        $actions = array_merge($parentActions, $overwriteActions);

        return $actions;
    }
}

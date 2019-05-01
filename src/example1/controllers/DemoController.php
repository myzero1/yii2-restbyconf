<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */
namespace myzero1\restbyconf\example\controllers;

use \myzero1\restbyconf\components\rest\ApiController;

/**
 * DemoController implements the CRUDI actions for the module.
 */
class DemoController extends ApiController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        $parentActions = parent::actions();

        $overwriteActions = [
            'index' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\myzero1\restbyconf\example\processing\Demo\Index',
            ],
            'create' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\myzero1\restbyconf\example\processing\Demo\Create',
            ],
            'update' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\myzero1\restbyconf\example\processing\Demo\Update',
            ],
            'view' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\myzero1\restbyconf\example\processing\Demo\View',
            ],
            'delete' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\myzero1\restbyconf\example\processing\Demo\Delete',
            ],
            'export' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\myzero1\restbyconf\example\processing\Demo\Export',
            ],
        ];

        $actions = array_merge($parentActions, $overwriteActions);

        return $actions;
    }
}

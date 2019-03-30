<?php

namespace myzero1\restbyconf\controllers;

use myzero1\restbyconf\components\rest\BasicController;

/**
 * FriendsController implements the CRUD actions for SjEnterprise model.
 */
class DemoController extends BasicController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'create' => [
                'class' => 'myzero1\restbyconf\components\rest\CreateAction',
                'modelClass' => $this->modelClass,
                'processingClass' => 'myzero1\restbyconf\controllers\processing\demo\Create',
            ],
            'update' => [
                'class' => 'myzero1\restbyconf\components\rest\UpdateAction',
                'modelClass' => $this->modelClass,
                'processingClass' => 'myzero1\restbyconf\controllers\processing\demo\Update',
            ],
            'view' => [
                'class' => 'myzero1\restbyconf\components\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'processingClass' => 'myzero1\restbyconf\controllers\processing\DemoProcessing',
            ],
            'delete' => [
                'class' => 'myzero1\restbyconf\components\rest\DeleteAction',
                'modelClass' => $this->modelClass,
                'processingClass' => 'myzero1\restbyconf\controllers\processing\DemoProcessing',
            ],
            'index' => [
                'class' => 'myzero1\restbyconf\components\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'processingClass' => 'myzero1\restbyconf\models\search\DemoSearch',
            ],
        ];
    }
}

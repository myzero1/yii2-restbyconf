<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\components\rest;

use yii\base\Model;
use yii\base\InvalidConfigException;
use yii\rest\Action;

/**
 * DeleteAction extends Action.
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class DeleteAction extends Action
{
    /**
     * @var string class name of the model which will be handled by this action.
     * The model class must implement [[ActiveRecordInterface]].
     * This property must be set.
     */
    public $processingClass;

    /**
     * @var string the scenario to be assigned to the new model before it is validated and saved.
     */
    public $scenario = Model::SCENARIO_DEFAULT;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if ($this->processingClass === null) {
            throw new InvalidConfigException('The "processingClass" property must be set.');
        }
    }

    /**
     * Update a new model.
     * @param mixed $id
     * @return \yii\db\ActiveRecordInterface the model newly created
     */
    public function run($id)
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        $processing = new $this->processingClass();
        return $processing->processing($id);
    }
}

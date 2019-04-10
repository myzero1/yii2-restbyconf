<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\components\rest;

use yii\base\Model;
use yii\base\InvalidConfigException;

/**
 * IndexAction extends Action.
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class IndexAction extends Action
{
    /**
     * Creates a new model.
     * @return \yii\db\ActiveRecordInterface the model newly created
     */
    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        $processing = new $this->processingClass();
        return $processing->processing();
    }
}

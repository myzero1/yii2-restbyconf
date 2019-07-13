<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\components\rest;

use yii\web\ServerErrorHttpException;

/**
 * Some Helpful function
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class HandlingHelper
{
    /**
     * @param mixed $completedData
     * @return mixed
     */
    public static function before($completedData)
    {
        return $completedData;
    }

    /**
     * @param mixed $handledData
     * @return mixed
     */
    public static function after($handledData)
    {
        return $handledData;
    }
}

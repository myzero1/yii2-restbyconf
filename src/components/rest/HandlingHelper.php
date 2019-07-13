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
    public static function before($completedData, $ioClassName)
    {
        self::checkReturnDoc($completedData, $ioClassName);

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

    /**
     * ['*', 'c1', 'c2'],
     *
     * @param string $allFlag *
     * @param array $handledData
     * @return bool
     */
    public static function isAll($inArray, $allFlag = '*')
    {
        return boolval(in_array($allFlag, $inArray));
    }

    /**
     * @param string $ioClassName
     * @param array $completedData
     * @return bool
     */
    public static function checkReturnDoc($completedData, $ioClassName)
    {
        /*
            [
                '*' => '*', // all ations, as default
                'controllerA' => [
                    '*', // all actons in controllerA
                ],
                'controllerB' => [
                    'actionB',
                ],
            ],
        */

        $runningAsDocActions = \Yii::$app->controller->module->runningAsDocActions;
        $controllerIds = array_keys($runningAsDocActions);

        if (self::isAll($controllerIds)) {
            return $ioClassName::egOutputData();
        } else {
            $cid = \Yii::$app->controller->id;
            if (isset($runningAsDocActions[$cid])) {
                if (self::isAll($runningAsDocActions[$cid])) {
                    return $ioClassName::egOutputData();
                } else {
                    $aid = \Yii::$app->controller->action->id;
                    if (in_array($aid, $runningAsDocActions[$cid])) {
                        return $ioClassName::egOutputData();
                    }
                }
            }
        }
    }
}

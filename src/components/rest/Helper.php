<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\components\rest;

/**
 * Some Helpful function
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class Helper
{
    public static function response($data, $code = 0, $msg = '')
    {
        \Yii::$app->response->data = $data;

        if ($code !== 0) {
            \Yii::$app->response->statusCode = $code;
        }

        if ($msg !== '') {
            \Yii::$app->response->statusText = $msg;
        }

        return 0;
    }

    /**
     * @param array $errors ['inputField' => 'inputValue]
     * @return string
     */
    public static function getErrorMsg($errors)
    {
        $error = array_shift($errors);
        return $error[0];
    }

    /**
     * @param array $input ['inputField' => 'inputValue]
     * @param array $inputFieldMap ['inputField' => 'dbField]
     * @return array ['dbField' => 'inputValue]
     */
    public static function input2DbField($input, $inputFieldMap = [])
    {
        if (count($inputFieldMap) === 0) {
            return $input;
        } else {
            $outPut = [];
            foreach ($input as $k => $v) {
                if (isset($inputFieldMap[$k])) {
                    $outPut[$inputFieldMap[$k]] = $v;
                }
            }

            return $outPut;
        }
    }

    /**
     * @param array ['dbField' => 'inputValue]
     * @param array $outputFieldMap ['inputField' => 'dbField]
     * @return array ['outputField' => 'inputValue]
     */
    public static function db2OutputField($db, $outputFieldMap = [])
    {
        if (count($outputFieldMap)) {
            return $db;
        } else {
            $outPut = [];
            foreach ($db as $k => $v) {
                if (isset($outputFieldMap[$k])) {
                    $outPut[$outputFieldMap[$k]] = $v;
                }
            }

            return $outPut;
        }
    }

    /**
     * @param int $timestamp 1552886962 the will be converted timestamp.
     * @return string 2019-03-23
     */
    public static function time2string($timestamp)
    {
        if (empty($timestamp)) {
            return '';
        } else {
            if (self::isTimestamp($timestamp)) {
                return date('Y-m-d H:i:s', $timestamp);
            } else {
                return '';
            }
        }
    }

    /**
     * @param string $string 2019-03-23
     * @return int 1552886962
     */
    public static function string2time($string)
    {
        if (empty($timestamp)) {
            return 0;
        } else {
            return strtotime($string);
        }
    }

    /**
     * @param mixed $timestamp .
     * @return bool
     */
    public static function isTimestamp($timestamp)
    {
        $timestamp = intval($timestamp);

        if (strtotime(date('Y-m-d H:i:s', $timestamp)) === $timestamp) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param mixed $data .
     * @return bool
     */
    public static function isReturning($data)
    {
        if (isset($data['code']) && isset($data['code']) && isset($data['code']) && (count($data) === 3)) {
            return true;
        } else {
            return false;
        }
    }
}

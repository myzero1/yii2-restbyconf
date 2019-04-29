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
            foreach ($input as $k => $v) {
                if (isset($inputFieldMap[$k])) {
                    $input[$inputFieldMap[$k]] = $v;
                    unset($input[$k]);
                }
            }

            return $input;
        }
    }

    /**
     * @param array ['dbField' => 'inputValue]
     * @param array $outputFieldMap ['inputField' => 'dbField]
     * @return array ['outputField' => 'inputValue]
     */
    public static function db2OutputField($db, $outputFieldMap = [])
    {
        if (count($outputFieldMap) === 0) {
            return $db;
        } else {
            foreach ($db as $k => $v) {
                if (isset($outputFieldMap[$k])) {
                    $db[$outputFieldMap[$k]] = $v;
                    unset($db[$k]);
                }
            }

            return $db;
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


    /**
     * @param string $sort +id,-id
     * @param string $defaultSort +id
     * @param array $sortFiledArray ['id','name']
     * @return mixed false | ['sort'=>SORT_ASC, 'sortFile'=>'id]
     */
    public static function getSort($sort, $sortFiledArray, $defaultSort)
    {
        $checkedSort = self::checkSortInput($sort);

        if ($checkedSort !== false) {
            if (in_array($checkedSort['sortFiled'], $sortFiledArray)) {
                return self::decodeSort($checkedSort);
            } else {
                $checkedSortDefault = self::checkSortInput($defaultSort);
                if ($checkedSortDefault !== false) {
                    if (in_array($checkedSortDefault['sortFiled'], $sortFiledArray)) {
                        return self::decodeSort($checkedSortDefault);
                    } else {
                        throw new ServerErrorHttpException('Failed to get sort for checkedSortDefault reason.');
                    }
                } else {
                    throw new ServerErrorHttpException('Failed to get sort for checkedSortDefault reason.');
                }
            }
        } else {
            $checkedSortDefault = self::checkSortInput($defaultSort);
            if ($checkedSortDefault !== false) {
                if (in_array($checkedSortDefault['sortFiled'], $sortFiledArray)) {
                    return self::decodeSort($checkedSortDefault);
                } else {
                    throw new ServerErrorHttpException('Failed to get sort for not a sort field reason.');
                }
            } else {
                throw new ServerErrorHttpException('Failed to get sort for checkedSortDefault reason.');
            }
        }
    }

    /**
     * @param array ['sort'=>'+', 'sortFiled'=>'id']
     * @return array
     */
    public static function decodeSort($sort)
    {
        $sortSetting = [
            '+' => SORT_ASC,
            '-' => SORT_DESC,
        ];

        return [
            'sort' => $sortSetting[$sort['sort']],
            'sortFiled' => $sort['sortFiled'],
        ];
    }

    /**
     * @param string $sort +id,+ id
     * @return mixed false | +id
     */
    public static function checkSortInput($sort)
    {
        $trimSort = trim($sort);
        $pre = substr($trimSort, 0, 1);
        $sortFiled = substr($trimSort, 1);
        $sortFiled = trim($sortFiled);

        if (!empty($pre) && !empty($sortFiled)) {
            if (in_array($pre, ['+', '-'])) {
                return [
                    'sort' => $pre,
                    'sortFiled' => $sortFiled,
                ];
            } else {
                return [
                    'sort' => '+',
                    'sortFiled' => $trimSort,
                ];
            }
        } else {
            return false;
        }
    }

    /**
     * @param string $uncamelized_words
     * @param string $separator
     * @return string
     */
    public static function camelize($uncamelized_words, $separator = '_')
    {
        $uncamelized_words = $separator . str_replace($separator, " ", strtolower($uncamelized_words));
        return ltrim(str_replace(" ", "", ucwords($uncamelized_words)), $separator);
    }

    /**
     * @param string $camelCaps
     * @param string $separator
     * @return string
     */
    public static function uncamelize($camelCaps, $separator = '_')
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $camelCaps));
    }

    /**
     * @param string $camelCaps
     * @param string $separator
     * @return string
     */
    public static function optimizeRestUrlRules($urlRules)
    {
        // var_dump($urlRules);exit;
        $apiRuleConfigs = [];
        foreach ($urlRules as $k => $v) {
            if (isset($v['class']) && $v['class'] == '\yii\rest\UrlRule') {
                $tmp = [];
                $tmp['controller'] = $v['controller'];
                if (isset($v['extraPatterns'])) {
                    $tmp['extraPatterns'] = $v['extraPatterns'];
                }

                $apiRuleConfigs[] = $tmp;
            }
        }

        $apiRuleConfigsDealed = [];
        foreach ($apiRuleConfigs as $key => $value) {
            $apiRuleConfigsDealed[] = self::addOptionsAction($value);
        }
        // var_dump($apiRuleConfigsDealed);exit;
        return $apiRuleConfigsDealed;
    }

    /**
     * @param string $camelCaps
     * @param string $separator
     * @return string
     */
    public static function addOptionsAction($urlRule)
    {
        $unit = $urlRule;

        if ($urlRule['controller'][0] == 'restbyconf_custom_rules') {
            foreach ($urlRule['extraPatterns'] as $key => $val) {
                if (!is_numeric(strpos($key, 'OPTIONS'))) {
                    //判断是否有空格符
                    if (is_numeric(strpos($key, ' '))) {
                        //存在
                        $tmp = explode(' ', $key);
                        $k = str_replace($tmp[0], 'OPTIONS', $key);
                        $urlRule['extraPatterns'][$k] = 'options';
                    } else {
                        //不存在
                        $urlRule['extraPatterns']['OPTIONS'] = 'options';
                    }
                }
            }

            return $urlRule['extraPatterns'];
        } else {
            //防止默认options控制器被屏蔽
            if (isset($unit['only']) && !empty($unit['only']) && !in_array('options', $unit['only'])) {
                $urlRule['only'][] = 'options';
            }
            if (isset($unit['except']) && !empty($unit['except']) && in_array('options', $unit['except'])) {
                $urlRule['except'] = array_merge(array_diff($unit['except'], ['options']));
            }
            //由于ajax设置请求头后,会有一次options请求,默认为所有路由添加支持options请求
            if (isset($unit['extraPatterns']) && !empty($unit['extraPatterns'])) {
                foreach ($unit['extraPatterns'] as $key => $val) {
                    if (!is_numeric(strpos($key, 'OPTIONS'))) {
                        //判断是否有空格符
                        if (is_numeric(strpos($key, ' '))) {
                            //存在
                            $tmp = explode(' ', $key);
                            $k = str_replace($tmp[0], 'OPTIONS', $key);
                            $urlRule['extraPatterns'][$k] = 'options';
                        } else {
                            //不存在
                            $urlRule['extraPatterns']['OPTIONS'] = 'options';
                        }
                    }
                }
            }
            if (isset($unit['patterns']) && !empty($unit['patterns'])) {
                foreach ($unit['patterns'] as $key => $val) {
                    if (!is_numeric(strpos($key, 'OPTIONS'))) {
                        //判断是否有空格符
                        if (is_numeric(strpos($key, ' '))) {
                            //存在
                            $tmp = explode(' ', $key);
                            $k = str_replace($tmp[0], 'OPTIONS', $key);
                            $urlRule['patterns'][$k] = 'options';
                        } else {
                            //不存在
                            $urlRule['patterns']['OPTIONS'] = 'options';
                        }
                    }
                }
            }

            $config = [
                'class' => '\yii\rest\UrlRule',
                'pluralize' => false,
                'tokens' => [
                    '{id}' => '<id:\\w[\\w,]*>',
                ],
            ];

            return array_merge($config, $urlRule);
        }
    }

    /**
     * @param string $filename export-enterprise
     * @param array $exportParams [
     * 'dataProvider' => $dataProvider,
     * 'columns' => [
     * [
     * 'attribute' => 'id',
     * 'label' => '网吧编码',
     * ],
     * [
     * 'attribute' => 'name',
     * 'label' => '网吧名称',
     * ],
     * ],
     * ]
     * @throws  \RuntimeException
     * @return bool true
     */
    public static function createXls($filename, $exportParams)
    {
        $filenameXls = $filename . '.xls';
        try {
            $exporter = new \yii2tech\spreadsheet\Spreadsheet($exportParams);
        } catch (\Exception $e) {
            throw new \RuntimeException($e);
        }
        $exporter->save($filenameXls);

        return true;
    }

    /**
     * @param string $filename export-enterprise
     * @param string $password password
     * @throws  \RuntimeException
     * @return bool true
     */
    public static function encryptZIP($filename, $password)
    {
        $filenameXls = $filename . '.xls';
        $filenameZip = $filename . '.zip';
        $zipFile = new ZipFile();

        try {
            $zipFile
                ->addFile($filenameXls)
                ->setPassword($password)
                ->saveAsFile($filenameZip)
                ->close();
        } catch (\Exception $e) {
            throw new \RuntimeException($e);
        }
        $zipFile->close();
        unlink($filenameXls);

        return true;
    }

    /**
     * @param array $input
     * @return mixed
     */
    public static function inputFilter($input)
    {
        return array_filter(
            $input,
            function($v){
                return !in_array(
                    $v,
                    $invalidParams = [
                        '',
                        null,
                        [],
                    ],
                    true
                );
            }
        );
    }

    /**
     * get dates
     * @param array $dictionary
     * @param string $type
     * @param string $item
     * @return string
     */
    public static function getDictionary($dictionary, $type, $item)
    {
        // $dictionaryPath = sprintf('%s/../backend/config/dictionary.php', Yii::getAlias('@app'));
        // $dictionary = Yii::$app->params['dictionary'];
        // $dictionary = require $dictionaryPath;


        if (isset($dictionary[$type][$item])) {
            return $dictionary[$type][$item];
        } else {
            return '';
        }
    }
}

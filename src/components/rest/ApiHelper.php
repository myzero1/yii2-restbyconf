<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\components\rest;

use yii\web\ServerErrorHttpException;
use Yii;

/**
 * Some Helpful function
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
class ApiHelper
{
    const EXPORT_PAGE = 1;
    const EXPORT_PAGE_SIZE = 999999;
    const DEFAULT_PAGE = 1;
    const DEFAULT_PAGE_SIZE = 30;

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
        if (empty($string)) {
            return '';
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
        if (isset($data['code']) && isset($data['msg']) && isset($data['data']) && (count($data) === 3)) {
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
     * @param array $urlRule
     * @return array
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
     * @param array $urlRule
     * @return array
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
     * @param array $node
     * @return array
     */
    public static function rmNode($node)
    {
        $rmNode = ['node_id', 'add_item_click_before_icon'];
        foreach ($rmNode as $k => $v) {
            unset($node[$v]);
        }

        return $node;
    }

    /**
     * @param string $moduleId
     * @return array
     */
    public static function getApiConf($moduleId)
    {
        if ($moduleId) {
            $path = self::getModulePath($moduleId);
        } else {
            $path = '';
        }
        $confDataPathTmp = sprintf('%s/config/conf_admin.json', $path);
        $confDataPathDefault = Yii::getAlias('@vendor/myzero1/yii2-restbyconf/src/components/conf/conf.json');

        if (is_file($confDataPathTmp)) {
            $confDataTmp = file_get_contents($confDataPathTmp);
            if (empty($confDataTmp)) {
                $confDataInit = file_get_contents($confDataPathDefault);
            } else {
                $configAdmin = json_decode($confDataTmp, true);
                $configAdminObj = json_decode($confDataTmp);
                $member = $configAdmin['json']['myGroup']['member'];

                $adminControllers = array_keys($configAdmin['json']['controllers']);
                foreach ($adminControllers as $k2 => $v2) {
                    $configAdmin['json']['controllers'][$v2] = $configAdminObj->json->controllers->$v2;
                }

                foreach (array_keys($member) as $k => $v) {
                    $fileName = sprintf('%s/config/conf_%s.json', $path, $v);
                    if (is_file($fileName)) {
                        $data = file_get_contents($fileName);
                        $dataArray = json_decode($data, true);
                        $dataObj = json_decode($data);

                        $controllers = explode(',', $member[$v]);

                        foreach ($controllers as $k1 => $v1) {
                            if (isset($dataArray['json']['controllers'][$v1])) {
                                $configAdmin['json']['controllers'][$v1] = $dataObj->json->controllers->$v1;
                            }
                        }
                    }
                }

                // $members = array_keys($configAdmin['json']['myGroup']['member']);
                // $members = array_merge(['admin'] ,$members);
                // $configAdmin['schemaRefs']['schema']['properties']['myGroup']['properties']['currentUser']['enum'] = $members;
                // var_dump($configAdmin);exit;
                $confDataInit = json_encode($configAdmin);
            }
        } else {
            $confDataInit = file_get_contents($confDataPathDefault);
        }

        return $confDataInit;
    }

    /**
     * @param string $moduleId
     * @return array
     */
    public static function getApiUrlRules($moduleId)
    {
        if ($moduleId) {
            $path = self::getModulePath($moduleId);
        } else {
            $path = '';
        }
        $confDataPathTmp = sprintf('%s/config/apiUrlRules.php', $path);
        $confDataPathDefault = Yii::getAlias('@vendor/myzero1/yii2-restbyconf/src/components/conf/apiUrlRules.php');

        if (is_file($confDataPathTmp)) {
            $confDataTmp = require $confDataPathTmp;
            if (empty($confDataTmp)) {
                $confDataInit = require $confDataPathDefault;
            } else {
                $confDataInit = $confDataTmp;
            }
        } else {
            $confDataInit = require $confDataPathDefault;
        }

        return $confDataInit;
    }

    /**
     * @param  string $modelClass
     * @param  int $id
     * @param  array $where
     * @return mixed
     */
    public static function findModel($modelClass, $id, $where = [])
    {
        if (count($where)) {
            $model = $modelClass::find()->where($where)->one();
        } else {
            $model = $modelClass::find()->where(['id' => $id, 'is_del' => 0])->one();
        }

        if (!$model) {
            /*
            return [
                'code' => ApiCodeMsg::NOT_FOUND,
                'msg' => ApiCodeMsg::NOT_FOUND_MSG,
                'data' => new \StdClass(),
            ];
            */

            $data = [
                'code' => ApiCodeMsg::NOT_FOUND,
                'msg' => ApiCodeMsg::NOT_FOUND_MSG,
                'data' => new \StdClass(),
            ];

            Yii::$app->response->data = $data;
            Yii::$app->response->send();
            exit;
        } else {
            return $model;
        }
    }

    /**
     * @param array $input
     * @return mixed
     */
    public static function inputFilter($input)
    {
        return array_filter(
            $input,
            function ($v) {
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
     * @param  array $validatedInput
     * @return array
     */
    public static function getPagination($validatedInput)
    {
        $pagination = [];
        if (isset($validatedInput['page']) && !empty($validatedInput['page'])) {
            $pagination['page'] = $validatedInput['page'];
        } else {
            $pagination['page'] = ApiHelper::DEFAULT_PAGE;
        }
        if (isset($validatedInput['page_size']) && !empty($validatedInput['page_size'])) {
            $pagination['page_size'] = $validatedInput['page_size'];
        } else {
            $pagination['page_size'] = ApiHelper::DEFAULT_PAGE_SIZE;
        }

        return $pagination;
    }

    /**
     * @param string $filename export-files
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
     * Get the module's name of restbyconf.
     *
     * 调用实例：Helper::
     *
     * @param   void
     * @return  string
     **/
    public static function getRestModuleName()
    {
        foreach (\Yii::$app->modules as $key => $value) {
            if (!is_array($value)) {
                if (is_object($value)) {
                    if ('myzero1\restbyconf\Module' == $value::className()) {
                        return $key;
                    }
                } else {
                    if ('myzero1\restbyconf\Module' == $value) {
                        return $key;
                    }
                }
            }
        }

        return 'RestbyconfModule';
    }

    /**
     * Get the module's id of restbyconf.
     *
     * 调用实例：Helper::
     *
     * @param   void
     * @return  string
     **/
    public static function getRestByConfModuleId()
    {
        $moduleId = [];
        foreach (\Yii::$app->modules as $key => $value) {
            if (!is_array($value)) {
                if (is_object($value)) {
                    if (stripos($value::className(), "RestByConfModule") !== false) {
                        $moduleId[] = $key;
                    }
                }
            }
        }
        return $moduleId;
    }

    /**
     * Get the module's name of restbyconf.
     *
     * 调用实例：Helper::
     *
     * @param   obj $generator
     * @return  bool
     **/
    public static function isRestGenerator($generator)
    {
        $attributes = $generator->attributes;
        $restAttributes = ['conf', 'position', 'confAarray', 'moduleClass', 'moduleID', 'controller', 'action', 'controllerV',];

        foreach ($restAttributes as $k => $v) {
            if (in_array($v, $attributes)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the module's name of restbyconf.
     *
     * 调用实例：Helper::
     *
     * @param   obj $model
     * @param   int $code
     * @return  array
     **/
    public static function getModelError($model, $code)
    {
        $errors = $model->errors;
        return [
            'code' => $code,
            'msg' => Helper::getErrorMsg($errors),
            'data' => $errors,
        ];
    }

    /**
     * @param   string $className
     * @return  string
     **/
    public static function getClassPath($className = 'myzero1\restbyconf\Module')
    {
        $reflection = new \ReflectionClass($className);
        $fileName = $reflection->getFileName();
        return $fileName;
    }

    /**
     * @param   int $moduleId
     * @return  string
     **/
    public static function getModuleClass($moduleId, $setDefault = false)
    {
        if (isset(Yii::$app->modules[$moduleId])) {
            if (is_object(Yii::$app->modules[$moduleId])) {
                return Yii::$app->modules[$moduleId]->className();
            } else {
                return Yii::$app->modules[$moduleId];
            }
        } else {
            if ($setDefault) {
                return sprintf('app\modules\%s\%s', $moduleId, 'RestByConfModule');
            } else {
                self::throwError(sprintf('Not found module "%s"', $moduleId), __FILE__, __LINE__);
            }
        }
    }

    /**
     * @param   string $msg
     * @param   string $filePath
     * @param   string $lineNum
     **/
    public static function throwError($msg, $filePath, $lineNum)
    {
        if (defined('YII_ENV') && YII_ENV == 'dev') {
            $fileMsg = sprintf('in file:%s', $filePath);
            $lineMsg = sprintf('on file:%s', $lineNum);
            $msgs = "{$msg}\n{$fileMsg}\n{$lineMsg}";
        } else {
            $msgs = $msg;
        }
        
        throw new ServerErrorHttpException($msgs);
    }

    /**
     * @param   string $moduleId
     * @return  string
     **/
    public static function getModulePath($moduleId, $confJson=[])
    {
        $moduleClass = self::getModuleClass($moduleId, true);
        if (class_exists($moduleClass)) {
            $moduleFilePath = self::getClassPath($moduleClass);
            $modulePath = dirname($moduleFilePath);
        } else {
            // $modulePath = sprintf('%s/modules/%s', Yii::getAlias('@app'), $moduleId);

            $restModuleName = $confJson['restModuleName'];
            $restModuleAlias = $confJson['restModuleAlias'];
            $restModuleAliasPath = $confJson['restModuleAliasPath'];

            $modulePath = Yii::getAlias($restModuleAliasPath);
            $modulePath = str_replace($restModuleName, $restModuleAlias, $modulePath);

        }

        return $modulePath;
    }

    /**
     * @param   array $array
     * @param   mixed $key
     * @param   mixed $defafult
     * @return  mixed
     **/
    public static function getArrayVal($array, $key, $defafult='')
    {
        $result = '';
        if (isset($array[$key])) {
            $result = $array[$key];
        } else {
            $result = $defafult;
        }

        return $result;
    }
    

    /**
     * get Dictionary lable
     * @param string $type
     * @param string $item
     * @param mixed $customDic
     * @return string
     */
    public static function getDictionaryLable($type, $item, $customDic = false, $dicFilePath = false)
    {
        if ($customDic) {
            $dictionary['customDic'] = $customDic;
            $type = 'customDic';
        } else if ($dicFilePath) {
            // $dicFilePath = sprintf('%s/../common/config/dictionary.php', Yii::getAlias('@app'));
            $dictionary = require $dicFilePath;
        } else {
            return '';
        }

        if (isset($dictionary[$type][$item])) {
            return $dictionary[$type][$item];
        } else {
            return '';
        }
    }
    
    /**
     * filter EgOutputData
     * @param string $type
     * @param string $item
     * @param mixed $customDic
     * @return string
     */
    public static function filterEgOutputData($egOutputDataEncode)
    {
        $tmp =  unserialize($egOutputDataEncode);

        foreach ($tmp as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k1 => $v1) {
                    if (is_array($v1)) {
                        foreach ($v1 as $k2 => $v2) {
                            if (is_string($v2)) {
                                $t2 = explode('---', $v2);
                                $tmp[$k][$k1][$k2] = $t2[0];
                            }
                        }
                    } else {
                        if (is_string($v1)) {
                            $t1 = explode('---', $v1);
                            $tmp[$k][$k1] = $t1[0];
                        }
                    }
                }
            } else {
                if (is_string($v)) {
                    $t = explode('---', $v);
                    $tmp[$k] = $t[0];
                }
            }
        }

        // var_dump($tmp);
        return $tmp;
    }
}

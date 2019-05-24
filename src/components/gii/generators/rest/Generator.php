<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace myzero1\restbyconf\components\gii\generators\rest;

use yii\gii\CodeFile;
use yii\helpers\Html;
use Yii;
use yii\helpers\StringHelper;
use myzero1\restbyconf\components\rest\ApiHelper;

/**
 * This generator will generate the skeleton code needed by a module.
 *
 * @property string $controllerNamespace The controller namespace of the module. This property is read-only.
 * @property bool $modulePath The directory that contains the module class. This property is read-only.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Generator extends \yii\gii\Generator
{
    public $conf;
    public $position;
    public $confAarray;
    public $moduleClass;
    public $moduleID;
    public $controller;
    public $action;
    public $controllerV;


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Restfull Generator';
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return 'This generator helps you to generate the restfull api by the api setting.';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['conf','position'], 'filter', 'filter' => 'trim'],
            [['conf'], 'required', 'message' => 'You should change the conf.'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'conf' => 'Conf',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function hints()
    {
        return [
            'moduleID' => 'This refers to the ID of the module, e.g., <code>admin</code>.',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function successMessage()
    {
        if (Yii::$app->hasModule($this->moduleID)) {
            $link = Html::a('try it now', Yii::$app->getUrlManager()->createUrl($this->moduleID), ['target' => '_blank']);

            return "The module has been generated successfully. You may $link.";
        }

        $output = <<<EOD
<p>The module has been generated successfully.</p>
<p>To access the module, you need to add this to your application configuration:</p>
EOD;
        $code = <<<EOD
<?php
    ......
    'modules' => [
        '{$this->moduleID}' => [
            'class' => '{$this->moduleClass}',
        ],
    ],
    ......
EOD;
        $rest = <<<EOD
<p>The code has been generated successfully.</p>
EOD;

        return $output . '<pre>' . highlight_string($code, true) . '</pre>' . $rest;
    }

    /**
     * {@inheritdoc}
     */
    public function requiredTemplates()
    {
        return ['module.php', 'controller.php', 'view.php'];
    }

    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $this->confAarray = json_decode($this->conf, true);

        $mId = Yii::$app->request->get('mId', '');
        if ($mId) {
            $this->moduleID = $mId;
        } else {
            $this->moduleID = trim($this->confAarray['json']['basePath'], '/');
        }

//        $this->moduleClass = sprintf('app\modules\%s\%s', $this->moduleID, 'RestByConfModule');
        $this->moduleClass = ApiHelper::getModuleClass($this->moduleID, true);

        $files = [];

        // for rest api
        $files = array_merge($files, $this->generateRest());

        // for swagger


        // for md

        // save conf to file
        $files[] = new CodeFile(
//            Yii::getAlias(sprintf('@app/modules/%s/config/conf.json', $this->moduleID)),
            sprintf('%s/config/conf.json', ApiHelper::getModulePath($this->moduleID)),
            $this->conf
        );

        $confAarray = $this->confAarray;
        $controllers = $confAarray['json']['controllers'];
        $controllers = ApiHelper::rmNode($controllers);
        $curdi = ['create', 'update', 'view', 'delete', 'index', ];
        $version =  $confAarray['json']['info']['version'];
        $moduleName = trim($confAarray['json']['basePath'], '/');
        $rules = "<?php\n";
        $rules .= sprintf("\$version = '%s';\n", $version);
        $rules .= sprintf("\$moduleName = '%s';\n", $moduleName);
        $rules .= "return [\n";
        $rules .= "    // defult\n";
        $rules .= "    [\n";
        $rules .= "        'class' => 'yii\\rest\UrlRule',\n";
        $rules .= "        'pluralize' => false,\n";
        $rules .= "        'controller' => [\n";
        $rules .= "            'placeholder',\n";
        $controllerKeys = array_keys($controllers);
        foreach ($controllerKeys as $k => $v) {
            $v = ApiHelper::uncamelize($v, $separator = '-');
            $rules .= sprintf("            \$moduleName . '/%s',\n", $v);
        }
        $rules .= "        ],\n";
        $rules .= "        'extraPatterns' => extraPatterns\n";
        $rules .= "    ],\n\n";

        $rules .= "    // custom\n";
        $extra = [];
        foreach ($controllers as $controllerK => $controllerV) {
            $actions = $controllerV['actions'];
            $controllerK = ApiHelper::uncamelize($controllerK, $separator = '-');
            foreach ($actions as $actionK => $actionV) {
                $uri = str_replace('{controller}', $controllerK, $actionV['uri']);
                $pathParams = $actionV['inputs']['path_params'];
                $pathParams = ApiHelper::rmNode($pathParams);
//                $tmpIds = [];
                foreach ($pathParams as $pathParamK => $pathParamV) {
                    $rulesTmp = $pathParamV['rules'];
                    $rulesTmp = trim($rulesTmp, '^');
                    $rulesTmp = trim($rulesTmp, '$');
                    $pathParam = sprintf('<%s:%s>', $pathParamK, $rulesTmp);
                    $uri = str_replace('{'.$pathParamK.'}', $pathParam, $uri);
                }

                $actionK = ApiHelper::uncamelize($actionK, '-');
                $uri = sprintf("'%s,OPTIONS ' . %s .'%s' => %s . '/%s/%s'", strtoupper($actionV['method']), '$version', $uri, '$moduleName', $controllerK, $actionK);

                $rules .= sprintf("    %s,\n", $uri);

                if (!in_array($actionK, $curdi)) {
                    $tmp = sprintf('%s,OPTIONS ', strtoupper($actionV['method']));
                    $pathParams = $actionV['inputs']['path_params'];
                    $pathParams = ApiHelper::rmNode($pathParams);
                    $tmpIds = [];
                    foreach ($pathParams as $pathParamK => $pathParamV) {
                        $rulesTmp = $pathParamV['rules'];
                        $rulesTmp = trim($rulesTmp, '^');
                        $rulesTmp = trim($rulesTmp, '$');
                        // $tmp = sprintf('%s<%s:%s>', $tmp, $pathParamK, $rulesTmp);
                        $tmpIds[] = sprintf('<%s:%s>', $pathParamK, $rulesTmp);
                    }

                    $tmpIdsStr = implode('/', $tmpIds);
                    $tmp = sprintf('%s%s', $tmp, $tmpIdsStr);
                    $actionK = ApiHelper::uncamelize($actionK, '-');
                    $tmp = sprintf("'%s/%s' => '%s'", $tmp, $actionK, $actionK);
                    $extra[] = $tmp;
                }

            }
            $rules .= "\n";
        }

        // $rules .= "\n";
        $rules .= "];\n";

        if (count($extra)) {
            $rulesExtra = sprintf("'extraPatterns' => [\n");
            $extra = array_unique($extra);
            foreach ($extra as $key => $value) {
                $rulesExtra .= sprintf("            %s,\n", $value);
            }
            $rulesExtra .= sprintf("        ],\n");

            $rules = str_replace("'extraPatterns' => extraPatterns", $rulesExtra, $rules);
        } else {
            $rules = str_replace("'extraPatterns' => extraPatterns", "'extraPatterns' => []", $rules);
        }

        $files[] = new CodeFile(
//            Yii::getAlias(sprintf('@app/modules/%s/config/apiUrlRules.php', $this->moduleID)),
            sprintf('%s/config/apiUrlRules.php', ApiHelper::getModulePath($this->moduleID)),
            $rules
        );

        return $files;
    }

    /**
     * Validates [[moduleClass]] to make sure it is a fully qualified class name.
     */
    public function generateRest()
    {
        $files = [];
//        $modulePath = $this->getModulePath();
        $modulePath = ApiHelper::getModulePath($this->moduleID);

        $files[] = new CodeFile(
            $modulePath . '/' . StringHelper::basename($this->moduleClass) . '.php',
            $this->render("module.php")
        );
        $files[] = new CodeFile(
            $modulePath . '/controllers/DefaultController.php',
            $this->render("controller.php")
        );
        $files[] = new CodeFile(
            $modulePath . '/views/default/index.php',
            $this->render("view.php")
        );

        $controllers = $this->confAarray['json']['controllers'];
        $controllers = ApiHelper::rmNode($controllers);

       foreach ($controllers as $controller => $controllerV) {
            $this->controller = $controller;
            $controllerV['actions'] = ApiHelper::rmNode($controllerV['actions']);
            $this->controllerV = $controllerV;
            $files[] = new CodeFile(
                sprintf('%s/controllers/%sController.php', $modulePath, ucwords($controller)),
                $this->render('rest/ApiController.php')
            );
            $actions = array_keys($controllerV['actions']);

            $template = ['create', 'update', 'delete', 'view', 'index', 'export', ];
            foreach ($actions as $k => $action) {
                $this->action = $action;
                if (in_array($action, $template)) {
                    $files[] = new CodeFile(
                        sprintf('%s/processing/%s/%s.php', $modulePath, $controller, ucwords($action)),
                        $this->render(sprintf('rest/template/Api%sProcessing.php', ucfirst($action)))
                    );
                } else {
                    $files[] = new CodeFile(
                        sprintf('%s/processing/%s/%s.php', $modulePath, $controller, ucwords($action)),
                        $this->render('rest/template/ApiCustomProcessing.php')
                    );
                }

                $files[] = new CodeFile(
                    sprintf('%s/processing/%s/io/%sIo.php', $modulePath, $controller, ucwords($action)),
                    $this->render('rest/ApiIoProcessing.php')
                );
            }
        }

        return $files;
    }

    public function getModuleTemplateParams()
    {
        $params = [];
        $params['namespace'] = $this->getModuleNamespace();
        $params['moduleID'] = $this->moduleID;
        $params['className'] = $this->getModuleClassName();
        $params['classNameMd5'] = md5($params['className']);
        $params['controllerNamespace'] = $this->getControllerNamespace();
        $params['restbyconfAuthenticator'] = $this->confAarray['json']['mySecurity']['security'];
        // var_dump($this->confAarray['json']['mySecurity']['exclude']);exit;
        $params['restbyconfUnAuthenticateActions'] = $this->confAarray['json']['mySecurity']['exclude'];
        $params['restModuleAlias'] = $this->confAarray['json']['restModuleAlias'];
        $params['restModuleAliasPath'] = $this->confAarray['json']['restModuleAliasPath'];

        return $params;
    }

    public function getModuleNamespace()
    {
        $className = $this->moduleClass;
        $pos = strrpos($className, '\\');
        $ns = ltrim(substr($className, 0, $pos), '\\');

        return $ns;
    }

    public function getModuleClassName()
    {
        $className = $this->moduleClass;
        $pos = strrpos($className, '\\');
        return substr($this->moduleClass, $pos + 1);
    }

    public function getControllerNamespace()
    {
        return substr($this->moduleClass, 0, strrpos($this->moduleClass, '\\')) . '\controllers';
    }




    /**
     * @return bool the directory that contains the module class
     */
    public function getModulePath()
    {
        return Yii::getAlias('@' . str_replace('\\', '/', substr($this->moduleClass, 0, strrpos($this->moduleClass, '\\'))));
    }
}

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
        $this->moduleID = trim($this->confAarray['json']['basePath'], '/');
        $this->moduleClass = sprintf('app\modules\%s\%s', $this->moduleID, 'RestByConfModule');
        $files = [];

        // for rest api
        $files = array_merge($files, $this->generateRest());

        // for swagger


        // for md

        // save conf to file
        $files[] = new CodeFile(
            Yii::getAlias(sprintf('@app/modules/%s/config/conf.json', $this->moduleID)),
            $this->conf
        );

        $confAarray = $this->confAarray;
        $controllers = $confAarray['json']['controllers'];
        $controllers = ApiHelper::rmNode($controllers);
        $curdi = ['create', 'update', 'view', 'delete', 'index', ];
        $rules = "<?php\n";
        $rules .= "return [\n";
        foreach ($controllers as $controllerK => $controllerV) {
            $extra = [];
            $actions = $controllerV['actions'];
            $actions = ApiHelper::rmNode($actions);
            foreach ($actions as $actionK => $actionV) {
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

            $version = trim($confAarray['json']['basePath'], '/');
            $controllerK = ApiHelper::uncamelize($controllerK, $separator = '-');

            $rules .= sprintf("    '%s/%s' => [\n", $version, $controllerK);
            $rules .= sprintf("        'controller' => ['%s/%s'],\n", $version, $controllerK);
            $rules .= sprintf("        'class' => '\\yii\\rest\UrlRule',\n");
            $rules .= sprintf("        'pluralize' => false,\n");

            if ($controllerV['defaultPathIdRule']) {
                $idPattern = $controllerV['defaultPathIdRule'];
            } else {
                $idPattern = '\d+';
            }
            if ($controllerV['defaultPathIdKey']) {
                $idKey = $controllerV['defaultPathIdKey'];
            } else {
                $idKey = 'id';
            }
            $patterns = [
                sprintf('PUT,PATCH {%s}', $idKey) => 'update',
                sprintf('DELETE {%s}', $idKey) => 'delete',
                sprintf('GET,HEAD {%s}', $idKey) => 'view',
                sprintf('{%s}', $idKey) => 'options',
                'POST' => 'create',
                'GET,HEAD' => 'index',
                '' => 'options',
            ];

            $rules .= sprintf("        'tokens' => [\n");
            $rules .= sprintf("            '{%s}' => '<%s:%s>',\n", $idKey, $idKey, $idPattern);
            $rules .= sprintf("        ],\n");

            $rules .= sprintf("        'patterns' => [\n");
            foreach ($patterns as $k => $v) {
                $rules .= sprintf("            '%s' => '%s',\n", $k, $v);
            }
            $rules .= sprintf("        ],\n");

            if (count($extra)) {
                $rules .= sprintf("        'extraPatterns' => [\n");
                foreach ($extra as $key => $value) {
                    $rules .= sprintf("            %s,\n", $value);
                }
                $rules .= sprintf("        ],\n");
            }
            $rules .= sprintf("    ],\n");
        }

        $rules .= "];\n";
        
        $files[] = new CodeFile(
            Yii::getAlias(sprintf('@app/modules/%s/config/apiUrlRules.php', $this->moduleID)),
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
        $modulePath = $this->getModulePath();
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
                        sprintf('%s/processing/%s/%s.php', $modulePath, ucwords($controller), ucwords($action)),
                        $this->render('rest/template/ApiCustomProcessing.php')
                    );
                }

                $files[] = new CodeFile(
                    sprintf('%s/processing/%s/io/%sIo.php', $modulePath, ucwords($controller), ucwords($action)),
                    $this->render('rest/ApiIoProcessing.php')
                );
            }
        }

        return $files;
    }

    /**
     * @return bool the directory that contains the module class
     */
    public function getModulePath()
    {
        return Yii::getAlias('@' . str_replace('\\', '/', substr($this->moduleClass, 0, strrpos($this->moduleClass, '\\'))));
    }

    /**
     * @return string the controller namespace of the module.
     */
    public function getControllerNamespace()
    {
        return substr($this->moduleClass, 0, strrpos($this->moduleClass, '\\')) . '\controllers';
    }
}

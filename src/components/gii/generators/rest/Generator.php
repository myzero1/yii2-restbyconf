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
    public $confAarray;
    public $moduleClass;
    public $moduleID;


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
            [['conf'], 'filter', 'filter' => 'trim'],
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
        return 'The module has been generated successfully';
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
        $this->moduleClass = sprintf('app\modules\%s\%s', $this->moduleID, 'Module');
        $files = [];

        // for rest api
        $files = array_merge($files, $this->generateRest());

        // for swagger


        // for md

        // save conf to file
        $files[] = new CodeFile(
            Yii::getAlias('@vendor/myzero1/yii2-restbyconf/src/components/conf/conf.json'),
            $this->conf
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

//        foreach ($conf['json']['tags'] as $tag => $tagV) {
//             $files[] = new CodeFile(
//                 $modulePath . '/controllers/DefaultController.php',
//                 $this->render('controller.php')
//             );
//        }
//        var_dump($conf['json']['tags']);exit;

        // $files[] = new CodeFile(
        //     $modulePath . '/controllers/DefaultController.php',
        //     $this->render("controller.php")
        // );


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

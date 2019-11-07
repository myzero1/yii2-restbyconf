<?php
echo "<?php\n";
?>
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */
namespace <?= $generator->confAarray['json']['restModuleAlias'] . '\controllers' ?>;

use \myzero1\restbyconf\components\rest\ApiController;

/**
 * BasicController implements the CRUDI actions for the module.
 */
class BasicController extends ApiController
{
    public function beforeAction($action)
    {
        \Yii::$app->user->identity = \myzero1\restbyconf\components\rest\ApiHelper::getUser();

        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        return $behaviors;
    }
}<?="\n"?>
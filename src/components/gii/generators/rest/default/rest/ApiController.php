<?php
use myzero1\restbyconf\components\rest\ApiHelper;
/**
 * This is the template for generating a controller class within a module.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */

$controller = ucwords($generator->controller);
$controllerV = $generator->controllerV;
$actions = array_keys($controllerV['actions']);
$actions = ApiHelper::rmNode($actions);

$moduleClass = $generator->moduleClass;
$controlerClassNs = sprintf('%s\controllers', dirname($moduleClass));
$processingClassNs = sprintf('%s\processing\%s', dirname($moduleClass), $generator->controller);

echo "<?php\n";
?>
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */
namespace <?=$controlerClassNs?>;

use \myzero1\restbyconf\components\rest\ApiController;

/**
 * <?=$controller?>Controller implements the CRUDI actions for the module.
 */
class <?=$controller?>Controller extends ApiController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        $parentActions = parent::actions();

        $overwriteActions = [
    <?php
        foreach ($actions as $key => $action) {
            $actionNew = ApiHelper::uncamelize($action, '-');
    ?>
            '<?=$actionNew?>' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\<?=$processingClassNs?>\<?=ucwords($action)?>',
            ],
<?php } ?>
        ];

        $actions = array_merge($parentActions, $overwriteActions);

        return $actions;
    }
}

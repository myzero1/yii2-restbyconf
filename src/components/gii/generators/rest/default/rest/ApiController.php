<?php
/**
 * This is the template for generating a controller class within a module.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */

$controller = ucwords($generator->controller);
$controllerV = $generator->controllerV;
$actions = array_keys($controllerV['paths']);
$moduleClass = $generator->moduleClass;
$controlerClass = sprintf('%s\controllers', dirname($moduleClass));
$processingClassNs = sprintf('%s\processing\%s', $controlerClass, $controller);
$searchClass = sprintf('\%s\models\search\%sSearch', dirname($moduleClass), $controller);

echo "<?php\n";
?>
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */
namespace <?=$controlerClass?>;

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
<?php if (in_array('create', $actions)): ?>
            'create' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\<?=$processingClassNs?>\Create',
            ],
<?php endif; ?>
<?php if (in_array('update', $actions)): ?>
            'update' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\<?=$processingClassNs?>\Update',
            ],
<?php endif; ?>
<?php if (in_array('view', $actions)): ?>
            'view' => [
                'class' => '\myzero1\restbyconf\components\rest\ActiveAction',
                'processingClass' => '\<?=$processingClassNs?>\View',
            ],
<?php endif; ?>
<?php if (in_array('delete', $actions)): ?>
            'delete' => [
                'class' => '\myzero1\restbyconf\components\rest\ActiveAction',
                'processingClass' => '\<?=$processingClassNs?>\Delete',
            ],
<?php endif; ?>
<?php if (in_array('index', $actions)): ?>
            'index' => [
                'class' => '\myzero1\restbyconf\components\rest\ActiveAction',
                'processingClass' => '<?=$searchClass?>',
            ],
<?php endif; ?>
        ];

        $actions = array_merge($parentActions, $overwriteActions);

        return $actions;
    }
}

<?php
/**
 * This is the template for generating a controller class within a module.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */

$tag = ucwords($generator->tag);
$tagV = $generator->tagV;
$actions = array_keys($tagV['paths']);
$moduleClass = $generator->moduleClass;
$controlerClass = sprintf('%s\controllers', dirname($moduleClass));
$processingClassNs = sprintf('%s\processing\%s', $controlerClass, $tag);
$searchClass = sprintf('\%s\models\search\%sSearch', dirname($moduleClass), $tag);

echo "<?php\n";
?>
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */
namespace <?=$controlerClass?>;

use \myzero1\restbyconf\components\rest\BasicController;

/**
 * <?=$tag?>Controller implements the CRUDI actions for the module.
 */
class <?=$tag?>Controller extends BasicController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
<?php if (in_array('create', $actions)): ?>
            'create' => [
                'class' => '\myzero1\restbyconf\components\rest\CreateAction',
                'modelClass' => $this->modelClass,
                'processingClass' => '\<?=$processingClassNs?>\Create',
            ],
<?php endif; ?>
<?php if (in_array('update', $actions)): ?>
            'update' => [
                'class' => '\myzero1\restbyconf\components\rest\UpdateAction',
                'modelClass' => $this->modelClass,
                'processingClass' => '\<?=$processingClassNs?>\Update',
            ],
<?php endif; ?>
<?php if (in_array('view', $actions)): ?>
            'view' => [
                'class' => '\myzero1\restbyconf\components\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'processingClass' => '\<?=$processingClassNs?>\View',
            ],
<?php endif; ?>
<?php if (in_array('delete', $actions)): ?>
            'delete' => [
                'class' => '\myzero1\restbyconf\components\rest\DeleteAction',
                'modelClass' => $this->modelClass,
                'processingClass' => '\<?=$processingClassNs?>\Delete',
            ],
<?php endif; ?>
<?php if (in_array('index', $actions)): ?>
            'index' => [
                'class' => '\myzero1\restbyconf\components\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'processingClass' => '<?=$searchClass?>',
            ],
<?php endif; ?>
        ];
    }
}

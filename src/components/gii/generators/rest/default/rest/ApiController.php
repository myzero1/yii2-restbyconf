<?php
use myzero1\restbyconf\components\rest\ApiHelper;

$templateParams = $generator->getApiControllerParams();

echo "<?php\n";
?>
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */
namespace <?= $templateParams['namespace'] ?>;

use <?= $templateParams['basicControllerClass'] ?>;

/**
 * <?= $templateParams['className'] ?>Controller implements the CRUDI actions for the module.
 */
class <?= $templateParams['className'] ?>Controller extends BasicController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        $parentActions = parent::actions();

        $overwriteActions = [
    <?php
        foreach ($templateParams['actions'] as $key => $action) {
            $actionNew = ApiHelper::uncamelize($action, '-');
    ?>
            '<?=$actionNew?>' => [
                'class' => $this->apiActionClass,
                'processingClass' => '\<?= $templateParams['processingClassNs'] ?>\<?=ucwords($action)?>',
            ],
<?php } ?>
        ];

        $actions = array_merge($parentActions, $overwriteActions);

        return $actions;
    }
}<?="\n\r"?>
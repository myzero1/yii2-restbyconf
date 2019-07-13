<?php
/**
 * This is the template for generating a module class file.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */

$templateParams = $generator->getModuleTemplateParams();

echo "<?php\n";
?>

namespace <?= $templateParams['namespace'] ?>;

use Yii;
use yii\base\Module as BaseModule;
use yii\base\BootstrapInterface;
use myzero1\restbyconf\components\rest\ApiHelper;

/**
 * <?= $templateParams['moduleID'] ?> module definition class
 */
class <?= $templateParams['className'] ?> extends BaseModule implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = '<?= $templateParams['controllerNamespace'] ?>';
    public $runningAsDocActions = ['*' => '*']; // all action
    public $docToken = 'docTokenAsMyzero1';
    public $fixedUser = [ 'id' => 1, 'username' => 'myzero1',];

    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            Yii::$app->params['restbyconfAuthenticator_<?= $templateParams['moduleClassMd5'] ?>'] = '<?= $templateParams['restbyconfAuthenticator'] ?>';
            Yii::$app->params['restbyconfUnAuthenticateActions_<?= $templateParams['moduleClassMd5'] ?>'] = [
<?php
foreach ($templateParams['restbyconfUnAuthenticateActions'] as $k => $v) {
        printf("                '%s',\n", $v);
    }
?>
            ];
            $apiUrlRules = ApiHelper::getApiUrlRules($this->id);
            $app->getUrlManager()->addRules($apiUrlRules, $append = true);
        }

        Yii::setAlias('@<?= $templateParams['restModuleAlias'] ?>', '<?= $templateParams['restModuleAliasPath'] ?>');
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

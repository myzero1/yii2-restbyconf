<?php
/**
 * This is the template for generating a module class file.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */

$className = $generator->moduleClass;
$pos = strrpos($className, '\\');
$ns = ltrim(substr($className, 0, $pos), '\\');
$className = substr($className, $pos + 1);
$confAarray = json_decode($generator->conf, true);
$restbyconfUnAuthenticateActions = $confAarray['json']['mySecurity']['exclude'];
$restbyconfAuthenticator = $confAarray['json']['mySecurity']['security'];
$moduleName = md5($generator->moduleClass);

echo "<?php\n";
?>

namespace <?= $ns ?>;

use Yii;
use yii\base\Module as BaseModule;
use yii\base\BootstrapInterface;
use myzero1\restbyconf\components\rest\ApiHelper;

/**
 * <?= $generator->moduleID ?> module definition class
 */
class <?= $className ?> extends BaseModule implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = '<?= $generator->getControllerNamespace() ?>';

    /**
    /**
    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            Yii::$app->params['restbyconfAuthenticator_<?=$moduleName?>'] = '<?=$restbyconfAuthenticator?>';
            Yii::$app->params['restbyconfUnAuthenticateActions_<?=$moduleName?>'] = [
<?php
foreach ($restbyconfUnAuthenticateActions as $k => $v) {
        printf("                '%s',\n", $v);
    }
?>
            ];
            $apiUrlRules = ApiHelper::getApiUrlRules($this->id);
            $app->getUrlManager()->addRules($apiUrlRules, $append = true);
        }
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

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

echo "<?php\n";
?>

namespace <?= $ns ?>;

use Yii;
use yii\base\Module as BaseModule;
use yii\base\BootstrapInterface;

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
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        $controller = [];
        $rulesPath = Yii::getAlias('@vendor/myzero1/yii2-restbyconf/src/components/conf/rules.json');
        $rulesData = file_get_contents($rulesPath);
        $rules = json_decode($rulesData, true);
        foreach ($rules['tags'] as $key => $value) {
            $controller[] = sprintf('%s/%s', trim($rules['basePath'], '/'), $value);
        }

        if ($app instanceof \yii\web\Application) {
            $app->getUrlManager()->addRules([
                [
                    'class' => '\yii\rest\UrlRule', 
                    'controller' => $controller,
                    'pluralize' => false,
                    'tokens' => [
                        '{id}' => '<id:\\w[\\w,]*>',
                    ],
                ],
            ], false);
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

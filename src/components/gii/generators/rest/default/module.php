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

/**
 * <?= $generator->moduleID ?> module definition class
 */
class <?= $className ?> extends \yii\base\Module
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
            $controller[] = sprintf('%s/%s', $rules['basePath'], $key);
        }

        if ($app instanceof \yii\web\Application) {
            $app->getUrlManager()->addRules([
                [
                    'class' => '\myzero1\restbyconf\components\rest\UrlRule', 
                    'controller' => $controller,
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

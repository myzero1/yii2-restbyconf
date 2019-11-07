<?php
/**
 * This is the template for generating a module class file.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\module\Generator */

$templateParams = $generator->getModuleTemplateParams();

echo "<?php\n";
?>

namespace <?= json_decode($generator->conf, true)['json']['restModuleNamespace'] ?>;

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
    public $apiTokenExpire = 86400; // 24h
    public $captchaExpire = 60 * 5; // 5m
    public $captchaMaxTimes = 3;
    public $runningAsDocActions = ['*' => '*']; // all action
    public $fixedUser = [ 'id' => 1, 'username' => 'myzero1', 'api_token' => 'myzero1ApiToken'];
    public $smsAndCacheComponents = [
                'captchaCache' => [
                    'class' => '\yii\caching\FileCache',
                    'cachePath' => '@runtime/captchaCache',
                ],
                'captchaSms' => [
                    // 腾讯云
                    'class' => 'myzero1\smser\QcloudsmsSmser',
                    'appid' => '140028081944', // appid
                    'appkey' => '23e167badfc804d97d454e32e258b7833', // 请替换成您的apikey
                    'smsSign' => '玩索得',
                    'expire' => '5',//分钟
                ],
            ];

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
}<?="\n\r"?>
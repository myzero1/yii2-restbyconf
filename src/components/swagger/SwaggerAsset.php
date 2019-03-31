<?php
namespace myzero1\restbyconf\components\swagger;
use yii\web\AssetBundle;
/**
 * Main asset for the `adminlte` theming
 */
class SwaggerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-restbyconf/src/components/swagger/asset';
    //public $baseUrl = '@web';
    public $css = [
        'swagger-ui-3.22.0-dist/swagger-ui.css',
        'custom.css',
    ];
    public $js = [
        'swagger-ui-3.22.0-dist/swagger-ui-bundle.js',
        'swagger-ui-3.22.0-dist/swagger-ui-standalone-preset.js',
        'custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
<?php
namespace myzero1\restbyconf\components\swagger;
use yii\web\AssetBundle;
/**
 * Main asset for the `adminlte` theming
 */
class SwaggerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-restbyconf/src/components/swagger/swagger-ui-3.22.0-dist';
    //public $baseUrl = '@web';
    public $css = [
        'swagger-ui.css',
    ];
    public $js = [
        'swagger-ui-bundle.js',
        'swagger-ui-standalone-preset.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
<?php
namespace myzero1\restbyconf\assets\php;
use yii\web\AssetBundle;
/**
 * Main asset for the `adminlte` theming
 */
class JsonEditorAsset extends AssetBundle
{
    public $sourcePath = '@vendor/myzero1/yii2-restbyconf/src/assets/assets/jsoneditor-5.32.1';
    //public $baseUrl = '@web';
    public $css = [
        'dist/jsoneditor.min.css',
        // 'custom.css',
    ];
    public $js = [
        'dist/jsoneditor.min.js',
        // 'custom.js',
    ];
}
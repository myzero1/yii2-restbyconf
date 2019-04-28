yii2-restbyconf
========================

You can generate restfull api by configuration.

Show time
------------

![](https://github.com/myzero1/show-time/blob/master/yii2-gridview-export/screenshot/1.png)

Installation
------------

The preferred way to install this module is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require myzero1/yii2-gridview-export：1.4.0
```

or add

```
"myzero1/yii2-gridview-export": "1.4.0"
```

to the require section of your `composer.json` file.



Setting
-----

Once the extension is installed, simply modify your application configuration as follows:

```php
return [
    ......
    'modules' => [
        ......
        'gdexport' => [
            'class' => 'myzero1\gdexport\Module',
        ],
        ......
    ],
    ......
];
```

Usage
-----

### Use export widget in view
You can use it,anywhere in view as following:

```php

<?= \myzero1\gdexport\helpers\Helper::createExportForm($dataProvider, $columns, $name='导出文件名', $buttonOpts = ['class' => 'btn btn-info'], $url=['/gdexport/export/export','id' => 1], $writerType='Xls', $buttonLable='导出');?>

```
### Use custom router
Use the custom router in ExportController.php, as following:

```php

<?php
//......
/**
 * ExportController.
 */
class ExportController extends Controller
{
    //......
    /**
     * Realtime exporter
     * @return mixed
     */
    public function actionRealtime()
    {
        $post = \Yii::$app->request->post();

        return \myzero1\gdexport\helpers\Helper::exportSend($post['export_columns'], $exportQuery=$post['export_query'], $exportSql=$post['export_sql'], $exportName=$post['export_name'], $writerType = $post['export_type']);
    }
?>

```

Use the custom router in view, as following:

```php
<?= \myzero1\gdexport\helpers\Helper::createExportForm($dataProvider, $columns, $name='导出文件名', $buttonOpts = ['class' => 'btn btn-info'], ['/export/realtime'], $writerType='Xls', $buttonLable='导出');?>

```

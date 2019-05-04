yii2-restbyconf
========================

You can generate restfull api by configuration.

Show time
------------

![](https://github.com/myzero1/show-time/blob/master/yii2-restbyconf/screenshot/104.png)
![](https://github.com/myzero1/show-time/blob/master/yii2-restbyconf/screenshot/102.png)
![](https://github.com/myzero1/show-time/blob/master/yii2-restbyconf/screenshot/103.png)

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


`In main-local.php`

```php
...
if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'myzero1\restbyconf\components\gii\Module',
    ];
}
...
```


`In main.php`

```php
return [
    ......
    'bootstrap' => [
        // 'v1',
    ],
    ......
    'modules' => [
        ......
        // 'v1' => 'app\modules\v1\Module',
        'restbyconf' => 'myzero1\restbyconf\Module',
        ......
    ],
    ......
];
```


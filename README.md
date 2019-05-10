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
php composer.phar require myzero1/yii2-restbyconf：~1.3.0
```

or add

```
"myzero1/yii2-restbyconf": "~1.3.0"
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
        'class' => 'myzero1\restbyconf\components\gii\Module', // use restbyconf
    ];
}
...
```

`In main.php`

```php
return [
    ......
    'bootstrap' => [
        ......
        'example',
        ......
    ],
    ......
    'modules' => [
        ......
        'example' => '\myzero1\restbyconf\example\RestByConfModule',// should add table to db by 'example/models/user.sql'
        'restbyconf' => 'myzero1\restbyconf\Module',
        ......
    ],
    ......
    'components' => [
        ......
        'user' => [
            'identityClass' => 'myzero1\restbyconf\components\rest\ApiAuthenticator',
            'enableSession' => false,
        ],
        ......
    ]
    ......
];
```


Usage
-----

### Selectable modules
* Set basePath to "/v2"
* Click the "Preview" button
* Click the "Generate" button, to Generate the codes.
* Set the config files

`In main.php`

```php
return [
    ......
    'bootstrap' => [
        ......
        'v2',
        ......
    ],
    ......
    'modules' => [
        ......
        'v2' => '\myzero1\restbyconf\v2\RestByConfModule',
        ......
    ],
    ......
];
```
* the `v2` will display to Selectable modules menu as `v2 api`
* you can click the `v2 api` button to config the `v2`

### The other menu of restbyconfig
* you can click the `Swagger` button to use it.
* you can click the `Markdown` button to use it.

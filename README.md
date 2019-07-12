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
php composer.phar require myzero1/yii2-restbyconf：*
```

or add

```
"myzero1/yii2-restbyconf": "*"
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
    ...
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
    $config['modules']['gii']['generators'] = [
        'rest' => [
            'class' => 'myzero1\restbyconf\components\gii\generators\rest\Generator'
        ],
    ];
    ...
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
            'authTimeout' => 3600 * 24, // defafult 24h
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
        // 'v2' => '\myzero1\restbyconf\v2\RestByConfModule',
        'v2' => [
            'class' => '\myzero1\restbyconf\v2\RestByConfModule',
            'runModel' => 'doc', // default doc,you can set as code
            'fixedUser' => [ //
                'id' => 1,
                'username' => 'myzero1',
            ],
        ],
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


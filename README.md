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
        'v1',
        ......
    ],
    ......
    'modules' => [
        ......
        'restbyconf' => 'myzero1\restbyconf\Module',
        'example' => [
            'class' => 'myzero1\restbyconf\example\RestByConfModule',// should add table to db by 'yii2-restbyconf/src/user.sql'
            'apiTokenExpire' => 24 * 3600 * 365,
            'fixedUser' => [
                'id' => '1',
                'username' => 'myzero1',
                'api_token' => 'myzero1Token',
            ],
            'smsAndCacheComponents' => [
                'captchaCache' => [
                    'class' => '\yii\caching\FileCache',
                    'cachePath' => '@runtime/captchaCache',
                ],
                'captchaSms' => [
                    'class' => 'myzero1\smser\QcloudsmsSmser',// 腾讯云
                    'appid' => '1400280810', // 请替换成您的appid
                    'appkey' => '23e167badfc804d97d454e32e258b780', // 请替换成您的apikey
                    'smsSign' => '玩索得',
                    'expire' => '5',//分钟
                    'templateId' => 459670, // 请替换成您的templateId
                ],
            ],
            'runningAsDocActions' => [
                '*' => '*', // all ations, as default
                // 'controllerA' => [
                //     '*', // all actons in controllerA
                // ],
                // 'controllerB' => [
                //     'actionB',
                // ],
            ],
        ],
        ......
    ],
    ......
    'components' => [
        ......
        // 'assetManager' => [
        //     'class' => 'yii\web\AssetManager',
        //     'forceCopy' => true,// true/false
        // ],
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
        'v2' => [
            'class' => 'api\modules\v2\RestByConfModule',
            'apiTokenExpire' => 24 * 3600 * 365,
            'fixedUser' => [
                'id' => '1',
                'username' => 'myzero1',
                'api_token' => 'myzero1Token',
            ],
            'smsAndCacheComponents' => [
                'captchaCache' => [
                    'class' => '\yii\caching\FileCache',
                    'cachePath' => '@runtime/captchaCache',
                ],
                'captchaSms' => [
                    'class' => 'myzero1\smser\QcloudsmsSmser',// 腾讯云
                    'appid' => '1400280810', // 请替换成您的appid
                    'appkey' => '23e167badfc804d97d454e32e258b780', // 请替换成您的apikey
                    'smsSign' => '玩索得',
                    'expire' => '5',//分钟
                    'templateId' => 459670, // 请替换成您的templateId
                ],
            ],
            'runningAsDocActions' => [
                '*' => '*', // all ations, as default
                // 'controllerA' => [
                //     '*', // all actons in controllerA
                // ],
                // 'controllerB' => [
                //     'actionB',
                // ],
            ],
        ],
        ......
    ],
    ......
];
```
* the `v2` will display to Selectable modules menu as `v2 api`
* you can click the `v2 api` button to config the `v2`
* you can add `response_code` param to return characteristic return

### The other menu of restbyconfig
* you can click the `Swagger` button to use it.
* you can click the `Markdown` button to use it.

### Can overwrite classes
* myzero1\restbyconf\components\rest\Helper
* myzero1\restbyconf\components\rest\ApiHelper
* myzero1\restbyconf\components\rest\ApiAuthenticator
* myzero1\restbyconf\components\rest\HandlingHelper


`In main.php`

```php
return [
    ......
    'bootstrap' => [
        ......
        'classMap' => function(){
             Yii::$classMap['myzero1\restbyconf\components\rest\Helper'] = '@app/modules/v1/components/Helper.php';
             Yii::$classMap['myzero1\restbyconf\components\rest\ApiHelper'] = 'path/to/ApiHelper.php';
        },
        ......
    ],
    ......
];
```

### change logs
* Add my group
* Carding code
* Multiple responses

### TODO
* $modelPost->addRule(['mobile_phone'], 'required', ['message' => '\'{attribute}\':手机号不能为空']);


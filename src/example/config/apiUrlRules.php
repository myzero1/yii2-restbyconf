<?php
$version = 'example';
$moduleName = 'example';
return [
    // defult
    [
        'class' => 'yii\rest\UrlRule',
        'pluralize' => false,
        'controller' => [
            'placeholder',
            $moduleName . '/z1authenticator',
            $moduleName . '/z1tools',
            $moduleName . '/z1user',
        ],
        'extraPatterns' => [
            'POST,OPTIONS /join' => 'join',
            'POST,OPTIONS /login' => 'login',
            'POST,OPTIONS /captcha' => 'captcha',
            'POST,OPTIONS /upload' => 'upload',
            'GET,OPTIONS /export' => 'export',
            'PATCH,OPTIONS <id:\d+>/status' => 'status',
        ],

    ],

    // custom
    'POST,OPTIONS ' . $version .'/z1authenticator/join' => $moduleName . '/z1authenticator/join',
    'POST,OPTIONS ' . $version .'/z1authenticator/login' => $moduleName . '/z1authenticator/login',

    'POST,OPTIONS ' . $version .'/z1tools/captcha' => $moduleName . '/z1tools/captcha',
    'POST,OPTIONS ' . $version .'/z1tools/upload' => $moduleName . '/z1tools/upload',

    'POST,OPTIONS ' . $version .'/z1user' => $moduleName . '/z1user/create',
    'PUT,OPTIONS ' . $version .'/z1user/<id:\d+>' => $moduleName . '/z1user/update',
    'GET,OPTIONS ' . $version .'/z1user/<id:\d+>' => $moduleName . '/z1user/view',
    'DELETE,OPTIONS ' . $version .'/z1user/<id:\d+>' => $moduleName . '/z1user/delete',
    'GET,OPTIONS ' . $version .'/z1user' => $moduleName . '/z1user/index',
    'GET,OPTIONS ' . $version .'/z1user/export' => $moduleName . '/z1user/export',
    'PATCH,OPTIONS ' . $version .'/z1user/<id:\d+>/status' => $moduleName . '/z1user/status',

];

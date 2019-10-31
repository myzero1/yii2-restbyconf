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
            $moduleName . '/authenticator',
            $moduleName . '/tools',
            $moduleName . '/user',
        ],
        'extraPatterns' => [
            'POST,OPTIONS /join' => 'join',
            'POST,OPTIONS /login' => 'login',
            'POST,OPTIONS /upload' => 'upload',
            'GET,OPTIONS /export' => 'export',
            'PATCH,OPTIONS <id:\d+>/status' => 'status',
        ],

    ],

    // custom
    'POST,OPTIONS ' . $version .'/authenticator/join' => $moduleName . '/authenticator/join',
    'POST,OPTIONS ' . $version .'/authenticator/login' => $moduleName . '/authenticator/login',

    'POST,OPTIONS ' . $version .'/tools/upload' => $moduleName . '/tools/upload',

    'POST,OPTIONS ' . $version .'/user' => $moduleName . '/user/create',
    'PUT,OPTIONS ' . $version .'/user/<id:\d+>' => $moduleName . '/user/update',
    'GET,OPTIONS ' . $version .'/user/<id:\d+>' => $moduleName . '/user/view',
    'DELETE,OPTIONS ' . $version .'/user/<id:\d+>' => $moduleName . '/user/delete',
    'GET,OPTIONS ' . $version .'/user' => $moduleName . '/user/index',
    'GET,OPTIONS ' . $version .'/user/export' => $moduleName . '/user/export',
    'PATCH,OPTIONS ' . $version .'/user/<id:\d+>/status' => $moduleName . '/user/status',

];

<?php
return [
    '/v1/controller' => [
        'controller' => ['/v1/controller'],
        'class' => '\yii\rest\UrlRule',
        'pluralize' => false,
        'extraPatterns' => [
            'POST,OPTIONS /<in_str:^\w{1,32}$>/action' => 'action',
            'POST,OPTIONS /<in_str:^\w{1,32}$>/info' => 'info',
        ],
    ],
    '/v1/user' => [
        'controller' => ['/v1/user'],
        'class' => '\yii\rest\UrlRule',
        'pluralize' => false,
        'extraPatterns' => [
            'POST,OPTIONS /<in_str:^\w{1,32}$>/action' => 'action',
            'POST,OPTIONS /<in_str:^\w{1,32}$>/info' => 'info',
        ],
    ],
];

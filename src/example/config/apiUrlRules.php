<?php
return [
    'example/demo' => [
        'controller' => ['example/demo'],
        'class' => '\yii\rest\UrlRule',
        'pluralize' => false,
        'tokens' => [
            '{id}' => '<id:\d+>',
        ],
        'patterns' => [
            'PUT,PATCH {id}' => 'update',
            'DELETE {id}' => 'delete',
            'GET,HEAD {id}' => 'view',
            '{id}' => 'options',
            'POST' => 'create',
            'GET,HEAD' => 'index',
            '' => 'options',
        ],
        'extraPatterns' => [
            'GET,OPTIONS /export' => 'export',
            'PATCH,OPTIONS <id:\d{0,32}>/custom' => 'custom',
        ],
    ],
];

];

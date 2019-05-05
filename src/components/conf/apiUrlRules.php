<?php
return [
    'v1/demo' => [
        'controller' => ['v1/demo'],
        'class' => '\yii\rest\UrlRule',
        'pluralize' => false,
        'tokens' => [
            '{id}' => '<id:\d+>',
        ],
        'extraPatterns' => [
            'GET,OPTIONS /export' => 'export',
            'PATCH,OPTIONS <id:\d{0,32}>/custom' => 'custom',
        ],
    ],
];

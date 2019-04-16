<?php
return [
    'v1/demo' => [
        'controller' => ['v1/demo'],
        'class' => '\yii\rest\UrlRule',
        'pluralize' => false,
        'extraPatterns' => [
            'GET,OPTIONS <id:\w{1,32}>/info' => 'info',
        ],
    ],
];

<?php
return [
    'example/demo' => [
        'controller' => ['example/demo'],
        'class' => '\yii\rest\UrlRule',
        'pluralize' => false,
        'extraPatterns' => [
            'GET,OPTIONS /export' => 'export',
        ],
    ],
];

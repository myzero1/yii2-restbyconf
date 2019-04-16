<?php
return [
    'v1/controller' => [
        'controller' => ['v1/controller'],
        'class' => '\yii\rest\UrlRule',
        'pluralize' => false,
        'extraPatterns' => [
            'GET,OPTIONS /<in_str:\w+>/action' => 'action',
        ],
    ],
];

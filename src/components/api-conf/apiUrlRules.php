<?php
return [
    'v1/demo' => [
        'controller' => ['v1/demo'],
        'class' => '\yii\rest\UrlRule',
        'pluralize' => false,
        'extraPatterns' => [
            'POST,OPTIONS <in_str:\w{1,32}>/info' => 'info',
        ],
    ],
];

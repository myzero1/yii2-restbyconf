<?php
return [
    '/v2/controller' => [
        'controller' => ['/v2/controller'],
        'class' => '\yii\rest\UrlRule',
        'pluralize' => false,
        'extraPatterns' => [
            'POST,OPTIONS /<in_str:^\w{1,32}$>/action' => 'action',
        ],
    ],
];

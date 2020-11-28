<?php
return [
    'id' => 'app-frontend-tests',
    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
//            'cookieValidationKey' => 'test',
            'cookieValidationKey' => COMMON_COOKIE_VALIDATION_KEY,
        ],
    ],
];

<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
//            'cookieValidationKey' => '4vbHgv9Anx7cHW3yzU-0B3cviGPSf7FH',
            'cookieValidationKey' => COMMON_COOKIE_VALIDATION_KEY,
        ],
    ],
];

//if (!YII_ENV_TEST) {
//if (DEBUG_TOOL_ON === 'on') {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
		'allowedIPs' => ['91.144.142.147', '92.255.199.99', '127.0.0.1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
		'allowedIPs' => ['91.144.142.147', '92.255.199.99', '127.0.0.1'],
    ];
//}

return $config;

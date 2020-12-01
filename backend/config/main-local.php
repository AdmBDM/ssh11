<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
//            'cookieValidationKey' => 'riAjRTB34STElLugvWWp6jl826hPfJJ3',
            'cookieValidationKey' => COMMON_COOKIE_VALIDATION_KEY,
        ],
    ],
];

if (!YII_ENV_TEST) {
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
    ];
}

return $config;

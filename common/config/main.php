<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		"sms" => [
			"class" => 'alexeevdv\sms\ru\Client',
			"api_id" => "CEF03C16-996B-5ECA-C6A2-B3EDF2BB1F0F",
		],
    ],
];

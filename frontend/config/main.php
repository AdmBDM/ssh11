<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
	'language' => Yii::$app->params['language'],
	'sourceLanguage' => Yii::$app->params['language'],
    'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'frontend\controllers',
	'bootstrap' => ['log'],
	'modules' => [
		'yii2images' => [
			'class' => 'rico\yii2images\Module',
			//be sure, that permissions ok
			//if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
			'imagesStorePath' => 'upload/store', //path to origin images
			'imagesCachePath' => 'upload/cache', //path to resized copies
//			'imagesStorePath' => Yii::$app->params['imgStoreMin'], //path to origin images
//			'imagesCachePath' => Yii::$app->params['imgCacheMin'], //path to resized copies
			'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
			'placeHolderPath' => '@webroot/upload/store/no-image.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
//			'placeHolderPath' => '@webroot/' . Yii::$app->params['imgStore'] . 'no-image.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
		],

	],
    'components' => [
        'request' => [
			'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
//            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'identityCookie' => ['name' => '_identity-site', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
//            'name' => 'advanced-frontend',
            'name' => 'advanced-site',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
			'rules' => [
				'' => 'site/index',
				'<controller:\w+>/<action:[\-\w]+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//				'<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
			],
        ],
    ],
    'params' => $params,
];

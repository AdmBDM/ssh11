<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
	'language' => Yii::$app->params['language'],
	'sourceLanguage' => Yii::$app->params['language'],
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
//			'baseUrl' => '/admin',
			'baseUrl' => '',
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
//            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'identityCookie' => ['name' => '_identity-site', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
//            'name' => 'advanced-backend',
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

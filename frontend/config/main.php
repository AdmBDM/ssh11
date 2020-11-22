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
	'modules' => [],
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

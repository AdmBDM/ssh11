<?php
return [
    'components' => [
//        'db' => [
//            'class' => 'yii\db\Connection',
//            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
//            'username' => 'root',
//            'password' => '',
//            'charset' => 'utf8',
//        ],
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'pgsql:host=jim7.ru;port=5432;dbname=jim7',
			'username' => 'jim7',
			'password' => 'Adm_BDM_jim7',
			'charset' => 'utf8',
		],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];

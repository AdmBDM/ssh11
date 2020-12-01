<?php

//--- параметры подключения ---
//  сервер БД - переменная DATA_CONNECT_HOST:
//							= jim7.ru 	(значение для отладки)
//  						= 127.0.0.1	(значение для работы)
	if (strpos($_SERVER['CONTEXT_DOCUMENT_ROOT'], ':') === false) {
		define('DATA_CONNECT_HOST', '127.0.0.1', true);
		define('DEBUG_TOOL_ON', 'on', true);
	} else {
		define('DATA_CONNECT_HOST', 'jim7.ru', true);
		define('DEBUG_TOOL_ON', 'off', true);
	}

// единый cookieValidationKey
//			backend:	'cookieValidationKey' => 'riAjRTB34STElLugvWWp6jl826hPfJJ3'
//			common:		'cookieValidationKey' => '-lr4inoNnPzYBi07_DId-_2plDLFIS8C'
//			frontend:	'cookieValidationKey' => '4vbHgv9Anx7cHW3yzU-0B3cviGPSf7FH'
	define('COMMON_COOKIE_VALIDATION_KEY', '-lr4inoNnPriAjRTB34ST4vbHgv9Anx7', true);

// проверка при смене пароля:
//			= email - через почту
//			= sms   - через телефон
	define('CHECK_FROM_EMAIL', 'email', true);
	define('CHECK_FROM_SMS', 'sms', true);

// почта админа
	define('EMAIL_ADMIN', 'jim7kzn@gmail.com', true);

	return [
    'components' => [
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'pgsql:host=' . DATA_CONNECT_HOST . ';port=5432;dbname=jim7',
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

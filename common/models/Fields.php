<?php

namespace common\models;


class Fields
{

	//определение локальных констант
	const FORM_LOGIN = 'Login';
	const FORM_RESET_PASS = 'Reset_Pass';

	static public function getAttributes($objName) {
		if ($objName == self::FORM_LOGIN) {
			return [
				'username' => 'Имя пользователя',
				'password' => 'Пароль',
				'rememberMe' => 'Запомнить меня',
			];
		}

		if ($objName == self::FORM_RESET_PASS) {
			return [
				'email' => 'Эл.почта',
			];
		}

		return false;
	}

}
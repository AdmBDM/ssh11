<?php

namespace common\models;

class Fields
{
	//определение локальных констант
	const TAB_USER = 'User';
	const TAB_SECTION = 'Section';
	const FORM_LOGIN = 'Login';
	const FORM_RESET_PASS_E = 'Reset_Pass_email';
	const FORM_RESET_PASS_M = 'Reset_Pass_mobile';

	/**
	 * @param $objName
	 *
	 * @return false|string[]
	 */
	static public function getAttributes($objName) {
		if ($objName == self::TAB_USER) {
			return [
				'id' => 'ID',
				'username' => 'Имя пользователя',
				'auth_key' => 'Ключ авторизации',
				'password_hash' => 'Хэш пароля',
				'password_reset_token' => 'Токен замены пароля',
				'email' => 'Эл.почта',
				'status' => 'Статус',
				'created_at' => 'Создан',
				'updated_at' => 'Изменён',
				'verification_token' => 'Токен проверки',
				'phone_number' => 'Мобильный',
			];
		}

		if ($objName == self::TAB_SECTION) {
			return [
				'id' => 'ID',
				'path' => 'Path',
				'section_id' => 'Section ID',
				'icon' => 'Icon',
				'has_menu' => 'Подменю',
				'title' => 'Заголовок',
				'published' => 'Публиковать',
				'sort' => 'Порядок',
				'main' => 'main',
			];
		}

		if ($objName == self::FORM_LOGIN) {
			return [
				'username' => 'Имя пользователя',
				'email' => 'Эл.почта',
				'phone_number' => 'Мобильный',
				'password' => 'Пароль',
				'rememberMe' => 'Запомнить меня',
			];
		}

		if ($objName == self::FORM_RESET_PASS_E) {
			return [
				'email' => 'Эл.почта',
				'phone_number' => 'Номер телефона',
			];
		}

		if ($objName == self::FORM_RESET_PASS_M) {
			return [
				'phone_number' => 'Номер телефона',
				'email' => 'Эл.почта',
			];
		}

		// возвращаем, если объект не описан
		return false;
	}

	/**
	 * @param $objName
	 *
	 * @return array[]|false
	 */
	static public function getRules($objName) {
		if ($objName == self::TAB_SECTION) {
			return [
				[['section_id', 'has_menu'], 'integer'],
				[['path', 'template_id', 'icon', 'title'], 'string', 'max' => 255],
				[['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['section_id' => 'id']],
			];
		}

		if ($objName == self::FORM_LOGIN) {
			return [
//				// username and password are both required
//				[['username', 'password'], 'required'],
				// phone_number and password are both required
				[['phone_number', 'password'], 'required'],
				// rememberMe must be a boolean value
				['rememberMe', 'boolean'],
				// password is validated by validatePassword()
				['password', 'validatePassword'],
			];
		}

		if ($objName == self::FORM_RESET_PASS_E) {
			return [
				['email', 'trim'],
				['email', 'required'],
				['email', 'email'],
				['email', 'exist',
					'targetClass' => '\common\models\User',
					'filter' => ['status' => User::STATUS_ACTIVE],
					'message' => 'Нет пользователя с таким адресом.'
				],
			];
		}

		if ($objName == self::FORM_RESET_PASS_M) {
			return [
				['phone_number', 'trim'],
				['phone_number', 'required'],
//				['phone_number', 'exist',
//					'targetClass' => '\common\models\User',
//					'filter' => ['status' => User::STATUS_ACTIVE],
//					'message' => 'Нет пользователя с таким адресом.'
//				],
			];
		}

		// возвращаем, если объект не описан
		return false;
	}
}
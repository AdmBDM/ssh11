<?php

namespace common\models;

class Fields
{
	//определение локальных констант
	const TAB_USER = 'User';
	const TAB_SECTION = 'Section';
	const FORM_LOGIN = 'Login';
	const FORM_RESET_PASS = 'Reset_Pass';

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
				'mobile' => 'Мобильный',
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

	static public function getRules($objName) {
		if ($objName == self::TAB_SECTION) {
			return [
				[['section_id', 'has_menu'], 'integer'],
				[['path', 'template_id', 'icon', 'title'], 'string', 'max' => 255],
				[['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['section_id' => 'id']],
				[['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => Template::className(), 'targetAttribute' => ['template_id' => 'id']],
			];
		}

		return false;
	}
}
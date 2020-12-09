<?php

namespace common\models;

use Yii;

class Fields
{
	//определение локальных констант
	const TAB_USER = 'User';
	const TAB_SECTION = 'Section';
	const TAB_VYPUSK81 = 'Vypusk81';
	const TAB_PROFILES = 'Profiles';
	const TAB_GALLERY = 'Gallery';
	const FORM_LOGIN = 'Login';
	const FORM_SIGNUP = 'Signup';
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
				'admin' => 'Админ',
				'admin_edit' => 'Редактор',
				'image' => 'Фото',
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
				'main' => 'Главное',
				'menu_head' => 'Верхнее',
				'menu_right' => 'Правое',
				'menu_footer' => 'Нижнее',
				'menu_left' => 'Левое',
				'group' => 'Группа',
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

		if ($objName == self::FORM_SIGNUP) {
			return [
				'username' => 'Имя пользователя',
				'email' => 'Эл.почта',
				'phone_number' => 'Мобильный',
				'password' => 'Пароль',
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

		if ($objName == self::TAB_VYPUSK81) {
			return [
				'id' => 'ID',
				'gender' => 'М/Ж',
				'first_name_current' => 'Фамилия в настоящее время',
				'first_name' => 'Фамилия',
				'last_name' => 'Имя',
				'patronymic' => 'Отчество',
				'year_from' => 'С какого года',
				'year_for' => 'По какой год',
				'birthday' => 'День рождения',
				'deathday' => 'Дата ухода',
				'profile_id' => 'Users ID',
                'death_reason' => 'Причина ухода',
				'image' => 'Фото',
				'gallery' => 'Галерея',
            ];
		}

		if ($objName == self::TAB_PROFILES) {
			return [
				'id' => 'ID',
				'vypusk81_id' => 'vypusk81 ID',
			];
		}

		if ($objName == self::TAB_GALLERY) {
			return [
				'id' => 'ID',
				'gallery_name' => 'Наименование',
				'issue81_id' => 'ID владельца',
				'for_all' => 'Для всех',
			];
		}

		// возвращаем, если объект не описан
		return false;
	}

	/**
	 * @param $objName
	 *
	 * @return array[]|false
     *
	 */
	static public function getRules($objName) {
		if ($objName == self::TAB_SECTION) {
			return [
				[['section_id', 'has_menu'], 'integer'],
				[['path', 'template_id', 'icon', 'title'], 'string', 'max' => 255],
				[['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::class, 'targetAttribute' => ['section_id' => 'id']],
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

		if ($objName == self::FORM_SIGNUP) {
			return [
				['username', 'trim'],
				['username', 'required'],
				['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Указанное имя уже используется.'],
				['username', 'string', 'min' => 2, 'max' => 255],

				['email', 'trim'],
				['email', 'required'],
				['email', 'email'],
				['email', 'string', 'max' => 255],
				['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Указанный адрес уже используется.'],

				['password', 'required'],
				['password', 'string', 'min' => 6],

				['phone_number', 'trim',],
				['phone_number', 'required',],
				['phone_number', 'match', 'pattern' => '/^\+[0-9]+$/u', 'message' => 'Вводятся только "+" и цифры',],
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
				[['phone_number', 'trim',], 'match', 'pattern' => '/^\+[0-9]+$/u', 'message' => 'Вводятся только "+" и цифры, без пробелов, скобок и пр.',],
				[['phone_number', 'required',], 'string', 'min' => 11,],
				['phone_number', 'exist',
					'targetClass' => '\common\models\User',
					'filter' => ['status' => User::STATUS_ACTIVE],
					'message' => 'Нет пользователя с таким номером.'
				],
			];
		}

		if ($objName == self::TAB_VYPUSK81) {
			return [
				[['first_name_current', 'first_name', 'last_name', 'patronymic', 'death_reason'], 'string'],
				[['year_from', 'year_for'], 'default', 'value' => null],
				[['year_from', 'year_for'], 'integer'],
				[['death_year'], 'boolean'],
				[['birthday', 'deathday', 'death_reason', 'death_year'], 'safe'],
				[['gender'], 'string', 'max' => 1],
//				[['id'], 'exist', 'skipOnError' => true, 'targetClass' => Profiles::class, 'targetAttribute' => ['id' => 'vypusk81_id']],
				[['profile_id'], 'integer'],
				[['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
				[['gallery'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 4],
			];
		}

		if ($objName == self::TAB_PROFILES) {
			return [
				[['id'], 'required'],
				[['id', 'vypusk81_id'], 'default', 'value' => null],
				[['id', 'vypusk81_id'], 'integer'],
				[['vypusk81_id'], 'unique'],
				[['id'], 'unique'],
			];
		}

		if ($objName == self::TAB_GALLERY) {
			return [
				[['gallery_name'], 'string'],
				[['issue81_id'], 'default', 'value' => null],
				[['issue81_id'], 'integer'],
				[['for_all'], 'boolean'],
				[['image'], 'file', 'extensions' => Yii::$app->params['imgExt']],
				[['gallery'], 'file', 'extensions' => Yii::$app->params['imgExt'], 'maxFiles' => Yii::$app->params['lenGallery']],
			];
		}

		if ($objName == self::TAB_USER) {
			return [
				['status', 'default', 'value' => User::STATUS_INACTIVE],
				['status', 'in', 'range' => [User::STATUS_ACTIVE, User::STATUS_INACTIVE, User::STATUS_DELETED]],
				[['image'], 'file', 'extensions' => Yii::$app->params['imgExt']],
				[['gallery'], 'file', 'extensions' => Yii::$app->params['imgExt'], 'maxFiles' => Yii::$app->params['lenGallery']],
			];
		}

		// возвращаем, если объект не описан
		return false;
	}
}
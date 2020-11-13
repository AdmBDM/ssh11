<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $phone_number;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
    	return Fields::getRules(Fields::FORM_LOGIN);
    }

	public function attributeLabels()
	{
		return Fields::getAttributes(Fields::FORM_LOGIN);
	}

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
//			$_SERVER['_my_test_'] = ['pswd' => $this->password, 'mob'];
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Некорректное имя пользователя или пароль.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
//			$this->_user = User::findByUsername($this->username);
//			$this->_user = strpos($this->email, '@') !== false ? User::findByEmail($this->email) : User::findByPhone($this->email);
//			$this->_user = User::findByPhone($this->phone_number);
			if (Yii::$app->params['checkPassword'] == CHECK_FROM_EMAIL) {
				$this->_user = User::findByEmail($this->email);
			} else {
				$this->_user = User::findByPhone($this->phone_number);
			}
		}

        return $this->_user;
    }
}

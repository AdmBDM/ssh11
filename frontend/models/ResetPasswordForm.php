<?php
namespace frontend\models;

use yii\base\Exception;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
	public $password_reset_token;
	public $password;
	public $password2;
	public $phone_number;

    /**
     * @var User
     */
//    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
//    public function __construct($token, $config = [])
//    {
//        if (empty($token) || !is_string($token)) {
//            throw new InvalidArgumentException('Password reset token cannot be blank.');
//        }
//        $this->_user = User::findByPasswordResetToken($token);
//        if (!$this->_user) {
//            throw new InvalidArgumentException('Wrong password reset token.');
//        }
//        parent::__construct($config);
//    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
//        return [
//            ['password', 'required'],
//            ['password', 'string', 'min' => 6],
//        ];
		return [
			[['password', 'password2', 'password_reset_token'], 'required'],
			[['password', 'password2'], 'string', 'min' => 6],
			[['password_reset_token', 'phone_number'], 'string']    ,
			['password2', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают" ],
			['password_reset_token', function () {
				if (!User::find()->where([
					'password_reset_token' => $this->password_reset_token,
					'phone_number' => $this->phone_number,
				])->exists()) {
					$this->addError('password_reset_token', 'Неверный код');
				}
			}]
		];
    }

	public function attributeLabels()
	{
		return [
			'password' => 'Пароль',
			'password_reset_token' => 'Код',
			'password2' => 'Пароль еще раз',
		];
	}

	/**
	 * Resets password.
	 *
	 * @return bool if password was reset.
	 * @throws Exception
	 */
    public function resetPassword()
    {
//        $user = $this->_user;
//        $user->setPassword($this->password);
//        $user->removePasswordResetToken();
//
//        return $user->save(false);

		$user = User::findByPhone($this->phone_number);
		$user->setPassword($this->password);
		$user->removePasswordResetToken();

		return $user->save(false);

	}
}

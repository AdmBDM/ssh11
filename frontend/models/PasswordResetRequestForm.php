<?php
namespace frontend\models;

use alexeevdv\sms\ru\Sms;
use common\models\Fields;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $phone_number;
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
    	if (Yii::$app->params['checkPassword'] == CHECK_FROM_EMAIL) {
			return Fields::getRules(Fields::FORM_RESET_PASS_E);
		} else {
			return Fields::getRules(Fields::FORM_RESET_PASS_M);
		}
    }

	/**
	 * @return array|false|string[]
	 */
    public function attributeLabels()
	{
		if (Yii::$app->params['checkPassword'] == CHECK_FROM_EMAIL) {
			return Fields::getAttributes(Fields::FORM_RESET_PASS_E);
		} else {
			return Fields::getAttributes(Fields::FORM_RESET_PASS_M);
		}
	}

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

//		$_SERVER['_my_test'][] = ['user' => $user->email];

		if (!$user) {
            return false;
        }

//		$_SERVER['_my_test'][] = ['reset_token' => $user->password_reset_token];

		if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Установлен пароль для ' . Yii::$app->name)
            ->send();
    }

	/**
	 * @return User|false
	 */
    public function sendSms() {
		$user = User::findOne([
//			'status' => User::STATUS_ACTIVE,
			'phone_number' => $this->phone_number,
		]);
		if (!$user) {
			return false;
		}
		$user->generatePasswordResetToken();
		if (!$user->save()) {
			return false;
		}
//		$response = Yii::$app->sms->send(new Sms([
		Yii::$app->sms->send(new Sms([
//			"to" => "+7" . $user->phone_number,
			"to" => $user->phone_number,
			"text" => "Ваш код для восстановления пароля : " . $user->password_reset_token,
		]));

//		$_SERVER['_my_test'][] = ['phone_number' => $this->phone_number,];

		return $user;
	}

}


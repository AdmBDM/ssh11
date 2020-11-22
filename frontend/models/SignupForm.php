<?php
namespace frontend\models;

use common\models\Fields;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $phone_number;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
    	return Fields::getRules(Fields::FORM_SIGNUP);
    }

	/**
	 * @return array|false|string[]
	 */
    public function attributeLabels()
	{
		return Fields::getAttributes(Fields::FORM_SIGNUP);
	}

	/**
	 * @return bool|null whether the creating new account was successful and email was sent
	 * @throws Exception
	 */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

//	упрощённая регистрация
//		$this->username = $this->phone_number;
//		$this->email = $this->phone_number . '@freepost.ru';
//		$this->password = '1234567';
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone_number = $this->phone_number;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}

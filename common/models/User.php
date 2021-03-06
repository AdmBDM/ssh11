<?php
namespace common\models;

use Yii;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $phone_number
 * @property string $admin
 * @property string $admin_edit
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $image;
    public $gallery;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return mb_strtolower(Fields::TAB_USER);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
//			'image' => [
//				'class' => 'rico\yii2images\behaviors\ImageBehave',
//			],

// Basic-аутентификация
//        	'authenticator' => [
//        		'class' => HttpBasicAuth::class,
//        		'realm' => 'Закрытые данные',
//        		'auth' => function ($username, $password) {
//					$user = User::findByUsername($username);
//					if ($user && $user->validatePassword($password)) {
//						return $user;
//					} else {
//						return null;
//					}
//				},
//			],
        ];
    }

	/**
	 * @return array|false|string[]
	 */
	public function attributeLabels() {
    	return Fields::getAttributes(Fields::TAB_USER);
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
    	return Fields::getRules(Fields::TAB_USER);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

	/**
	 * {@inheritdoc}
	 * @throws NotSupportedException
	 */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

//    /**
//     * Finds user by username
//     *
//     * @param string $username
//     * @return static|null
//     */
//    public static function findByUsername($username)
//    {
//        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
//    }

//    /**
//     * Finds user by password reset token
//     *
//     * @param string $token password reset token
//     * @return static|null
//     */
//    public static function findByPasswordResetToken($token)
//    {
//        if (!static::isPasswordResetTokenValid($token)) {
//            return null;
//        }
//
//        return static::findOne([
//            'password_reset_token' => $token,
//            'status' => self::STATUS_ACTIVE,
//        ]);
//    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

	/**
	 * Finds user by email
	 *
	 * @param string $email
	 * @return static|null
	 */
	public static function findByEmail($email)
	{
		return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
	}

	/**
	 * Finds user by phone
	 *
	 * @param string $phone_number
	 * @return static|null
	 */
	public static function findByPhone($phone_number)
	{
		$phone_number = str_replace(' ', '', str_replace('(', '', str_replace(')', '', str_replace('-', '', $phone_number))));
//		$phone_number = clearPhone($phone_number);

//		return static::findOne(['phone_number' => $phone_number, 'status' => self::STATUS_ACTIVE]);
		return static::findOne(['phone_number' => $phone_number]);
	}

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password
	 *
	 * @throws Exception
	 */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

	/**
	 * Generates "remember me" authentication key
	 *
	 * @throws Exception
	 */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
//        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
		$this->password_reset_token = rand(10000, 99999);
	}

	/**
	 * Generates new token for email verification
	 *
	 * @throws Exception
	 */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}

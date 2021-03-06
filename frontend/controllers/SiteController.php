<?php
namespace frontend\controllers;

//use alexeevdv\sms\ru\Sms;
use common\models\User;
use Yii;
use yii\base\Exception;
use yii\base\InvalidArgumentException;
use yii\filters\auth\HttpBasicAuth;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
//use frontend\models\ResendVerificationEmailForm;
use frontend\models\SignupForm;
//use frontend\models\VerifyEmailForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
//                'only' => ['logout', 'signup'],
                'only' => ['login', 'logout'],
                'rules' => [
                    [
//                        'actions' => ['signup'],
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'ips' => ['127.0.0.1',],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

		$model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

//        return $this->goHome();
		return $this->render('index');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
//                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                Yii::$app->session->setFlash('success', 'Спасибо за сообщение. Мы рассмотрим его максимально быстро.');
            } else {
//                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
                Yii::$app->session->setFlash('error', 'Ошибка при отправке сообщения.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

	/**
	 * Signs user up.
	 *
	 * @return mixed
	 * @throws Exception
	 */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Спасибо за регистрацию. Проверьте свою почту.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

//		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
		if ($model->load(Yii::$app->request->post())) {
	// отправка на почту
			if (Yii::$app->params['checkPassword'] == CHECK_FROM_EMAIL) {
				if ($model->sendEmail()) {
					Yii::$app->session->setFlash('success', 'Проверьте вашу почту для получения инструкций.');

					return $this->goHome();
				} else {
					Yii::$app->session->setFlash('error', 'Извините, невозможно отправить подтверждение по указанному адресу.');
				}
			} else {

	// отправка на телефон
				$user = $model->sendSms();
				$form = new ResetPasswordForm();
				$form->phone_number = $user->phone_number;
				return $this->render('resetPassword', [
					'model' => $form,
				]);
			}
		}

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);

    }

    /**
     * Resets password.
     *
     * @param string $token
     *
     * @return mixed
     * @throws BadRequestHttpException|Exception
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранён.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
//    public function actionVerifyEmail($token)
//    {
//        try {
//            $model = new VerifyEmailForm($token);
//        } catch (InvalidArgumentException $e) {
//            throw new BadRequestHttpException($e->getMessage());
//        }
//        if ($user = $model->verifyEmail()) {
//            if (Yii::$app->user->login($user)) {
//                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
//                return $this->goHome();
//            }
//        }
//
//        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
//        return $this->goHome();
//    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
//    public function actionResendVerificationEmail()
//    {
//        $model = new ResendVerificationEmailForm();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->sendEmail()) {
//                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
//                return $this->goHome();
//            }
//            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
//        }
//
//        return $this->render('resendVerificationEmail', [
//            'model' => $model
//        ]);
//    }

	/**
	 * Requests password reset.
	 *
	 * @return mixed
	 */
	public function actionPasswordReset()
	{
		$model = new PasswordResetRequestForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$user = $model->sendSms();
			$form = new ResetPasswordForm();
			$form->phone_number = $user->phone_number;
			return $this->render('resetPassword', [
				'model' => $form
			]);
		}

		return $this->render('requestPasswordResetToken', [
			'model' => $model,
		]);
	}

	/**
	 * Resets password.
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function actionPasswordResetSms()
	{
		if (!Yii::$app->request->isPost) return $this->goHome();
		$model = new ResetPasswordForm();

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
			return $this->render('successPasswordChange');
		}

		return $this->render('resetPassword', [
			'model' => $model,
		]);
	}

	/**
	 * @return string
	 */
	public function actionForWhat()
	{
		$this->layout = 'fe_main';

		return $this->render('forWhat');
	}

	public function actionHowLogin() {
		return $this->render('howLogin');
	}

	public function actionAdmin() {
		return $this->render('howLogin');
	}

}

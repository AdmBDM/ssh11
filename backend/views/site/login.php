<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptionsName = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptionsPassword = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

$fieldOptionsMobile = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-phone form-control-feedback'></span>"
];
?>

<div class="login-box">
<!--    <div class="login-logo">-->
<!--        <a href="#"><b>Admin</b>LTE</a>-->
<!--    </div>-->
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Для входа в этот раздел необходимо авторизоваться</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

		<?= $form
			->field($model, 'phone_number', $fieldOptionsMobile)
			->label(false)
			->textInput(['autofocus' => true, 'placeholder' => '+<код страны> 123 456 7890']) ?>

<!--		--><?//= $form
//            ->field($model, 'username', $fieldOptionsName)
//            ->label(false)
//            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptionsPassword)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Вход', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

<!--        <div class="social-auth-links text-center">-->
<!--            <p>- OR -</p>-->
<!--            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in-->
<!--                using Facebook</a>-->
<!--            <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign-->
<!--                in using Google+</a>-->
<!--        </div>-->
        <!-- /.social-auth-links -->

        <a href="#">I forgot my password</a><br>
<!--        <a href="register.html" class="text-center">Register a new membership</a>-->

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

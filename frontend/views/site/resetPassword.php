<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-title-page area-bg area-bg_op_90 area-bg_grad parallax">
    <div class="area-bg__inner">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="b-title-page"><span class="sm"><?= Html::encode($this->title) ?></span></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end .b-title-page-->

<div class="container">
    <div class="row">
        <div class="col-md-12 content-right">
            <div class="l-main-content l-main-content_pd-rgt">
                <div class="row">
                    <p>Введите код из смс</p>

                    <div class="row">
                        <div class="col-lg-8">
                            <?php $form = ActiveForm::begin(['action' => '/site/password-reset-sms', 'options' => ['class' => 'custom-form']]); ?>

                            <?= $form->field($model, 'phone_number')->hiddenInput()->label(false) ?>

                            <?= $form->field($model, 'password_reset_token')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'password2')->passwordInput(['autofocus' => true]) ?>

                            <div class="form-group">
                                <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


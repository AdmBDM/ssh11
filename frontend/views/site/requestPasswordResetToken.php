<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model PasswordResetRequestForm */

use frontend\models\PasswordResetRequestForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Введите <?= (Yii::$app->params['checkPassword'] == CHECK_FROM_EMAIL ? 'адрес электронной почты' : 'номер телефона') ?>, куда будет отправлен код подтверждения</p>

    <div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

			<?php
				if (Yii::$app->params['checkPassword'] == CHECK_FROM_EMAIL) {
					echo $form->field($model, 'email')->textInput(['autofocus' => true]);
				} else {
					echo $form->field($model, 'phone_number')->textInput(['autofocus' => true, 'placeholder' => '+<код страны>1234567890', 'mask' => '+79999999999',])->label('Следует вводить только знак "+" и цифры, без пробелов, дефисов и подчёкиваний');
				}
			?>

			<div class="form-group">
				<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
			</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>

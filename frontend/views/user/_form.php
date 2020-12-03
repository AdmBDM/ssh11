<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

	<?php
		if (!isset($model->id)) {

			echo $form->field($model, 'username')->textInput(['autofocus' => true]);

			echo $form->field($model, 'phone_number')->textInput();

		} else {

		    echo $form->field($model, 'status')->textInput();
		}
	?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

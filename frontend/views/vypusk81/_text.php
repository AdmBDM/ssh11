<?php

	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	/* @var $this yii\web\View */
	/* @var $model common\models\GallerySearch */
	/* @var $form yii\widgets\ActiveForm */
?>

<div class="sos-text">

	<?php $form = ActiveForm::begin([
		'action' => ['sos'],
		'method' => 'post',
		'options' => [
			'data-pjax' => 0,
		],
	]); ?>

	<div class="row">
		<div class="col-lg-5">
			<?= $form->field($msgSos, 'send_text')->label(false)
				->textarea(['rows' => 3, 'cols' => 5, 'placeholder' => 'Текст, который вы хотите отправить.']) ?>
		</div>
	</div>

	<div class="form-group">
		<?= Html::submitButton('Жми!', ['class' => 'btn btn-primary']) ?>
<!--		--><?//= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>

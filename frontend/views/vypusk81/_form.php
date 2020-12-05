<?php

	use kartik\date\DatePicker;
	use yii\helpers\Html;
//	use yii\jui\DatePicker;
	use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Vypusk81 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vypusk81-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<!--    --><?//= $form->field($model, 'id')->textInput() ?>

<!--    --><?//= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput() ?>

	<?= $form->field($model, 'first_name_current')->textInput() ?>

    <?= $form->field($model, 'last_name')->textInput() ?>

    <?= $form->field($model, 'patronymic')->textInput() ?>

    <?= $form->field($model, 'year_from')->textInput() ?>

    <?= $form->field($model, 'year_for')->textInput() ?>

<!--	--><?//= $form->field($model, 'birthday')->widget(DatePicker::class) ?>
	<?= $form->field($model, 'birthday')->widget(DatePicker::class, [
//				'removeButton' => false,
				'pluginOptions' => [
					'autoclose' => true,
					'format' => 'yyyy-mm-dd',
					'todayHighlight' => true,
					'todayBtn' => true,
				],
//				'disabled'=> $view,
				'language' => 'ru',
//				'pickerButton' => "<span class=\"input-group-addon kv-date-calendar\" title=\"Выбрать дату\"><i class=\"fa fa-calendar-o\" 									aria-hidden=\"true\"></i></span>"
				]) ?>

<!--    --><?//= $form->field($model, 'deathday')->textInput() ?>
    <?php
		if (Yii::$app->user->identity->admin || Yii::$app->user->identity->admin_edit) {
			echo $form->field($model, 'deathday')->widget(DatePicker::class, [
//				'removeButton' => false,
				'pluginOptions' => [
					'autoclose' => true,
					'format' => 'yyyy-mm-dd',
					'todayHighlight' => true,
					'todayBtn' => true,
				],
//				'disabled'=> $view,
				'language' => 'ru',
//				'pickerButton' => "<span class=\"input-group-addon kv-date-calendar\" title=\"Выбрать дату\"><i class=\"fa fa-calendar-o\" 									aria-hidden=\"true\"></i></span>"
			]);
			echo $form->field($model, 'death_reason')->textInput();
		}

		echo $form->field($model, 'image')->fileInput();

	?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

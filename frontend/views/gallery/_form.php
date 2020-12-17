<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
/* @var $form yii\widgets\ActiveForm */

if (isset($_SESSION['gallery'])) {
	$model->fio = $_SESSION['gallery']['fio'];
	$model->issue81_id = $_SESSION['gallery']['id'];
	$model->gallery_type = $_SESSION['gallery']['type'];
}
?>

<div class="gallery-form">

<!--	--><?// myDebug($model); ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gallery_name')->textInput() ?>

<!--    --><?//= $form->field($model, 'issue81_id')->textInput() ?>
    <?= $form->field($model, 'issue81_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'gallery_type')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'fio')->textInput(['readonly'=> true]) ?>

<!--	--><?//= $form->field($model, 'image')->fileInput() ?>
	<?php
		if ($_SESSION['gallery']['mode'] <> 'create') {
			echo $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']);
		}
	?>

<!--    --><?//= $form->field($model, 'for_all')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

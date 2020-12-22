<?php

	use common\models\Vypusk81;
	use yii\bootstrap\ActiveForm;
	use yii\grid\ActionColumn;
	use yii\helpers\Html;
	use yii\grid\GridView;
	use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = $_SESSION['sos']['title'];
	$this->params['breadcrumbs'][] = $this->title;

//	$msgSos->send_text = 'Test';
?>
<div class="sos-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(); ?>
				<?= $form->field($msgSos, 'send_text')->label(false)
						->textarea(['rows' => 2, 'cols' => 5, 'placeholder' => 'Текст, который вы хотите отправить.'])
				; ?>
			<?php ActiveForm::end(); ?>
		</div>
	</div>

	<?php Pjax::begin(); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			[
				'class' => ActionColumn::class,
				'template' => '{send-sos}',
				'header' => '',
				'options' => ['style' => 'width: 50px;'],
				'buttons' => [
					'send-sos' => function ($url, $msgSos) {
						return Html::a('<span class="glyphicon glyphicon-bullhorn"></span>', $url, [
							'title' => 'Отравить запрос',
//							'data' => [
//								'msgSos' => $msgSos,
//								'confirm' => 'Вы действительно хотите удалить данные?',
//								'method' => 'post',
//							],
						]);
					},
				],
			],

			[
				'label' => 'Ф И О',
				'options' => ['style' => 'width: 350px;'],
				'format' => 'text',
				'contentOptions' => ['style'=>'white-space: normal;'],
				'value' => function($model) {
					return Vypusk81::getFIO($model->id);
				},
			],

			[
				'attribute' => 'birthday',
				'enableSorting' => false,
				'options' => ['style' => 'width: 150px;'],
			],

			[
				'label' => '',
				'format' => 'text',
				'contentOptions' => ['style'=>'white-space: normal;'],
				'value' => function($model) {
					return (!empty($model->deathday) ? 'Уже не с нами' : '');
				},
			],

		],
	]); ?>

	<?php Pjax::end(); ?>

</div>

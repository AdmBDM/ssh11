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

?>
<div class="sos-index">

	<h1><?= Html::encode($this->title) ?></h1>

<!--	<div class="row">-->
<!--		<div class="col-lg-5">-->
<!--			--><?php //$form = ActiveForm::begin(); ?>
<!--				--><?//= $form->field($model, 'textArea')
//						->textarea(['rows' => 2, 'cols' => 5])
//						->label('Многострочное текстовое поле'); ?>
<!--			--><?php //ActiveForm::end(); ?>
<!--		</div>-->
<!--	</div>-->

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
					'send-sos' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-bullhorn"></span>', $url, [
							'title' => 'Отравить запрос',
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

//			[
//				'attribute' => 'birthday',
//				'enableSorting' => false,
//				'options' => ['style' => 'width: 150px;'],
//			],

//			[
//				'label' => 'Годы учёбы',
//				'options' => ['style' => 'width: 150px;'],
//				'format' => 'text',
//				'value' => function($model) {
//					$return = (empty($model->year_from) ? '...' : $model->year_from) . '  -  ';
//					$return .= (empty($model->year_for) ? '...' : $model->year_for);
//					return $return;
//				},
//			],

			[
				'label' => '',
				'format' => 'text',
				'contentOptions' => ['style'=>'white-space: normal;'],
				'value' => function($model) {
					return (!empty($model->deathday) ? 'Уже не с нами' : '');
				},
			],
//			[
//				'attribute' => 'image',
//				'value' => function($model) {
//					$img = $model->getImage();
//					return "<img src='" . $img->getUrl() . "'>";
//				},
//				'format' => 'html',
//			],
		],
	]); ?>

	<?php Pjax::end(); ?>

</div>

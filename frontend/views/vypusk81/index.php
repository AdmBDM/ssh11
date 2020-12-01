<?php

	use yii\grid\ActionColumn;
	use yii\helpers\Html;
	use yii\grid\GridView;
	use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Выпускники 1981';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="vypusk81-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p <?= (Yii::$app->user->identity->admin ?: 'style="visibility: hidden"'); ?>>
		<?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php Pjax::begin(); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			[
				'class' => ActionColumn::class,
				'template' => '{view} {update} {delete}',
				'header' => 'Действия',
				'options' => ['style' => 'width: 100px;'],
				'buttons' => [
					'view' => function ($url, $model) {
//						if (!Yii::$app->user->identity->admin) {
//							return '';
//						}
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
							'title' => 'Просмотреть',
						]);
					},
					'update' => function ($url, $model) {
						if (!Yii::$app->user->identity->admin && Yii::$app->user->id != $model->profile_id) {
							return '';
						}
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
							'title' => 'Изменить',
						]);
					},
					'delete' => function ($url, $model) {
						if (!Yii::$app->user->identity->admin) {
							return '';
						}
						return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
							'title' => 'Удалить',
							'data' => [
								'confirm' => 'Вы действительно хотите удалить данные?',
								'method' => 'post',
							],
						]);
					},
				],
			],

			[
				'label' => 'Ф И О',
				'options' => ['style' => 'width: 350px;'],
				'format' => 'text',
				'contentOptions'=>['style'=>'white-space: normal;'],
				'value' => function($model) {
					$return = $model->first_name . ' ';
					$return .= (empty($model->first_name_current) ? '' : '(' . $model->first_name_current . ')') . ' ';
					$return .= $model->last_name . ' ';
					$return .= $model->patronymic;
					return $return;
				},
			],

			[
				'attribute' => 'birthday',
				'enableSorting' => false,
				'options' => ['style' => 'width: 150px;'],
			],

			[
				'label' => 'Годы учёбы',
				'options' => ['style' => 'width: 150px;'],
				'format' => 'text',
				'value' => function($model) {
					$return = (empty($model->year_from) ? '...' : $model->year_from) . '  -  ';
					$return .= (empty($model->year_for) ? '...' : $model->year_for);
					return $return;
				},
			],

			[
				'label' => '',
				'format' => 'text',
				'contentOptions'=>['style'=>'white-space: normal;'],
				'value' => function($model) {
					return (!empty($model->deathday) ? 'Уже не с нами' : '');
				},
			],
		],
	]); ?>

	<?php Pjax::end(); ?>

</div>

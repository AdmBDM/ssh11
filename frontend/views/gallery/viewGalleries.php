<?php

	use common\models\Fields;
	use common\models\Image;
	use common\models\Vypusk81;
	use yii\grid\ActionColumn;
	use yii\helpers\Html;
	use yii\grid\GridView;
	use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Все наши галереи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <h2>--><?//= Gallery::getHowImages(); ?><!--</h2>-->

	<div></div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
			[
				'class' => ActionColumn::class,
//				'template' => '{view} {view-gallery} {update} {delete}',
				'template' => '{view} {view-gallery}',
//				'template' => '{view-gallery}',
				'header' => 'Действия',
				'options' => ['style' => 'width: 100px;'],
				'buttons' => [
//					'view' => function ($url, $model) {
					'view' => function ($url) {
						if (!Yii::$app->user->identity->admin) {
							return '';
						}
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
							'title' => 'Просмотреть',
						]);
					},
					'view-gallery' => function ($url) {
						return Html::a('<span class="glyphicon glyphicon-book"></span>', $url, [
							'title' => 'Просмотреть галерею',
						]);
					},
//					'update' => function ($url, $model) {
//						if (!Yii::$app->user->identity->admin && !Yii::$app->user->identity->admin_edit && Yii::$app->user->id != $model->profile_id) {
//							return '';
//						}
//						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
//							'title' => 'Изменить',
//						]);
//					},
////					'delete' => function ($url, $model) {
//					'delete' => function ($url) {
//						if (!Yii::$app->user->identity->admin) {
//							return '';
//						}
//						return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
//							'title' => 'Удалить',
//							'data' => [
//								'confirm' => 'Вы действительно хотите удалить данные?',
//								'method' => 'post',
//							],
//						]);
//					},
				],
			],

//			'gallery_name',
			[
				'label' => Fields::getColumnName(Fields::TAB_GALLERY, 'gallery_name'),
				'options' => ['style' => 'width: 250px;'],
				'format' => 'text',
//				'contentOptions' => ['style'=>'white-space: normal;'],
				'value' => 'gallery_name',
//				'attribute' => 'gallery_name',
			],

			[
				'label' => 'Кол-во фото',
				'options' => ['style' => 'width: 75px;'],
				'value' => function($model) {
					return Image::getCountImages(Image::MODEL_GALLERY, $model->id);
				},
			],

			[
				'label' => 'Автор',
				'options' => ['style' => 'width: 350px;'],
				'format' => 'text',
				'contentOptions' => ['style'=>'white-space: normal;'],
				'value' => function($model) {
					return Vypusk81::getFIO($model->issue81_id, Vypusk81::NAME_FAM);
				},
			],

			[
				'label' => '',
				'format' => 'text',
				'contentOptions' => ['style'=>'white-space: normal;'],
				'value' => function() {return '';},
			],

        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

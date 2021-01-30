<?php

	use common\models\Fields;
//	use common\models\Gallery;
	use common\models\Image;
	use common\models\Vypusk81;
	use yii\grid\ActionColumn;
	use yii\helpers\Html;
	use yii\grid\GridView;
	use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel common\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Галереи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">

	<h1>
		<?php
			$type = isset($_SESSION['gallery']) ? $_SESSION['gallery']['title'] : 'Общие';
			echo Html::encode($this->title . ' ' . $type);
		?>
	</h1>

	<p>
		<?php
			if (Yii::$app->user->identity->admin || isset($_SESSION['gallery'])) {
				echo Html::a('Создать', ['create'], ['class' => 'btn btn-success']);
			}
		?>
	</p>

	<?php Pjax::begin(); ?>
<!--	--><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
        'dataProvider' => $dataProvider,
//		'filterModel' => $searchModel,
		'columns' => [
			[
				'class' => ActionColumn::class,
				'template' => '{view} {view-gallery} {update} {delete}',
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
					'update' => function ($url, $model) {
//						if (!Yii::$app->user->identity->admin && $model->profile_id && Yii::$app->user->id != $model->profile_id) {
						$id = (Vypusk81::getProfileId($model->issue81_id) == Yii::$app->user->id);
						if (!Yii::$app->user->identity->admin && !$id) {
//						if (!Yii::$app->user->identity->admin) {
							return '';
						}

						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
//							'title' => 'Изменить',
//							'title' => Vypusk81::getProfileId($model->id) . ' - ' . Yii::$app->user->id,
						]);
					},
//					'delete' => function ($url, $model) {
					'delete' => function ($url) {
// todo-my: мои доработки: открыть удаление галереи для владельца
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

//			'gallery_name',
			[
//				'attribute' => 'gallery_name',
				'label' => Fields::getColumnName(Fields::TAB_GALLERY, 'gallery_name'),
				'value' => 'gallery_name',
				'options' => ['style' => 'width: 250px;'],
//				'contentOptions' => ['style'=>'white-space: normal;'],
				'format' => 'text',
			],

			[
//				'attribute' => 'how_images',
				'label' => 'Кол-во фото',
				'options' => ['style' => 'width: 75px;'],
				'value' => function($model) {
					return Image::getCountImages(Image::MODEL_GALLERY, $model->id);
				},
			],

			[
//				'attribute' => 'fio',
				'label' => 'Ф И О',
				'options' => ['style' => 'width: 350px;'],
				'format' => 'text',
				'contentOptions' => ['style'=>'white-space: normal;'],
				'value' => function($model) {
    				return Vypusk81::getFIO($model->issue81_id, Vypusk81::NAME_FAM);
				},
				'visible' => !isset($_SESSION['gallery']['view_fio']),
			],

//			'issue81_id',
//			'for_all:boolean',

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

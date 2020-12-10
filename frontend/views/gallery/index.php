<?php

	use common\models\Gallery;
	use yii\grid\ActionColumn;
	use yii\helpers\Html;
	use yii\grid\GridView;
	use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Галереи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
			[
				'class' => ActionColumn::class,
				'template' => '{view} {view-gallery} {update} {delete}',
				'header' => 'Действия',
				'options' => ['style' => 'width: 100px;'],
				'buttons' => [
//					'view' => function ($url, $model) {
					'view' => function ($url) {
//						if (!Yii::$app->user->identity->admin) {
//							return '';
//						}
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
						if (!Yii::$app->user->identity->admin && !Yii::$app->user->identity->admin_edit && Yii::$app->user->id != $model->profile_id) {
							return '';
						}
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
							'title' => 'Изменить',
						]);
					},
//					'delete' => function ($url, $model) {
					'delete' => function ($url) {
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

			'gallery_name',

			[
				'label' => 'Ф И О',
				'options' => ['style' => 'width: 350px;'],
				'format' => 'text',
				'contentOptions' => ['style'=>'white-space: normal;'],
				'value' => function($model) {
					return Gallery::getOwner($model->issue81_id);
				},
			],

			'issue81_id',
			'for_all:boolean',

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

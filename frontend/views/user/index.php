<?php

	use yii\grid\ActionColumn;
	use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<p <?= (Yii::$app->user->identity->admin ?: 'style="visibility: hidden"'); ?>>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
//			['class' => 'yii\grid\SerialColumn'],

			[
				'class' => ActionColumn::class,
				'template' => '{view} {update} {delete}',
				'header' => 'Действия',
				'options' => ['style' => 'width: 100px;'],
				'buttons' => [
					'view' => function ($url, $model) {
						if (!Yii::$app->user->identity->admin) {
							return '';
						}
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
							'title' => 'Просмотреть',
						]);
					},
					'update' => function ($url, $model) {
						if (!Yii::$app->user->identity->admin) {
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
				'attribute' => 'id',
				'options' => ['style' => 'width: 50px;']
			],

			[
				'attribute' => 'username',
				'options' => ['style' => 'width: 250px;']
			],

			[
				'attribute' => 'phone_number',
				'options' => ['style' => 'width: 150px;'],
			],

			[
				'attribute' => 'email',
				'options' => ['style' => 'width: 350px;'],
			],

			[
				'label' => '',
				'format' => 'text',
				'contentOptions' => ['style'=>'white-space: normal;'],
				'value' => function($model) {
					return ' ';
				},
			],

//			'id',
//			'username',
//			'auth_key',
//			'password_hash',
//			'password_reset_token',
//			'email:email',
//			'status',
//			'created_at',
//			'updated_at',
//			'verification_token',
//			'phone_number',
//			'admin:boolean',
		],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

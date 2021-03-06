<?php

	use yii\helpers\Html;
	use yii\web\YiiAsset;
	use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Vypusk81 */

$this->title = 'Идентификатор ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vypusk81s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>

<?php
	$mainImg = $model->getImage();
	$gallery = $model->getImages();
	$imgPath = Yii::$app->params['imgStore'];
?>

<div class="vypusk81-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p <?= (Yii::$app->user->identity->admin ?: 'style="visibility: hidden"'); ?>>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данные?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<!--	--><?php //$img = $model->getImage(); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'gender',
            'first_name_current',
            'first_name',
            'last_name',
            'patronymic',
            'year_from',
            'year_for',
            'birthday',
//            'deathday',
//			[
//				'attribute' => 'image',
//				'value' => "<img src='{$mainImg->getUrl()}'>",
//				'format' => 'html',
//			],
//			[
//				'attribute' => 'image',
//				'value' => '<img src="/' . $mainImg->getPath() . '" alt="' . $mainImg->filePath . '">',
//				'format' => 'html',
//			],
        ],
    ]) ?>

<!--	--><?//= Html::img($mainImg->getUrl(), ['alt' => $model->first_name]); ?>

<!--	--><?//=
//		$mainImg->getUrl();
//		myDebug($mainImg);
//		myDebug($gallery);
//	?>

	<div class="memory-photo">
<!--		<img src="/upload/store/--><?//= $mainImg->filePath ?><!--" alt="test">-->
		<img src="/<?= $imgPath . $mainImg->filePath ?>" alt="test">
	</div>
</div>

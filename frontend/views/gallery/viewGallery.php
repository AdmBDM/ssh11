<?php
	/* @var $this yii\web\View */

	use yii\bootstrap\Carousel;
	use yii\helpers\Html;

	$this->title = 'Страница просмотра галерей';

?>

<div class="view-gallery">
<!--	<h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
	<h2><?= Html::encode('Просмотр галереи "' . $option['name']) . '"' ?></h2>
	<h3><?= Html::encode('Автор: ' . $option['owner_fio']) ?></h3>

<!--	--><?// if ($images): ?>
<!--		<h2>--><?//= Html::encode('Содержимое присутствует!') ?><!--</h2>-->
<!--	--><?// else: ?>
<!--		<h2>--><?//= Html::encode('Данных для отображения нет!') ?><!--</h2>-->
<!--	--><?// endif; ?>

	<div class="row">
		<?=
			Carousel::widget([
				'items' => $images,
				'options' => ['class' => 'carousel slide', 'data-interval' => '10000'],
				'controls' => [
					'<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
					'<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
					],
			]);
		?>
	</div>

	<h4><?= Html::encode('Изображений - ' . count($images) . ' шт.') ?></h4>

	<!--	<iframe src="https://www.youtube.com/embed/RpLnN1-SNYE" frameborder="0">test</iframe>-->
<!--	<img src='../../images/ssh11_1981_10а.jpg' alt='Photo' />-->

</div>
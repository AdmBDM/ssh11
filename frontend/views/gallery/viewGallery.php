<?php
	/* @var $this yii\web\View */

	use yii\helpers\Html;

	$this->title = 'Страница просмотра галерей';

//	$imgMain = $model->getImage();
//	$imgGallery = $model->getImages();

?>

<div class="view-gallery">
	<h1><?= Html::encode($this->title) ?></h1>

	<p>Краткая инструкция по pаботе с данной страницей</p>

	<?=
		myDebug($_GET);
	?>
	<!--	<iframe src="https://www.youtube.com/embed/RpLnN1-SNYE" frameborder="0">test</iframe>-->
<!--	<img src='../../images/ssh11_1981_10а.jpg' alt='Photo' />-->

</div>

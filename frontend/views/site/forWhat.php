<?php
	/* @var $this yii\web\View */

	use yii\helpers\Html;

//	$this->title = 'Главная страница проекта';
//	$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-first">
<h1><?= Html::encode($this->title) ?></h1>

	<iframe src="https://www.youtube.com/embed/RpLnN1-SNYE" frameborder="0">test</iframe>

	<img src='../../images/ssh11_1981_10а.jpg' alt='Foto' />

	<p><?= 	Yii::$app->user->identity->username; ?></p>
	<p><?= 	Yii::$app->user->identity->email; ?></p>
	<p><?= 	Yii::$app->user->identity->admin; ?></p>

	<?php
		myDebug(Yii::$app->user->identity);
//		Yii::$app->session->setFlash('error', ['123', '456', '789']);
//		Yii::$app->session->setFlash('success', 'This is the message');
//		Yii::$app->session->setFlash('info', 'This is the message');
	?>
</div>

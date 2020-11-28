<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

Yii::$app->name = Yii::$app->params['myAppName'] . ' (t)';

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--<html lang="--><?//= Yii::$app->language ?><!--">-->
<html lang="<?= Yii::$app->params['language'] ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $this->render('header')?>
<div class="wrap">

	<?php $this->beginContent('@app/views/layouts/two_col.php'); ?>

	<aside class='sidebar left_sidebar'>
		<?= $this->render('@app/views/layouts/sidebar/left.php') ?>
	</aside>
	<section class='main right_main'>
		<?php echo $content; ?>
	</section>
	<?php $this->endContent(); ?>

</div>
<?php $this->endBody() ?>
<?= $this->render('footer')?>
</body>
</html>
<?php $this->endPage() ?>

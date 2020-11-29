<?php
use yii\helpers\Html;
	use yii\web\View;

	/* @var $this View */
/* @var $content string */


	Yii::$app->name = Yii::$app->params['myAppName'];

if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'fe_main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('frontend\assets\AppAsset')) {
        frontend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
<!--    <html lang="--><?//= Yii::$app->language ?><!--">-->
    <html lang="<?= Yii::$app->params['language'] ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
<!--        <title>***--><?//= Html::encode($this->title) ?><!--***</title>-->
        <title><?= Html::encode(Yii::$app->name) ?></title>
        <?php $this->head() ?>
    </head>
	<body class="hold-transition skin-blue sidebar-mini">
	<?php $this->beginBody() ?>
	<div class="wrapper">

		<?= $this->render(
			'fe_header.php',
			['directoryAsset' => $directoryAsset]
		) ?>

		<?= $this->render(
			'fe_left.php',
			['directoryAsset' => $directoryAsset]
		)
		?>

		<?= $this->render(
			'fe_content.php',
			['content' => $content, 'directoryAsset' => $directoryAsset]
		) ?>

	</div>

	<?php $this->endBody() ?>
	</body>
	</html>
    <?php $this->endPage() ?>
<?php } ?>

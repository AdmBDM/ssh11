<?php

use yii\helpers\Html;

?>


<footer class="footer">
	<div class="container">
		<div class="pageup"><a href="#"><span class="scroll-top fa fa-angle-double-up"></span></a></div>
	</div>

	<div class="container">
		<p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?>, <?= date('Y') ?></p>

		<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
	</div>
</footer>


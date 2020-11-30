<?php
/* @var $this yii\web\View */

	$imgPathMemory = Yii::$app->basePath . '\..\common\images\memory';

?>
<div class="memory">
	<h1>Аллея памяти</h1>
	<div class="memory-row">
		<div class="memory-block">
			<div class="memory-photo"><img src="../../images/memory/utkin.png" alt='Photo' /></div>
			<div class="memory-date">1982</div>
			<div class="memory-text">
				Причина ухода: погиб при исполнении интернационального долга в Афганистане
			</div>
		</div>
		<div class="memory-block">
			<div class="memory-photo"><img src="../../images/memory/stepanova.png" alt='Photo' /></div>
			<div class="memory-date">25.10.2020</div>
			<div class="memory-text">
				Причина ухода: пандемия короновируса
			</div>
		</div>
	</div>
</div>


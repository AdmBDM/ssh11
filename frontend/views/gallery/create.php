<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */

$this->title = 'Создать галерею';
$this->params['breadcrumbs'][] = ['label' => 'Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$_SESSION['gallery']['mode'] = 'create';
?>
<div class="gallery-create">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
	<h1>
		<?php
			$type = isset($_SESSION['gallery']) ? $_SESSION['gallery']['title'] : 'Общие';
			echo Html::encode($this->title . ' ' . $type);
		?>
	</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

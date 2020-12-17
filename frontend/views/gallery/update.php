<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */

$this->title = 'Редактировать галерею: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
$_SESSION['gallery']['mode'] = 'edit';
$_SESSION['gallery']['type'] = $model->gallery_type;
?>
<div class="gallery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

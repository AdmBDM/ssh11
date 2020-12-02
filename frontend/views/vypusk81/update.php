<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vypusk81 */

$this->title = 'Изменить "Выпуск 81" : ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vypusk81', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="vypusk81-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

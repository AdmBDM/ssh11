<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vypusk81 */

$this->title = 'Update Vypusk81: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vypusk81s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vypusk81-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

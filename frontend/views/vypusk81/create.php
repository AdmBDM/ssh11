<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vypusk81 */

$this->title = 'Create Vypusk81';
$this->params['breadcrumbs'][] = ['label' => 'Vypusk81s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vypusk81-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

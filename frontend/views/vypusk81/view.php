<?php

	use yii\helpers\Html;
	use yii\web\YiiAsset;
	use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Vypusk81 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vypusk81s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="vypusk81-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p <?= (Yii::$app->user->identity->admin ?: 'style="visibility: hidden"'); ?>>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данные?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'gender',
            'first_name_current',
            'first_name',
            'last_name',
            'patronymic',
            'year_from',
            'year_for',
            'birthday',
            'deathday',
        ],
    ]) ?>

</div>

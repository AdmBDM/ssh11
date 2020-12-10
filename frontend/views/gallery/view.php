<?php

//	use common\models\Gallery;
	use yii\helpers\Html;
	use yii\web\YiiAsset;
	use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */

$this->title = 'Галерея "' . $model->gallery_name . '" (' . $model->id . ')';
$this->params['breadcrumbs'][] = ['label' => 'Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);

$imgMain = $model->getImage();
$imgGallery = $model->getImages();
$imgPath = Yii::$app->params['imgStore'];

?>
<div class="gallery-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данные?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'gallery_name',
            'issue81_id',
            'for_all:boolean',
			[
				'label' => 'test',
				'value' => Html::img($imgMain->getUrl('x200'), ['alt' => '']),
				'format' => 'html'
			],
        ],
    ]) ?>

</div>

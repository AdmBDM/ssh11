<?php
/* @var $this yii\web\View */

	use common\models\Vypusk81;
	use yii\helpers\Html;

	/* @var $this yii\web\View */
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = 'Аллея памяти';
	$this->params['breadcrumbs'][] = $this->title;

	$memory = Vypusk81::find()->where('not deathday isnull')->orderBy('deathday ASC')  ->all();

?>
<div class="memory">
	<h1><?= Html::encode($this->title) ?></h1>
	<div class="memory-row">
		<?php
			foreach ($memory as $item) {
				$mainImg = $item->getImage();
				echo '<div class="memory-block">';
					echo '<div class="memory-photo">';
						echo '<img src="/upload/store/' . $mainImg->filePath . '" alt="test">';
					echo '</div>';
					echo '<div class="memory-comment">';
						echo '<div class="memory-date">';
							$dateFormat = $item->death_year ? 'yyyy' : 'dd.MM.yyyy';
							echo Yii::$app->formatter->asDate( $item->deathday, $dateFormat);
						echo '</div>';
						echo '<div class="memory-text">';
							echo $item->death_reason;
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		?>
	</div>
</div>


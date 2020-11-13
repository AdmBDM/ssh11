<?php

use common\models\Section;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

if (!isset($this->params['header_color'])) $this->params['header_color'] = 'black';
?>

<?
	$model = Section::find()
		->where(['section_id' => null, 'published' => 1])
		->orderBy(['sort' => SORT_ASC])
		->all();

	foreach ($model as $item) {
		if (!Yii::$app->user->isGuest) {
			$menuItems[] = ['label' => $item['title'], 'url' => ['/' . $item['path']]];
		} else {
			if ($item['main']) {
				$menuItems[] = ['label' => $item['title'], 'url' => ['/' . $item['path']]];
			}
		}
	}

	if (Yii::$app->user->isGuest) {
		$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
	} else {
		$menuItems[] = '<li>'
			. Html::beginForm(['/site/logout'], 'post')
			. Html::submitButton(
				'Logout (' . Yii::$app->user->identity->username . ')',
				['class' => 'btn btn-link logout']
			)
			. Html::endForm()
			. '</li>';
	}
?>

<div class="navbar">
<?
	NavBar::begin();
	echo Nav::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		'items' => $menuItems,
	]);
	NavBar::end();
?>
</div>


<!--   Далее - всё то, что можно будет удалить   -->
<!--<div>
	<?php
/*		NavBar::begin([
			'brandLabel' => Yii::$app->name,
			'brandUrl' => Yii::$app->homeUrl,
			'options' => [
				'class' => 'navbar-inverse navbar-fixed-top',
			],
		]);
		$menuItems = [
			['label' => 'На главную', 'url' => ['/site/index']],
			['label' => 'Подробнее о проекте', 'url' => ['/site/about']],
		];
		if (!Yii::$app->user->isGuest) {
			$menuItems[] = ['label' => 'Обратная связь', 'url' => ['/site/contact']];
		}

		if (Yii::$app->user->isGuest) {
//        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
			$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
		} else {
			$menuItems[] = '<li>'
				. Html::beginForm(['/site/logout'], 'post')
				. Html::submitButton(
					'Logout (' . Yii::$app->user->identity->username . ')',
					['class' => 'btn btn-link logout']
				)
				. Html::endForm()
				. '</li>';
		}
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => $menuItems,
		]);
		NavBar::end();
	*/?>
</div>-->

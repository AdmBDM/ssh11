<?php

use common\models\Section;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

if (!isset($this->params['header_color'])) $this->params['header_color'] = 'black';
?>

<?
	$model = Section::find()
		->where(['section_id' => null, 'published' => 1, 'menu_head' => true])
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
//		$menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
		$menuItems[] = ['label' => 'Вход', 'url' => ['/site/login']];
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

<header class="header header-topbar-hidden header-normal-width navbar-fixed-top header-background-trans header-color-<?= $this->params['header_color'] ?> header-logo-white header-navibox-1-left header-navibox-2-left header-navibox-3-right header-navibox-4-right">

	<div class="container container-boxed-width">
		<div class="navbar">
			<?
				NavBar::begin([
					'brandLabel' => Yii::$app->name,
					'brandUrl' => Yii::$app->homeUrl,
					'options' => [
						'class' => 'navbar-inverse navbar-fixed-top',
//						'class' => 'navbar-fixed-top',
					],
				]);
				try {
					echo Nav::widget([
						'options' => ['class' => 'navbar-nav navbar-right'],
						'items' => $menuItems,
					]);
				} catch (Exception $e) {
				}
				NavBar::end();
			?>
		</div>
	</div>
</header>

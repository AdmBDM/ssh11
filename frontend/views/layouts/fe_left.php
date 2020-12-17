<?php

	use common\models\Section;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <!--<div class="user-panel">
            <div class="pull-left image">
                <img src="
use common\models\Section;<?/*= $directoryAsset */?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->

        <!-- search form -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

<!--	Формирование массива меню	-->
		<?php
			$menuAdmin = Yii::$app->user->identity->admin ? Section::getMenuGroup(Section::GR_ADMIN) : [];
			$menuDebug = Yii::$app->user->id < 10 ? Section::getMenuGroup(Section::GR_DEBUG) : [];
			$menuUser = Section::getMenuGroup(Section::GR_USER);
			$menuCommon = Section::getMenuGroup(Section::GR_COMMON);
			$menuAlert = Section::getMenuGroup(Section::GR_ALERT);
		?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => array_merge($menuDebug, $menuAdmin, $menuCommon, $menuUser, $menuAlert),
//                'items' => [
//                    ['label' => 'Управление', 'options' => ['class' => 'header'], 'visible' => Yii::$app->user->identity->admin],
//                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'], 'visible' => Yii::$app->user->identity->admin],
//                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'], 'visible' => Yii::$app->user->identity->admin],
//                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
//                    [
//                        'label' => 'Some tools',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
//                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
//                            [
//                                'label' => 'Level One',
//                                'icon' => 'circle-o',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
//                ],
            ]
        ) ?>

    </section>

</aside>

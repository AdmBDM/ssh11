<?php
/* @var $this \yii\web\View */
/* @var $model common\models\Declarant */

use yii\bootstrap\Html;
use yii\widgets\ActiveFormAsset;

$this->title = '';
//\kartik\form\ActiveFormAsset::register($this);
ActiveFormAsset::register($this);

?>

<div class="section-title-page area-bg area-bg_op_90 area-bg_grad parallax">
    <div class="area-bg__inner">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="b-title-page"><span class="sm"><?= Html::encode($this->title) ?></span></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end .b-title-page-->

<div class="container">
    <div class="row">
        <? if(Yii::$app->session->hasFlash('success')) {?>
            <div class="alert alert-block alert-5">
                <button class="close" data-dismiss="alert"><i class="close-icon fa fa-times"></i>
                </button>
                <div class="alert-icon"><i class="icon fa fa-check"></i>
                </div>
                <div class="alert__inner">
                    <h3 class="alert-title"><?=Yii::$app->session->getFlash('success')?></h3>
                </div>
            </div>
        <?}?>
        <div class="col-md-12 content-right">
            <div class="l-main-content l-main-content_pd-rgt">
                <div class="row">
                    <div>
                        <h3 class="ui-title-block title-sm">Ваш пароль успешно изменен</h3>
                        <div class="ui-decor-1 ui-decor-1_white bg-primary"></div>
                        <div class="block-paragraphs">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
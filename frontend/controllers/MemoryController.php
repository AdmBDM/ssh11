<?php

namespace frontend\controllers;

use yii\web\Controller;

class MemoryController extends Controller
{
    public function actionIndex()
    {
		$this->layout = 'fe_main';
        return $this->render('index');
    }

}

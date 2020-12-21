<?php

namespace frontend\controllers;

use Yii;
use common\models\Vypusk81;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * Vypusk81Controller implements the CRUD actions for Vypusk81 model.
 */
class Vypusk81Controller extends MyController
{

	/**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Vypusk81 models.
     * @return mixed
     */
    public function actionIndex()
    {
    	unset($_SESSION['mayDay']);

        $dataProvider = new ActiveDataProvider([
            'query' => Vypusk81::find()->orderBy(['first_name' => SORT_ASC, 'last_name' => SORT_ASC, 'patronymic' => SORT_ASC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vypusk81 model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Vypusk81 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vypusk81();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Vypusk81 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (empty($model->profile_id)) {
        	$model->profile_id = Yii::$app->user->id;
		}

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

// сохранение картинки
        	$model->image = UploadedFile::getInstance($model, 'image');
			if( $model->image ){
				$model->upload();
			}
			unset($model->image);

// сохранение галереи
        	$model->gallery = UploadedFile::getInstances($model, 'gallery');
			if( $model->gallery ){
				$model->uploadGallery();
			}

        	Yii::$app->session->setFlash('success', 'Информация обновлена.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Vypusk81 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vypusk81 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vypusk81 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vypusk81::findOne($id)) !== null) {
            return $model;
        }

//        throw new NotFoundHttpException('The requested page does not exist.');
        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }

	/**
	 * @return string
	 */
    public function actionSos()
	{
		$_SESSION['sos'] = [
			'title' => 'Помощь друга',
			'view_fio'=> false,
			'message' => '',
		];
		$dataProvider = new ActiveDataProvider([
			'query' => Vypusk81::find()
//					->where('not profile_id isnull and deathday isnull and profile_id <> ' . Yii::$app->user->id)
					->where('not profile_id isnull and deathday isnull')
					->orderBy(['first_name' => SORT_ASC, 'last_name' => SORT_ASC, 'patronymic' => SORT_ASC]),
		]);

		return $this->render('sos', [
			'dataProvider' => $dataProvider,
		]);
	}
}

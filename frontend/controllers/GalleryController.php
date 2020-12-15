<?php

namespace frontend\controllers;

use common\models\Vypusk81;
use Yii;
use common\models\Gallery;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends MyController
{
	/**
	 * @return array
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
			'image' => [
				'class' => 'rico\yii2images\behaviors\ImageBehave',
			],
        ];
    }

    /**
     * Lists all Gallery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Gallery::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gallery model.
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
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gallery();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Gallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

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
     * Deletes an existing Gallery model.
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
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }

	/**
	 * @return string
	 */
	public function actionViewGallery($id)
	{
		$model = $this->findModel($id);
		$gallery = $model->getImages();

		$images = [];
		foreach ($gallery as $item) {
//			$images[] = Html::img($item->getUrl('x200'), ['alt' => '']);
			$images[] = Html::a(
				Html::img($item->getUrl('x200'), ['alt' => '']),
				[$item->getUrl()],
				['data-method' => 'post', 'target' => '_blank']
			);
		}

		return $this->render('viewGallery', [
			'model' => $model,
			'gallery' => $gallery,
			'images' => $images,
			'option' => [
				'owner_fio' => Vypusk81::getFIO($model->issue81_id),
				'name' => $model->gallery_name,
			],
		]);
	}

	public function actionViewGalleries() {
		$dataProvider = new ActiveDataProvider([
			'query' => Gallery::find()
						->where('gallery_type = 0'),
		]);

		return $this->render('viewGalleries', [
			'dataProvider' => $dataProvider,
		]);

//		return $this->render('viewGalleries', [
//			'model' => $model,
//			'gallery' => $gallery,
//			'images' => $images,
//			'option' => [
//				'owner_fio' => Vypusk81::getFIO($model->issue81_id),
//				'name' => $model->gallery_name,
//			],
//		]);
	}
}

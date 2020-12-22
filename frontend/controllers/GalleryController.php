<?php

namespace frontend\controllers;

use common\models\Vypusk81;
use Yii;
use common\models\Gallery;
use common\models\GallerySearch;
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
    public function behaviors(): array
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
		unset($_SESSION['gallery']);

//        $dataProvider = new ActiveDataProvider([
//            'query' => Gallery::find()->where('not gallery_deleted'),
//        ]);

		$searchModel = new GallerySearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
        ]);
    }

	/**
	 * Displays a single Gallery model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
    public function actionView(int $id)
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
            if (isset($_SESSION['gallery'])) {
				Yii::$app->session->setFlash('success', 'Галерея создана. Можно её наполнять содержимым в режиме редактирования.');
				switch ($_SESSION['gallery']['type']) {
					case Gallery::GALLERY_ANIMAL:
						$url = 'animals';
						break;

					case Gallery::GALLERY_USER:
						$url = 'family';
						break;

					default: $url = 'index';
				}
				return $this->redirect([$url]);
			} else {
				Yii::$app->session->setFlash('error', 'Галерея создана. Можно её наполнять содержимым в режиме редактирования.');
				return $this->redirect(['view', 'id' => $model->id]);
			}
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

	/**
	 * Updates an existing Gallery model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

		if ($model->issue81_id) {
			$_SESSION['gallery'] = [
				'id' => $model->issue81_id,
				'type' => $model->gallery_type,
				'title' => $model->gallery_type == 1 ? 'домашних питомцев' : 'домашних и ...',
				'fio' => Vypusk81::getFIO($model->issue81_id),
				'view_fio' => false,
			];
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
            return $this->redirect([($model->gallery_type == 1 ? 'animals' : 'family')]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

	/**
	 * Deletes an existing Gallery model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
    public function actionDelete(int $id)
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

	/**
	 * @return string
	 */
	public function actionAnimals()
	{
		$_SESSION['gallery'] = [
			'id' => Vypusk81::getOwnerId(Yii::$app->user->id),
			'type'=> Gallery::GALLERY_ANIMAL,
			'title'=> 'домашних питомцев',
			'fio'=> Vypusk81::getFIO(Vypusk81::getOwnerId(Yii::$app->user->id)),
			'view_fio'=> false,
		];
		$dataProvider = new ActiveDataProvider([
			'query' => Gallery::find()->where('not gallery_deleted and issue81_id = ' . $_SESSION['gallery']['id'] . ' and gallery_type = ' . $_SESSION['gallery']['type']),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * @return string
	 */
	public function actionFamily()
	{
		$_SESSION['gallery'] = [
			'id' => Vypusk81::getOwnerId(Yii::$app->user->id),
			'type'=> Gallery::GALLERY_USER,
			'title'=> 'домашних и ...',
			'fio'=> Vypusk81::getFIO(Vypusk81::getOwnerId(Yii::$app->user->id)),
			'view_fio'=> false,
		];
		$dataProvider = new ActiveDataProvider([
			'query' => Gallery::find()->where('not gallery_deleted and issue81_id = ' . $_SESSION['gallery']['id'] . ' and gallery_type = ' . $_SESSION['gallery']['type']),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}
}

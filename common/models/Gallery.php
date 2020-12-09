<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property string|null $gallery_name
 * @property int $issue81_id
 * @property bool|null $for_all
 */
class Gallery extends ActiveRecord
{
	const GALLERY_COMMON = 0;
	const GALLERY_ANIMAL = 1;
	const GALLERY_USER = 2;

	public $image;
	public $gallery;

	/**
	 * @return string[][]
	 */
	public function behaviors()
	{
		return [
			'image' => [
				'class' => 'rico\yii2images\behaviors\ImageBehave',
			]
		];
	}

	/**
     * {@inheritdoc}
     */
    public static function tableName()
    {
		return mb_strtolower(Fields::TAB_GALLERY);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
    	return Fields::getRules(Fields::TAB_GALLERY);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
    	return Fields::getAttributes(Fields::TAB_GALLERY);
    }

    /**
     * {@inheritdoc}
     * @return GalleryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GalleryQuery(get_called_class());
    }

	public static function getOwner($id = 0) {
		return Vypusk81::getFIO($id);
	}

	/**
	 * @return bool
	 */
	public function upload() {
		if ($this->validate()) {
//			$path = 'upload/store/' . $this->image->baseName . '.' . $this->image->extension;
			$path = Yii::$app->params['imgStore'] . $this->image->baseName . '.' . $this->image->extension;
			$this->image->saveAs($path);
//			$this->attachImage($path, true, 'id' . Yii::$app->user->id);
			$this->attachImage($path, true);
//			@unlink($path);
			unlink($path);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @return bool
	 */
	public function uploadGallery(){
		if($this->validate()){
			foreach($this->gallery as $file){
//				$path = 'upload/store/' . $file->baseName . '.' . $file->extension;
				$path = Yii::$app->params['imgStore'] . $file->baseName . '.' . $file->extension;
				$file->saveAs($path);
				$this->attachImage($path);
				@unlink($path);
			}
			return true;
		}else{
			return false;
		}
	}

}

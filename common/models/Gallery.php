<?php

namespace common\models;

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

}

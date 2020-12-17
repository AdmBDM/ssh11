<?php

namespace common\models;

use yii\db\ActiveRecord;

class Image extends ActiveRecord
{
	const MODEL_GALLERY = 'Gallery';
	const MODEL_VYPUSK81 = 'Vypusk81';


	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return mb_strtolower(Fields::TAB_IMAGE);
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return Fields::getAttributes(Fields::TAB_IMAGE);
	}

	public static function getCountImages($type_model, $id) {
		if ($type_model) {
			$howRec = Image::findAll(['modelName' => $type_model, 'itemId' => $id]);
			return count($howRec);
		}

		return false;
	}
}
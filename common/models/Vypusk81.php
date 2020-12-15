<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "vypusk81".
 *
 * @property int         $id
 * @property string      $gender
 * @property string|null $first_name_current
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $patronymic
 * @property int|null    $year_from
 * @property int|null    $year_for
 * @property string|null $birthday
 * @property string|null $deathday
 *
 * @property Profiles    $id0
 */
class Vypusk81 extends ActiveRecord
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
        return mb_strtolower(Fields::TAB_VYPUSK81);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
		return Fields::getRules(Fields::TAB_VYPUSK81);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
		return Fields::getAttributes(Fields::TAB_VYPUSK81);
    }

//    /**
//     * Gets query for [[Id0]].
//     *
//     * @return \yii\db\ActiveQuery|ProfilesQuery
//     */
//    public function getId0()
//    {
//        return $this->hasOne(Profiles::class, ['vypusk81_id' => 'id']);
//    }

//    /**
//     * {@inheritdoc}
//     * @return Vypusk81Query the active query used by this AR class.
//     */
//    public static function find()
//    {
//        return new Vypusk81Query(get_called_class());
//    }

	/**
	 * @return bool
	 */
	public function upload() {
		if ($this->validate()) {
			$path = Yii::$app->params['imgStore'] . $this->image->baseName . '.' . $this->image->extension;
			$this->image->saveAs($path);
//			$this->attachImage($path, true, 'id' . Yii::$app->user->id);
			$this->attachImage($path, true);
			@unlink($path);
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

	/**
	 * @param $id
	 *
	 * @return string
	 */
	public static function getFIO($id) {
		if (($model = Vypusk81::findOne($id)) !== null) {
			$return = $model->first_name . ' ';
			$return .= (empty($model->first_name_current) ? '' : '(' . $model->first_name_current . ')') . ' ';
			$return .= $model->last_name . ' ';
			$return .= $model->patronymic;
			return $return;
		}
		return 'без имени';
	}

	/**
	 * @return string
	 */
	public function getFullName() {
		$return = $this->first_name . ' ';
		$return .= (empty($this->first_name_current) ? '' : '(' . $this->first_name_current . ')') . ' ';
		$return .= $this->last_name . ' ';
		$return .= $this->patronymic;
		return $return;
	}
}



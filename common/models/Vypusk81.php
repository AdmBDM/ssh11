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
//        return [
//            [['first_name_current', 'first_name', 'last_name', 'patronymic'], 'string'],
//            [['year_from', 'year_for', 'new_column'], 'default', 'value' => null],
//            [['year_from', 'year_for', 'new_column'], 'integer'],
//            [['birthday', 'deathday'], 'safe'],
//            [['gender'], 'string', 'max' => 1],
//            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Profiles::class, 'targetAttribute' => ['id' => 'vypusk81_id']],
//        ];
		return Fields::getRules(Fields::TAB_VYPUSK81);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
//        return [
//            'id' => 'ID',
//            'gender' => 'Gender',
//            'first_name_current' => 'First Name Current',
//            'first_name' => 'First Name',
//            'last_name' => 'Last Name',
//            'patronymic' => 'Patronymic',
//            'year_from' => 'Year From',
//            'year_for' => 'Year For',
//            'birthday' => 'Birthday',
//            'deathday' => 'Deathday',
//        ];
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

    /**
     * {@inheritdoc}
     * @return Vypusk81Query the active query used by this AR class.
     */
    public static function find()
    {
        return new Vypusk81Query(get_called_class());
    }

	/**
	 * @return bool
	 */
	public function upload() {
		if ($this->validate()) {
			$path = 'upload/store/' . $this->image->baseName . '.' . $this->image->extension;
			$this->image->saveAs($path);
			$this->attachImage($path, true, 'id' . Yii::$app->user->id);
			return true;
		} else {
			return false;
		}
	}

}



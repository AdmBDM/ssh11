<?php

namespace common\models;

//use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "profiles".
 *
 * @property int $id
 * @property int|null $vypusk81_id
 *
 * @property User $user
 * @property Vypusk81 $vypusk81
 */
class Profiles extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
//        return 'profiles';
        return mb_strtolower(Fields::TAB_PROFILES);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
//        return [
//            [['id'], 'required'],
//            [['id', 'vypusk81_id'], 'default', 'value' => null],
//            [['id', 'vypusk81_id'], 'integer'],
//            [['vypusk81_id'], 'unique'],
//            [['id'], 'unique'],
//        ];
		return Fields::getRules(Fields::TAB_PROFILES);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
//        return [
//            'id' => 'ID',
//            'vypusk81_id' => 'vypusk81 ID',
//        ];
		return Fields::getAttributes(Fields::TAB_PROFILES);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id']);
    }

//    /**
//     * Gets query for [[Vypusk81]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getVypusk81()
//    {
//        return $this->hasOne(Vypusk81::class, ['id' => 'vypusk81_id']);
//    }
}

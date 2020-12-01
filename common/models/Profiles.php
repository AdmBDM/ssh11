<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profiles".
 *
 * @property int $id
 * @property int|null $classmate_id
 *
 * @property User $user
 * @property Vypusk81 $vypusk81
 */
class Profiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'classmate_id'], 'default', 'value' => null],
            [['id', 'classmate_id'], 'integer'],
            [['classmate_id'], 'unique'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'classmate_id' => 'Classmate ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    /**
     * Gets query for [[Vypusk81]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVypusk81()
    {
        return $this->hasOne(Vypusk81::className(), ['id' => 'classmate_id']);
    }
}

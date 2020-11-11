<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "section".
 *
 * @property integer $id
 * @property string $path
 * @property integer $section_id
 * @property string $template_id
 * @property string $icon
 * @property integer $has_menu
 * @property string $title
 *
 * @property Section $section
 * @property Section[] $sections
 */
class Section extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return mb_strtolower(Fields::TAB_SECTION);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
    	return Fields::getRules(Fields::TAB_SECTION);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
    	return Fields::getAttributes(Fields::TAB_SECTION);
    }

//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getPage()
//    {
//        return $this->hasOne(Page::className(), ['section_id' => 'id', 'route' => 'path']);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(Section::className(), ['section_id' => 'id']);
    }

//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getTemplate()
//    {
//        return $this->hasOne(Template::className(), ['id' => 'template_id']);
//    }
}

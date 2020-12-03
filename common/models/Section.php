<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "section".
 *
 * @property integer $id
 * @property string $path
 * @property integer $section_id
 * @property string $icon
 * @property integer $has_menu
 * @property string $title
 * @property string $published
 * @property string $sort
 * @property boolean $main
 * @property boolean $menu_head
 * @property boolean $menu_right
 * @property boolean $menu_footer
 * @property boolean $menu_left
 * @property string $group
 *
 * @property Section $section
 * @property Section[] $sections
 */

class Section extends ActiveRecord
{
	//определение локальных констант
	const MENU_MAIN = 'main';
	const MENU_HEAD = 'menu_head';
	const MENU_LEFT = 'menu_left';
	const MENU_RIGHT = 'menu_right';
	const MENU_FOOTER = 'menu_footer';
	const GR_COMMON = 'common';
	const GR_USER = 'user';
	const GR_ALERT = 'alert';


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
//        return $this->hasOne(Page::class, ['section_id' => 'id', 'route' => 'path']);
//    }

    /**
     * @return ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::class, ['id' => 'section_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(Section::class, ['section_id' => 'id']);
    }

//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getTemplate()
//    {
//        return $this->hasOne(Template::class, ['id' => 'template_id']);
//    }

	/**
	 * @param string $group
	 *
	 * @return Section[]
	 */
	public static function getMenuGroup($group = 'common')
	{
		$menu = static::find()->where(['group' => $group, 'published' => true])->orderBy([new Expression('sort')])->all();

		$group_label = '---';
		if ($group === self::GR_COMMON) { $group_label = 'Общее'; }
		if ($group === self::GR_USER) { $group_label = 'Личное'; }
		if ($group === self::GR_ALERT) { $group_label = 'Важно'; }
		$menuItems[] = [
			'label' => $group_label,
			'icon' => 'share',
			'options' => ['class' => 'header'],
//			'visible' => Yii::$app->user->identity->admin,
		];
		foreach ($menu as $menuItem) {
			$menuItems[] = [
				'label' => $menuItem->title,
				'url' => [$menuItem->path],
				'icon' => $menuItem->icon,
			];
		}
		return $menuItems;
	}
}

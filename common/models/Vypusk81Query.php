<?php

namespace common\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Vypusk81]].
 *
 * @see Vypusk81
 */
class Vypusk81Query extends ActiveQuery
{
//	public $image;
//	public $gallery;

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

    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Vypusk81[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Vypusk81|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

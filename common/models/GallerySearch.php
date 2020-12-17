<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
//use common\models\Gallery;

/**
 * GallerySearch represents the model behind the search form of `common\models\Gallery`.
 */
class GallerySearch extends Gallery
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
    	return Fields::getRules(Fields::TAB_GALLERY);
//        return [
//            [['id', 'issue81_id', 'gallery_type'], 'integer'],
//            [['gallery_name'], 'safe'],
//            [['for_all', 'gallery_deleted'], 'boolean'],
//        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Gallery::find()->where('not gallery_deleted');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		// grid filtering conditions
		$query->andFilterWhere([
			'id' => $this->id,
			'issue81_id' => $this->issue81_id,
			'for_all' => $this->for_all,
			'gallery_type' => $this->gallery_type,
//			'gallery_deleted' => $this->gallery_deleted,
		]);

//        $this->addCondition($query, 'fio', true);

        $query->andFilterWhere(['ilike', 'gallery_name', $this->gallery_name]);
//        $query->andFilterWhere(['ilike', 'fio', $this->fio]);
//        $query->andFilterWhere(['ilike', 'gallery_name', $this->gallery_name]);

        return $dataProvider;
    }
}

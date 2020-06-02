<?php

namespace app\models\shop;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\shop\Shop;

/**
 * ShopSearch represents the model behind the search form of `app\models\shop\Shop`.
 */
class ShopSearch extends Shop
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'new', 'sale', 'price', 'salePercent', 'category_id', 'activite'], 'integer'],
            [['product_name_ru', 'product_name_en', 'collection', 'description_ru', 'description_en'], 'safe'],
        ];
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
        $query = Shop::find();

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
            'new' => $this->new,
            'sale' => $this->sale,
            'price' => $this->price,
            'salePercent' => $this->salePercent,
            'category_id' => $this->category_id,
            'activite' => $this->activite,
        ]);

        $query->andFilterWhere(['like', 'product_name', $this->product_name_ru])
            ->andFilterWhere(['like', 'product_name', $this->product_name_en])
            ->andFilterWhere(['like', 'collection', $this->collection])
            ->andFilterWhere(['like', 'description', $this->description_ru])
            ->andFilterWhere(['like', 'description', $this->description_en]);

        return $dataProvider;
    }
}

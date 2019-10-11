<?php

namespace albertgeeca\language_manager\src\common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use albertgeeca\language_manager\src\common\entities\Language;

/**
 * SearchModel represents the model behind the search form of `albertgeeca\language_manager\src\common\entities\Language`.
 */
class SearchModel extends Language
{
    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['id', 'is_default', 'is_archived'], 'integer'],
            [['locale', 'name'], 'safe'],
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
        $query = Language::find();

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
            'is_default' => $this->is_default,
            'is_archived' => $this->is_archived,
        ]);

        $query->andFilterWhere(['like', 'locale', $this->locale])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}

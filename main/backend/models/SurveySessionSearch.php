<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SurveySessions;

/**
 * SurveySessionSearch represents the model behind the search form of `backend\models\SurveySessions`.
 */
class SurveySessionSearch extends SurveySessions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'survey_id', 'status'], 'integer'],
            [['last_session', 'next_session'], 'safe'],
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
        $query = SurveySessions::find();

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
            'survey_id' => $this->survey_id,
            'last_session' => $this->last_session,
            'next_session' => $this->next_session,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}

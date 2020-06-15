<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Responses;

/**
 * ResponseSearch represents the model behind the search form of `backend\models\Responses`.
 */
class ResponseSearch extends Responses
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'survey_id'], 'integer'],
            [['question', 'response', 'respondent', 'created_at'], 'safe'],
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
        $query = Responses::find();

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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'response', $this->response])
            ->andFilterWhere(['like', 'respondent', $this->respondent]);

        return $dataProvider;
    }
}

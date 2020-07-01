<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Surveys;

/**
 * SurveySearch represents the model behind the search form of `backend\models\Surveys`.
 */
class SurveySearch extends Surveys
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'contact_group', 'frequency', 'is_active'], 'integer'],
            [['survey_name', 'company_name', 'duration', 'message', 'created_at'], 'safe'],
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
        $query = Surveys::find();

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
            'contact_group' => $this->contact_group,
            'frequency' => $this->frequency,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'survey_name', $this->survey_name])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'duration', $this->duration])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}

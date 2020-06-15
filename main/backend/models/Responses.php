<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "responses".
 *
 * @property int $id
 * @property int $survey_id
 * @property string $question
 * @property string $response
 * @property string $respondent
 * @property string $created_at
 *
 * @property Surveys $survey
 */
class Responses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'responses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['survey_id', 'question', 'response', 'respondent'], 'required'],
            [['survey_id'], 'integer'],
            [['created_at'], 'safe'],
            [['question', 'response', 'respondent'], 'string', 'max' => 256],
            [['survey_id'], 'exist', 'skipOnError' => true, 'targetClass' => Surveys::className(), 'targetAttribute' => ['survey_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'survey_id' => 'Survey ID',
            'question' => 'Question',
            'response' => 'Response',
            'respondent' => 'Respondent',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurvey()
    {
        return $this->hasOne(Surveys::className(), ['id' => 'survey_id']);
    }

    /**
     * {@inheritdoc}
     * @return ResponsesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResponsesQuery(get_called_class());
    }
}

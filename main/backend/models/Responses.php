<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%responses}}".
 *
 * @property int $id
 * @property int $survey_id
 * @property string $msisdn
 * @property int $question_id
 * @property string $response
 * @property int $session_id
 * @property string $inserted_at
 *
 * @property SurveySessions $session
 * @property Surveys $survey
 * @property Questions $question
 */
class Responses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%responses}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['survey_id', 'msisdn', 'question_id', 'response'], 'required'],
            [['survey_id', 'question_id', 'session_id'], 'integer'],
            [['inserted_at'], 'safe'],
            [['msisdn', 'response'], 'string', 'max' => 20],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => SurveySessions::className(), 'targetAttribute' => ['session_id' => 'id']],
            [['survey_id'], 'exist', 'skipOnError' => true, 'targetClass' => Surveys::className(), 'targetAttribute' => ['survey_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
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
            'msisdn' => 'Msisdn',
            'question_id' => 'Question ID',
            'response' => 'Response',
            'session_id' => 'Session ID',
            'inserted_at' => 'Inserted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(SurveySessions::className(), ['id' => 'session_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurvey()
    {
        return $this->hasOne(Surveys::className(), ['id' => 'survey_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
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

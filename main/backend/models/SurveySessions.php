<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%survey_sessions}}".
 *
 * @property int $id
 * @property int $survey_id
 * @property string $session_name
 * @property string $start_time
 * @property int $status
 * @property string $inserted_at
 *
 * @property Responses[] $responses
 * @property Surveys $survey
 */
class SurveySessions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%survey_sessions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['survey_id', 'session_name'], 'required'],
            [['survey_id', 'status'], 'integer'],
            [['start_time', 'inserted_at'], 'safe'],
            [['session_name'], 'string', 'max' => 30],
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
            'session_name' => 'Session Name',
            'start_time' => 'Start Time',
            'status' => 'Status',
            'inserted_at' => 'Inserted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Responses::className(), ['session_id' => 'id']);
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
     * @return SurveySessionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SurveySessionsQuery(get_called_class());
    }
}

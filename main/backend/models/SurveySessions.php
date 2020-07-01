<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%survey_sessions}}".
 *
 * @property int $id
 * @property int $survey_id
 * @property string $last_session
 * @property string $next_session
 * @property int $status
 *
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
            [['survey_id'], 'required'],
            [['survey_id', 'status'], 'integer'],
            [['last_session', 'next_session'], 'safe'],
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
            'last_session' => 'Last Session',
            'next_session' => 'Next Session',
            'status' => 'Status',
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
     * @return SurveySessionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SurveySessionsQuery(get_called_class());
    }
}

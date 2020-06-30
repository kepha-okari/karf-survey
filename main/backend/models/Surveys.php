<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%surveys}}".
 *
 * @property int $id
 * @property string $survey_name
 * @property string $company_name
 * @property string $duration
 * @property string $message
 * @property int $frequency
 * @property int $is_active
 * @property string $created_at
 *
 * @property Groups[] $groups
 * @property Questions[] $questions
 * @property Responses[] $responses
 */
class Surveys extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%surveys}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['survey_name', 'company_name', 'message', 'frequency'], 'required'],
            [['frequency', 'is_active'], 'integer'],
            [['created_at'], 'safe'],
            [['survey_name', 'company_name'], 'string', 'max' => 256],
            [['duration'], 'string', 'max' => 20],
            [['message'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'survey_name' => 'Survey Name',
            'company_name' => 'Company Name',
            'duration' => 'Duration',
            'message' => 'Message',
            'frequency' => 'Frequency',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::className(), ['survey_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Questions::className(), ['survey_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Responses::className(), ['survey_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return SurveysQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SurveysQuery(get_called_class());
    }
}

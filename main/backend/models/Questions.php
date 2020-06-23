<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property int $survey_id
 * @property string $state
 * @property string $question_type
 * @property string $title
 * @property int $pointer
 * @property int $question_number
 * @property string $created_at
 *
 * @property Options[] $options
 * @property Surveys $survey
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['survey_id', 'state', 'question_type', 'title', 'question_number'], 'required'],
            [['survey_id', 'pointer', 'question_number'], 'integer'],
            [['created_at'], 'safe'],
            [['state', 'question_type', 'title'], 'string', 'max' => 256],
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
            'survey_id' => 'Survey Name',
            'state' => 'State',
            'question_type' => 'Type',
            'title' => 'Question',
            'pointer' => 'Next Question',
            'question_number' => 'Question Number',
            'created_at' => 'Time Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Options::className(), ['question_id' => 'id']);
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
     * @return QuestionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QuestionsQuery(get_called_class());
    }
}

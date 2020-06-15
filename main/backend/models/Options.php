<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property int $question_id
 * @property string $state
 * @property string $choice
 * @property string $label
 * @property int $pointer
 * @property string $created_at
 *
 * @property Questions $question
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'state', 'choice', 'label', 'pointer'], 'required'],
            [['question_id', 'pointer'], 'integer'],
            [['created_at'], 'safe'],
            [['state', 'choice', 'label'], 'string', 'max' => 256],
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
            'question_id' => 'Question ID',
            'state' => 'State',
            'choice' => 'Choice',
            'label' => 'Label',
            'pointer' => 'Pointer',
            'created_at' => 'Created At',
        ];
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
     * @return OptionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OptionsQuery(get_called_class());
    }
}

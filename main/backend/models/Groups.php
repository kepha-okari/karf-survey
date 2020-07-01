<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%groups}}".
 *
 * @property int $id
 * @property int $survey_id
 * @property string $name
 * @property string $inserted_at
 *
 * @property Contacts[] $contacts
 * @property Surveys $survey
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%groups}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['survey_id', 'name'], 'required'],
            [['survey_id'], 'integer'],
            [['inserted_at'], 'safe'],
            [['name'], 'string', 'max' => 20],
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
            'name' => 'Name',
            'inserted_at' => 'Inserted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['group_id' => 'id']);
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
     * @return GroupsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GroupsQuery(get_called_class());
    }
}

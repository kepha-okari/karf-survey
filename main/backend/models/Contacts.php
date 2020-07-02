<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%contacts}}".
 *
 * @property int $id
 * @property string $contact
 * @property int $group_id
 * @property string $inserted_at
 *
 * @property Groups $group
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contacts}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact', 'group_id'], 'required'],
            [['group_id'], 'integer'],
            [['inserted_at'], 'safe'],
            [['contact'], 'string', 'max' => 20],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contact' => 'Contact',
            'group_id' => 'Contact Group',
            'inserted_at' => 'Inserted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'group_id']);
    }

    /**
     * {@inheritdoc}
     * @return ContactsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactsQuery(get_called_class());
    }
}

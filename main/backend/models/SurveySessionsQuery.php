<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[SurveySessions]].
 *
 * @see SurveySessions
 */
class SurveySessionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SurveySessions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SurveySessions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

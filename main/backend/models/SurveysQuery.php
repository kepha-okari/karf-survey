<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Surveys]].
 *
 * @see Surveys
 */
class SurveysQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Surveys[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Surveys|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

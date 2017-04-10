<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[GameEstimate]].
 *
 * @see GameEstimate
 */
class GameEstimateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return GameEstimate[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GameEstimate|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

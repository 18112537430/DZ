<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[GameUnhitsHistory]].
 *
 * @see GameUnhitsHistory
 */
class GameUnhitsHistoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return GameUnhitsHistory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GameUnhitsHistory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}

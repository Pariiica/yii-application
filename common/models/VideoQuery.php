<?php

namespace common\models;

use common\dictionaries\Status;

/**
 * This is the ActiveQuery class for [[Video]].
 *
 * @see Video
 */
class VideoQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => Status::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     * @return Video[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Video|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

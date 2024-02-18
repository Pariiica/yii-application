<?php

namespace api\models;

use common\dictionaries\Status;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class VideoSearch extends Video
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category', 'status', 'type', 'title'], 'integer'],];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Video::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
//             uncomment the following line if you do not want to return any records when validation fails
//             $query->where('0=1');
            return $dataProvider;
        }

        if ($this->category) {
            $query->andWhere(['category' => $this->category]);
        }

        if ($this->status = Status::STATUS_ACTIVE) {
            $query->andWhere(['status' => $this->status]);
        }

        if ($this->title) {
            $query->andWhere(['like', 'title', $this->title]);
        }
        if ($this->type) {
            $query->andWhere(['type' => $this->type]);
        }

        return $dataProvider;
    }
}
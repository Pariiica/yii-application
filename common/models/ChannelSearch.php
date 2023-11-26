<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Channel;

/**
 * ChannelSearch represents the model behind the search form of `common\models\Channel`.
 */
class ChannelSearch extends Channel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'status', 'created_at', 'updated_at', 'last_post_at', 'verified', 'user_id', 'pinned_video_id', 'paid'], 'integer'],
            [['did', 'username', 'title', 'description', 'image', 'cover', 'tags', 'addresses', 'config'], 'safe'],
        ];
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
        $query = Channel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'last_post_at' => $this->last_post_at,
            'verified' => $this->verified,
            'user_id' => $this->user_id,
            'pinned_video_id' => $this->pinned_video_id,
            'paid' => $this->paid,
        ]);

        $query->andFilterWhere(['like', 'did', $this->did])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'cover', $this->cover])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'addresses', $this->addresses])
            ->andFilterWhere(['like', 'config', $this->config]);

        return $dataProvider;
    }
}

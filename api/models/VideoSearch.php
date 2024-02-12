<?php

namespace api\models;

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
            [['id', 'type', 'status', 'permission', 'file_status', 'created_at', 'updated_at', 'published_at', 'via', 'length', 'config', 'channel_id', 'user_id'], 'integer'],
            [['did', 'title', 'description', 'slug', 'image', 'tags', 'location', 'manifest', 'address', 'source', 'file_service_id'], 'safe'],
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
        $query = Video::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, '');

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
            'permission' => $this->permission,
            'file_status' => $this->file_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'published_at' => $this->published_at,
            'via' => $this->via,
            'length' => $this->length,
            'config' => $this->config,
            'channel_id' => $this->channel_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'did', $this->did])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'manifest', $this->manifest])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'file_service_id', $this->file_service_id]);

        return $dataProvider;
    }
}
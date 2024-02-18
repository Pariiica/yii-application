<?php

namespace api\models;

class Video extends \common\models\Video
{
    public function fields()
    {
        return [
            'id' => 'did',
            'title',
            'description',
            'image',
            'status',
            'type',
            'created_at',
            'tags',
            'user_id',
            'channel_id'
        ];
    }
}
<?php

namespace api\models;

class Video extends \common\models\Video
{
    public function fields()
    {
        return ['id', 'title', 'description', 'image', 'status', 'created_at', 'tags', 'user_id', 'channel_id'];
    }
}
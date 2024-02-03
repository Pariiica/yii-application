<?php

namespace app\widgets;

use InvalidArgumentException;
use yii\base\Widget;

class Comment extends Widget
{
    public $video;
    public $channel;
    public $comments;

    public function run()
    {
        if ($this->video === null) {
            throw new InvalidArgumentException('The "video" property must be set in the Comment widget.');
        }

        return $this->render('comment', [
            'video' => $this->video,
            'channel' => $this->channel,
            'comments' => $this->comments,
        ]);
    }
}
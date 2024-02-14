<?php

namespace frontend\controllers;

use common\models\Channel;
use common\models\Playlist;
use yii\web\Controller;

class PlaylistController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionView($id)
    {
        $channel = Channel::findOne($id);
        $playlists = Playlist::find()->where(['channel_id' => $channel->id])->all();

        return $this->render('view', [
            'channel' =>$channel,
            'playlists' =>$playlists,
        ]);
    }
}
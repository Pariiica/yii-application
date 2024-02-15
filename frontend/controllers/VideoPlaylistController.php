<?php

namespace frontend\controllers;

use common\models\VideoPlaylist;
use yii\web\Controller;

class VideoPlaylistController extends Controller
{
    public function actionView($id)
    {
        $videoPlaylist = VideoPlaylist::findOne($id);
        $videos = $videoPlaylist->videos();

        return $this->render('index', [
            'videoPlaylist' => $videoPlaylist,
            'videos' => $videos
            ]);
    }
}
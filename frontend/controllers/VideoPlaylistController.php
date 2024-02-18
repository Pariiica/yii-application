<?php

namespace frontend\controllers;

use common\models\VideoPlaylist;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class VideoPlaylistController extends Controller
{
    public function actionView($id)
    {
        $videoPlaylist = $this->findModel($id);
        $playlist = $videoPlaylist->playlist;
        $video = $videoPlaylist->video;

        return $this->render('view', [
            'videoPlaylist' => $videoPlaylist,
            'playlist' => $playlist,
            'video' => $video
        ]);
    }


    public function findModel($id)
    {
        if (($model = VideoPlaylist::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested playlist does not exist.'));
    }


}
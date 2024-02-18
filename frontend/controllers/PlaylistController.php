<?php

namespace frontend\controllers;

use common\models\Channel;
use common\models\Playlist;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PlaylistController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionView($id)
    {
        $playlist = $this->findModel($id);
        $channel = Channel::find()->where(['channel_id' => $playlist->id]);
        $playlists = Playlist::find()->where(['channel_id' => $playlist->id])->all();

        return $this->render('view', [
            'playlist' => $playlist,
            'channel' =>$channel,
            'playlists' =>$playlists,
        ]);
    }

    public function findModel($id)
    {
        if (($model = Playlist::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested playlist does not exist.'));
    }
}
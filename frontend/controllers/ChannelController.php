<?php

namespace frontend\controllers;

use common\models\Channel;
use common\models\Video;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ChannelController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id) //model relations
    {
        $channel = $this->findModel($id);
        $videos = $channel->videos;
        return $this->render('view', [
            'channel' =>$channel,
            'videos' => $videos,
        ]);
    }

    public function findModel($id)
    {
        if (($model = Channel::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

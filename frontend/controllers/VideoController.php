<?php

namespace frontend\controllers;

use common\models\Video;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class VideoController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionView($id)
    {
        $video = $this->findModel($id);
        $videos = Video::find()->where(['category' => $video->category])->andWhere(['not', ['id' => $video->id]])->limit(5)->all();
        return $this->render('view', [
            'videos' => $videos,
            'video' => $video,
        ]);

    }
    public function findModel($id)
    {
        if (($video = Video::findOne(['id' => $id])) !== null) {
            return $video;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
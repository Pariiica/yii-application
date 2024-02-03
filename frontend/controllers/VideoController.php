<?php

namespace frontend\controllers;

use app\models\User;
use common\models\Comment;
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
        $comment = new Comment();
        $comments = Comment::find()->where(['video_id' => $comment->video_id])->limit(3)->all();

        return $this->render('view', [
            'videos' => $videos,
            'video' => $video,
            'comments' => $comments,
        ]);

    }
    public function findModel($id)
    {
        if (($model = Video::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
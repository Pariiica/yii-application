<?php

namespace frontend\controllers;

use common\models\Comment;
use common\models\Video;
use Yii;
use yii\web\Controller;

class CommentController extends Controller
{
    public function behaviors()
    {

        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $comment = new Comment();

        if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
            echo 'Comment saved successfully';
        } else {
            echo 'There was an error saving the comment';
        }
        return $this->redirect(['/video/view', 'id' => $comment->video_id]);
    }
}
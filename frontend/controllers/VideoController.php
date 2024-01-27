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
        $model = $this->findModel($id);
        $models = Video::find()->where(['category' => $model->category])->andWhere(['not', ['id' => $model->id]])->limit(5)->all();
        return $this->render('view', [
            'models' => $models,
            'model' => $model
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
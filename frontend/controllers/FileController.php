<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class FileController extends Controller
{
    public function actionImage($path)
    {
        $filePath = Yii::getAlias('@backend/web/img/' . $path);
        return $this->response->sendFile($filePath);
    }
}
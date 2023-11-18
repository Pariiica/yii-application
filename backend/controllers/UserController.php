<?php

namespace backend\controllers;

class UserController extends \yii\web\Controller // id = user
{
    public function actionIndex() // id = index
    {
        return $this->render('index');
    }

}

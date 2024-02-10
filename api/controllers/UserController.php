<?php

namespace api\controllers;


use common\models\UserSearch;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new UserSearch();
        return $searchModel->search(\Yii::$app->request->queryParams);
    }
}

<?php

namespace api\controllers;

use api\models\UserSearch;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    public $modelClass = 'api\models\User';

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

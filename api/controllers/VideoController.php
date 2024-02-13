<?php

namespace api\controllers;

use api\models\VideoSearch;
use yii\rest\ActiveController;

class VideoController extends ActiveController
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    public $modelClass = 'api\models\video';

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new VideoSearch;
        return $searchModel->search(\Yii::$app->request->queryParams);
    }
}
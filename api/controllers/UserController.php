<?php

namespace api\controllers;


use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'api\models\User';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = parent::actions();

        // Customize the data provider preparation with the "prepareDataProvider()" method.
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];


        return $actions;
    }

    public function prepareDataProvider()
    {

    }
}

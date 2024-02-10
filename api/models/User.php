<?php

namespace api\models;
use yii\behaviors\TimestampBehavior;

class User extends \common\models\User
{
    public function fields()
    {
        return ['id', 'username', 'email','created_at','updated_at'];
    }

}
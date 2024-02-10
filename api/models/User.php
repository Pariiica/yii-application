<?php

namespace api\models;

class User extends \common\models\User
{
    public function fields()
    {
        return ['id', 'username', 'email','created_at','updated_at'];
    }

}

<?php

namespace api\models;

class User extends \common\models\User
{
    public function fields()
    {
        return ['id', 'username', 'first_name', 'last_name', 'status', 'email','created_at','birthday'];
    }

}

<?php

namespace App\Entities\APIv1;

use CodeIgniter\Entity\Entity;

class UsersEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    protected function setPassword(String $password){
        $this->attributes['password']=password_hash($password,PASSWORD_DEFAULT);
    }


}




?>

<?php

namespace App\Controllers\APIv1;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;

class User extends BaseController
{
    use ResponseTrait;
     
    public function getIndex()
    {
        $users = new UserModel;
        return $this->respond(['users' => $users->findAll()], 200);
    }
    
}

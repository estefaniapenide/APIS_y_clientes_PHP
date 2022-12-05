<?php

namespace App\Controllers\APIv3;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;

class Register extends BaseController
{
    use ResponseTrait; 

    public function postIndex()
    {
        $rules = [
            'username' => ['rules' => 'required|is_unique[users.username]'],
            'password' => ['rules' => 'required'],
            'group' => ['rules' => 'required|integer'],
            'confirm_password'  => [ 'label' => 'confirm password', 'rules' => 'matches[password]']
        ];
            
  
        if($this->validate($rules)){
            $model = new UsersModel();
            $data = [
                'username'    => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'group'    => $this->request->getVar('group')
            ];
            $model->save($data);
             
            return $this->respond(['message' => 'Registered Successfully'], 200);
        }else{
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response , 409);
             
        }
    }
}

<?php

namespace App\Controllers\APIv3;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;
use \Firebase\JWT\JWT;

class Login extends BaseController
{
    use ResponseTrait; 

    public function postIndex()
    {
        $userModel = new UsersModel();
   
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
           
        $user = $userModel->where('username', $username)->first();
   
        if(is_null($user)) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }
   
        $pwd_verify = password_verify($password, $user['password']);
   
        if(!$pwd_verify) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }
  
        $key = getenv('JWT_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;
  
        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "username" => $user['username'],
            //"password" => $user['password']
             "group" => $user['group']
        );
          
        $token = JWT::encode($payload, $key, 'HS256');
  
        $response = [
            'message' => 'Login Succesful',
            'token' => $token
        ];
          
        return $this->respond($response, 200);
    }

/*     public function logout(){
        $userModel = new UserModel();
   
        $username = $this->request->getVar('username');

        $user = $userModel->where('username', $username)->first();
   
        if(is_null($user)) {
            return $this->respond(['error' => 'Invalid username'], 401);
        }

        $key = getenv('JWT_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat; //Expira al momento de crearse.
  
        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "username" => $user['username'],
        );
          
        $token = JWT::encode($payload, $key, 'HS256');
  
        $response = [
            'message' => 'Logout Succesful',
            'token' => $token
        ];
          
        return $this->respond($response, 200);

    } */
}

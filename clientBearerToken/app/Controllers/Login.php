<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Exceptions\HTTPException;
use Config\Services;


class Login extends BaseController
{
    public static $token='Hola';

    public function index()
    {
        return view('login');
    }

    public function login()
    {

        $data=$this->request->getPost();

        try{ 
  
        $client = Services::curlrequest();
         
        $response = $client->request('POST', 'http://apis.test/APIv3/login',['form_params' => $data]); 
        
        $login= (array) json_decode($response->getBody());
        $code=$response->getStatusCode();


        if($code=='200'){
          //session_start();
          
          $t=$login['token'];
          session()->set(array('login.token' => $t));
           
          return redirect()->to(base_url(route_to('ventas')));
        
        }else{
          return redirect()->to(base_url(route_to('/')));
        }     
     }catch(HTTPException $e){
         //$estado=$e->getMessage();
        return redirect()->to(base_url(route_to('/')));
          
      }

    }

    public function logout(){
      session()->set(array('login.token' => ''));
      //session_destroy();
      
      return view('login');
    }
}
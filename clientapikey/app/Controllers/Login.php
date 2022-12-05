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
         
        $response = $client->request('POST', 'http://apis.test/APIv4/login',['form_params' => $data]); 

        
        
        $login= (array) json_decode($response->getBody());
        $code=$response->getStatusCode();


        if($code=='200'){
          //session_start();
          $apikey=$login['api_key'];
          $k=$apikey->clave;
          $v=$apikey->valor;;
          session()->set(array('apikey.clave' => $k));
          session()->set(array('apikey.valor' => $v));
           
          return redirect()->to(base_url(route_to('ventas')));
        
        }else{
          //var_dump(print_r($response));
          return redirect()->to(base_url(route_to('/'))); 
        }  
        }catch(HTTPException $e){
         //$e->getMessage();
         //var_dump(print_r($e));
        return redirect()->to(base_url(route_to('/')));
          
      } 

    }

    public function logout(){
      session()->set(array('apikey.clave' => ''));
      session()->set(array('apikey.valor' => ''));
      //session_destroy();
      
      return view('login');
    }
}
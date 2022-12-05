<?php

namespace App\Filters\APIv1;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class BasicAuthUsers implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        
      /*  if (empty($_SERVER['PHP_AUTH_USER'])) {
            
            $response = service('response');
                        $response->setBody('Usuario y contraseña obligatorios');
                        $response->setStatusCode(401);
                        return $response;
        
        }else{  */

            //$user=$_SERVER['PHP_AUTH_USER'];
            //$password=$_SERVER['PHP_AUTH_PW'];

        $header = $request->getHeader("Authorization");
   
        $token = null;
  
        // extract the token from the header
        if(!empty($header)) {
            if (preg_match('/Basic\s(\S+)/', $header, $matches)) {
                $token = $matches[1];
            }
        }
  
        // check if token is null or empty
        if(is_null($token) || empty($token)) {
            $response = service('response');
            $response->setBody('Acceso denegado - Usuario y contraseña obligatorios');
            $response->setStatusCode(401);
            return $response;
        }

            $decoded = base64_decode($token);
            $array=explode(":", $decoded);
             $user=$array[0];
             $password=$array[1];
          
            $model=model('UsersModel');
            $data=$model->getUserBy('username',$user); 
            
            if($data!=null){
                $u=$data['username'];
                $g=$data['group'];
                $p=$data['password'];

            
                if(($g==1)||($g==2)){
                    
                    if($u==$user && password_verify($password,$p)){
                         //entra y funciona  
                    }else{
                        $response = service('response');
                        $response->setBody('Acceso denegado - Usuario o contraseña incorrecta');
                        $response->setStatusCode(401);
                        return $response;
                    }
                }else{
                    
                    $response = service('response');
                    $response->setBody('Acceso denegado');
                    $response->setStatusCode(401);
                    return $response;
                }
            
   /*          }else{
                
                $response = service('response');
                $response->setBody('Access denied- No existe ese usuario');
                $response->setStatusCode(401);
                return $response;
            } */
            
           
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
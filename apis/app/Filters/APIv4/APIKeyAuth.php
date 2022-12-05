<?php

namespace App\Filters\APIv4;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class APIKeyAuth implements FilterInterface
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

        try{
            $apikey = getenv('API_KEY_VALOR');
            $header = $request->getHeader(getenv('API_KEY_CLAVE'));
            $key=null;

            if(!empty($header)) {
                if (preg_match('/\s(\S+)/', $header, $matches)) {
                    $key = $matches[1];
                }
            }
                
            if(is_null($key) || empty($key) || ($key!=$apikey)) {
                    $response = service('response');
                    $response->setBody('Acceso denegado');
                    $response->setStatusCode(401);
                    return $response;
            }


        } catch (Exception $ex) {
            $response = service('response');
            $response->setBody('Acceso denegado');
            $response->setStatusCode(401);
            return $response;
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

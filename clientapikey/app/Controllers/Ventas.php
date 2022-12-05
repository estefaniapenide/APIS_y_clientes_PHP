<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Exceptions\HTTPException;
use App\Controllers\Login;
use Config\Services;


class Ventas extends BaseController
{
    
    public function index()
    {
        $ventas=null;
        $estado=null;
        return view('fVentas',['ventas' => $ventas,'estado'=>$estado]);
    }

    public function consultarVentas()
    {
        $k=session()->get('apikey.clave');
        $v=session()->get('apikey.valor');
        $headers[$k]=$v;
        $options['headers']=$headers;

        try{
            $estado=null;
            $ventas=null;
            $client = Services::curlrequest();

            $data=$this->request->getPost();

            if($data['id']==null){
                $response = $client->request('GET', 'http://apis.test/APIv4/ventas/todasVentas',$options);
                $ventas= (array) json_decode($response->getBody());
     
            }else{
                //En no s econtrola que el id introcido sea un int. En caso de entrar otra cosa saltará error del servidor 500 porque alli tampoco
                //se ha especificado que es de tipo 400 (bad request al no ser el tipo correcto) o 404 (not found ya que no existe).
                $response = $client->request('GET', 'http://apis.test/APIv4/ventas/ventasBy/ventas_id/'.$data['id'],$options);
                $ventas= (array) json_decode($response->getBody());
            }
        }catch(HTTPException $e){
            $estado=$e->getMessage();
      
       }finally{
           return view('fVentas',['ventas' => $ventas,'estado'=>$estado]);
       }
    }

    
    public function ventasEmpresa()
    {
        $ventas=null;
        $estado=null;
        return view('fVentasEmpresa',['ventas' => $ventas,'estado'=>$estado]);
    }


     public function consultarPorEmpresa()
    {
        /* $k=session()->get('apikey.clave');
        $v=session()->get('apikey.valor');
        $headers[$k]=$v;
        $options['headers']=$headers; */
        
         $data=$this->request->getPost();

      try{ 
        $ventas=null; 
        $estado=null;    
        $client = Services::curlrequest();
        $k=session()->get('apikey.clave');
        $v=session()->get('apikey.valor');
        $client->appendHeader($k,$v);


        if(!($data['from']==null && $data['to']==null)){      
            if($data['from']==null){
                $response = $client->request('POST', 'http://apis.test/APIv4/ventas/ventasPorEmpresa',['form_params' => ['to'=>$data['to']]]);
            }elseif($data['to']==null){
                $response = $client->request('POST', 'http://apis.test/APIv4/ventas/ventasPorEmpresa',['form_params' => ['from'=>$data['from']]]);
            }else{
                $response = $client->request('POST', 'http://apis.test/APIv4/ventas/ventasPorEmpresa',['form_params' => $data]);
            }
        }else{
            $response = $client->request('POST', 'http://apis.test/APIv4/ventas/ventasPorEmpresa',$options);
        }

        $ventas= (array) json_decode($response->getBody());

    }catch(HTTPException $e){
        $estado=$e->getMessage();
        
      }finally{
         
        return view('fVentasEmpresa',['ventas' => $ventas,'estado' => $estado]);
      }  
       
    } 


    public function ventasFabrica()
    {
        $ventas=null;
        $estado=null;
        return view('fVentasFabrica',['ventas' => $ventas,'estado'=>$estado]);
    }


    public function consultarPorFabrica()
    {
        
        $data=$this->request->getPost();
    
        try{ 
            $ventas=null;
            $estado=null;
            
            $client = Services::curlrequest();
            $k=session()->get('apikey.clave');
            $v=session()->get('apikey.valor');
            $client->appendHeader($k,$v);
            
            $response = $client->request('POST', 'http://apis.test/APIv4/ventas/ventasPorFabrica',['json' => $data]);
            $ventas= (array) json_decode($response->getBody());
            

    }catch(HTTPException $e){
       $estado=$e->getMessage();
        
      }finally{
     return view('fVentasFabrica',['ventas' => $ventas,'estado'=>$estado]);
      }
    }

    

    public function ventasCentro()
    {
        $ventas=null;
        $estado=null;
        $errors[]=null;
        return view('fVentasCentro',['ventas' => $ventas,'estado'=>$estado,'errors'=>$errors]);
    }

    public function consultarPorCentro()
    {
       
        $ventas=null;
        $estado=null;
        $errors[]=null;
        $data=$this->request->getPost();

        $validation = service('validation');
        $validation->setRules([
            'from'=> 'permit_empty|integer',
            'to'=> 'permit_empty|integer'
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return view('fVentasCentro',['errors' => $validation->getErrors(),'estado' => $estado,'ventas'=>$ventas]);
        }  

        try{ 

            $client = Services::curlrequest();
            $k=session()->get('apikey.clave');
            $v=session()->get('apikey.valor');
            $client->appendHeader($k,$v);
            
            //El método de la API sólo acepta ints o valores vacíos., por lo que hay que convertir los datos a ints.
            //Es imprescindible hacer una validación previa porque al hacer el casting así, si son strings los convertirá a cero.
            $response = $client->request('POST', 'http://apis.test/APIv4/ventas/ventasPorCentro',['json' => ['from'=>(int)$data['from'],'to'=>(int)$data['to']]]);
            $ventas= (array) json_decode($response->getBody());

        }catch(HTTPException $e){
            $estado=$e->getMessage();
        
        }finally{
       
            return view('fVentasCentro',['ventas' => $ventas,'estado'=>$estado,'errors'=>$errors]);
        }
    }

    public function ventasCliente()
    {
        $ventas=null;
        $estado=null;
        $errors[]=null;
        return view('fVentasCliente',['ventas' => $ventas,'estado'=>$estado,'errors'=>$errors]);
    }

    public function consultarPorCliente()
    {
        
        $ventas=null;
        $estado=null;
        $errors[]=null;
        $data=$this->request->getPost();

        $validation = service('validation');
        $validation->setRules([
            'from'=> 'permit_empty|integer',
            'to'=> 'permit_empty|integer'
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return view('fVentasCliente',['errors' => $validation->getErrors(),'estado' => $estado,'ventas'=>$ventas]);
        }  

        try{ 

            $client = Services::curlrequest();
            $k=session()->get('apikey.clave');
            $v=session()->get('apikey.valor');
            $client->appendHeader($k,$v);
            
            //El método de la API sólo acepta ints o valores vacíos., por lo que hay que convertir los datos a ints.
            //Es imprescindible hacer una validación previa porque al hacer el casting así, si son strings los convertirá a cero.
            $response = $client->request('POST', 'http://apis.test/APIv4/ventas/ventasPorCliente',['json' => ['from'=>(int)$data['from'],'to'=>(int)$data['to']]]);
            $ventas= (array) json_decode($response->getBody());

        }catch(HTTPException $e){
            $estado=$e->getMessage();
        
        }finally{
       
            return view('fVentasCliente',['ventas' => $ventas,'estado'=>$estado,'errors'=>$errors]);
        }
    }

    public function ventasMaterial()
    {
        $ventas=null;
        $estado=null;
        $errors[]=null;
        return view('fVentasMaterial',['ventas' => $ventas,'estado'=>$estado,'errors'=>$errors]);
    }

    public function consultarPorMaterial()
    {
       
        $ventas=null;
        $estado=null;
        $errors[]=null;
        $data=$this->request->getPost();

        $validation = service('validation');
        $validation->setRules([
            'from'=> 'permit_empty|integer',
            'to'=> 'permit_empty|integer'
        ]);

        if(!$validation->withRequest($this->request)->run()){
            return view('fVentasMaterial',['errors' => $validation->getErrors(),'estado' => $estado,'ventas'=>$ventas]);
        }  

        try{ 

            $client = Services::curlrequest();
            $k=session()->get('apikey.clave');
            $v=session()->get('apikey.valor');
            $client->appendHeader($k,$v);
            
            //El método de la API sólo acepta ints o valores vacíos., por lo que hay que convertir los datos a ints.
            //Es imprescindible hacer una validación previa porque al hacer el casting así, si son strings los convertirá a cero.
            $response = $client->request('POST', 'http://apis.test/APIv4/ventas/ventasPorMaterial',['json' => ['from'=>(int)$data['from'],'to'=>(int)$data['to']]]);
            $ventas= (array) json_decode($response->getBody());

        }catch(HTTPException $e){
            $estado=$e->getMessage();
        
        }finally{
        
            return view('fVentasMaterial',['ventas' => $ventas,'estado'=>$estado,'errors'=>$errors]);
        }
    }

    public function modificar()
    {  
        $estado=null;
        $errors=null;
        return view('fVentasModificarCantidad',['estado' => $estado,'errors'=>$errors]);   
    }


    public function modificarCantidad()
    {
        
        $estado=null;
        $errors=null;

        $validation = service('validation');
        $validation->setRules([
            'id'=> 'required|integer',
            'cantidad'=> 'required|integer'
        ]);

        if(!$validation->withRequest($this->request)->run()){
            //return redirect()->back()->withInput()->with('errors',$validation->getErrors());
            return view('fVentasModificarCantidad',['errors' => $validation->getErrors(),'estado' => $estado]);
        }  
        
        $data=$this->request->getPost();
        
        try{
            $client = Services::curlrequest();
            $k=session()->get('apikey.clave');
            $v=session()->get('apikey.valor');
            $client->appendHeader($k,$v);

                //Tanto el id como la cantidad es requerido en la API que sean ints, por lo que al hacer el casting así, si son strings los convertirá a cero,
                //por lo que es imprescindible la validación anterior.
                $response = $client->request('PUT', 'http://apis.test/APIv4/ventas/modificarCantidadVenta/'.(int)$data['id'],['json' => ['ventas_cantidad' => (int)$data['cantidad']]]);

                $estado= $response->getStatusCode();

        }catch(HTTPException $e){
            $estado=$e->getMessage();
            
        }finally{
                
                return view('fVentasModificarCantidad',['errors' => $errors,'estado' => $estado]);
        } 
        
    }

    public function eliminar()
    {  
        $estado=null;
        $errors[]=null;
        return view('fVentasEliminarRegistro',['estado' => $estado,'errors'=>$errors]);   
    }


    public function eliminarRegistro()
    {
        
        $estado=null;
        $errors[]=null;

      $validation = service('validation');
        $validation->setRules([
            'id'=> 'required|integer',
        ]);

        if(!$validation->withRequest($this->request)->run()){
            //return redirect()->back()->withInput()->with('errors',$validation->getErrors());
            return view('fVentasEliminarRegistro',['errors' => $validation->getErrors(),'estado' => $estado]);
        }  
        
        $data=$this->request->getPost();
        
       try{
            $client = Services::curlrequest();
            $k=session()->get('apikey.clave');
            $v=session()->get('apikey.valor');
            $client->appendHeader($k,$v);

            //Tanto el id como la cantidad es requerido en la API que sean ints, por lo que al hacer el casting así, si son strings los convertirá a cero,
            //por lo que es imprescindible la validación anterior.
            $response = $client->request('DELETE', 'http://apis.test/APIv4/ventas/eliminarRegistroVenta/'.(int)$data['id']);

            $estado= $response->getStatusCode();

          }catch(HTTPException $e){
           $estado=$e->getMessage();
           
         }finally{
            
            return view('fVentasEliminarRegistro',['errors' => $errors,'estado' => $estado]);
         } 
        
    }
}
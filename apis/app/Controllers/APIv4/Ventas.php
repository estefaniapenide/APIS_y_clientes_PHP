<?php

namespace App\Controllers\APIv4;

//use App\Controllers\BaseController;
use CodeIgniter\RESTful\BaseResource;
use CodeIgniter\API\ResponseTrait;
use App\Models\VentasModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Ventas extends BaseResource
{
    use ResponseTrait;

    public function getTodasVentas()
    {
        $model= new VentasModel();
        $data=$model->findAll();
        return $this->respond($data,200);
    }
    
    public function getVentasBy($campo=null,$valor=null)
    {
   
        $model= new VentasModel();
        //No controlo que se metan campos correctos
        $data=$model->ventasBy($campo,$valor);
        return $this->respond($data,200);
       
    }

    public function postVentasPorEmpresa()
    {
        $model= new VentasModel();

       $data = [
            'from' => $this->request->getPost('from'),
            'to' => $this->request->getPost('to')
        ]; 
        //Con getPost no encuentro forma de asegurarme de que lo que se pasa al modelo sean integers
        //(si los casteo a int se convertirán en cero si antes eran un string).
        //Es ya en el modelo donde no dejo pasar algo no sea int, pero el error que devolverá será genérico (500)
        $result=$model->ventasPorEmpresa($data['from'],$data['to']);
        return $this->respond($result,200);
    } 

    
    public function postVentasPorFabrica()
    {
        $model= new VentasModel();


        $input = $this->request->getJSON();

        //Al no hacer ningún control de tipos devolverá error de servidor genérico
      if(!empty($input->from)){
            $data['from']=$input->from;
        }else{
            $data['from']=null;
        }

        if(!empty($input->to)){
            $data['to']=$input->to;
        }else{
            $data['to']=null;
        } 
        
        $data=$model->ventasPorFabrica($data['from'],$data['to']);
        return $this->respond($data,200);

    }

    public function postVentasPorCentro()
    {
        $model= new VentasModel();


        $input = $this->request->getJSON();

            //Hay control de tipos, asi que si se pasa algo que no sea un int o un valor vacío devoloverá el error 400
            if(empty($input->from)){
                $data['from']=null;
            }elseif((gettype($input->from))=='integer'){
                $data['from']=$input->from;
            }else{
                return $this->fail('Incorrect type',400);
            }

            if(empty($input->to)){
                $data['to']=null;
            }elseif((gettype($input->to))=='integer'){
                $data['to']=$input->to;
            }else{
                return $this->fail('Incorrect type',400);
            }
            
            $data=$model->ventasPorCentro($data['from'],$data['to']);
            return $this->respond($data,200);
       
    }

    public function postVentasPorCliente()
    {
        $model= new VentasModel();


        $input = $this->request->getJSON();
         //Hay control de tipos, asi que si se pasa algo que no sea un int o un valor vacío devoloverá el error 400
         if(empty($input->from)){
            $data['from']=null;
        }elseif((gettype($input->from))=='integer'){
            $data['from']=$input->from;
        }else{
            return $this->fail('Incorrect type',400);
        }

        if(empty($input->to)){
            $data['to']=null;
        }elseif((gettype($input->to))=='integer'){
            $data['to']=$input->to;
        }else{
            return $this->fail('Incorrect type',400);
        }
        
        $data=$model->ventasPorCliente($data['from'],$data['to']);
        return $this->respond($data,200);
    }

    public function postVentasPorMaterial()
    {
        $model= new VentasModel();


        $input = $this->request->getJSON();
         //Hay control de tipos, asi que si se pasa algo que no sea un int o un valor vacío devoloverá el error 400
         if(empty($input->from)){
            $data['from']=null;
        }elseif((gettype($input->from))=='integer'){
            $data['from']=$input->from;
        }else{
            return $this->fail('Incorrect type',400);
        }

        if(empty($input->to)){
            $data['to']=null;
        }elseif((gettype($input->to))=='integer'){
            $data['to']=$input->to;
        }else{
            return $this->fail('Incorrect type',400);
        }
        
        $data=$model->ventasPorMaterial($data['from'],$data['to']);
        return $this->respond($data,200);
    }

    
    public function putModificarCantidadVenta(int $id=null){
        $model = new VentasModel();
    
        
        $idVenta = $model->find($id);

        if($idVenta){

            $input = $this->request->getJSON();
            if($input){
                $data = [
                    'ventas_cantidad' => $input->ventas_cantidad
                ];
            }else{
                $input = $this->request->getRawInput();
                $data = [
                    'ventas_cantidad' => $input['ventas_cantidad']
                ];
            }  
            
            if((gettype($data['ventas_cantidad']))=='integer'){
                $model->update($id, $data);
                $response = [
                    'status'   => 200,
                    'error'    => null,
                    'messages' => [
                        'success' => 'Data Updated'
                    ]
                ];
                return $this->respondUpdated($response);
            
            }else{
                return $this->fail('Incorrect Type',400);
            }     

        }else{

            return $this->failNotFound('No Data Found with id '.$id);
        }

    
        
    }

    public function deleteEliminarRegistroVenta(int $id = null)
    {
        $model = new VentasModel();
        $idVenta = $model->find($id);
        if($idVenta){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }    
    }


}

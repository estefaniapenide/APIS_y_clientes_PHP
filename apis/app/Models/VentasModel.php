<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'crm_ventas';
    protected $primaryKey       = 'ventas_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ventas_cantidad'];

    // Dates
    /* protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at'; */

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function ventasBy($campo=null,$valor=null){
        $builder=$this->builder();
        $builder->select('*');
        if($valor!=null){
            $builder->where($campo.'='.$valor);
        }
        $query=$builder->get()->getResultArray();

        return $query;
    }


    public function ventasPorEmpresa(int $from=null,int $to=null){
        $builder=$this->builder();
        $builder->select('DISTINCT(ventas_idempresa),SUM(ventas_cantidad) AS ventas_cantidad, (SELECT ventas_empresa FROM crm_ventas as cr
        WHERE cr.ventas_idempresa = crm_ventas.ventas_idempresa 
        ORDER BY ventas_año desc, ventas_mes desc
        LIMIT 1) AS ventas_empresa');
       if($from != null){
            $builder->where('ventas_año >=',$from);
        }
        if($to !=null){
            $builder->where('ventas_año <=',$to);
        }
        $builder->groupby('ventas_idempresa');
        $query=$builder->get()->getResultArray();

        return $query;
    } 


    public function ventasPorFabrica(int $from=null, int $to=null){
        $builder=$this->builder();
        $builder->select('DISTINCT(ventas_idfabrica),SUM(ventas_cantidad) AS ventas_cantidad, (SELECT ventas_fabrica FROM crm_ventas as cr
        WHERE crm_ventas.ventas_idfabrica = cr.ventas_idfabrica
        ORDER BY ventas_año desc, ventas_mes desc
        LIMIT 1) AS ventas_fabrica');
        if($from != null){
            $builder->where('ventas_año >=',$from);
        }
        if($to !=null){
            $builder->where('ventas_año <=',$to);
        }
        $builder->groupby('ventas_idfabrica');
        $query=$builder->get()->getResultArray();


        return $query;
    }


    public function ventasPorCentro(int $from=null, int $to=null){
        $builder=$this->builder();
        $builder->select('DISTINCT(ventas_idcentro),SUM(ventas_cantidad) AS ventas_cantidad, (SELECT ventas_centro FROM crm_ventas as cr
        WHERE crm_ventas.ventas_idcentro = cr.ventas_idcentro
        ORDER BY ventas_año desc, ventas_mes desc
        LIMIT 1) AS ventas_centro');
        if($from != null){
            $builder->where('ventas_año >=',$from);
        }
        if($to !=null){
            $builder->where('ventas_año <=',$to);
        }
        $builder->groupby('ventas_idcentro');
        $query=$builder->get()->getResultArray();

        return $query;
    }


    public function ventasPorCliente(int $from=null, int $to=null){
        $builder=$this->builder();
        $builder->distinct();
        $builder->select('DISTINCT(ventas_idcliente),SUM(ventas_cantidad) AS ventas_cantidad, (SELECT ventas_cliente FROM crm_ventas as cr
        WHERE crm_ventas.ventas_idcliente = cr.ventas_idcliente
        ORDER BY ventas_año desc, ventas_mes desc
        LIMIT 1) AS ventas_cliente');
        if($from != null){
            $builder->where('ventas_año >=',$from);
        }
        if($to !=null){
            $builder->where('ventas_año <=',$to);
        }
        $builder->groupby('ventas_idcliente');
        $query=$builder->get()->getResultArray();

        return $query;
    }

    public function ventasPorMaterial(int $from=null, int $to=null){
        $builder=$this->builder();
        $builder->distinct();
        $builder->select('DISTINCT(ventas_idmaterial),SUM(ventas_cantidad) AS ventas_cantidad, (SELECT ventas_material FROM crm_ventas as cr
        WHERE crm_ventas.ventas_idmaterial = cr.ventas_idmaterial
        ORDER BY ventas_año desc, ventas_mes desc
        LIMIT 1) AS ventas_material');
        if($from != null){
            $builder->where('ventas_año >=',$from);
        }
        if($to !=null){
            $builder->where('ventas_año <=',$to);
        }
        $builder->groupby('ventas_idmaterial');
        $query=$builder->get()->getResultArray();

        return $query;
    }

}

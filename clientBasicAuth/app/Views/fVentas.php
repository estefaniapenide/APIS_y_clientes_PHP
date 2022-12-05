<?=$this->extend('layout/main')?> 

<?= $this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<?= $this->endSection()?>

<?= $this->section('title')?>
Consultas
<?= $this->endSection()?>

<?= $this->section('content')?>
<section class="section">
<?php if($estado):?>
    <div class="container">
        <div class="notification is-danger">
        No es posible realizar la consulta solicitada. Error <?= $estado?>.
        </div>
    </div>
<?php endif;?> 
<div class="container">
  <h1 class="title">Consultar ventas</h1>
  <h2 class="subtitle">
    Obtener todas las ventas de la tabla ventas</h2>

<form action="<?= base_url(route_to('consultarVentas'))?>" method="POST">
<div class="field">
        <label class="label">ID</label>
        <div class="control">
            <input name="id" value="" class="input" type="text" placeholder="ID">
        </div>
        <p class="is-danger help"><?= session('errors.from')?></p>
    </div>

    <div class="field is-grouped">
        <div class="control">
            <button class="button is-link">Enviar consulta</button>
        </div>
    </div>

</form>

<?php if($ventas): ?>
<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>ID Empresa</th>
      <th>Empresa</th>  
      <th>ID Centro</th>
      <th>Centro</th> 
      <th>ID Cliente</th>
      <th>Cliente</th>
      <th>CIF Cliente</th>  
      <th>ID Fábrica</th> 
      <th>Fábrica</th>
      <th>ID Material</th>
      <th>Material</th>
      <th>Año</th>
      <th>Mes</th>
      <th>Cantidad</th>
    </tr>
  </thead>
  <tfoot>
  </tfoot>
  <tbody>
  <?php foreach($ventas as $venta):?> 
    <tr>
      <th><?= $venta->ventas_id?></th>
      <th><?= $venta->ventas_idempresa;?></th>
      <td><?= $venta->ventas_empresa;?></td>
      <th><?= $venta->ventas_idcentro;?></th>
      <td><?= $venta->ventas_centro;?></td>
      <th><?= $venta->ventas_idcliente;?></th>
      <td><?= $venta->ventas_cliente;?></td>
      <th><?= $venta->ventas_cifcliente;?></th>
      <th><?= $venta->ventas_idfabrica;?></th>
      <td><?= $venta->ventas_fabrica;?></td>
      <th><?= $venta->ventas_idmaterial;?></th>
      <td><?= $venta->ventas_material;?></td>
      <td><?= $venta->ventas_año;?></td>
      <td><?= $venta->ventas_mes;?></td>
      <td><?= $venta->ventas_cantidad;?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<?php endif;?>
</div>
</section>
<?= $this->endSection()?>

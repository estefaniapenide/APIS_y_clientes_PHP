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
  <h1 class="title">Consultar ventas por empresa</h1>
  <h2 class="subtitle">
    Consulta las ventas por empresa en un determinado intervalo de tiempo</h2>

<form action="<?= base_url(route_to('consultarPorEmpresa'))?>" method="POST">
    <div class="field">
        <label class="label">Año incio</label>
        <div class="control">
            <input name="from" value="<?= old('from')?>" class="input" type="text" placeholder="From">
        </div>
        <p class="is-danger help"><?= session('errors.from')?></p>
    </div>

    <div class="field">
        <label class="label">Año fin</label>
        <div class="control">
            <input name="to" value="<?= old('to')?>"class="input" type="text" placeholder="To">
        </div>
        <p class="is-danger help"><?= session('errors.to')?></p>
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
      <th>ID Empresa</th>
      <th>Empresa</th>
      <th>Cantidad</th>  
    </tr>
  </thead>
  <tfoot>
  </tfoot>
  <tbody>
  <?php foreach($ventas as $venta):?> 
    <tr>
      <th><?= $venta->ventas_idempresa;?></th>
      <td><?= $venta->ventas_empresa;?></td>
      <td><?= $venta->ventas_cantidad;?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<?php endif; ?>

</div>
</section>
<?= $this->endSection()?>
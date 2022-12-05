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
  <?php if($estado==200):?>
  <div class="container">
        <div class="notification is-success">
        El registro de venta ha sido eliminado.
        </div>
    </div>
    <?php else:?>
    <div class="container">
        <div class="notification is-danger">
        No es posible realizar la consulta solicitada. Error <?= $estado?>.
        </div>
    </div>
    <?php endif;?> 
<?php endif;?> 
<div class="container">
  <h1 class="title">Eliminar Registro de Venta</h1>
  <h2 class="subtitle">
    Eliminar un registro de venta a partir de su ID</h2>

<form action="<?= base_url(route_to('eliminarRegistro'))?>" method="POST">
<div class="field">
        <label class="label">ID</label>
        <div class="control">
            <input name="id" value="" class="input" type="text" placeholder="ID">
        </div>
        <?php if(array_key_exists('id',$errors)):?>
        <p class="is-danger help"><?= $errors['id']?></p>
        <?php endif;?>
    </div>

    <div class="field is-grouped">
        <div class="control">
            <button class="button is-link">Enviar consulta</button>
        </div>
    </div>

</form>
</div>
</section>
<?= $this->endSection()?>

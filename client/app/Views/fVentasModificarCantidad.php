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
    <?php if($estado==200):?>
        <div class="notification is-success">
            La cantidad ha sido actualizada.
        </div>
    <?php else:?>   
        <div class="notification is-danger">
        No ha sido posible actualizar la cantidad. Error <?= $estado?>.
        </div>
    <?php endif;?> 
    </div>
<?php endif;?> 
<div class="container">
  <h1 class="title">Modificar la cantidad de una venta</h1>
  <h2 class="subtitle">
    Dado el ID de una venta, modificar su cantidad</h2>

<form action="<?= base_url(route_to('modificarCantidad'))?>" method="POST">
    <div class="field">
        <label class="label">ID Venta</label>
        <div class="control">
            <input name="id" value="" class="input" type="text" placeholder="ID Venta">
        </div>
        <?php if($errors): ?>
            <?php if(array_key_exists('id',$errors)): ?>
        <p class="is-danger help"><?= $errors['id']?></p>
        <?php endif; ?>
        <?php endif; ?>
    </div>

    <div class="field">
        <label class="label">Cantidad</label>
        <div class="control">
            <input name="cantidad" value="" class="input" type="text" placeholder="Cantidad">
        </div>
        <?php if($errors): ?>
            <?php if(array_key_exists('cantidad',$errors)): ?>
        <p class="is-danger help"><?= $errors['cantidad']?></p>
        <?php endif; ?>
        <?php endif; ?>
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
<section class="hero is-link">
  <div class="hero-body">
    <p class="title">
      Cliente API 3 - Bearer Token
    </p>
    <p class="subtitle">
      Haz tu consulta
    </p>
    <a href="<?=base_url(route_to('logout'))?>" class="button is-right">Log out</a>
  </div>
  <div class="hero-foot">
  <nav class="tabs is-boxed is-fullwidth">
    <div class="container">
        <ul>
          <li class="<?= (service('request')->uri->getPath() =='/' || service('request')->uri->getPath() =='ventas' || service('request')->uri->getPath() =='consultarVentas') ? 'is-active': ''?>"><a href="<?=base_url(route_to('ventas'))?>"><b>Ventas</b></a></li>
          <li class="<?= (service('request')->uri->getPath() =='ventasEmpresa'|| service('request')->uri->getPath() =='consultarPorEmpresa')? 'is-active': ''?>"><a href="<?=base_url(route_to('ventasEmpresa'))?>"><b>Ventas Empresa</b></a></li>
          <li class="<?= (service('request')->uri->getPath() =='ventasFabrica'|| service('request')->uri->getPath() =='consultarPorFabrica')? 'is-active': ''?>"><a href="<?=base_url(route_to('ventasFabrica'))?>"><b>Ventas Fábrica</b></a></li>
          <li class="<?= (service('request')->uri->getPath() =='ventasCentro'|| service('request')->uri->getPath() =='consultarPorCentro')? 'is-active': ''?>"><a href="<?=base_url(route_to('ventasCentro'))?>"><b>Ventas Centro</b></a></li>
          <li class="<?= (service('request')->uri->getPath() =='ventasCliente' || service('request')->uri->getPath() =='consultarPorCliente')? 'is-active': ''?>"><a href="<?=base_url(route_to('ventasCliente'))?>"><b>Ventas Cliente</b></a></li>
          <li class="<?= (service('request')->uri->getPath() =='ventasMaterial' || service('request')->uri->getPath() =='consultarPorMaterial')? 'is-active': ''?>"><a href="<?=base_url(route_to('ventasMaterial'))?>"><b>Ventas Material</b></a></li>
          <li class="<?= (service('request')->uri->getPath() =='modificar'|| service('request')->uri->getPath() =='modificarCantidad')? 'is-active': ''?>"><a href="<?=base_url(route_to('modificar'))?>"><b>Modificar Cantidad Venta</b></a></li>
          <li class="<?= (service('request')->uri->getPath() =='eliminar'|| service('request')->uri->getPath() =='eliminarRegistro')? 'is-active': ''?>"><a href="<?=base_url(route_to('eliminar'))?>"><b>Eliminar registro de Venta</b></a></li>
        </ul>
      </div>
    </nav> 
  </div>
</section>
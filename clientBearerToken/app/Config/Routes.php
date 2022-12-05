<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');

//$routes->group('/',['namespace'=>'App\Controllers'],function($routes){ 
    $routes->post('login', 'Login::login');
    $routes->get('logout', 'Login::logout');

    $routes->get('ventas', 'Ventas::index');
    $routes->post('consultarVentas', 'Ventas::consultarVentas',['as'=>'consultarVentas']);
    
    $routes->get('ventasEmpresa', 'Ventas::ventasEmpresa',['as'=>'ventasEmpresa']);
    $routes->post('consultarPorEmpresa', 'Ventas::consultarPorEmpresa',['as'=>'consultarPorEmpresa']);
    
    $routes->get('ventasFabrica', 'Ventas::ventasFabrica',['as'=>'ventasFabrica']);
    $routes->post('consultarPorFabrica', 'Ventas::consultarPorFabrica',['as'=>'consultarPorFabrica']);
    
    $routes->get('ventasCentro', 'Ventas::ventasCentro',['as'=>'ventasCentro']);
    $routes->post('consultarPorCentro', 'Ventas::consultarPorCentro',['as'=>'consultarPorCentro']);
    
    $routes->get('ventasCliente', 'Ventas::ventasCliente',['as'=>'ventasCliente']);
    $routes->post('consultarPorCliente', 'Ventas::consultarPorCliente',['as'=>'consultarPorCliente']);

    $routes->get('ventasMaterial', 'Ventas::ventasMaterial',['as'=>'ventasMaterial']);
    $routes->post('consultarPorMaterial', 'Ventas::consultarPorMaterial',['as'=>'consultarPorMaterial']);
    
    $routes->get('modificar', 'Ventas::modificar',['as'=>'modificar']);
    $routes->post('modificarCantidad', 'Ventas::modificarCantidad',['as'=>'modificarCantidad']);

    $routes->get('eliminar', 'Ventas::eliminar',['as'=>'eliminar']);
    $routes->post('eliminarRegistro', 'Ventas::eliminarRegistro',['as'=>'eliminarRegistro']);
//});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

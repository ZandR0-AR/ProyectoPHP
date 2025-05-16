<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//$routes->get('/agencias', 'Agencias::index');
//$routes->get('/agencias/new', 'Agencias::new');

$routes->resource('agencias', ['placeholder' => '(:num)', 'except' => 'show']);
$routes->resource('cajeros', ['placeholder' => '(:num)', 'except' => 'show']);
$routes->resource('corresponsales',  ['placeholder' => '(:num)', 'except' => 'show']);
$routes->get('/mapas/vista', 'Mapas::vista'); // Método para cargar la vista
$routes->get('/mapas', 'Mapas::index'); // Método API devuelve JSON
$routes->get('/dashboard', 'AgenciasController::dashboard');







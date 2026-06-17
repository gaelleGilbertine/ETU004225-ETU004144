<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AchatController::index');

// Quantite Produit routes
$routes->get('/quantites', 'QuantiteProduitController::findAll');
$routes->get('/quantites/(:num)', 'QuantiteProduitController::find/$1');
$routes->post('/quantites', 'QuantiteProduitController::create');
$routes->post('/quantites/(:num)', 'QuantiteProduitController::update/$1');
$routes->post('/quantites/(:num)', 'QuantiteProduitController::delete/$1');







//Produit
$routes->get('/produits', 'ProduitController::findAll');
$routes->get('/produits/(:num)', 'ProduitController::find/$1');
$routes->post('/produits', 'ProduitController::create');
$routes->post('/produits/(:num)', 'ProduitController::update/$1');
$routes->post('/produits/(:num)', 'ProduitController::delete/$1');  




// Caisses
$routes->get('/caisses', 'CaisseController::findAll');
$routes->get('/caisses/(:num)', 'CaisseController::find/$1');
$routes->post('/caisses', 'CaisseController::create');      
$routes->post('/caisses/(:num)', 'CaisseController::update/$1');
$routes->post('/caisses/(:num)', 'CaisseController::delete/$1');    






// Prix
$routes->get('/prix', 'PrixController::findAll');
$routes->get('/prix/(:num)', 'PrixController::find/$1');
$routes->post('/prix', 'PrixController::create');
$routes->post('/prix/(:num)', 'PrixController::update/$1');
$routes->post('/prix/(:num)', 'PrixController::delete/$1');



// User
$routes->get('/users', 'UserController::findAll');
$routes->get('/users/(:num)', 'UserController::find/$1');
$routes->post('/users', 'UserController::create');
$routes->post('/users/(:num)', 'UserController::update/$1');
$routes->post('/users/(:num)', 'UserController::delete/$1');




// Achat
$routes->get('/achats', 'AchatController::index');
$routes->get('/achats/list', 'AchatController::findAll');
$routes->get('/achats/(:num)', 'AchatController::find/$1');
$routes->post('/achats/insert', 'AchatController::create');


// Achat Detail
$routes->get('/achatDetail', 'AchatDetailController::index');
$routes->post('/achatDetail/insert', 'AchatDetailController::create');




// Routes REST existantes (conservées)
$routes->get('/users',              'UserController::index');
$routes->post('/users',             'UserController::create');
$routes->post('/users/login',       'UserController::login');
$routes->post('/users/logout',      'UserController::logout');


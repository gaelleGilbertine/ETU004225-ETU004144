<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Page d'accueil → SPA Caisse·Marché
$routes->get('/', 'CaisseAppController::index');
$routes->get('/caisse', 'CaisseAppController::index');

// API endpoints (appelés par le JavaScript de la SPA)
$routes->post('/api/login',        'CaisseAppController::login');
$routes->post('/api/logout',       'CaisseAppController::logout');
$routes->get('/api/caisses',       'CaisseAppController::getCaisses');
$routes->get('/api/produits',      'CaisseAppController::getProduits');
$routes->post('/api/achat/creer',  'CaisseAppController::creerAchat');

// Routes REST existantes (conservées)
$routes->get('/users',              'UserController::index');
$routes->post('/users',             'UserController::create');
$routes->post('/users/login',       'UserController::login');
$routes->post('/users/logout',      'UserController::logout');

$routes->get('/produits',           'ProduitController::findAll');
$routes->post('/produits',          'ProduitController::create');
$routes->get('/produits/(:num)',    'ProduitController::find/$1');
$routes->post('/produits/(:num)',   'ProduitController::update/$1');
$routes->delete('/produits/(:num)', 'ProduitController::delete/$1');

$routes->get('/caisses',            'CaisseController::findAll');
$routes->post('/caisses',           'CaisseController::create');
$routes->get('/caisses/(:num)',     'CaisseController::find/$1');
$routes->post('/caisses/(:num)',    'CaisseController::update/$1');
$routes->delete('/caisses/(:num)', 'CaisseController::delete/$1');

$routes->get('/achats',             'AchatController::index');
$routes->post('/achats',            'AchatController::create');
$routes->get('/achats/(:num)',      'AchatController::show/$1');
$routes->delete('/achats/(:num)',   'AchatController::delete/$1');

$routes->get('/achat-details',          'AchatDetailController::index');
$routes->post('/achat-details',         'AchatDetailController::create');
$routes->get('/achat-details/(:num)',   'AchatDetailController::show/$1');

$routes->get('/prix',               'PrixController::findAll');
$routes->post('/prix',              'PrixController::create');
$routes->get('/prix/(:num)',        'PrixController::find/$1');
$routes->post('/prix/(:num)',       'PrixController::update/$1');
$routes->delete('/prix/(:num)',     'PrixController::delete/$1');

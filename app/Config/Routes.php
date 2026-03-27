<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pages;
use App\Controllers\Contacts;
use App\Controllers\Auth;
use App\Controllers\Users;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Auth::class, 'login']);
    $routes->get('pages', [Pages::class, 'afficher'],['filter'=>'auth']);
    $routes->get('pages/(:segment)', [Pages::class, 'afficher'],['filter'=>'auth']);
    $routes->get('contacts', [Contacts::class, 'index'],['filter'=>'auth']);
    $routes->get('contacts/create', [Contacts::class, 'create'],['filter'=>'auth']);
    $routes->get('contacts/delete/(:num)', [Contacts::class, 'delete/$1'],['filter'=>'auth']);
    $routes->post('contacts', [Contacts::class, 'store'],['filter'=>'auth']);
    $routes->get('auth/register', [Auth::class,'register']);
    $routes->post('auth/register', [Auth::class,'store']);
    $routes->get('users/profil', [Users::class,'profil'],['filter'=>'auth']);
    $routes->get('auth/logout', [Auth::class,'deconnexion'],['filter'=>'auth']);
    $routes->get('auth/login', [Auth::class,'login']);
    $routes->post('auth/login', [Auth::class,'loginAttempt']);






<?php
use App\Controllers\HomeController;
use App\Controllers\ClientController;
use App\Controllers\UserController;
use App\Controllers\LivreController;
use App\Controllers\LocationController;
use App\Controllers\AuthController;
use App\Controllers\LogController;
use App\Routes\Route;

// Page d'accueil
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

// Routes pour les clients
Route::get('/clients', 'ClientController@index');  
Route::get('/client/create', 'ClientController@create');
Route::post('/client/create', 'ClientController@store');  
Route::get('/client/show', 'ClientController@show');
Route::get('/client/edit', 'ClientController@edit');
Route::post('/client/update', 'ClientController@update');
Route::post('/client/delete', 'ClientController@delete');

// Routes pour les livres
Route::get('/livres', 'LivreController@index');  
Route::get('/livre/show', 'LivreController@show');  
Route::get('/livre/create', 'LivreController@create');  
Route::post('/livre/store', 'LivreController@store');  
Route::post('/livre/delete', 'LivreController@delete');  

// Upload d'images pour les livres
Route::post('/livre/upload', 'LivreController@uploadImage');  

// Routes pour les locations
Route::get('/locations', 'LocationController@index');  
Route::get('/location/show', 'LocationController@show');  
Route::get('/location/create', 'LocationController@create');  
Route::post('/location/store', 'LocationController@store');  
Route::post('/location/delete', 'LocationController@delete');  

// Routes pour l'authentification
Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');

// Routes pour les logs (Journal d'activité)
Route::get('/logs', 'LogController@index');

Route::dispatch();
?>

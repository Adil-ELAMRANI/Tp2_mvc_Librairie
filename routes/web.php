<?php

use App\Routes\Route;

// Page d'accueil
Route::get('/', 'ControllerHome@index');

// Routes pour les clients
Route::get('/clients', 'ControllerClient@index');  // Liste des clients
Route::get('/clients/show/{id}', 'ControllerClient@show');  // Afficher un client 
Route::get('/client/create', 'ControllerClient@create');
Route::post('/client', 'ControllerClient@store');  // Ajouter un client
Route::post('/clients/update/{id}', 'ControllerClient@update');  // Mettre à jour un client
Route::post('/clients/delete/{id}', 'ControllerClient@delete');  // Supprimer un client

// Routes pour les livres
Route::get('/livres', 'ControllerLivre@index');  // Liste des livres
Route::get('/livres/show/{id}', 'ControllerLivre@show');  // Afficher un livre spécifique


// Routes pour les locations
Route::get('/locations', 'ControllerLocation@index');  // Liste des locations
Route::get('/locations/show/{id}', 'ControllerLocation@show');  // Afficher une location spécifique
Route::post('/locations', 'ControllerLocation@store');  // Ajouter une location
Route::post('/locations/delete/{id}', 'ControllerLocation@delete');  // Supprimer une location

Route::dispatch();
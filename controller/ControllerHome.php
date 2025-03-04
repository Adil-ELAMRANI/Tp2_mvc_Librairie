<?php
namespace App\Controllers;
use App\Providers\View;

class ControllerHome {
    public function index() {
       echo "Bienvenue sur la page d'accueil";
       View::render('home', ['title' => 'Bienvenue sur la page d\'accueil']);
    }
}


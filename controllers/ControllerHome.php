<?php
namespace App\Controllers;
use App\Providers\View;

class ControllerHome {
    public function index() {
       echo "Bienvenue sur la page de notre Librairie";
       View::render('client/home-index', ['title' => 'Bienvenue sur la page de notre Librairie']);
    }
}


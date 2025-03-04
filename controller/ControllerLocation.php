<?php
// ControllerLocation.php
// Gère les actions liées aux locations de livres.

namespace App\Controllers;

use App\Models\Client;
use App\Models\Livre;
use App\Models\Location;
use App\Providers\View;

class LocationController {
    
    // Affiche le formulaire de création d'une nouvelle location
    public function create() {
        $client = new Client();
        $livre = new Livre();
    
        // Récupération des clients et livres disponibles
        $selectClient = $client->select();
        $selectLivre = $livre->select();

        // Définition des dates de location
        $date_debut = date("Y-m-d");
        $date_fin7 = date("Y-m-d", strtotime("+7 day"));
        $date_fin14 = date("Y-m-d", strtotime("+14 day"));
    
        // Affichage avec View
        return View::render('location/create', [
            'clients' => $selectClient,
            'livres' => $selectLivre,
            'datedebut' => $date_debut,
            'datefin7' => $date_fin7,
            'datefin14' => $date_fin14
        ]);
    }

    // Insère une nouvelle location en base de données
    public function store($data = []) {
        $location = new Location();
        $insert = $location->insert($data);
        return View::redirect('home');
    }

    // Supprime une location existante
    public function delete($data = []) {
        $location = new Location();
        $delete = $location->delete($data['id']);
        return View::redirect('home');
    }
}
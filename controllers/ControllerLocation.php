<?php
// ControllerLocation.php
// Gère les actions liées aux locations de livres.

namespace App\Controllers;

use App\Models\Client;
use App\Models\Livre;
use App\Models\Location;
use App\Providers\View;
use App\Providers\Validator;

class ControllerLocation
{

    // Affiche la liste des locations
    public function index()
    {
        $location = new Location();
        $selectLocation = $location->select();
        return View::render('location/home-index', ['locations' => $selectLocation]);
    }
    // Affiche le formulaire de création d'une nouvelle location
    public function create()
    {
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
        return View::render('location/location-create', [
            'clients' => $selectClient,
            'livres' => $selectLivre,
            'datedebut' => $date_debut,
            'datefin7' => $date_fin7,
            'datefin14' => $date_fin14
        ]);
    }

    // Insère une nouvelle location en base de données

    public function store($data = []){
        $validator = new Validator();
        $validator->field('client_id', $data['client_id'])->required();
        $validator->field('livre_id', $data['livre_id'])->required();

        if ($validator->isSuccess()) { 
            $location = new Location();
            $insert = $location->insert($data);
            if ($insert) {
                return View::redirect('location/location-show?id=' . $insert);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('location/location-create', ['errors' => $errors, 'location' => $data]);
        }
    }

    // Supprime une location existante
    public function delete($data = [])
    {
        $location = new Location();
        $delete = $location->delete($data['id']);
        return View::redirect('locations');
    }
}

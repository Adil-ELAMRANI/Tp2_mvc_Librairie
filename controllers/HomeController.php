<?php
namespace App\Controllers;

use App\Models\Location;
use App\Models\Client;
use App\Models\Livre;
use App\Providers\View;

class HomeController {
    public function index() {
        $location = new Location();
        $client = new Client();
        $livre = new Livre();

        $locations = $location->select();
        $clients = $client->select();
        $livres = $livre->select();

        return View::render('home-index', [
            'locations' => $locations,
            'clients' => $clients,
            'livres' => $livres
        ]);
    }
}
?>



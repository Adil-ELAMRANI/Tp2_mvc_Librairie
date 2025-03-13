<?php
// ClientController.php
// Gère les actions liées aux clients : affichage, création, modification et suppression.

namespace App\Controllers;

use App\Models\Client;
use App\Models\Ville;
use App\Models\Location;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class ClientController
{

    public function index(){
        Auth::session();
        $client = new Client();
        $ville = new Ville();

        $selectClient = $client->select();
        $selectVille = $ville->select();

        return View::render("client/client-index", [
            'clients' => $selectClient, 
            'villes' => $selectVille
        ]);
    }

    public function create(){
        Auth::session();
        Auth::privilege(1);
        $ville = new Ville();
        $selectVille = $ville->select();
        return View::render('client/client-create', ['villes' => $selectVille]);
    }

    public function store($data = []){
        Auth::session();
        $validator = new Validator();
        $validator->field('nom', $data['nom'])->min(3)->max(25);
        $validator->field('prenom', $data['prenom'])->min(3)->max(25);
        $validator->field('adresse', $data['adresse'])->max(45);
        $validator->field('phone', $data['phone'])->max(20);
        $validator->field('code_postal', $data['code_postal'], "Code postal")->number()->max(10);


        if ($validator->isSuccess()) {
            $client = new Client();
            $insert = $client->insert($data);
            if ($insert) {
                return View::redirect('client/client-show?id=' . $insert);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('client/client-create', ['errors' => $errors, 'client' => $data]);
        }
    }

    public function show($data = []) {
        Auth::session();
    
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => "ID du client manquant."]);
        }
    
        $client = new Client();
        $ville = new Ville();
    
        $selectedClient = $client->selectId($data['id']);
        $villes = $ville->select();
    
        if ($selectedClient) {
            return View::render('client/client-show', [
                'client' => $selectedClient,
                'villes' => $villes
            ]);
        } else {
            return View::render('error', ['msg' => "Client introuvable."]);
        }
    }

    public function edit($data = []) {
        Auth::session();
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => "ID du client manquant."]);
        }

        $client = new Client();
        $ville = new Ville();

        $selectedClient = $client->selectId($data['id']);
        $villes = $ville->select();

        if ($selectedClient) {
            return View::render('client/client-edit', [
                'client' => $selectedClient,
                'villes' => $villes
            ]);
        } else {
            return View::render('error', ['msg' => "Client introuvable."]);
        }
    }

    public function update($data = []) {
        Auth::session();
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => "ID du client manquant."]);
        }

        $validator = new Validator();
        $validator->field('nom', $data['nom'])->min(3)->max(25);
        $validator->field('prenom', $data['prenom'])->min(3)->max(25);
        $validator->field('adresse', $data['adresse'])->max(45);
        $validator->field('phone', $data['phone'])->max(20);
        $validator->field('code_postal', $data['code_postal'])->number()->max(10);

        if ($validator->isSuccess()) {
            $client = new Client();
            $update = $client->update($data, $data['id']);
            if ($update) {
                return View::redirect('/clients');
            } else {
                return View::render('error', ['msg' => "Erreur lors de la mise à jour du client."]);
            }
        } else {
            return View::render('client/client-edit', ['errors' => $validator->getErrors(), 'client' => $data]);
        }
    }

    public function delete($data = []) {
        Auth::session();
        if (!isset($data['id']) || empty($data['id'])) {
            return View::render('error', ['msg' => "ID du client manquant."]);
        }

        $client = new Client();
        $delete = $client->delete($data['id']);

        if ($delete) {
            return View::redirect('/clients');
        } else {
            return View::render('error', ['msg' => "Erreur lors de la suppression du client."]);
        }
    }

    
}
?>
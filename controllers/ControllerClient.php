<?php
// ControllerClient.php
// Gère les actions liées aux clients : affichage, création, modification et suppression.

namespace App\Controllers;
use App\Models\Client;
use App\Models\Ville;
use App\Providers\View;
use App\Providers\Validator;

class controllerClient {
    
    public function index() {
        $client = new Client();
        $ville = new Ville();
        
        $selectClient = $client->select();
        $selectVille = $ville->select();

    return View::render("client/index", ['clients' => $selectClient, 'villes' => $selectVille]);
    }

    public function create() {
        $ville = new Ville();
        $selectVille = $ville->select();
        return View::render('client/create', ['villes' => $selectVille]);
    }

    public function store($data=[]) {
        $validator = new Validator();
        $validator->field('name', $data['name'])->min(3)->max(25);
        $validator->field('address', $data['address'])->max(45);
        $validator->field('phone', $data['phone'])->max(20);
        $validator->field('code_postal', $data['code_postal'], "Code postal")->number()->max(10);
        $validator->field('email', $data['email'])->required()->max(45)->email();

        if ($validator->isSuccess()) {
            $client = new Client();
            $insert = $client->insert($data);
            if ($insert) {
                return View::redirect('client/show?id=' . $insert);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('client/create', ['errors' => $errors, 'client' => $data]);
        }
    }

    public function show($data=[]) {
        if (isset($data['id']) && $data['id'] != null) {
            $client = new Client();
            $ville = new Ville();
            
            $selectClient = $client->selectId($data['id']);
            $selectVille = $ville->select();
            
            if ($selectClient) {
                return View::render('client-show', ['client' => $selectClient, 'villes' => $selectVille]);
            } else {
                return View::render('error', ['msg' => 'Client doesn\'t exist']);
            }
        }
        return View::render('error');
    }

    public function edit($data=[]) {
        if (isset($data['id']) && $data['id'] != null) {
            $client = new Client();
            $ville = new Ville();
            
            $selectClient = $client->selectId($data['id']);
            $selectVille = $ville->select();
            
            if ($selectClient) {
                return View::render('client/edit', ['client' => $selectClient, 'villes' => $selectVille]);
            } else {
                return View::render('error', ['msg' => 'Client doesn\'t exist']);
            }
        }
        return View::render('error');
    }

    public function update($data=[], $get=[]) {
        $validator = new Validator();
        $validator->field('name', $data['name'])->min(3)->max(25);
        $validator->field('address', $data['address'])->max(45);
        $validator->field('phone', $data['phone'])->max(20);
        $validator->field('code_postal', $data['code_postal'], "Code postal")->number()->max(10);
        $validator->field('email', $data['email'])->required()->max(45)->email();

        if ($validator->isSuccess()) {
            $client = new Client();
            $update = $client->update($data, $get['id']);
            if ($update) {
                return View::redirect('client/show?id=' . $get['id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('client/edit', ['errors' => $errors, 'client' => $data]);
        }
    }

    public function delete($data=[]) {
        $id = $data['id'];
        $client = new Client();
        $delete = $client->delete($id);
        if ($delete) {
            return View::redirect('clients');
        } else {
            return View::render('error');
        }
    }
}

<?php
// ModelClient.php
// Gestion des clients

namespace App\Models;

use App\Models\CRUD;


class Client extends CRUD{
    protected $table = 'client';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'prenom', 'adresse', 'code_postal', 'phone', 'ville_id'];
}

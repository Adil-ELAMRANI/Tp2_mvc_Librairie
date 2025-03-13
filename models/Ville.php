<?php
// ModelVille.php
// Gestion des villes

namespace App\Models;

use App\Models\Crud;

class Ville extends Crud {
    protected $table = 'ville';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nom'];
}
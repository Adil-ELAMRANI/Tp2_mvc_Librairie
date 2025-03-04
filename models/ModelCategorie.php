<?php
// ModelCategorie.php
// Gestion des catégories de livres

namespace App\Models;

use App\Models\Crud;

class Categorie extends Crud {
    protected $table = 'categorie';
    protected $primaryKey = 'id';
}

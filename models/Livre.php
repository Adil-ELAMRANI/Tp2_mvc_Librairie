<?php
// ModelLivre.php
// Gestion des livres

namespace App\Models;

use App\Models\Crud;

class Livre extends Crud {
    protected $table = 'livre';
    protected $primaryKey = 'id';
}

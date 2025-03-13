<?php
// ModelLivre.php
// Gestion des livres

namespace App\Models;

use App\Models\Crud;

class Livre extends Crud {
    protected $table = 'livre';
    protected $primaryKey = 'id';
    protected $fillable = ['titre', 'auteur', 'nombre_pages', 'categorie_id', 'librairie_id', 'image'];
}
?>
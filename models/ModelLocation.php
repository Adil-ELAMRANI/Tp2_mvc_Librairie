<?php
// ModelLocation.php
// Gestion des locations de livres

namespace App\Models;

use App\Models\Crud;

class Location extends Crud {
    protected $table = 'location';
    protected $primaryKey = 'id';
    protected $fillable = ['client_id', 'livre_id', 'date_debut', 'date_fin'];
}

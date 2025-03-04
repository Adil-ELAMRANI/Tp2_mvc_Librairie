<?php
// ControllerLivre.php
// Gère l'affichage des livres et leur catégorisation.

namespace App\Controllers;
use App\Models\Livre;
use App\Models\Categorie;
use App\Providers\View;

class LivreController {
    
    public function index() {
        $livre = new Livre();
        $categorie = new Categorie();
    
        // Récupération des livres et catégories
        $selectLivre = $livre->select();
        $selectCategorie = $categorie->select();
    
        // Affichage avec View
        return View::render("livre/index", [
            'livres' => $selectLivre,
            'categories' => $selectCategorie
        ]);
    }
}
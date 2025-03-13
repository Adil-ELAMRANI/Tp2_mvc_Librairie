<?php
// ControllerLivre.php
// Gère l'affichage des livres et leur catégorisation.

namespace App\Controllers;
use App\Models\Livre;
use App\Models\Categorie;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class LivreController {
    
    public function index() {
        Auth::session();
        $livre = new Livre();
        $categorie = new Categorie();
    
        // Récupération des livres et catégories
        $selectLivre = $livre->select();
        $selectCategorie = $categorie->select();
    
        // Affichage avec View
        return View::render(template: "livre/livre-index", data:[
            'livres' => $selectLivre,
            'categories' => $selectCategorie
        ]);
    }

    public function uploadImage() {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . UPLOAD_PATH;
            $targetFile = $targetDir . basename($_FILES['image']['name']);
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                echo json_encode(['success' => true, 'message' => 'Image uploadée avec succès']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'upload']);
            }
        }
    }

    public function delete($data = []) {
        $livre = new Livre();
        $book = $livre->selectId($data['id']);

        if (!$book) {
            return View::render('error', ['msg' => "Livre non trouvé."]);
        }

        // Suppression du fichier image associé
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . UPLOAD_PATH . $book['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        if ($livre->delete($data['id'])) {
            return View::redirect('/livres');
        } else {
            return View::render('error', ['msg' => "Erreur lors de la suppression du livre."]);
        }
    }
}
?>
<?php
// RequirePage.php
// Gère le chargement dynamique des fichiers et la redirection

namespace Tp2Librairie\librairie;

class RequirePage {
    // Charge dynamiquement un modèle
    public static function requireModel($model) {
        return require_once "model/$model.php";
    }

    // Redirige vers une autre page
    public static function redirectPage($page) {
        header("Location: http://localhost/tp2Librairie/".$page);
        exit();
    }
}
?>
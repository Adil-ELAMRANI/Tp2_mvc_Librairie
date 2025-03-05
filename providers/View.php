<?php
// View.php
// Gère le moteur de templates Twig

namespace App\Providers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View {
    static public function render($template, $data = []){
        $loader = new FilesystemLoader('views');
        $twig = new Environment($loader);
        $twig->addGlobal('asset', ASSET);
        $twig->addGlobal('base', BASE);
        echo $twig->render(name: $template.".twig", context: $data);
    }

    static public function redirect($url){
        return header('location:'.BASE.'/'.$url);
    }
}
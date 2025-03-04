<?php
// RenderView.php
// Gère l'affichage des vues en PHP simple

namespace Tp2Librairie\librairie;

class RenderView {
    private $data = [];
    private $render = false;

    public function __construct($template) {
        try {
            $file = 'view/' . $template . '.php';
            if (file_exists($file)) {
                $this->render = $file;
            } else {
                throw new \Exception("Fichier de vue non trouvé : " . $file);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function assign($variable, $value) {
        $this->data[$variable] = $value;
    }

    public function __destruct() {
        extract($this->data);
        include($this->render);
    }
}
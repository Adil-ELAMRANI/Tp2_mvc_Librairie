<?php
// index.php - Point d'entrée principal du projet TP2 MVC
ini_set(option: 'display_errors', value:1);
ini_set(option: 'display_startup_errors', value:1);
error_reporting(error_level:E_ALL);

require_once('vendor/autoload.php');
require_once('config.php');
require_once('routes/web.php');

?>
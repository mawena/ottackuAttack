<?php
ini_set('display_errors', 'On');            //On rend les erreurs visibles
error_reporting(E_ALL | E_STRICT);            //On reporte les erreurs sur la page
require '../Library/autoload.php';
$app = new \Applications\Backend\BackendApplication;
$app->run();

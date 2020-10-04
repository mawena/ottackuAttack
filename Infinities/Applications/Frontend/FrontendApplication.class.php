<?php

namespace Applications\Frontend;

class FrontendApplication extends \Library\Application
{
    /**
     * Fonction chargé de construire le BackendApplication
     */
    public function __construct()
    {
        parent::__construct();
        $this->name = 'Frontend';
    }

    /**
     * Fonction appellé pour lancer l'application
     */
    public function run()
    {
        $controller = $this->getController();    //Obtention du contrôleur
        $controller->execute(); //Exécution du contrôleur
        $this->httpReponse->setPage($controller->page());   //Assignation de la page créée par le contrôleur à la réponse
        $this->httpReponse->send(); //Envoie de la réponse
    }
}

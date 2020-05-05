<?php

namespace Applications\Backend;

class BackendApplication extends \Library\Application
{
    /**
     * Fonction chargé de construire le BackendApplication
     */
    public function __construct()
    {
        parent::__construct();
        $this->name = "Backend";
    }

    /**
     * Fonction appellé pour lancer l'application
     */
    public function run()
    {
        if ($this->user->isAuthenticated()) {  //Si l'utilisateur s'est identifié en tant qu'Admin ou autre
            $controller = $this->getController();    //Obtention du controller correspondant
        } else {
            $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index');   //Obtention du controller de connexion
        }
        $controller->execute(); //Exécution du controller
        $this->httpReponse->setPage($controller->page());   //Assignation de la page créée par le contrôleur à la réponse
        $this->httpReponse->send(); //Envoie de la réponse
    }
}

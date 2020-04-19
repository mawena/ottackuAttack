<?php

namespace Library;

class Config extends ApplicationComponent
{
    protected $vars = array(), $admins = array();

    /**
     * Méthode permétant de récupérer une configuration de l'application
     * @param $var:mixte permete d'indentifier la configuration
     * @return mixte
     */
    public function get($var)
    {
        if (!$this->vars) {   //Si le tableau contenant les valeurs est vide
            $xml = new \DOMDocument;    //Insctantion du parseur
            $xml->load(__DIR__ . '/../Applications/' . $this->app->name() . '/Config/app.xml'); //Chargement du fichier contenant les routes
            $elements = $xml->getElementsByTagName('define');  //Enregistrement des routes dans une variables
            foreach ($elements as $element) {
                $this->vars[$element->getAttribute('var')] = $element->getAttribute('value');
            }
        }
        return (isset($this->vars[$var])) ? $this->vars[$var] : null;   //La valeur correspondant au paramètre est renvoyé si elle existe
    }

    /**
     * Méthode permétant de recupérer les données des admins de l'application
     * @return array | null
     */
    public function getAdminAll()
    {
        if (!$this->admins) {
            $xml = new \DOMDocument;
            $xml->load(__DIR__ . '/../Applications/' . $this->app->name() . '/Config/admins.xml');
            $elements = $xml->getElementsByTagName('admin');
            foreach ($elements as $element) {
                $this->admins[$element->getAttribute('login')] = $element->getAttribute('mdp');
            }
        }
        return isset($this->admins) ? $this->admins : null;
    }
}

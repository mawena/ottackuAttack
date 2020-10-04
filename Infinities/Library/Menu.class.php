<?php
namespace Library;
class Menu extends \Library\ApplicationComponent{
    protected $vars = array();

    public function addVars($name, $chemin, $bakground){    //On ajoute des éléments 
        if(!is_string($name) || is_numeric($name) || empty($name)){
            throw new \InvalidArgumentException('Le nom de la variable doit être une chaîne de caractère non nulle');
        }
        $this->vars[] = array("name" => $name, "chemin" => $chemin, "background" => $bakground);
    }

    public function getListMenu(){
        if(!$this->vars){   //Si le tableau contenant les valeurs est vide
            $xml = new \DOMDocument;    //Insctantion du parseur
            $xml->load(__DIR__.'/../Applications/'.$this->app->name().'/Config/menu.xml'); //Chargement du fichier contenant les menu
            $menus = $xml->getElementsByTagName('menu');  //Enregistrement des menu dans une variables 
            foreach ($menus as $menu){
                $this->addVars($menu->getAttribute('name'), $menu->getAttribute('chemin'), $menu->getAttribute('background'));  //Ajout des menus du fichier dans l'attribut $vars
            }
        }
        return $this->vars;
    }
}
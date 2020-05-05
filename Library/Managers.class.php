<?php
namespace Library;
class Managers{
    protected $api = null, $dao = null, $managers = array();
    
    public function __construct($api, $dao){
        $this->api = $api;
        $this->dao = $dao;
    }
    public function getManagerOf($module){  //Renvoie le bon module après quelques vérifications et traitements
        if(!is_string($module) || empty($module)){
            throw new \InvalidArgumentException('Le module spécifié est invalide');
        }
        if(!isset($this->managers[$module])){   //Si le module n'existe pas
            $manager = '\\Library\\Models\\'.$module.'Manager_'.$this->api; //Important du bon module en fonction de son nom et du nom de l'api
            $this->managers[$module] = new $manager($this->dao);
        }
        return $this->managers[$module];
    }
}
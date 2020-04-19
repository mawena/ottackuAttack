<?php
namespace Library\Models;
abstract class VideosManager extends \Library\Manager{
    /**
    * Méthode retournant une liste de videos demandée
    * @param $debut int La première videos à sélectionner
    * @param $limite int Le nombre de videos à sélectionner
    * @return array La liste des videos. Chaque entrée est une instance de videos.
    */
    abstract public function getList($debut = -1, $limite = -1);
    
    /**
    * Méthode retournant une videos précise.
    * @param $id int L'identifiant de la videos à récupérer
    * @return Videos La videos demandée
    */
    abstract public function getUnique($id);

    /**
     * Méthode permétant de compter les videoss en bdd en fonction d'un mot clé
     * @param $regex string le mot clé
     * @return int
     */
    abstract function count($regex);
}
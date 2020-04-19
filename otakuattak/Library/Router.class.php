<?php
namespace Library;
class Router{
    protected $routes = array();
    const NO_ROUTE = 1;

    public function addRoute(Route $route){
        if(!in_array($route, $this->routes)){
            $this->routes[] = $route;   //Ajout du nouveau route dans l'attribut routes
        }
    }
    public function getRoute($url){
        foreach ($this->routes as $route){
            if (($varsValues = $route->match($url)) !== false){ //Si la route correspond à l'URL
                if($route->hasVars()){  //Si elle a des variables
                    $varNames = $route->varsNames();
                    $listVars = array();
                    foreach ($varsValues as $key => $match){    //Remplissage du tableau clé/valeurs
                        ($key > 0) ? $listVars[$varNames[$key-1]] = $match : null;
                    }
                    $route->setVars($listVars); //Assignation du tableau à la route
                }
                return $route;
            }
        }
    throw new \RuntimeException('Aucune route ne correspond à l\'url', self::NO_ROUTE);
    }
    public function routes(){
        return $this->routes;
    }
}
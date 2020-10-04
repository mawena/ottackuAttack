<?php

namespace Library;

abstract class Application
{
    /**
     * Attributs qui stockant consécutivement une instance de $httpRequest, une instance de $httpReponse, et le nom de l'application
     */
    protected $httpRequest, $httpReponse, $user, $config, $menu, $name;

    /**
     * Méthode de construction de l'objet
     * @return void
     */
    public function __construct()
    {
        $this->httpRequest = new HTTPRequest($this);
        $this->httpReponse = new HTTPReponse($this);
        $this->user = new User($this);
        $this->config = new Config($this);
        $this->menu = new Menu($this);
        $this->name = '';
    }

    /**
     * Méthode permettant d'obtenir le controller adéquat
     * @return \Library\BackController
     */
    public function getController()
    {
        $router = new \Library\Router;  //Instantion du routeur
        $xml = new \DOMDocument;    //Insctantion du parseur
        $xml->load(__DIR__ . '/../Applications/' . $this->name() . '/Config/routes.xml'); //Chargement du fichier contenant les routes
        $routes = $xml->getElementsByTagName('route');  //Enregistrement des routes dans une variables
        foreach ($routes as $route) {
            $vars = array();
            if ($route->hasAttribute('vars')) {    //Si des variables sont présentes dans l'URL
                $vars = explode(',', $route->getAttribute('vars'));  //I!
            }
            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));   //Ajout de la route au routeur
        }
        try {
            $matchedRoute = $router->getRoute($this->httpRequest->getRequestURI());  //Enregistrement des routes formelles
        } catch (\RuntimeException $e) {
            if ($e->getCode() == \Library\Router::NO_ROUTE) {  //Si le code de l'erreur levé correspond au code NO_ROUTE de la classe Router alors on établie une redirection 404
                $this->httpReponse->redirect404();
            }
        }
        $_GET = array_merge($_GET, $matchedRoute->vars());  //Ajout des variables de l'url dans le tableau $_GET
        $controllerClass = '\Applications\\' . $this->name . '\\Modules\\' . $matchedRoute->module() . '\\' . $matchedRoute->module() . 'Controller';
        return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
    }

    /**
     * Méthode pour lancer l'application
     */
    abstract public function run();

    /**
     * Méthode retournant les données de requêtte
     * @return \Library\HTTPRequest
     */
    public function httpRequest()
    {
        return $this->httpRequest;
    }

    /**
     * Méthode retournant les données de reponse
     * @return \Library\HTTPReponse
     */
    public function httpReponse()
    {
        return $this->httpReponse;
    }

    /**
     * Méthode retournant le nom de l'application
     * @return String
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Méthode retournant les données de l'utilisateur
     * @return \Library\User
     */
    public function user()
    {
        return $this->user;
    }
    /**
     * Méthode retournant l'objet de gestion de configuration de l'application
     * @return \Library\Config
     */
    public function config()
    {
        return $this->config;
    }
    /**
     * Méthode retournant l'objet de gestion du menu de l'appliaction
     * @return \Library\Menu
     */
    public function menu()
    {
        return $this->menu;
    }
}

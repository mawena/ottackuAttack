<?php
namespace Library;
use RuntimeException;

abstract class BackController extends ApplicationComponent{
    protected $action = '', $module = '', $page = null, $view = '', $managers = null, $layoutFileName = '', $menuFileName;
    public function __construct(Application $app, string $module, string $action){
        parent::__construct($app);
        $this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());
        $this->page = new Page($app);
        $this->setModule($module);
        $this->setAction($action);
        $this->setLayoutFileName('layout'.$this->app->config()->get('view_nb').".php"); //On définit le nom du layout en fonction de la configuration
        $this->setMenuFileName('menu'.$this->app->config()->get('view_nb').".php"); //On définit le nom du menu en fonction de la configuration
        $this->setView($action);  //Par défaut la vue à la même valeur du l'action
    }
    public function execute(){
        $methode = 'execute'.ucfirst($this->action);    //Définition de la méthode execute correspondant à l'action 
        if(!is_callable(array($this, $methode))){   //Si la classe appelant execute ne peut appeler la methode $methode on lève une RuntimeException
            throw new \RuntimeException('L\'action '.$this->action.'n\'est pas définit sur ce module');
        }
        $liste = $this->app->menu()->getListMenu(); //On recupère la liste des liste des menus
        //On ajoute le menu
        $this->page->addVar('listeMenu', $liste);
        $this->$methode($this->app->httpRequest()); //Appel de la méthode $methode avec les information de la requête en argument
    }
    public function page(){
        return $this->page;
    }
    public function setModule($module){
        if(!is_string($module) || empty($module)){
            throw new \InvalidArgumentException('Le module doit être une chaîne de caractères');
        }
        $this->module = $module;
    }
    public function setAction($action){
        if(!is_string($action) || empty($action)){
            throw new \InvalidArgumentException('L\'action doit être une chaîne de caractères');
        }
        $this->action = $action;
    }
    public function setView($view){
        if(!is_string($view) || empty($view)){
            throw new \InvalidArgumentException('La vue doit être une chaîne de caractères');
        }
        $this->view = $view;
        $this->page->setContentFile(__DIR__.'/../Applications/'.$this->app->name().'/Modules/'.$this->module.'/Views/'.$this->view.'.php'); //Mise à jour de la vue dans la page
    }
    public function setLayoutFileName($layoutFileName){
        if(!is_string($layoutFileName) || empty($layoutFileName)){
            throw new \InvalidArgumentException('L\'action doit être une chaîne de caractères');
        }
        $this->layoutFileName = $layoutFileName;
        $this->page->setLayoutFileName($this->layoutFileName); //Mise à jour du nom du layout de la page
    }
    public function setMenuFileName($menuFileName){
        if(!is_string($menuFileName) || empty($menuFileName)){
            throw new \InvalidArgumentException('L\'action doit être une chaîne de caractères');
        }
        $this->menuFileName = $menuFileName;
        $this->page->setMenuFile(__DIR__.'/../Applications/'.$this->app->name().'/Templates/'.$this->menuFileName); //Mise à jour du menu de la page
    }
}
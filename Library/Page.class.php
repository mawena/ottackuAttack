<?php

namespace Library;

class Page extends ApplicationComponent
{
    protected $contentFile, $menuFile, $layoutFileName, $vars = array();

    /**
     * Ajoute une variable à la page
     */
    public function addVar($var, $value)
    {
        if (!is_string($var) || is_numeric($var) || empty($var)) {
            throw new \InvalidArgumentException('Le nom de la variable doit être une chaîne de caractère non nulle');
        }
        $this->vars[$var] = $value;
    }
    /**
     * retourne la page généré
     */
    public function getGeneratedPage()
    {
        if (!file_exists($this->contentFile)) {
            throw new \RuntimeException('La vue spécifié n\'existe pas');
        }

        $user = $this->app->user();
        extract($this->vars);   //Extrait toutes les variables transmises par le constructeur
        ob_start();
        require $this->contentFile;
        $content = ob_get_clean();  //Stocke le contenu du fichier

        if (!empty($this->menuFile)) {
            ob_start();
            require $this->menuFile;
            $menu = ob_get_clean();  //Stocke le contenu du fichier
        }

        if (!empty($this->layoutFileName)) {
            ob_start();
            require dirname(__FILE__) . '/../Applications/' . $this->app->name() . '/Templates/' . $this->layoutFileName;
            return ob_get_clean();
        }
        return $content;
    }
    /**
     * Modidie l'attribut $contentFile
     */
    public function setContentFile($contentFile)
    {
        if (!is_string($contentFile) || empty($contentFile)) {
            throw new \InvalidArgumentException('La vue spécifié est invalide');
        }
        $this->contentFile = $contentFile;
    }
    public function setMenuFile($menuFile)
    {
        if (!is_string($menuFile) || empty($menuFile)) {
            throw new \InvalidArgumentException('La vue spécifié est invalide');
        }
        $this->menuFile = $menuFile;
    }
    public function setLayoutFileName($layoutFileName)
    {
        if (!is_string($layoutFileName) || empty($layoutFileName)) {
            throw new \InvalidArgumentException('La vue spécifié est invalide');
        }
        $this->layoutFileName = $layoutFileName;
    }
}

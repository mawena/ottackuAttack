<?php

namespace Library;

abstract class Entity implements \ArrayAccess
{
    protected $erreurs = array(), $id;

    public function __construct(array $donnees = array())
    {
        if (!empty($donnees)) {   //Si le paramètre $donnees n'est pas vide, on hydrate l'objet
            $this->hydrate($donnees);
        }
    }
    public function isNew()
    {    //Vérifie si l'objet est nouveau, donc ne provient pas de la bdd
        return empty($this->id);
    }
    public function erreurs()
    {
        return $this->erreurs;
    }
    public function id()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = (int) $id;
    }
    public function hydrate(array $donnees)
    {    //Hydratation de l'objet
        foreach ($donnees as $attribut => $valeur) {
            $method = 'set' . ucfirst($attribut);
            if (is_callable(array($this, $method))) {
                $this->$method($valeur);
            }
        }
    }
    //Implémentation des méthodes de l'interface ArrayAccess
    public function offsetGet($var)
    {
        if (isset($this->$var) && is_callable(array($this, $var))) {
            return $this->$var;
        }
    }
    public function offsetSet($var, $value)
    {
        $method = 'set' . ucfirst($var);
        if (isset($this->$var) && is_callable(array($this, $method))) {
            $this->$var($value);
        }
    }
    public function offsetExists($var)
    {
        return isset($this->$var) && is_callable(array($this, $var));
    }
    public function offsetUnset($var)
    {
        throw new \Exception('Impossible de suprimer une quelconque valeur');
    }
}

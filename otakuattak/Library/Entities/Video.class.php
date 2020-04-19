<?php

namespace Library\Entities;

class Video extends \Library\Entity
{
    protected $nom, $extention, $artiste, $dateAjout, $description;
    const NOM_INVALIDE = 1, ARTISTE_INVALIDE = 2, DESCRIPTION_INVALIDE = 3;

    //Getters et Setters:
    public function nom()
    {
        return $this->nom;
    }
    public function extention()
    {
        return $this->extention;
    }
    public function artiste()
    {
        return $this->artiste;
    }
    public function dateAjout()
    {
        return $this->dateAjout;
    }
    public function description()
    {
        return $this->dateAjout;
    }

    public function setNom($nom)
    {
        (!is_string($nom) || empty($nom)) ? $this->erreurs[] = self::NOM_INVALIDE : $this->nom = $nom;
    }
    public function setExtention($extention)
    {
        $this->extention = $extention;
    }  //Si la dateAjout est valide, on met à jour l'attribut dateAjout
    public function setDescription($description)
    {
        (!is_string($description) || empty($description)) ? $this->erreurs[] = self::DESCRIPTION_INVALIDE : $this->description = $description;
    }
    public function setArtiste($artiste)
    {
        (!is_string($artiste) || empty($artiste)) ? $this->erreurs[] = self::ARTISTE_INVALIDE : $this->artiste = $artiste;
    }
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }  //Si la dateAjout est valide, on met à jour l'attribut dateAjout
    //Fonctions suplémentaires:
    public function isValid()
    {
        return !(empty($this->nom) || empty($this->artiste));
    }    //Vérifie si la news est valide
}

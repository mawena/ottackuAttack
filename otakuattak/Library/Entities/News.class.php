<?php

namespace Library\Entities;

class News extends \Library\Entity
{
    protected $auteur, $titre, $contenu, $dateAjout, $dateModif;
    const AUTEUR_INVALIDE = 1, TITRE_INVALIDE = 2, CONTENU_INVALIDE = 3;    //Constantes relatives aux erreurs pouvant être rencontrées

    //Getters et Setters:
    public function auteur()
    {
        return $this->auteur;
    }
    public function titre()
    {
        return $this->titre;
    }
    public function contenu()
    {
        return $this->contenu;
    }
    public function dateAjout()
    {
        return $this->dateAjout;
    }
    public function dateModif()
    {
        return $this->dateModif;
    }

    public function setAuteur($auteur)
    {
        (!is_string($auteur) || empty($auteur)) ? $this->erreurs[] = self::AUTEUR_INVALIDE : $this->auteur = $auteur;
    }   //Si l'auteur n'est pas valide on l'ajoute aux erreurs, sinon on met à jour l'attribut auteur
    public function setTitre($titre)
    {
        (!is_string($titre) || empty($titre)) ? $this->erreurs[] = self::TITRE_INVALIDE : $this->titre = $titre;
    }    //Si le titre n'est pas valide on l'ajoute aux erreurs, sinon on met à jour l'attribut titre
    public function setContenu($contenu)
    {
        (!is_string($contenu) || empty($contenu)) ? $this->erreurs[] = self::CONTENU_INVALIDE : $this->contenu = $contenu;
    }  //Si le contenu n'est pas valide on l'ajoute aux erreurs, sinon on met à jour l'attribut contenu
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }  //Si la dateAjout est valide, on met à jour l'attribut dateAjout
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;
    }  //Si la dateModif est valide, on met à jour l'attribut dateModif

    //Fonctions suplémentaires:
    public function isValid()
    {
        return !(empty($this->auteur) || empty($this->titre) || empty($this->contenu));
    }    //Vérifie si la news est valide

}

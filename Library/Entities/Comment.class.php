<?php

namespace Library\Entities;

class Comment extends \Library\Entity
{
    protected $elementId, $auteur, $contenu, $date;
    const AUTEUR_INVALIDE = 1, CONTENU_INVALIDE = 2;

    public function isValid()
    {  //Vérifie la validité d'un commentaire
        return !(empty($this->auteur) || empty($this->contenu));
    }
    public function setElementId($elementId)
    { //Met à jour la news commentée
        $this->elementId = (int) $elementId;
    }
    public function setAuteur($auteur)
    { //Met à jour l'auteur du commentaire
        if (!is_string($auteur) || empty($auteur)) {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        } else {
            $this->auteur = $auteur;
        }
    }
    public function setContenu($contenu)
    {   //Met à jour le contenu du commentaire
        if (!is_string($contenu) || empty($contenu)) {
            $this->erreurs[] = self::CONTENU_INVALIDE;
        } else {
            $this->contenu = $contenu;
        }
    }
    public function setDate($date)
    { //Met à jour la date d'ajout / de modification du commentaire
        $this->date = $date;
    }


    public function elementId()
    {
        return $this->elementId;
    }
    public function auteur()
    {
        return $this->auteur;
    }
    public function contenu()
    {
        return $this->contenu;
    }
    public function date()
    {
        return $this->date;
    }
}

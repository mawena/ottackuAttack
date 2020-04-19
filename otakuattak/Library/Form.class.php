<?php

namespace Library;

use \Library\Entity;

class Form
{
    protected $entity, $fields;

    /**
     * Méthode permettant de construire l'objet
     * @param $entity \Library\Entity L'entité utilisé pour créer l'objet
     * @return void
     */
    public function __construct(Entity $entity)
    {
        $this->setEntity($entity);
    }

    /**
     * Méthode permettant d'ajouter des champs au formulaire
     * @param $field Field Le champ à ajouter
     * @return Form
     */
    public function add(Field $field)
    {
        $attr = $field->name();  //On récupère le nom
        $field->setValue($this->entity->$attr());   //On assigne la valeur correspondante au champ
        $this->fields[] = $field;   //On ajoute le champ passé en argument à la liste des champs
        return $this;
    }

    /**
     * Méthode permettant de générer la vue du formulaire
     * @return String
     */
    public function createView()
    {
        $view = "";
        //On générère un par un les champs du formulaire
        foreach ($this->fields as $field) {
            $view .= $field->buildWidget() . "<br/>";
        }
        return $view;
    }

    /**
     * Méthode permettant vérifier la validité du formulaire
     * @return bool
     */
    public function isValid()
    {
        $valid = true;
        //On vérifie si tout les champs sont valides
        foreach ($this->fields as $field) {
            if (!$field->isValid()) {
                $valid = false;
            }
        }
        return $valid;
    }

    /**
     * Méthode retournant l'entité du formulaire
     */
    public function entity()
    {
        return $this->entity;
    }

    /**
     * Méthode permettant de modifier l'entité du formulaire
     * @param $entity \Library\Entity La nouvelle entité de l'objet
     * @return void
     */
    public function setEntity(Entity $entity)
    {
        $this->entity = $entity;
    }
}

<?php

namespace Library;

abstract class FormBuilder
{
    protected $form;

    /**
     * Méthode permettant de construire l'objet
     * @param $entity Entity
     * @return void
     */
    public function __construct(Entity $entity)
    {
        $this->setForm(new Form($entity));
    }

    /**
     * Méthode permettant de construire un formulaire
     * @return void
     */
    abstract public function build();

    /**
     * Méthode retournant le formulaire
     * @return Form
     */
    public function form()
    {
        return $this->form;
    }

    /**
     * Méthode permettant de modifier le formualire
     * @param $form Form le nouveau formulaire
     * @return void
     */
    public function setForm(Form $form)
    {
        $this->form = $form;
    }
}

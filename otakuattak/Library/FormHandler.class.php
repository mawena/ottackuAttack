<?php

namespace Library;

class FormHandler
{
    protected $form, $manager, $request;

    /**
     * Méthode permettant de construire l'objet
     * @param $form
     * @param $manager
     * @param $request
     * @return void
     */
    public function __construct($form, $manager, $request)
    {
        $this->setForm($form);
        $this->setManager($manager);
        $this->setRequest($request);
    }

    /**
     * Méthode permettant le formulaire envoyé
     * @return bool
     */
    public function process()
    {
        if ($this->request->method() == "POST" && $this->form->isValid()) {
            $this->manager->save($this->form->entity());
            return true;
        }
        return false;
    }

    /**
     * Méthode permettant de modifier la valeur de l'attribut 
     * @param $form \Library\Form
     * @return void
     */
    public function setForm(\Library\Form $form)
    {
        $this->form = $form;
    }

    /**
     * Méthode permettant de modifier la valeur de l'attribut 
     * @param $manager \Library\Manager
     * @return void
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
    }

    /**
     * Méthode permettant de modifier la valeur de l'attribut 
     * @param $request \Library\HTTPRequest
     * @return void
     */
    public function setRequest(\Library\HTTPRequest $request)
    {
        $this->request = $request;
    }
}

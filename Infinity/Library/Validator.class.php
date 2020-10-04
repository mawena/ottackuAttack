<?php

namespace Library;

class Validator
{
    protected $errorMessage;

    /**
     * Méthode permettant de construire l'objet
     * @param $errorMessage String
     * @return void
     */
    public function __construct($errorMessage)
    {
        $this->setErrorMessage($errorMessage);
    }


    /**
     * Méthode permettant d'éffectuer une vérification
     * @param $value String La valeur à utilisé pour la vérification
     * @return bool
     */
    public function isValid($value)
    {
    }

    /**
     * Méthode retournant la valeur l'attribut $errorMessage
     * @return String
     */
    public function errorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Méthode permettant de modifier la valeur de $errorMessage
     * @param $errorMessage String la nouvelle valeur de $errorMessage
     * @return void
     */
    public function setErrorMessage($errorMessage)
    {
        if (is_String($errorMessage)) {
            $this->errorMessage = $errorMessage;
        } else {
            throw new \RuntimeException("Le message d'erreur doit être un String");
        }
    }
}

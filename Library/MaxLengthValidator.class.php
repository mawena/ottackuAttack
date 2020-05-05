<?php

namespace Library;

class MaxLengthValidator extends Validator
{
    protected $maxLength;

    /**
     * Méthode permettant de construire l'objet
     * @param $errorMessage String
     * @param $maxLength int
     * @return void
     */
    public function __construct($errorMessage, $maxLength)
    {
        parent::__construct($errorMessage);
        $this->setMaxLength($maxLength);
    }

    public function isValid($value)
    {
        return strlen($value) <= $this->maxLength;
    }

    /**
     * Méthode permettant de modifer le taille maximale
     * @param $maxLength int La nouvelle taille maximum
     * @return void
     */
    public function setMaxLength($maxLength)
    {
        $maxLength = (int) $maxLength;
        if ($maxLength > 0) {
            $this->maxLength = $maxLength;
        } else {
            throw new \RuntimeException("La taille maximum doit être un entier supérieur à 0");
        }
    }
}

<?php

namespace Library;

class StringField extends \Library\Field
{
    protected $maxLength;

    public function buildWidget()
    {
        $widget = "";
        if (!empty($this->errorMessage)) {
            $widget .= $this->errorMessage . "<br/>";
        }
        $widget .= "<label for='" . $this->name() . "'>" . $this->label . "</label> <input type='text' id='" . $this->name() . "' name='" . $this->name() . "'";
        if (!empty($this->value)) {
            $widget .= " value='" . htmlspecialchars($this->value) . "'";
        }
        if (!empty($this->maxLength)) {
            $widget .= " maxlength='" . htmlspecialchars($this->maxLength) . "'";
        }
        return $widget . "/>";
    }

    /**
     * Méthode permettant de modifier le taille maximum du champ String
     * @param $maxLength int La taille maximum de la valeur du champ
     * @return void
     */
    public function setMaxLength(int $maxLength)
    {
        $maxLength = (int) $maxLength;
        if ($maxLength > 0) {
            $this->maxLength = (int) $maxLength;
        } else {
            throw new \RuntimeException('La longeur maximal doit être un nombre supérieur à 0');
        }
    }
}

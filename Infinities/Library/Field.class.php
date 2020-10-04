<?php

namespace Library;

abstract class Field
{
    protected $errorMessage, $label, $name, $value, $validators = array();

    /**
     * Méthode permettant de construire l'objet
     * @param $option array Les options du champ
     * @return void
     */
    public function __construct($options = array())
    {
        if (!empty($options)) {
            $this->hydrate($options);
        }
    }

    /**
     * Méthode retournant Le génération du code HTML du champ
     * @return String
     */
    abstract public function buildWidget();

    /**
     * Méthode permettant d'hydrater l'objet
     * @param $option array Les options du champ
     * @return void
     */
    public function hydrate($options)
    {
        foreach ($options as $type => $value) {
            $method = 'set' . ucfirst($type);
            if (is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }

    /**
     * Méthode retournant la vérification de validation de champ
     * @return bool
     */
    public function isValid()
    {
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($this->value)) {
                $this->errorMessage = $validator->errorMessage();
                return false;
            }
        }
        return true;
    }

    /**
     * Méthode retournant le label du champ
     * @return String
     */
    public function label()
    {
        return $this->label;
    }

    /**
     * Méthode retournant le nom du champ
     * @return String
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Méthode retournant la valeur du champ
     * @return String
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Méthode retournant les validateurs du champ
     * @return array
     */
    public function validators()
    {
        return $this->validators;
    }

    /**
     * Méthode permettant de modifier le label du champ
     * @return void 
     */
    public function setLabel($label)
    {
        if (is_string($label)) {
            $this->label = $label;
        }
    }

    /**
     * Méthode permettant de modifier le nom du champ
     * @return void
     */
    public function setName($name)
    {
        if (is_string($name)) {
            $this->name = $name;
        }
    }

    /**
     * Méthode permettant de modifier la valeur du champ
     * @return void
     */
    public function setValue($value)
    {
        if (is_string($value)) {
            $this->value = $value;
        }
    }

    /**
     * Méthode permettant de modifier les validateurs du champ
     * @param $validators array La liste des validateurs
     * @return void
     */
    public function setValidators($validators)
    {
        foreach ($validators as $validator) {
            if ($validator instanceof Validator && !in_array($validator, $this->validators)) {
                $this->validators[] = $validator;
            } else {
                throw new \RuntimeException('Les validateurs doivent être contenus dans un liste');
            }
        }
    }
}

<?php

namespace Library;

class TextField extends \Library\Field
{
    protected $cols, $rows;


    public function buildWidget()
    {
        $widget = "";
        if (!empty($this->errorMessage)) {
            $widget .= $this->errorMessage . "<br/>";
        }
        $widget .= "<label for='" . $this->name() . "'>" . $this->label . "</label> <textarea id='" . $this->name() . "' name='" . $this->name() . "'";
        if (!empty($this->cols)) {
            $widget .= " cols='" . htmlspecialchars($this->cols) . "'";
        }
        if (!empty($this->rows)) {
            $widget .= " rows='" . htmlspecialchars($this->rows) . "'";
        }
        $widget .= ">";

        if (!empty($this->value)) {
            $widget .= htmlspecialchars($this->value);
        }
        return $widget .= "</textarea>";
    }

    /**
     * Méthode permettant de modifier la propriété $cols
     * @param $cols int
     * @return void
     */
    public function setCols($cols)
    {
        $this->cols = $cols;
    }

    /**
     * Méthode permettant de modifier la propriété $rows
     * @param $rows int
     * @return void
     */
    public function setRows($rows)
    {
        $this->rows = $rows;
    }
}

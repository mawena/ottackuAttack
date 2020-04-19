<?php

namespace Library;

class Route
{
    protected $action, $module, $url, $varsNames, $vars = array();

    public function __construct($url, $module, $action, $varsNames)
    {
        $this->setUrl($url);
        $this->setModule($module);
        $this->setAction($action);
        $this->setVarsNames($varsNames);
    }

    public function hasVars()
    {
        return !empty($this->varsNames);
    }
    public function match($url)
    {
        if (preg_match('`^' . $this->url . '$`', $url, $matches)) {   //I!
            return $matches;
        } else {
            return false;
        }
    }
    public function setUrl($url)
    {
        (is_string($url)) ? $this->url = $url : null;
    }
    public function setModule($module)
    {
        (is_string($module)) ? $this->module = $module : null;
    }
    public function setAction($action)
    {
        (is_string($action)) ? $this->action = $action : null;
    }
    public function setVarsNames(array $varsNames)
    {
        $this->varsNames = $varsNames;
    }
    public function setVars(array $vars)
    {
        $this->vars = $vars;
    }
    public function url()
    {
        return $this->url;
    }
    public function module()
    {
        return $this->module;
    }
    public function action()
    {
        return $this->action;
    }
    public function varsNames()
    {
        return $this->varsNames;
    }
    public function vars()
    {
        return $this->vars;
    }
}

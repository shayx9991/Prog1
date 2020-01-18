<?php

namespace app\core;
use app\core\View;

abstract class Controller
{
    public $route;
    public $view;
    public $acl;

    public function __construct($route)
    {
        $this->route=$route;    
        $_SESSION['authorize']['id'] = 1;
        if(!$this->checkAcl()){
            View::errors(403);
        }
        $this->view= new View($route);
        $this->model = $this->loadModel($route['controller']);
        //debug();
    }

    public function loadModel($name) {
        $path = 'app\models\\'.ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
        //debug($path);
    }

    
    public function checkAcl(){
        $this->acl = require 'app/acl/'.$this->route['controller'].'.php';
        if($this->isAcl('all')){
            return true;
        }
        elseif(isset($_SESSION['authorize']['id']) && $this->isAcl('authorize')){
            return true;
        }
        elseif(!isset($_SESSION['authorize']['id']) && $this->isAcl('guest')){
            return true;
        }
        elseif(isset($_SESSION['admin']) && $this->isAcl('admin')){
            return true;
        }
        return false;    
    }

    public function isAcl($key){
        return  in_array($this->route['action'], $this->acl[$key]);
    }
    

}
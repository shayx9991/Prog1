<?php

namespace app\core;
use app\core\View;

class Router
{
    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        $arr = require 'app/config/routes.php';
        //debug($arr);
        foreach ($arr as $key=> $val){
            $this->add($key,$val);
        }
    }
    // add routes 
    public function add($route, $params){
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }
    // check route in routes
    public function match(){
        $url = trim($_SERVER['REQUEST_URI'],'/');
        // debug($url);
        foreach ($this->routes as $route=>$params){
            if(preg_match($route,$url,$matches)){
                    $this->params = $params;
                    return true;
            }
        }
        return false;
    }
    // when object has taken this function run
    public function run(){
        if($this->match()){
            $path = 'app\controllers\\'.ucfirst($this->params['controller']).'Controller';
            //echo $path;
            if(class_exists($path)) {
                $action = $this->params['action'].'Action';
                if (method_exists($path,$action)){
                    $controller = new $path($this->params);
                    $controller->$action();
                }else{
                    View::errors(404);
                }
            }else{
                View::errors(404);
            }
        }else{
            View::errors(403);
        }
    }

}
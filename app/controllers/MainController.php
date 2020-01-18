<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

class MainController extends Controller
{
    
    public function  IndexAction(){
        $result = $this->model->getNews();
        $vars =[
            'F_I_SH' => $result,
        ];
        $this->view->render('Main page site', $vars);
    }

    public function  ContactAction(){
        $this->view->render('Contact page site');
    }

}
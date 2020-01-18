<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller
{
    public function  loginAction(){       
        if(!empty($_POST)){
            $this->view->location('/');    
        }
        
        //$this->view->redirect('https://www.php.net');
        $this->view->render('Login page site');
    }

    public function  registerAction(){
        $this->view->render('Register page site');
    }


}
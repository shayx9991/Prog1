<?php

namespace app\controllers;

use app\core\Controller;

class NewsController extends Controller
{

    public function  ShowAction(){
        $this->view->render('News page site');
        echo  'Show action';
    }


}
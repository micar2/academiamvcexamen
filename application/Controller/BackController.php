<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Back;
use Mini\Libs\Sesion;
use Mini\Model\Validation;

class BackController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->addData(['titulo' => 'Admin']);
    }

    public function index()
    {
        if(Back::adminIsLoggedIn()){
            echo $this->view->render('back/index');
        }else{
            echo $this->view->render('home/index');
        }

    }


}
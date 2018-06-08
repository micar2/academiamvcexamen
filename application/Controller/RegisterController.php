<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Crud;
use Mini\Model\Register;
use Mini\Libs\Sesion;
use Mini\Model\Validation;

class RegisterController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->addData(['titulo' => 'Register']);
    }

    public function index()
    {
        echo $this->view->render('register/index');
    }

    public function doregister()
    {
        $data=Validation::valAllRegister($_POST);

        if($_POST['error']=='todo correcto'){
            if (Crud::create('users', $data)) {

                echo $this->view->render('login/index');

            } else {

                echo $this->view->render('register/index');

            } }else {

            echo $this->view->render('register/index');

        }

    }

}
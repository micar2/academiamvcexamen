<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Login;
use Mini\Libs\Sesion;
use Mini\Model\Validation;

class LoginController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->view->addData(['titulo' => 'Login']);
	}

	public function index()
	{
		echo $this->view->render('login/index');
	}

	public function dologin()
	{

        if(Validation::valAllLoguin($_POST)){
            if($_POST['error']=='todo correcto'){
                if (Login::dologin($_POST)) {
                    if($origen = Sesion::get('origen')){
                        Sesion::set('origen', null);
                        header('location: '.$origen);
                        exit();
                    }
                    echo $this->view->render('login/usuariologueado');
                } else {
                    echo $this->view->render('login/index');
                }
            }else {
                echo $this->view->render('login/index');
            }
        }



	}

	public function salir()
	{
		Login::salir();
	}
}
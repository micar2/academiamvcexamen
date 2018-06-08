<?php

namespace Mini\Controller;

use Mini\Core\Auth;
use Mini\Core\Controller;
use Mini\Libs\Sesion;

class PrivadoController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		Sesion::set('origen', 'privado');
		Auth::checkAutentication();
	}

	public function index()
	{
		echo $this->view->render('privado/index');
	}
}
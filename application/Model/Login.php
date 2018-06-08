<?php 

namespace Mini\Model;

use Mini\Libs\Sesion;
use Mini\Core\Database;
use PDO;
class Login
{
	public static function dologin($datos)
    {

        $conn = Database::getInstance()->getDatabase();
        $ssql = " SELECT * FROM users WHERE email=:email";
        $query = $conn->prepare($ssql);
        $query->bindValue(':email', $datos['email'], PDO::PARAM_STR);
        $query->execute();

        $cuantos = $query->rowCount();
        if ($cuantos != 1) {
            $_POST["feedback_negative"] = "No existe ese usuario";
            $error = 1;
        }

        $usuario = $query->fetch();
        if ($usuario->password != $datos['password']) {
            $_POST["feedback_negative"] = "No existe ese usuario";
            $error = 1;
        }
        if (!isset($error)) {

            Sesion::set('user_id', $usuario->id);
            Sesion::set('user_name', $usuario->name);
            Sesion::set('user_email', $usuario->email);
            Sesion::set('user_rol', $usuario->user_rol);
            if ($usuario->user_rol == 'admin'){self::getMenu();}
            Sesion::set('user_logged_in', true);
            return true;
        } else {
            echo $_POST["feedback_negative"];
        }
    }

    public static function getMenu()
    {
        $conn = Database::getInstance()->getDatabase();
        $ssql = " SHOW TABLES ";
        $query = $conn->prepare($ssql);
        $query->execute();
        $tables = $query->fetchAll();

        foreach ($tables as $table2){
           foreach ($table2 as $table){
               Sesion::add('tables', $table);
           }

        }

    }

	public static function salir()
    {
		Sesion::destroy();
		header('location: /');
		exit();
	}
}
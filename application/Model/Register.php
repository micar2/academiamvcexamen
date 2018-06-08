<?php

namespace Mini\Model;

use Mini\Libs\Sesion;
use Mini\Core\Database;
use PDO;
class Register
{
    public static function doregister($datos)
    {

        $conn = Database::getInstance()->getDatabase();
        $ssql = " INSERT INTO users(name, email, password, user_rol) VALUES (:name, :email, :password, :user_rol)";
        $query = $conn->prepare($ssql);
        $query->bindValue(':name', $datos['name'], PDO::PARAM_STR);
        $query->bindValue(':email', $datos['email'], PDO::PARAM_STR);
        $query->bindValue(':password', md5($datos['password']), PDO::PARAM_STR);
        $query->bindValue(':user_rol', $datos['user_rol'], PDO::PARAM_STR);
        if($query->execute()){
            return true;
        }

    }
}
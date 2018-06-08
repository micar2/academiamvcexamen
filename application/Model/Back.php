<?php

namespace Mini\Model;

use Mini\Libs\Sesion;
use Mini\Core\Database;
use PDO;
class Back
{
        public static function adminIsLoggedIn()
        {
            if (Sesion::userIsLoggedIn() && Sesion::get('user_rol')=='admin'){
                return true;
            }else{
                return false;
            }
        }
}
<?php

namespace Mini\Model;

use Mini\Libs\Sesion;
use Mini\Core\Database;
use PDO;
class Validation
{
    public static function valAllRegister($data)
    {   $error='';
        $total=0;

        if (isset($data['name'])){
            self::valName($data['name'], 'name');
        }else{
            $error .= "el nombre esta vacio";
        }
        if (isset($data['email'])){
            self::valEmail($data['email']);
        }
        if (isset($data['password']) && isset($data['confPassword'])) {
            self::valPassword($data['password'], $data['confPassword']);
        }else{
            $error .= "la contraseña o la comprobacion estan vacia";
            $_POST['error_password'] = $error;
        }
        foreach ($data as $index => $datum) {
            if (!empty($_POST['error_'.$index])){
                $total++;
            }
        }
        if ($total==0){
            $_POST['error']='todo correcto';
            unset($data['confPassword']);
            return $data;
        }else{
            $_POST['error']='hay errores';
            return false;
        }

    }
    public static function valAllLoguin($data)
    {
        $total=0;
        if (isset($data['email'])){
            self::valEmailLoguin($data['email']);
        }
        if (isset($data['password'])) {
            self::valPasswordLoguin($data['password']);
        }

        foreach ($data as $index => $datum) {
            if (!empty($_POST['error_'.$index])){
                $total++;
            }
        }
        if ($total==0){
            $_POST['error']='todo correcto';
            return $data;
        }else{
            $_POST['error']='hay errores';
            return false;
        }
    }

    public static function valEmailLoguin($data)
    {
        $error='';
        if ( Sesion::userIsLoggedIn()){
            $error.="Ya existe una sesion iniciada";
        }
        if (! empty($data)) {
            $data = trim($data);
            if (isset($_POST["feedback_negative"])){
                if (!empty($_POST['feedback_negative'])){
                $error.=$_POST['feedback_negative'];
                }
            }
            if(! filter_var($data, FILTER_VALIDATE_EMAIL )){
                $error.="el email debe ser valido";
            }
            if (!preg_match("/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/",$data)) {
                $error.= "El email no es valido\n";
            }
            if (strlen($data)<6) {
                $error.= "Email demasiado corto\n";
            }
            $_POST['error_email']= $error;

        }else{
            $error.= "el email esta vacio";
            $_POST['error_email']= $error;
        }
    }

    public static function valPasswordLoguin($data)
    {
        $error='';
        if (!empty($data)) {
                    if (isset($_POST["feedback_negative"])){
                        if (!empty($_POST['feedback_negative'])){
                            $error.=$_POST['feedback_negative'];
                        }
                    }
                    if (strlen($data) < 6) {
                        $error.= " debe tener al menos 6 caracteres\n";
                    }
                    if (strlen($data) > 16) {
                        $error.= "  no puede tener más de 16 caracteres\n";
                    }
                    if (!preg_match('/[0-9]/', $data)) {
                        $error.= " debe tener al menos un caracter numérico";
                    }
                    $_POST['error_password'] = $error;

        } else {
            $error .= "la contraseña esta vacia";
            $_POST['error_password'] = $error;
        }

    }

    public static function valName($data, $name)
    {
        if (isset($data)) {
            $error = '';
            if (!empty($data)) {
                if (!preg_match("/[^0-9]/", $data)) {
                    $error.= "no puede tener numeros\n";
                }

                if (!preg_match("/[a-zA-ZñÑàÀèÈìÌòÒùÙüÜ\-.]/", $data)) {
                    $error.= "El " . $name . " no es valido\n";

                }
                if (strlen($data) < 3) {
                    $error.= "El " . $name . " es demasiado corto\n";

                }
                $n = 0;
                for ($i = 0; $i < strlen($data); $i++) {
                    if (substr($data, $i, 1) == substr($data, $i + 1, 1) && substr($data, $i + 1, 1) == substr($data, $i + 2, 1)) {
                        $n++;
                    }

                }
                if ($n > 0) {
                    $error.= "Demasiados caracteres iguales\n";

                }
                $_POST['error_'.$name]= $error;
            } else {
                $error.= "el " . $name . " esta vacio";
                $_POST['error_'.$name]= $error;
                return false;
            }


        }else {

            return false;
        }
    }

    public static function valEmail($data)
    {
        $error='';
        if (! empty($data)) {
            $n=0;
            if (!preg_match("/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/",$data)) {
                $error.= "El email no es valido\n";
                $n++;
            }
            if (strlen($data)<6) {
                $error.= "Email demasiado corto\n";
                $n++;
            }
            if ($n==0){
                $conn = Database::getInstance()->getDatabase();
                $ssql = " SELECT email FROM users  WHERE email=:email";
                $query = $conn->prepare($ssql);
                $query->bindValue(':email', $data, PDO::PARAM_STR);
                $query->execute();

                if($query->rowCount() != 0){
                    $error.= "Email en uso";
                }
            }
            $_POST['error_email']= $error;

        }else{
            $error.= "el email esta vacio";
            $_POST['error_email']= $error;
        }

    }

    public static function valPassword($data, $dataRepeat)
    {
        $error='';

        if (!empty($data)) {

            if (!empty($dataRepeat)) {

                if ($data == $dataRepeat) {

                    if (!preg_match("/[^a-zA-Z0-9]/", $data)) {
                        $error.= " debe tener al menos un caracter especial\n";
                    }
                    if (strlen($data) < 6) {
                        $error.= " debe tener al menos 6 caracteres\n";
                    }
                    if (strlen($data) > 16) {
                        $error.= "  no puede tener más de 16 caracteres\n";
                    }
                    if (!preg_match('/[a-z]/', $data)) {
                        $error.= "  debe tener al menos una letra minúscula\n";
                    }
                    if (!preg_match('/[A-Z]/', $data)) {
                        $error.= "  debe tener al menos una letra mayúscula\n";
                    }
                    if (!preg_match('/[0-9]/', $data)) {
                        $error.= " debe tener al menos un caracter numérico";
                    }
                    $_POST['error_password'] = $error;


                } else {
                    $error .= "las contraseñas no coinciden\n";
                    $_POST['error_password'] = $error;
                }
            } else {
                $error .= "la confirmación esta vacia";
                $_POST['error_password'] = $error;
            }
        } else {
            $error .= "la contraseña esta vacia";
            $_POST['error_password'] = $error;
        }

    }


}


<?php

namespace Mini\Model;

use Mini\Libs\Sesion;
use Mini\Core\Database;
use PDO;
class Crud
{
    public static function getAll($table)
    {
        $conn = Database::getInstance()->getDatabase();
        $ssql = 'SELECT * FROM '.$table.';';
        $query = $conn->prepare($ssql);
        $query->execute();
        $query = $query->fetchAll();
        return $query;
    }

    public static function getWhere($date, $type, $table, $more=false)
    {
        $conn = Database::getInstance()->getDatabase();
        $ssql = 'SELECT * FROM '.$table.' WHERE '.$type.'='.$date.';';
        $query = $conn->prepare($ssql);
        $query->execute();
        if ($more){
            $query = $query->fetchAll();
        }else{
            $query = $query->fetch();
        }
        return $query;
    }

    public static function update($table, $dates)
    {
        $values = '';
        foreach ($dates as $camp => $date){
            if ($camp!='id'){
                $values.= $camp.'="'.$date.'", ';
            }
        }
        $values= trim($values, ', ');
        $conn = Database::getInstance()->getDatabase();
        $ssql = 'UPDATE '.$table.' SET '.$values.' WHERE id='.$dates['id'];
        $query = $conn->prepare($ssql);
        if($query->execute()){
            return true;
        }
    }

    public static function actPost($table, $date)
    {
        $dates = self::getWhere($date,'id',$table);
        foreach ($dates as $key => $date){
            $_POST[$key] = $date;
        }
        return true;
    }

    public static function delete($table, $id)
    {
        $conn = Database::getInstance()->getDatabase();
        $ssql = 'DELETE FROM '.$table.' WHERE id='.$id;

        $query = $conn->prepare($ssql);
        if($query->execute()){
            return true;
        }
    }

    public static function create($table, $dates)
    {
        $values = '';
        $camps = '';
        foreach ($dates as $camp => $date){
            if ($camp=='password'){
                $values.="'".md5($date)."', ";
            }else{
                $values.="'".$date."', ";
            }
            $camps.=$camp.', ';
        }
        $values= trim($values, ', ');
        $camps= trim($camps, ', ');
        $conn = Database::getInstance()->getDatabase();
        $ssql = 'INSERT INTO '.$table.' ('.$camps.') VALUES ('.$values.')';
        echo ($ssql);
        $query = $conn->prepare($ssql);
        if($query->execute()){
            return true;
        }
    }

    public static function selectColums($table)
    {
        $conn = Database::getInstance()->getDatabase();
        $ssql = 'SHOW COLUMNS FROM '.$table;
        $query = $conn->prepare($ssql);
        $query->execute();
        $colums = $query->fetchAll();

        return $colums;


    }



}
<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Back;
use Mini\Model\Crud;
use Mini\Libs\Sesion;
use Mini\Model\Validation;


class ComentariesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->addData(['titulo' => 'Comentarios']);
        $this->table = 'comentaries';
    }

    public function index()
    {
        $comentaries=Crud::getAll($this->table);
        $columns=Crud::selectColums($this->table);
        echo $this->view->render('back/'.$this->table.'/index', ['categories' => $comentaries, 'columns' => $columns]);
    }

    public function create()
    {
        if (Back::adminIsLoggedIn()){
            if ($_POST){
                if(Crud::create($this->table, $_POST)){
                    unset($_POST);
                    Self::index();
                }
            }else{
                $columns=Crud::selectColums($this->table);
                echo $this->view->render('back/'.$this->table.'/create', ['columns' => $columns]);
            }
        }else{
            echo $this->view->render('home/index');
        }

    }

    public function delete($id = 0)
    {
        if (Back::adminIsLoggedIn()){
            if(Crud::delete($this->table, $id)){
                self::index();

            }
        }else{
            echo $this->view->render('home/index');
        }
    }

    public function update($id = 0)
    {
        if (Back::adminIsLoggedIn()){
            if ($_POST){
                if(Crud::update($this->table,$_POST)){
                    unset($_POST);
                    self::index();
                }
            }else{
                if(Crud::actPost($this->table,$id)){
                    $columns=Crud::selectColums($this->table);
                    echo $this->view->render('back/'.$this->table.'/update',['columns'=>$columns ]);
                }
            }

        }else{
            echo $this->view->render('home/index');
        }
    }
}
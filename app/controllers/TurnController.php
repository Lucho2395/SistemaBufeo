<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 19/11/2018
 * Time: 10:21
 */

require 'app/models/Turn.php';
class TurnController{
    private $log;
    private $turn;
    private $menu;
    private $crypt;
    private $nav;

    public function __construct()
    {
        $this->log = new Log();
        $this->turn = new Turn();
        //$this->menu = new Menu();
        $this->crypt = new Crypt();
    }

    //Vistas
    public function seeAll(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $turns = $this->turn->listall();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'turn/seeall.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function add(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'turn/add.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    //Funciones
    public function save(){
        try{
            $model = new Turn();
            $model->turn_datestart = date("Y-m-d");
            $model->turn_inicialcash = $_POST['turn_inicialcash'];
            $result = $this->turn->save($model);

            if($result == 1){
                $turn = $this->turn->searchByDay(date("Y-m-d"));
                $productos = $this->turn->listP();
                $result = $this->turn->setStock($productos, $turn->id_turn);
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Turn|save');
            $result = 2;
        }
        echo $result;
    }

    public function change(){
        try{
            $id_turn = $_POST['id'];
            $result = $this->turn->change($id_turn);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Turn|change');
            $result = 2;
        }
        echo $result;
    }
}
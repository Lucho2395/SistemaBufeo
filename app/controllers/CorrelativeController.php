<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 2/05/2019
 * Time: 13:17
 */

require 'app/models/Correlative.php';
class CorrelativeController{
    private $log;
    private $correlative;

    private $crypt;
    private $nav;

    public function __construct()
    {
        $this->log = new Log();
        $this->correlative = new Correlative();

        $this->crypt = new Crypt();
    }

    //Vistas
    public function show(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $correlative = $this->correlative->list();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'correlative/show.php';
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
            $model = new Correlative();
            $model->correlative_b  = $_POST['correlative_b'];
            $model->correlative_f = $_POST['correlative_f'];
            $model->correlative_in = $_POST['correlative_in'];
            $model->correlative_out = $_POST['correlative_out'];
            $model->correlative_p = $_POST['correlative_p'];
            $model->id_correlative = $_POST['id_correlative'];
            $result = $this->correlative->save($model);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Correlative|save');
            $result = 2;
        }
        echo $result;
    }
}
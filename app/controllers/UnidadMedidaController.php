<?php
/**
 * Created by PhpStorm.
 * User: Lucho
 * Date: 31/08/2020
 * Time: 23:20
 */
require 'app/models/UnidadMedida.php';
require 'app/models/Active.php';

class UnidadMedidaController
{
    private $crypt;
    private $menu;
    private $log;
    private $active;
    private $nav;
    private $unidadmedida;

    public function __construct()
    {
        $this->crypt = new Crypt();
        //$this->menu = new Menu();
        $this->log = new Log();
        $this->active =  new Active();
        $this->unidadmedida = new UnidadMedida();

    }
    public function listmedidas(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $unimedida = $this->unidadmedida->listAll();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'unidadmedida/listarunidades.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function Cambiarestado(){
        try {
            $id_medida = $_POST['medida_id'];
            $estado = $_POST['estado'];
            $result = $this->unidadmedida->cambiar_estado($estado, $id_medida);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
        }
        return $result;
    }
}
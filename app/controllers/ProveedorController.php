<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 14/05/2019
 * Time: 22:50
 */

require 'app/models/Proveedor.php';
class ProveedorController
{
    private $log;
    private $crypt;
    private $nav;
    private $proveedor;

    public function __construct()
    {
        $this->log = new Log();
        $this->proveedor = new Proveedor();

        $this->crypt = new Crypt();
    }

    //Vistas
    public function all()
    {
        try {
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'], _PASS_));
            $proveedor = $this->proveedor->listAll();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'proveedor/all.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"" . _SERVER_ . "\";</script>";
        }
    }

    public function add()
    {
        try {
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'], _PASS_));
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'proveedor/add.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"" . _SERVER_ . "\";</script>";
        }
    }

    public function edit()
    {
        try {
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'], _PASS_));
            $id = $_GET['id'] ?? 0;
            if ($id == 0) {
                throw new Exception('ID Sin Declarar');
            }
            $_SESSION['id_proveedor'] = $id;
            $proveedor = $this->proveedor->list($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'proveedor/edit.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"" . _SERVER_ . "\";</script>";
        }
    }

    //Funciones
    public function save()
    {
        try {
            $model = new Proveedor();
            if (isset($_SESSION['id_proveedor'])) {
                $validacion = $this->proveedor->validardnieditar($_POST['ruc_proveedor'], $_SESSION['id_proveedor']);
                $model->id_proveedor = $_SESSION['id_proveedor'];
            }else {
                $validacion = $this->proveedor->validardni($_POST['ruc_proveedor']);
            }
            if($validacion) {
                $result = 3;
            } else{
                $model->ruc_proveedor = $_POST['ruc_proveedor'];
                $model->nombre_provee = $_POST['nombre_provee'];
                $model->contacto_provee = $_POST['contacto_provee'];
                $model->telefono_provee = $_POST['telefono_provee'];
                $model->direccion_provee = $_POST['direccion_provee'];
                $result = $this->proveedor->save($model);
            }

        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function delete(){
        try{
            $id = $_POST['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $result = $this->proveedor->delete($id);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

}
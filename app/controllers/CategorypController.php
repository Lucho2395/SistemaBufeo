<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 14/05/2019
 * Time: 22:50
 */

require 'app/models/Categoryp.php';
class CategorypController
{
    private $log;
    private $crypt;
    private $nav;
    private $categoryp;

    public function __construct()
    {
        $this->log = new Log();
        $this->categoryp = new Categoryp();

        $this->crypt = new Crypt();
    }

    //Vistas
    public function all()
    {
        try {
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'], _PASS_));
            $categoryp = $this->categoryp->listAll();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'categoryp/all.php';
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

            require _VIEW_PATH_ . 'categoryp/add.php';
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
            $_SESSION['id_categoryp'] = $id;
            $categoryp = $this->categoryp->list($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'categoryp/edit.php';
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
            $model = new Categoryp();
            if (isset($_SESSION['id_categoryp'])) {
                $model->id_categoryp = $_SESSION['id_categoryp'];
                $model->categoryp_name = $_POST['categoryp_name'];
                $model->categoryp_description = $_POST['categoryp_description'];
                $result = $this->categoryp->save($model);
            } else {
                $model->categoryp_name = $_POST['categoryp_name'];
                $model->categoryp_description = $_POST['categoryp_description'];
                $result = $this->categoryp->save($model);

            }
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

}
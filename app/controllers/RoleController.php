<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 15/10/2018
 * Time: 17:48
 */

require 'app/models/Role.php';
require 'app/models/Menu.php';
class RoleController{
    private $crypt;
    private $nav;
    private $role;
    private $log;
    private $menu;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->role = new Role();
        $this->log = new Log();
        $this->menu = new Menu();
    }

    //Vistas
    public function all(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $role = $this->role->listAll();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'role/all.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
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

            require _VIEW_PATH_ . 'role/add.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function edit(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $_SESSION['id_rolee'] = $id;
            $rol_e = $this->role->list($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'role/edit.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function options(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $id_role = $_GET['id'] ?? 0;
            if($id_role  == 0){
                throw new Exception('ID Sin Declarar');
            }
            $role = $this->role->list($id_role);
            $menu = $this->role->listAllMenu();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'role/options.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    //Funciones
    public function save(){
        try{
            $model = new Role();
            if(isset($_SESSION['id_rolee'])){
                $model->id_role = $_SESSION['id_rolee'];
                $model->role_name= $_POST['role_name'];
                $model->role_description = $_POST['role_description'];
                $result = $this->role->save($model);
                unset($_SESSION['id_rolee']);
            } else {
                $model->role_name= $_POST['role_name'];
                $model->role_description = $_POST['role_description'];
                $result = $this->role->save($model);
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
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
            $result = $this->role->delete($id);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function addRelation(){
        try{
            $model = new Role();
            if($this->menu->verificatePassword($this->crypt->decrypt($_SESSION['user_nickname'],_PASS_), $_POST['password'])) {
                $id_role = $_POST['id_role'];
                $id_menu = $_POST['id_menu'];
                $result = $this->role->AddRelationship($id_role, $id_menu);
            } else {
                $result = 3;
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function deleteRelation(){
        try{
            $model = new Role();
            if($this->menu->verificatePassword($this->crypt->decrypt($_SESSION['user_nickname'],_PASS_), $_POST['password'])) {
                $id_role = $_POST['id_role'];
                $id_menu = $_POST['id_menu'];
                $result = $this->role->DeleteRelationship($id_role, $id_menu);
            } else {
                $result = 3;
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 15/10/2018
 * Time: 17:49
 */

//Llamada a modelos necesarios
require 'app/models/User.php';
require 'app/models/Person.php';
require 'app/models/Role.php';
class UserController{
    private $crypt;
    private $nav;
    private $user;
    private $person;
    private $role;
    private $log;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->user = new User();
        $this->person = new Person();
        $this->role = new Role();
        $this->log = new Log();
    }

    //Vistas
    public function all(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $user = $this->user->listAll();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'user/all.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function add(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $roles = $this->role->listAll2();
            $person = $this->person->listAllFree();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'user/add.php';
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
            $_SESSION['id_usered'] = $id;
            $user = $this->user->list($id);
            $roles = $this->role->listAll2();
            $person = $this->person->listAll();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'user/edit.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function changep(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $_SESSION['id_userchg'] = $id;
            $user = $this->user->list($id);

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'user/changep.php';
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
            $model = new User();
            if(isset($_SESSION['id_usered'])) { //con el slectNickname valida que el user_nickname de la bd sea igual al $user_nick name que recibe del formulario
                $validacion = $this->user->validateUsereditar($_POST['user_nickname'], $_SESSION['id_usered']);//sin esta validadion no se podria guardar ese usuario con su mismo user_nickname
            } else {
                $validacion = $this->user->validateUser($_POST['user_nickname']);
            }
            if ($validacion) {
                $result = 3;
            } else if (isset($_SESSION['id_usered'])) {
                $model->id_user = $_SESSION['id_usered'];
                $model->user_nickname = $_POST['user_nickname'];
                $model->user_status = $_POST['user_status'];
                $model->user_email = $_POST['user_email'];
                $model->id_role = $_POST['id_role'];
                $model->id_person = $_POST['id_person'];
                $result = $this->user->save($model);
                $this->user->sessionclose();
            } else {
                $model->user_nickname= $_POST['user_nickname'];
                $model->user_password =  password_hash($_POST['user_password'], PASSWORD_BCRYPT);
                $model->user_email = $_POST['user_email'];
                $model->id_role = $_POST['id_role'];
                $model->id_person = $_POST['id_person'];
                $result = $this->user->save($model);
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function changepass(){
        try{
            $model = new User();
            if(isset($_SESSION['id_userchg'])){
                $model->id_user = $_SESSION['id_user'];
                $model->user_password =  password_hash($_POST['user_password'], PASSWORD_BCRYPT);
                $result = $this->user->changepassword($model);
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
            $result = $this->user->delete($id);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }
}
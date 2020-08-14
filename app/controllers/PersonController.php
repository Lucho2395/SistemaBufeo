<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 15/10/2018
 * Time: 17:48
 */

require 'app/models/Person.php';
class PersonController{
    private $crypt;
    private $nav;
    private $person;
    private $log;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->person = new Person();
        $this->log = new Log();
    }

    //Vistas
    public function all(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $person = $this->person->listAll();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'person/all.php';
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

            require _VIEW_PATH_ . 'person/add.php';
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
            $_SESSION['id_persone'] = $id;
            $person = $this->person->list($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'person/edit.php';
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
            $model = new Person();
            if(isset($_SESSION['id_persone'])) {
                $validacion = $this->person->validardnieditar($_POST['person_dni'], $_SESSION['id_persone']);
                $model->id_person = $_SESSION['id_persone'];
            } else {
                $validacion = $this->person->validardni($_POST['person_dni']);
            }
            if($validacion){
                $result = 3;
            } else{
                $model->person_name= $_POST['person_name'];
                $model->person_surname = $_POST['person_surname'];
                $model->person_dni = $_POST['person_dni'];
                $model->person_birth = $_POST['person_birth'];
                $model->person_number_phone = $_POST['person_number_phone'];
                $model->person_genre = $_POST['person_genre'];
                $model->person_address = $_POST['person_address'];
                $result = $this->person->save($model);
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
            $result = $this->person->delete($id);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }
}

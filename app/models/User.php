<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 17/10/2018
 * Time: 1:13
 */

//use Exception;
class User{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function readAllrolenotfree(){
        try{
            $sql = 'select * from role where id_role <> 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), "User|readAllrolenotfree");
            $result = 2;
        }
        return $result;
    }

    public function selectuser($id){
        try{
            $sql = 'select * from user u inner join person p on u.id_person = p.id_person where u.id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), "User|selectuser");
            $result = 2;
        }
        return $result;
    }


    public function readAll(){
        try {
            $sql = 'select * from user u inner join person p on u.id_person = p.id_person inner join role r on u.id_role = r.id_role';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(),'User|readAll');
            $result = 2;
        }
        return $result;
    }

    //Listar Toda La Info Sobre Usuarios
    public function listAll(){
        try{
            $sql = 'select * from user u inner join role r on u.id_role = r.id_role';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    //listar el usuario para el filtro de Pedidos
    public function listAllPedidos(){
        try{
            $sql = 'select * from user where user_status = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function getDni($id){
        try{
            $sql = 'select person_dni from user u inner join person p on u.id_person = p.id_person where u.id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result->person_dni;
    }

    public function validateUsereditar($nickname , $id_user){
        try{
            $sql = 'select * from user where user_nickname = ? and id_user <> ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$nickname , $id_user]);
            $resultado = $stm->fetch();
            (isset($resultado->id_user)) ? $result=true:$result=false;
        }catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function validateUser($nickname){
        try{
            $sql = 'select * from user where user_nickname = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$nickname]);
            $resultado = $stm->fetch();
            (isset($resultado->id_user)) ? $result = true : $result = false;

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function selectNickname($id){
        try{
            $sql = 'select user_nickname from user u where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $re = $stm->fetch();
            $result = $re->user_nickname;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = "";
        }
        return $result;
    }

    //Listar Un Unico Usuario por ID
    public function list($id){
        try{
            $sql = 'select * from user u inner join role r on u.id_role = r.id_role where u.id_user = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //Guardar o Editar Informacion de Usuarios
    public function save($model){
        try {
            $fecha = date("Y-m-d H:i:s");
            if(empty($model->id_user)){
                $sql = 'insert into user(
                    id_person, id_role, user_nickname, user_password, user_email, user_status, user_created_at, user_modified_at, user_image
                    ) values(?,?,?,?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_person,
                    $model->id_role,
                    $model->user_nickname,
                    $model->user_password,
                    $model->user_email,
                    1,
                    $fecha,
                    $fecha,
                    'media/user/1/user.jpg'
                ]);

            } else {
                if(empty($model->id_person)){
                    $sql = "update user 
                set
                user_nickname = ?,
                user_email = ?,
                id_role = ?,
                user_status = ?,
                user_modified_at = ?
                where id_user = ?";
                    $stm = $this->pdo->prepare($sql);
                    $stm->execute([
                        $model->user_nickname,
                        $model->user_email,
                        $model->id_role,
                        $model->user_status,
                        $fecha,
                        $model->id_user
                    ]);
                    unset($_SESSION['id_usered']);
                } else {
                    $sql = "update user 
                set
                id_role = ?,
                id_person = ?,
                user_nickname = ?,
                user_email = ?,
                user_status = ?,
                user_modified_at = ?
                where id_user = ?";
                    $stm = $this->pdo->prepare($sql);
                    $stm->execute([
                        $model->id_role,
                        $model->id_person,
                        $model->user_nickname,
                        $model->user_email,
                        $model->user_status,
                        $fecha,
                        $model->id_user
                    ]);
                    unset($_SESSION['id_usered']);
                }

            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    //Cambiar Contraseña de un Usuario
    public function changepassword($model){
        try {
            $sql = 'update user set
                user_password = ?
                where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->user_password,
                $model->id_user
            ]);
            unset($_SESSION['id_userchg']);
            unset($_SESSION['id_userchginfo']);
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function changestatus($model){
        try {
            $sql = 'update user set
                user_status = ?
                where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->user_status,
                $model->id_user
            ]);
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    //Borrar un Registro
    public function delete($id){
        try{
            $sql = 'delete from user where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function sessionclose(){
        try{
            unset($_SESSION['id_user']);
            unset($_SESSION['id_person']);
            unset($_SESSION['user_nickname']);
            unset($_SESSION['user_image']);
            unset($_SESSION['person_name']);
            unset($_SESSION['person_surname']);
            unset($_SESSION['person_dni']);
            unset($_SESSION['person_genre']);
            unset($_SESSION['role']);
            unset($_SESSION['role_name']);
            session_destroy();

            setcookie('id_user', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('id_person', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('user_nickname', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('user_image', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('person_name', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('person_surname', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('person_dni', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('person_genre', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie("role", '1', time() - 365 * 30 * 24 * 60 * 60, "/");
            setcookie("role_name", '1', time() - 365 * 24 * 60 * 60, "/");
            $okey = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $okey = 2;
        }
        return $okey;
    }


}
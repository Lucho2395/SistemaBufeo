<?php
/**
 * Created by PhpStorm.
 * User: Cesar Jose Ruiz
 * Date: 08/04/2019
 * Time: 00:30
 */

class Rolei{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    /*public function readAllrole(){
        try{
            $sql = 'select * from role';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function save($model){
        try {
            if(empty($model->id_role)){
                $sql = 'insert into role(
                    role_name,
                    role_description
                    ) values(?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->role_name,
                    $model->role_description
                ]);
                $result = 1;
            } else {
                $sql = "
                    update role
                    set
                    role_name = ?,
                    role_description = ?
                    where id_role = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->role_name,
                    $model->role_description,
                    $model->id_rol
                ]);
                $result = 1;
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function insertPermits($model){
        try {
            $permits = explode('.', $model->permits);
            $sql = 'insert into rolepermit (id_role, id_permit) values ';
            $firstvalue = true;
            foreach ($permits as $permit){
                if($firstvalue){
                    $sql = $sql . '('.$model->id_role.','.$permit.')';
                    $firstvalue = false;
                } else {
                    $sql = $sql . ',('.$model->id_role.','.$permit.')';
                }

            }
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = 1;

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function deleteRole($id){
        try{
            $sql = "delete from role where id_role = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }

        return $result;
    }

    public function deletePermit($model){
        try{
            $sql = "delete from rolepermit where id_role = ? and id_permit = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->id_role,
                $model->id_permit
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function readPermits($id_role){
        $result = [];
        try{
            $sql = "select p.permit_controller, p.permit_action, p.permit_status from rolepermit r2 inner join permit p on r2.id_permit = p.id_permit where r2.id_role = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_role]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;

    }*/

    //FUNCION USADA EN API
    //SIRVE PARA VERIFICAR SI EL ACCESO ESTÁ PERMITITDO
    public function verificatePermitRole($id_role, $controller, $accion){
        $validate = false;
        try{
            $sql = "select m.menu_status, p.permit_status from role r inner join rolemenu rl on r.id_role = rl.id_role inner join menu m on rl.id_menu = m.id_menu inner join optionm o on m.id_menu = o.id_menu inner join permit p on o.id_optionm = p.id_optionm where rl.id_role = ? and m.menu_controller = ? and p.permit_action = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_role, $controller, $accion]);
            $result = $stm->fetchAll();
            if(count($result) > 0){
                if($result[0]->menu_status == 1 && $result[0]->permit_status == 1){
                    $validate = true;
                } else {
                    $validate = false;
                }
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $validate = false;
        }
        return $validate;
    }

    public function readPermitsview($id_role, $controller){
        try{
            $sql = "SELECT m.menu_name, o.option_name, o.option_url FROM role r inner join rolemenu rm on r.id_role = rm.id_rolemenu inner join menu m on m.id_menu = rm.id_menu inner join optionmenu o on o.id_menu = m.id_menu where r.id_role = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_role, $controller]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;

    }

    public function verificateStatusUser($user_nickname){
        try{
            $sql = 'select user_status from user where user_nickname = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$user_nickname]);
            $consulta = $stm->fetch();
            $permiso = $consulta->user_status;
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $permiso = 0;
        }
        return $permiso;
    }

    public function singOut(){
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
    }

}
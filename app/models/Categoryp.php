<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 14/05/2019
 * Time: 22:50
 */

class Categoryp{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Listar Toda La Info
    public function listAll(){
        try{
            $sql = 'select * from categoryp';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }


    //Listar Una Unica Persona por ID
    public function list($id){
        try{
            $sql = 'select * from categoryp where id_categoryp = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }


    //Guardar o Editar Informacion de Role
    public function save($model){
        try {
            if(empty($model->id_categoryp)){
                $sql = 'insert into categoryp(
                    categoryp_name, categoryp_description
                    ) values(?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->categoryp_name,
                    $model->categoryp_description
                ]);

            } else {
                $sql = "update categoryp
                set
                categoryp_name = ?,
                categoryp_description = ?
                where id_categoryp = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->categoryp_name,
                    $model->categoryp_description,
                    $model->id_categoryp
                ]);
                unset($_SESSION['id_categoryp']);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
}
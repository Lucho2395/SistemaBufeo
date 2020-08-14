<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 18/04/2019
 * Time: 21:00
 */

class Client{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Listar Toda La Info Sobre Personas
    public function listAll(){
        try{
            $sql = 'select * from client';
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
            $sql = 'select * from client where id_client = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //Listar Una Unica Persona por DNI
    public function listClientbyNumber($number){
        try{
            $sql = 'select * from client where client_number = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$number]);
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
            if(empty($model->id_client)){
                $sql = 'insert into client(client_name, client_type, client_number, client_address, 
                                    client_telephone) values(?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->client_name,
                    $model->client_type,
                    $model->client_number,
                    $model->client_address,
                    $model->client_telephone
                ]);

            } else {
                $sql = "update client
                    set
                    client_name = ?,
                    client_type = ?,
                    client_number = ?,
                    client_address = ?,
                    client_telephone = ?
                    where id_client = ?";


                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->client_name,
                    $model->client_type,
                    $model->client_number,
                    $model->client_address,
                    $model->client_telephone,
                    $model->id_client
                ]);
                unset($_SESSION['id_cliente']);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    //validar que el dni de los clientes no se repitan
    public function validardni($client_number){
        try {
            if (is_numeric($client_number)){
                $sql = 'select * from client where client_number = ? limit 1';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([$client_number]);
                $resultado = $stm->fetch();
                (isset($resultado->id_client))?$result=true:$result=false;
            }

        }catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function validardnieditar($client_number, $id_client){
        try {
            if (is_numeric($client_number)){
                $sql = 'select * from client where client_number = ? and id_client <> ?';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([$client_number, $id_client]);
                $resultado = $stm->fetch();
                (isset($resultado->id_client))?$result=true:$result=false;
            }

        }catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //Borrar un Registro
    public function delete($id){
        try{
            $sql = 'delete from client where id_client = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

}
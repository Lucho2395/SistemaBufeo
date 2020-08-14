<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 14/05/2019
 * Time: 22:50
 */

class Proveedor{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Listar Toda La Info
    public function listAll(){
        try{
            $sql = 'select * from proveedor';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }


    //Listar Un Unico Proveedor por ID
    public function list($id){
        try{
            $sql = 'select * from proveedor where id_proveedor = ? limit 1';
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
            if(empty($model->id_proveedor)){
                $sql = 'insert into proveedor( 
                    proveedor_ruc, nombre_provee, contacto_provee, telefono_provee, direccion_provee
                    ) values(?,?,?,?,?)'; //creamos el query
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->ruc_proveedor,
                    $model->nombre_provee,
                    $model->contacto_provee,
                    $model->telefono_provee,
                    $model->direccion_provee
                ]);

            } else {
                $sql = "update proveedor
                set
                proveedor_ruc = ?,
                nombre_provee = ?,
                contacto_provee = ?,
                telefono_provee = ?,
                direccion_provee = ?
                where id_proveedor = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->ruc_proveedor,
                    $model->nombre_provee,
                    $model->contacto_provee,
                    $model->telefono_provee,
                    $model->direccion_provee,
                    $model->id_proveedor
                ]);
                unset($_SESSION['id_proveedor']);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    //validar que el dni de los proveedores no se repitan
    public function validardni($ruc_proveedor){
        try {
            if (is_numeric($ruc_proveedor)){
                $sql = 'select * from proveedor where proveedor_ruc = ? limit 1';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([$ruc_proveedor]);
                $resultado = $stm->fetch();
                (isset($resultado->id_proveedor))?$result=true:$result=false;
            }

        }catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function validardnieditar($ruc_proveedor, $id_proveedor){
        try {
            if (is_numeric($ruc_proveedor)){
                $sql = 'select * from proveedor where proveedor_ruc = ? and id_proveedor <> ?';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([$ruc_proveedor, $id_proveedor]);
                $resultado = $stm->fetch();
                (isset($resultado->id_proveedor))?$result=true:$result=false;
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
            $sql = 'delete from proveedor where id_proveedor = ?';
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
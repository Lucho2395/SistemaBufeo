<?php
/**
 * Created by PhpStorm
 * User: Lucho
 * Date: 31/06/2020
 * Time: 21:00
 */

class TipoDocumento
{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Listar Toda La Info Sobre Personas
    public function listAll(){
        try{
            $sql = 'select * from tipo_documento';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
}
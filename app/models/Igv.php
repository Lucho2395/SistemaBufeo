<?php
/**
 * Created by PhpStorm
 * User: Lucho
 * Date: 07/09/2020
 * Time: 16:50
 */

class Igv{

    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Listar Toda La Info
    public function listAll(){
        try{
            $sql = 'select * from igv where igv_estado = 1;';
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
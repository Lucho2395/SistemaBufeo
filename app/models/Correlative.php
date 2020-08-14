<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 2/05/2019
 * Time: 13:18
 */

class Correlative{
    private $log;
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function list(){
        try{
            $sql = 'select * from correlative limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $return = $stm->fetch();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $return = [];
        }
        return $return;
    }

    public function save($model){
        try{
            $sql = 'update correlative set correlative_b = ?, correlative_f = ?, correlative_in = ?, correlative_out = ?, correlative_p = ? where id_correlative = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->correlative_b,
                $model->correlative_f,
                $model->correlative_in,
                $model->correlative_out,
                $model->correlative_p,
                $model->id_correlative
            ]);
            $return = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $return = 2;
        }
        return $return;
    }

    public function updatecorrelativeOut(){
        try{
            $sql = 'update correlative set correlative_out = correlative_out + 1 where id_correlative = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $return = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $return = 2;
        }
        return $return;
    }

    public function updatecorrelativeIn(){
        try{
            $sql = 'update correlative set correlative_in = correlative_in + 1 where id_correlative = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $return = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $return = 2;
        }
        return $return;
    }

    public function updatecorrelativeb(){
        try{
            $sql = 'update correlative set correlative_b = correlative_b + 1 where id_correlative = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $return = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $return = 2;
        }
        return $return;
    }

    public function updatecorrelativef(){
        try{
            $sql = 'update correlative set correlative_f = correlative_f+ 1 where id_correlative = 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $return = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $return = 2;
        }
        return $return;
    }
}
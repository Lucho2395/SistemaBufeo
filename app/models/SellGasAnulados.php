<?php
/**
 * Created by PhpStorm
 * User: Lucho
 * Date: 14/09/2020
 * Time: 21:50
 */

class SellGasAnulados
{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Hallar maximo numero de una fecha
    public function seleccionar($fechaanulado){
        try{
            $sql = 'SELECT MAX(numero) numero FROM saleproductgas_anulados WHERE fecha_anulado = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fechaanulado]);
            $result = $stm->fetch();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function seleccionarnumero(){
        try{
            $sql = 'SELECT MAX(numero) numero FROM saleproductgas_anulados ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([]);
            $result = $stm->fetch();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function insertar_anulacion($fechaanulado, $codigo_unico, $id_productoventa, $id_user, $ticket_sunat, $pdf_comprobante_Anulado){
        try {
            $sql = 'insert into saleproductgas_anulados (fecha_anulado, numero, saleproductgas_id, ticket_sunat, pdf_comprobante_anulado, empleado_user_id) values (?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $fechaanulado,
                $codigo_unico,
                $id_productoventa,
                $ticket_sunat,
                $pdf_comprobante_Anulado,
                $id_user
            ]);
            $result = true;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = false;
        }
        return $result;

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 05/11/2018
 * Time: 9:29
 */

class Sell{
    private $pdo;
    private $log;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Traer Datos Persona
    public function listperson($id){
        $result = [];
        try {
            $sql = 'select * from person where id_person = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function search_by_barcode($product_barcode){
        try {
            $sql = 'select * from product p inner join productforsale p2 on p.id_product = p2.id_product where p.product_barcode = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$product_barcode]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    //Traer Lista Locaciones
    public function listlocations(){
        $result = [];
        try {
            $sql = 'select * from location where location_status = 0 order by location_name asc';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    //Traer Producto a Vender
    public function listproductsale($id){
        $result = [];
        try {
            $sql = 'select * from productforsale pr inner join product p on pr.id_product = p.id_product where pr.id_productforsale = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    //Listar los datos de una venta
    public function listSale($id){
        try {
            $sql = 'select * from saleproduct s inner join client c on s.id_client = c.id_client inner join user u on s.id_user = u.id_user where s.id_saleproduct = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //Listar los datos de una venta
    public function revokeSale($id){
        try {
            $sql = 'update saleproduct set saleproduct_cancelled = 0 where id_saleproduct = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listSaledetail($id){
        try {
            $sql = 'select * from saledetail where id_saleproduct = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listSales(){
        try {
            $sql = 'select * from saleproduct s inner join user u on s.id_user = u.id_user inner join client c on s.id_client = c.id_client';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //Insertar Datos En Detalle Venta
    public function insertSale($id_client, $id_user, $id_turn, $saleproduct_type, $saleproduct_correlative, $saleproduct_total, $saleproduct_date, $saleproduct_cancelled){
        try{
            $date = date("Y-m-d H:i:s");
            $sql = 'insert into saleproduct(id_client, id_user, id_turn, saleproduct_type, saleproduct_correlative, saleproduct_total, saleproduct_date, saleproduct_cancelled) values(?,?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_client,
                $id_user,
                $id_turn,
                $saleproduct_type,
                $saleproduct_correlative,
                $saleproduct_total,
                $saleproduct_date,
                $saleproduct_cancelled
            ]);

            $sql2 = 'select id_saleproduct from saleproduct where saleproduct_date = ? and id_client = ?';
            $stm2 = $this->pdo->prepare($sql2);
            $stm2->execute([$saleproduct_date, $id_client]);
            $result = $stm2->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }

        return $result;
    }


    //Insertar Deuda
    public function insertDebt($id_saleproduct, $debt_total){
        try{
            $sql = 'insert into debt (id_saleproduct, debt_total, debt_cancelled, debt_status) values (?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_saleproduct,
                $debt_total,
                0,
                0
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }

        return $result;
    }


    public function insertSaledetail($id_saleproduct, $id_productforsale, $sale_productname, $sale_unid, $sale_price, $sale_productscant, $sale_productstotalselled, $sale_productstotalprice){
        try{
            $sql = 'insert into saledetail (id_saleproduct, id_productforsale, sale_productname, sale_unid, sale_price, sale_productscant, sale_productstotalselled, sale_productstotalprice) values(?,?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_saleproduct,
                $id_productforsale,
                $sale_productname,
                $sale_unid,
                $sale_price,
                $sale_productscant,
                $sale_productstotalselled,
                $sale_productstotalprice
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }

    //Actualizar Stock
    public function saveProductstock($stock, $id){
        try {
            $sql = 'update product set product_stock = product_stock - ? where id_product = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $stock,
                $id
            ]);

            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }

        return $result;
    }

    //Insertar Venta Renta
    public function insertRent($id_rent,$id_person,$id_user,$id_turn,$id_location,$totalprice,$cancelled,$minutes){
        try{
            $date = date("Y-m-d");
            $start = date("H:i:s");
            $starseconds = strtotime($start);
            $seconds_to_add = $minutes * 60;
            $finish = date("H:i:s", $starseconds + $seconds_to_add);
            $sql = 'insert into salerent (id_rent, id_person, id_user,id_turn, id_location, salerent_date, salerent_start, salerent_finish, salerent_total, salerent_finished, salerent_cancelled) values (?,?,?,?,?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_rent,
                $id_person,
                $id_user,
                $id_turn,
                $id_location,
                $date,
                $start,
                $finish,
                $totalprice,
                0,
                $cancelled
            ]);
            $sql2 = 'select id_salerent, id_location from salerent where salerent_date = ? and salerent_start = ? and id_location = ?';
            $stm2 = $this->pdo->prepare($sql2);
            $stm2->execute([$date, $start, $id_location]);
            $result = $stm2->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }

        return $result;
    }

    //Insertar Locacion Alquiler
    public function insertLocacionrent($id_salerent, $id_locacion){
        try {
            $sql = 'insert into locationrent (id_salerent, id_location) values (?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_salerent,
                $id_locacion
            ]);

            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }

        return $result;
    }

    //Insertar Deuda Alquiler
    public function insertDebtrent($id_salerent, $debt_total){
        try{
            $sql = 'insert into debtrent (id_salerent, debtrent_total, debtrent_cancelled, debtrent_status) values (?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_salerent,
                $debt_total,
                0,
                0
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }

        return $result;
    }

    public function updateLocationstatus($id_location, $status){
        try{
            $sql = 'update location set location_status = ? where id_location = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $status,
                $id_location
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }

        return $result;
    }

    public function selectLocationstatus($id_location){
        try{
            $sql = 'select * from location l inner join locationrent lr on l.id_location = lr.id_location inner join salerent s on s.id_salerent = lr.id_salerent where lr.id_location = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_location]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function updateStatuslocationrent($id_salerent, $id_location, $id_locationrent){
        try{
            $sql1 = 'update salerent set salerent_finished = 1 where id_salerent = ?';
            $stm1 = $this->pdo->prepare($sql1);
            $stm1->execute([$id_salerent]);

            $sql2 = 'update location set location_status = 0 where id_location = ?';
            $stm2 = $this->pdo->prepare($sql2);
            $stm2->execute([$id_location]);

            $sql3 = 'delete from locationrent where id_locationrent = ?';
            $stm3 = $this->pdo->prepare($sql3);
            $stm3->execute([$id_locationrent]);

            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function select_guias_entrada(){
        try{
            $sql2 = 'select * from stocklog s inner join product p on s.id_product=p.id_product';
            $stm2 = $this->pdo->prepare($sql2);
            $stm2->execute();
            $result = $stm2->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }
    public function select_guias_salida(){
        try{
            $sql2 = 'select * from stockout s inner join product p on s.id_product=p.id_product';
            $stm2 = $this->pdo->prepare($sql2);
            $stm2->execute();
            $result = $stm2->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }
    public function stocklog_detail($id){
        try{
            $sql = 'select * from stocklog s inner join product p on s.id_product=p.id_product where s.id_stocklog = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    public function stockout_detail($id){
        try{
            $sql = 'select * from stockout s inner join product p on s.id_product=p.id_product where s.id_stockout = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
}
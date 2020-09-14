<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 05/11/2018
 * Time: 9:29
 */

class SellGas{
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
            $sql = 'select * from product p inner join productforsale p2 on p.id_product = p2.id_product inner join medida m on p.product_unid_type = m.medida_id where p.product_barcode = ?';
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
            $sql = 'select * from saleproductgas s inner join client c on s.id_client = c.id_client inner join user u on s.id_user = u.id_user where s.id_saleproductgas = ?';
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
            $sql = 'update saleproductgas set saleproductgas_cancelled = 0, saleproductgas_estado = 0 where id_saleproductgas = ?';
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
            $sql = 'select * from saledetailgas where id_saleproductgas = ?';
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
            $sql = 'select * from saleproductgas s inner join user u on s.id_user = u.id_user inner join client c on s.id_client = c.id_client order by saleproductgas_date asc'; // where saleproductgas_naturaleza = "PEDIDO"
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listPendientes(){
        try {
            $sql = 'select * from saleproductgas s inner join user u on s.id_user = u.id_user inner join client c on s.id_client = c.id_client where saleproductgas_estado = 2 order by saleproductgas_date desc'; //
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //filtro para buscar entre 2 fechas y el estado del pedido
    public function listSalesfiltroestado($fecha_i,$fecha_f,$estadopedido){
        try {
            $sql = 'select * from saleproductgas s inner join user u on s.id_user = u.id_user inner join client c on s.id_client = c.id_client 
                    where DATE(saleproductgas_date) between ? and ? and s.saleproductgas_estado = ? order by saleproductgas_date asc'; // and u.id_user like ? where saleproductgas_naturaleza = "PEDIDO"
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $fecha_i,
                $fecha_f,
                $estadopedido
            ]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listSalesfiltrousuario($fecha_i,$fecha_f,$usuario){
        try {
            $sql = 'select * from saleproductgas s inner join user u on s.id_user = u.id_user inner join client c on s.id_client = c.id_client 
                    where DATE(saleproductgas_date) between ? and ? and u.id_user = ? order by saleproductgas_date asc'; //  where saleproductgas_naturaleza = "PEDIDO"
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $fecha_i,
                $fecha_f,
                $usuario
            ]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
//filtro para buscar con todos los campos llenos
    public function listSalesfiltro($fecha_i,$fecha_f,$estadopedido,$usuario){
        try {
            $sql = 'select * from saleproductgas s inner join user u on s.id_user = u.id_user inner join client c on s.id_client = c.id_client 
                    where DATE(saleproductgas_date) between ? and ? and s.saleproductgas_estado = ? and u.id_user = ? order by saleproductgas_date asc'; //  where saleproductgas_naturaleza = "PEDIDO"
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $fecha_i,
                $fecha_f,
                $estadopedido,
                $usuario
            ]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //filtro con las fechas
    public function listSalesfiltrofechas($fecha_i,$fecha_f){
        try {
            $sql = 'select * from saleproductgas s inner join user u on s.id_user = u.id_user inner join client c 
                    on s.id_client = c.id_client 
                    where DATE(saleproductgas_date) between ? and ? order by saleproductgas_date asc'; //  where saleproductgas_naturaleza = "PEDIDO"
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $fecha_i,
                $fecha_f
            ]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //Insertar Datos En Detalle Venta
    public function insertSale($id_client, $id_user, $id_turn, $saleproductgas_direccion, $saleproductgas_telefono, $saleproduct_type, $saleproductgas_naturaleza, $saleproduct_correlative, $saleproduct_gravada, $saleproduct_igv, $saleproduct_total, $saleproduct_date, $saleproduct_estado, $saleproduct_cancelled, $saleproduct_inafecta, $saleproduct_exonerada , $saleproduct_icbper, $tipo_nota){
        try{
            $date = date("Y-m-d H:i:s");
            $sql = 'insert into saleproductgas(id_client, id_user, id_turn, saleproductgas_direccion, saleproductgas_telefono, saleproductgas_type, saleproductgas_naturaleza, saleproductgas_correlativo, saleproductgas_totalexonerada, saleproductgas_totalinafecta, saleproductgas_totalgravada, saleproductgas_totaligv, saleproductgas_icbper, saleproductgas_total, saleproductgas_date, tipo_nota_id, saleproductgas_estado, saleproductgas_cancelled) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_client,
                $id_user,
                $id_turn,
                $saleproductgas_direccion,
                $saleproductgas_telefono,
                $saleproduct_type,
                $saleproductgas_naturaleza,
                $saleproduct_correlative,
                $saleproduct_exonerada,
                $saleproduct_inafecta,
                $saleproduct_gravada,
                $saleproduct_igv,
                $saleproduct_icbper,
                $saleproduct_total,
                $saleproduct_date,
                $tipo_nota,
                $saleproduct_estado,
                $saleproduct_cancelled
            ]);

            $sql2 = 'select id_saleproductgas from saleproductgas where saleproductgas_date = ? and id_client = ?';
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


    public function insertSaledetail($id_saleproduct, $id_productforsale, $sale_productname, $sale_unid, $sale_price, $sale_productscant, $sale_productstotalselled, $sale_productstotalprice, $precio_producto, $precio_base, $subtotal_base, $igv_total, $tipo_igv, $ICBPER){
        try{
            $sql = 'insert into saledetailgas (id_saleproductgas, id_productforsale, sale_productnamegas, id_medida, sale_pricegas, sale_productscantgas, sale_productstotalselledgas, precio_base, precio_producto, subtotal, igv, igv_tipoigv, total_icbper, sale_productstotalpricegas) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_saleproduct,
                $id_productforsale,
                $sale_productname,
                $sale_unid,
                $sale_price,
                $sale_productscant,
                $sale_productstotalselled,
                $precio_base,
                $precio_producto,
                $subtotal_base,
                $igv_total,
                $tipo_igv,
                $ICBPER,
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

    public function CambiarPedido($id){
        try {
            $sql = 'update saleproductgas set saleproductgas_estado = 1 where id_saleproductgas = ? ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = true;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    //funcion donde selecciona todas las columnas
    public function datos_comprobante($id_productoventa){
        try {
            $sql = 'SELECT sp.saleproductgas_date AS fecha_sunat, DATE_FORMAT(sp.saleproductgas_date, \'%d-%m-%Y\') AS 
                    fecha_de_emision, DATE_FORMAT(sp.saleproductgas_date, \'%d-%m-%Y\') AS fecha_de_vencimiento, 
                    emp.empresa_ruc, emp.empresa_nombre, emp.empresa_domiciliofiscal, emp.empresa_celular1, emp.empresa_correo, 
                    emp.empresa_descripcion, sp.id_saleproductgas, sp.id_empresa, sp.saleproductgas_type, sp.saleproductgas_correlativo, 
                    sp.saleproductgas_total, sp.saleproductgas_totalexonerada, sp.saleproductgas_totalinafecta, sp.saleproductgas_totalgravada, sp.saleproductgas_totaligv, cl.id_client, sp.id_moneda, 
                    cl.client_number, cl.id_tipodocumento, cl.client_name, cl.client_razonsocial, cl.client_razonsocial_sunat,
                    cl.client_address, cl.client_correo, tid.tipodocumento_codigo, sp.saleproductgas_type, mo.moneda, mo.abrstandar, 
                    mo.simbolo, sp.saleproductgas_icbper FROM saleproductgas sp INNER JOIN empresa emp ON sp.id_empresa = emp.id_empresa INNER JOIN client cl 
                    ON sp.id_client = cl.id_client INNER JOIN monedas mo ON sp.id_moneda = mo.id INNER JOIN tipo_documento tid ON 
                    cl.id_tipodocumento = tid.id_tipodocumento where sp.id_saleproductgas = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_productoventa]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function todos_saledetaill($id_productoventa){
        try {
            $sql = 'SELECT *, spr.id_saleproductgas, sde.id_productforsale, sde.id_medida FROM saledetailgas sde 
                    INNER JOIN saleproductgas spr ON sde.id_saleproductgas = spr.id_saleproductgas INNER JOIN igv igv ON sde.igv_tipoigv = igv.id_igv WHERE sde.id_saleproductgas = ? ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_productoventa]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function Buscarproduct_detalle($id_productforsale){
        try {
            $sql = 'SELECT * FROM productforsale pfs INNER JOIN product pr ON pfs.id_product = pr.id_product 
                    INNER JOIN medida me ON pr.product_unid_type = me.medida_id WHERE id_productforsale = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_productforsale]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function envio_sunat($id_productoventa){
        try {
            $sql = 'update saleproductgas set enviado_sunat = 1 where id_saleproductgas = ? ';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_productoventa]);
            $result = true;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function tipo_nota_credito($id_productoventa){
        try {
            $sql = 'SELECT * FROM saleproductgas sp INNER JOIN tipo_ncreditos tnc ON sp.tipo_nota_id = tnc.id 
                     WHERE sp.id_saleproductgas = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_productoventa]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function tipo_nota_debito($id_productoventa){
        try {
            $sql = 'SELECT * FROM saleproductgas sp INNER JOIN tipo_ndebitos tnc ON sp.tipo_nota_id = tnc.id 
                     WHERE sp.id_saleproductgas = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_productoventa]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
}
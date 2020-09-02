<?php
/**
 * Created by PhpStorm.
 * User: Lucho
 * Date: 31/08/2020
 * Time: 9:59
 */

class Inventory{
    private $pdo;
    private $log;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Listar Productos Registrados
    public function listProducts(){
        try{
            $sql = "Select * from product p inner join productforsale p2 on p.id_product = p2.id_product inner join categoryp c on p.id_categoryp = c.id_categoryp inner join medida me on p.product_unid_type = me.medida_id inner join proveedor pr on p.id_proveedor = pr.id_proveedor order by p.product_name";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();

            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listProducts');
            $result = 2;
        }

        return $result;
    }

    //Obtener ID Producto Según Fecha Única de Registro
    public function getIdProductByDate($date){
        try{
            $sql = "Select id_product from product where product_created_at = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$date]);

            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listProducts');
            $result = 0;
        }

        return $result->id_product;
    }

    //Agregar o Editar Producto
    public function save($model){
        try {
            if(empty($model->id_product)){
                $sql = 'insert into product(
                    id_categoryp, id_proveedor, product_barcode, product_name, product_description, product_unid_type, product_stock, product_created_at
                    ) values(?,?,?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_categoryp,
                    $model->id_proveedor,
                    $model->product_barcode,
                    $model->product_name,
                    $model->product_description,
                    $model->product_unid_type,
                    $model->product_stock,
                    $model->product_created_at
                ]);

            } else {
                $sql = "update product
                set
                id_categoryp = ?,
                id_proveedor = ?,
                product_barcode = ?,
                product_name = ?,
                product_description = ?,
                product_unid_type = ?,
                product_stock = ?                
                where id_product = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_categoryp,
                    $model->id_proveedor,
                    $model->product_barcode,
                    $model->product_name,
                    $model->product_description,
                    $model->product_unid_type,
                    $model->product_stock,                    
                    $model->id_product
                ]);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), 'Inventory|save');
            $result = 2;
        }

        return $result;
    }

    //validar que el dni de los clientes no se repitan
    public function validarCodigo($product_barcode){
        try {
            $sql = 'select * from product where product_barcode = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$product_barcode]);
            $resultado = $stm->fetch();
            (isset($resultado->id_product)) ? $result=true:$result=false;

        }catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function validarCodigoeditar($product_barcode , $id_producto){
        try {
            $sql = 'select * from product where product_barcode = ? and id_product <> ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$product_barcode, $id_producto]);
            $resultado = $stm->fetch();
            (isset($resultado->id_product)) ? $result=true:$result=false;

        }catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //Listar Producto Registrado
    public function listProduct($id){
        try{
            $sql = "Select * from product where id_product = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);

            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listProduct');
            $result = 2;
        }
       return $result;
    }

    //Listar Producto Registrado
    public function listProductwithprice($id){
        try{
            $sql = "Select * from product p inner join productforsale p2 on p.id_product = p2.id_product where p.id_product = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);

            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory| listProductwithprice');
            $result = 2;
        }

        return $result;
    }

    //Obtener ID Producto Por Nombre
    public function getProductID($name){
        try{
            $sql = "Select * from product where product_name = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$name]);

            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listProduct');
            $result = 2;
        }

        return $result->id_product;
    }

    //Obtener ID Productsale Por ID Product
    public function getIdProductSaleForIdProduct($id){
        try{
            $sql = "Select id_productforsale from productforsale where id_product = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);

            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|getIdProductSaleForIdProduct');
            $result = 0;
        }

        return $result->id_productforsale;
    }

    //Obtener ID Product Por ID Productsale
    public function getIdProductIdForProductSale($id){
        try{
            $sql = "Select id_product from productforsale where id_productforsale = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);

            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|getIdProductIdForProductSale');
            $result = 0;
        }

        return $result->id_product;
    }

    //Eliminar Producto Registrado
    public function deleteProduct($id){
        try{
            $sql = "delete from product where id_product = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listProduct');
            $result = 2;
        }

        return $result;
    }

    //Listar Productos Para Venta
    public function listProductsforsale($id){
        try{
            $sql = "select * from product p inner join productforsale pf on p.id_product = pf.id_product where p.id_product = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);

            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listProduct');
            $result = 2;
        }
        return $result;
    }
    //Lista Nombre Del Producto
    public function listProductname($id){
        try{
            $sql = "select id_product, product_name from product where id_product = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);

            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listProduct');
            $result = 2;
        }
        return $result;
    }
    //Guardar Precio Producto
    public function saveprice($model){
        try {
            if(empty($model->id_productforsale)){
                $sql = 'insert into productforsale(
                    id_product, product_unid, product_price
                    ) values(?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->id_product,
                    $model->product_unid,
                    $model->product_price
                ]);

            } else {
                $sql = "update productforsale
                set
                product_unid = ?,
                product_price = ?
                where id_productforsale = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->product_unid,
                    $model->product_price,
                    $model->id_productforsale
                ]);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), 'Inventory|save');
            $result = 2;
        }

        return $result;
    }
    //Listar Datos Precio Producto
    public function listProductprice($id){
        try{
            $sql = "Select * from productforsale where id_productforsale = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);

            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listProductprice');
            $result = 2;
        }

        return $result;
    }
    //Listar ID Product desde ProductSale
    public function listIdproducforproductsale($id){
        try{
            $sql = "Select * from product p inner join productforsale p2 on p.id_product = p2.id_product where p2.id_productforsale = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);

            $result = $stm->fetch();
            $result = $result->id_product;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listProductprice');
            $result = 0;
        }

        return $result;
    }
    //Listar Datos Precio Productos
    public function listProductprices(){
        try{
            $sql = "Select * from productforsale pr inner join product p on pr.id_product = p.id_product inner join categoryp c on p.id_categoryp = c.id_categoryp";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listProductprices');
            $result = 2;
        }

        return $result;
    }
    //Eliminar Precio Producto Registrado
    public function deleteProductprice($id){
        try{
            $sql = "delete from productforsale where id_productforsale = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|deleteProductprice');
            $result = 2;
        }
        return $result;
    }

    //Listar Alquileress Registrados
    public function listRents(){
        try{
            $sql = "Select * from rent";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();

            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listRents');
            $result = 2;
        }

        return $result;
    }

    //Guardar Precio Alquiler
    public function saveRent($model){
        try {
            if(empty($model->id_rent)){
                $sql = 'insert into rent(
                    rent_name, rent_description, rent_timeminutes, rent_cost
                    ) values(?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->rent_name,
                    $model->rent_description,
                    $model->rent_timeminutes,
                    $model->rent_cost
                ]);

            } else {
                $sql = "update rent
                set
                rent_name = ?,
                rent_description = ?,
                rent_timeminutes = ?,
                rent_cost = ?
                where id_rent = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->rent_name,
                    $model->rent_description,
                    $model->rent_timeminutes,
                    $model->rent_cost,
                    $model->id_rent
                ]);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), 'Inventory|saveRent');
            $result = 2;
        }

        return $result;
    }

    //Listar Renta
    public function listRent($id){
        try{
            $sql = "Select * from rent where id_rent = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listRent');
            $result = 2;
        }
        return $result;
    }
    //Borrar Alquiler
    public function deleteRent($id){
        try{
            $sql = "delete from rent where id_rent = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|deleteRent');
            $result = 2;
        }
        return $result;
    }

    //Listar Objetos
    public function listObjects(){
        try{
            $sql = "Select * from object";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listRent');
            $result = 2;
        }
        return $result;
    }

    //Guardar Precio Alquiler
    public function saveObject($model){
        try {
            if(empty($model->id_object)){
                $sql = 'insert into object(
                    object_name, object_description, object_total
                    ) values(?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->object_name,
                    $model->object_description,
                    $model->object_total
                ]);

            } else {
                $sql = "update object
                set
                object_name = ?,
                object_description = ?,
                object_total = ?
                where id_object = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->object_name,
                    $model->object_description,
                    $model->object_total,
                    $model->id_object
                ]);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), 'Inventory|saveObject');
            $result = 2;
        }

        return $result;
    }

    //Listar Objeto
    public function listObject($id){
        try{
            $sql = "Select * from object where id_object = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|listObject');
            $result = 2;
        }
        return $result;
    }

    //Borrar Objeto
    public function deleteObject($id){
        try{
            $sql = "delete from object where id_object = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Inventory|deleteObject');
            $result = 2;
        }
        return $result;
    }

    //Actualizar Stock
    public function saveProductstock($stock, $id, $turn, $stocklog_guide, $stocklog_description){
        try {
            $sql = 'update product set product_stock = product_stock + ? where id_product = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $stock,
                $id
            ]);
            $fechahora = date("Y-m-d H:i:s");

            $sql2 = 'insert into stocklog (id_product, stocklog_added, stocklog_guide, stocklog_description, stocklog_date, id_turn) values (?,?,?,?,?,?)';
            $stm2 = $this->pdo->prepare($sql2);
            $stm2->execute([
                $id,
                $stock,
                $stocklog_guide,
                $stocklog_description,
                $fechahora,
                $turn
            ]);
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), 'Inventory|saveProductstock');
            $result = 2;
        }

        return $result;
    }

    public function saveoutProductstock($stock, $id, $turn, $stockout_guide, $stockout_description, $stockout_destiny, $stockout_ruc, $stockout_origin){
        try {
            $sql = 'update product set product_stock = product_stock - ? where id_product = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $stock,
                $id
            ]);
            $fechahora = date("Y-m-d H:i:s");

            $sql2 = 'insert into stockout (id_product, stockout_out, stockout_guide, stockout_description, stockout_date, id_turn, stockout_destiny, stockout_ruc, stockout_origin) values (?,?,?,?,?,?,?,?,?)';
            $stm2 = $this->pdo->prepare($sql2);
            $stm2->execute([
                $id,
                $stock,
                $stockout_guide,
                $stockout_description,
                $fechahora,
                $turn,
                $stockout_destiny,
                $stockout_ruc,
                $stockout_origin
            ]);
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), 'Inventory|saveProductstock');
            $result = 2;
        }

        return $result;
    }


    //Listar Locaciones Alquiler
    public function listlocations(){
        try {
            $sql = 'select * from location order by location_name asc';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|listlocations');
            $result = 2;
        }
        return $result;
    }

    //Ver si Locacion está disponible
    public function viewstatuslocacion(){
        try {
            $sql = 'select * from location l  inner join salerent order by location_name asc';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|listlocations');
            $result = 2;
        }
        return $result;
    }

    public function listTypelocations(){
        try {
            $sql = 'select * from typelocation order by typelocation_name asc';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|listTypelocations');
            $result = 2;
        }
        return $result;
    }

    public function selectLocationstype($id){
        try {
            $sql = 'select * from location l inner join typelocation t on l.id_typelocation = t.id_typelocation where t.id_typelocation = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'Sell|listTypelocations');
            $result = 2;
        }
        return $result;
    }

    //Insertar Stock Producto Recien Creado
    public function setStockNew($producto, $id_turn, $stock){
        try {
            $sql = 'insert into startproduct(id_turn, id_product, startproduct_stock) values (?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_turn,
                $producto,
                $stock
            ]);
            $result = 1;

        } catch (Exception $e){
            $error = $e->getMessage();
            $this->log->insert($error, "Inventory|setStock");
            $result = 2;
        }
        return $result;

    }

}
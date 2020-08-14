<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 24/10/2018
 * Time: 19:22
 */
require 'app/models/Inventory.php';
require 'app/models/Active.php';
require 'app/models/Correlative.php';
require 'app/models/Categoryp.php';
require 'app/models/Proveedor.php';
class InventoryController{
    private $crypt;
    private $menu;
    private $log;
    private $inventory;
    private $active;
    private $correlative;
    private $categoryp;
    private $nav;
    private $proveedor;
    public function __construct()
    {
        $this->crypt = new Crypt();
        //$this->menu = new Menu();
        $this->log = new Log();
        $this->inventory = new Inventory();
        $this->active =  new Active();
        $this->correlative =  new Correlative();
        $this->categoryp =  new Categoryp();
        $this->proveedor = new Proveedor();
    }
    //Vistas
    //Producto
    public function listProducts(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $products = $this->inventory->listProducts();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'inventory/listproducts2.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function addProduct(){
        try{
            $this->nav = new Navbar();
            $categoryp = $this->categoryp->listAll();
            $proveedor = $this->proveedor->listAll();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'inventory/add.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function editProduct(){
        try{
            $idp = $_GET['id'];
            $this->nav = new Navbar();
            $categoryp = $this->categoryp->listAll();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $product = $this->inventory->listProductwithprice($idp);
            $proveedor = $this->proveedor->listAll();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'inventory/edit.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function productForsale(){
        try{
            $idp = $_GET['id'];
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $products = $this->inventory->listProductsforsale($idp);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'inventory/listproductsale.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function addProductforsale(){
        try{
            $idp = $_GET['id'];
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $product = $this->inventory->listProductname($idp);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'inventory/addproductsale.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function editProductforsale(){
        try{
            $idp = $_GET['id'];
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $productprice = $this->inventory->listProductprice($idp);
            $product = $this->inventory->listProductname($productprice->id_product);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'inventory/editproductsale.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function addProductstock(){
        try{
            $idp = $_GET['id'];
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $correlative = $this->correlative->list();
            $fechahoy = date("Y-m-d");
            $product = $this->inventory->listProduct($idp);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'inventory/addstock.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function outProductstock(){
        try{
            $idp = $_GET['id'];
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $product = $this->inventory->listProduct($idp);
            $correlative = $this->correlative->list();
            $fechahoy = date("Y-m-d");
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'inventory/outstock.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    //Funciones
    //Guardar Edicion o Nuevos Productos
    public function saveProduct(){
        try{
            $model = new Inventory();
            if(isset($_POST['id_product'])){
                $model->id_product = $_POST['id_product'];
                $model->product_barcode = $_POST['product_barcode'];
                $model->product_name = $_POST['product_name'];
                $model->product_description = $_POST['product_description'];
                $model->product_stock = $_POST['product_stock'];
                $result = $this->inventory->save($model);
            } else {
                $model->product_name = $_POST['product_name'];
                $model->product_barcode = $_POST['product_barcode'];
                $model->product_description = $_POST['product_description'];
                $model->product_stock = $_POST['product_stock'];
                $model->product_created_at = date("Y-m-d H:i:s");
                $result = $this->inventory->save($model);
            }

            $id_product = $this->inventory->getProductID($_POST['product_name']);
            $turn = $this->active->getTurnactive();
            $inserStock = $this->inventory->setStockNew($id_product, $turn, $_POST['product_stock']);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|saveProduct');
            $result = 2;
        }

        echo $result;
    }

    public function saveProductwithprice(){
        try{
            $model = new Inventory();
            if(isset($_POST['id_product'])){
                $validacion = $this->inventory->validarCodigoeditar($_POST['product_barcode'] , $_POST['id_product']);

            } else {
                $validacion = $this->inventory->validarCodigo($_POST['product_barcode']);
            }
            if ($validacion) {
                $result = 3;
            } else if(isset($_POST['id_product'])){
                $model->id_product = $_POST['id_product'];
                $model->id_categoryp = $_POST['id_categoryp'];
                $model->id_proveedor = $_POST['id_proveedor'];
                $model->product_barcode = $_POST['product_barcode'];
                $model->product_name = $_POST['product_name'];
                $model->product_description = $_POST['product_description'];
                $model->product_unid_type = $_POST['product_unid_type'];
                $model->product_stock = $_POST['product_stock'];
                $result = $this->inventory->save($model);

                $id_productforsale = $this->inventory->getIdProductSaleForIdProduct($_POST['id_product']);
                $model2 = new Inventory();
                $model2->id_productforsale = $id_productforsale;
                $model2->product_unid = 1;
                $model2->product_price = $_POST['product_price'];
                $result = $this->inventory->saveprice($model2);

            } else {
                $model->id_categoryp = $_POST['id_categoryp'];
                $model->id_proveedor = $_POST['id_proveedor'];
                $model->product_name = $_POST['product_name'];
                $model->product_barcode = $_POST['product_barcode'];
                $model->product_description = $_POST['product_description'];
                $model->product_unid_type = $_POST['product_unid_type'];
                $model->product_stock = $_POST['product_stock'];
                $date_created = date("Y-m-d H:i:s");
                $model->product_created_at = $date_created;
                $result = $this->inventory->save($model);

                $id_new_product = $this->inventory->getIdProductByDate($date_created);
                $model2 = new Inventory();
                $model2->id_product = $id_new_product;
                $model2->product_unid = 1;
                $model2->product_price = $_POST['product_price'];
                $result = $this->inventory->saveprice($model2);

            }

            $id_product = $this->inventory->getProductID($_POST['product_name']);
            $turn = $this->active->getTurnactive();
            $inserStock = $this->inventory->setStockNew($id_product, $turn, $_POST['product_stock']);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|saveProduct');
            $result = 2;
        }

        echo $result;
    }

    //Agregar Nuevo Stock Productos
    public function saveProductstock(){
        try{
            $id = $_POST['id_product'];
            $stock = $_POST['product_stock'];
            $stocklog_guide = $_POST['stocklog_guide'];
            $stocklog_description = $_POST['stocklog_description'];
            $turn = $this->active->getTurnactive();
            $result = $this->inventory->saveProductstock($stock, $id, $turn, $stocklog_guide, $stocklog_description);
            $this->correlative->updatecorrelativeIn();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|saveProductstock');
            $result = 2;
        }

        echo $result;
    }

    //Registrar Salida de Stock de Producto
    public function saveoutProductstock(){
        try{
            $id = $_POST['id_product'];
            $stock = $_POST['product_stock'];
            $stockout_guide = $_POST['stockout_guide'];
            $stockout_description = $_POST['stockout_description'];
            $stockout_destiny = $_POST['stockout_destiny'];
            $stockout_ruc = $_POST['stockout_ruc'];
            $stockout_origin = $_POST['stockout_origin'];
            $turn = $this->active->getTurnactive();
            $result = $this->inventory->saveoutProductstock($stock, $id, $turn, $stockout_guide, $stockout_description,$stockout_destiny, $stockout_ruc, $stockout_origin);
            $this->correlative->updatecorrelativeOut();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|saveProductstock');
            $result = 2;
        }

        echo $result;
    }
    //Borrar Productos
    public function deleteProduct(){
        try{
            $id_product = $_POST['id'];
            $result = $this->inventory->deleteProduct($id_product);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|deleteRent');
            $result = 2;
        }

        echo $result;
    }
    //Guardar Edicion o Nuevo Precio Producto
    public function saveProductprice(){
        try{
            $model = new Inventory();
            if(isset($_POST['id_productforsale'])){
                $model->id_productforsale = $_POST['id_productforsale'];
                $model->product_unid = $_POST['product_unid'];
                $model->product_price = $_POST['product_price'];
                $result = $this->inventory->saveprice($model);
            } else {
                $model->id_product = $_POST['id_product'];
                $model->product_unid = $_POST['product_unid'];
                $model->product_price = $_POST['product_price'];
                $result = $this->inventory->saveprice($model);
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|saveProductprice');
            $result = 2;
        }
        echo $result;
    }
    //Borrar Precio Producto
    public function deleteProductprice(){
        try{
            $id_productforsale = $_POST['id'];
            $result = $this->inventory->deleteProductprice($id_productforsale);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|deleteProductprice');
            $result = 2;
        }

        echo $result;
    }

    //Guardar Edicion o Nuevos Alquileres
    public function saveRent(){
        try{
            $model = new Inventory();
            if(isset($_POST['id_rent'])){
                $model->id_rent = $_POST['id_rent'];
                $model->rent_name = $_POST['rent_name'];
                $model->rent_description = $_POST['rent_description'];
                $model->rent_timeminutes = $_POST['rent_timeminutes'];
                $model->rent_cost = $_POST['rent_cost'];
                $result = $this->inventory->saveRent($model);
            } else {
                $model->rent_name = $_POST['rent_name'];
                $model->rent_description = $_POST['rent_description'];
                $model->rent_timeminutes = $_POST['rent_timeminutes'];
                $model->rent_cost = $_POST['rent_cost'];
                $result = $this->inventory->saveRent($model);
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|saveRent');
            $result = 2;
        }

        echo $result;
    }

    //Borrar Alquiler
    public function deleteRent(){
        try{
            $id_rent = $_POST['id'];
            $result = $this->inventory->deleteRent($id_rent);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|deleteRent');
            $result = 2;
        }

        echo $result;
    }

    //Guardar Edicion o Nuevos Objetos
    public function saveObject(){
        try{
            $model = new Inventory();
            if(isset($_POST['id_object'])){
                $model->id_object = $_POST['id_object'];
                $model->object_name = $_POST['object_name'];
                $model->object_description = $_POST['object_description'];
                $model->object_total = $_POST['object_total'];
                $result = $this->inventory->saveObject($model);
            } else {
                $model->object_name = $_POST['object_name'];
                $model->object_description = $_POST['object_description'];
                $model->object_total = $_POST['object_total'];
                $result = $this->inventory->saveObject($model);
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|saveObject');
            $result = 2;
        }
        echo $result;
    }

    //Borrar Objeto
    public function deleteObject(){
        try{
            $id_object = $_POST['id'];
            $result = $this->inventory->deleteObject($id_object);

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'InventoryController|deleteObject');
            $result = 2;
        }

        echo $result;
    }

}
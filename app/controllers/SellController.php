<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 05/11/2018
 * Time: 9:29
 */
require 'app/models/Person.php';
require 'app/models/Sell.php';
require 'app/models/Inventory.php';
require 'app/models/Active.php';
require 'app/models/Client.php';
require 'app/models/Correlative.php';
class SellController{
    private $crypt;
    private $nav;
    private $log;
    private $inventory;
    private $person;
    private $sell;
    private $active;
    private $client;
    private $correlative;

    public function __construct()
    {
        $this->crypt = new Crypt();
        //$this->menu = new Menu();
        $this->log = new Log();
        $this->inventory = new Inventory();
        $this->person = new Person();
        $this->sell = new Sell();
        $this->active = new Active();
        $this->client = new Client();
        $this->correlative = new Correlative();
    }

    //Vistas
    public function fastSell(){
        $this->nav = new Navbar();
        $_SESSION['productos'] = array();
        $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
        //Cargamos Productos
        $products = $this->inventory->listProductprices();
        //Cargamos Clientes
        $clients = $this->client->listAll();
        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'sell/sell3.php';
        require _VIEW_PATH_ . 'footer.php';
    }

    //Vistas
    public function viewhistory(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            //Cargamos Productos
            $sales = $this->sell->listSales();

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'sell/viewhistory.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }

    public function viewSale(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $sale = $this->sell->listSale($id);
            $productssale = $this->sell->listSaledetail($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'sell/viewsale.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }

    public function table_products(){
        require _VIEW_PATH_ . 'sell/table_products.php';
    }

    //Funciones
    public function addProduct(){
        try{
            if(isset($_POST['codigo']) && isset($_POST['producto']) && isset($_POST['unids']) && isset($_POST['precio']) && isset($_POST['cantidad'])){
                $repeat = false;
                foreach($_SESSION['productos'] as $p){
                    if($_POST['codigo'] == $p[0]){
                        $repeat = true;
                    }
                }
                if(!$repeat){
                    array_push($_SESSION['productos'], [$_POST['codigo'], $_POST['producto'], $_POST['unids'], round($_POST['precio'], 2), $_POST['cantidad']]);
                    $result = 1;
                } else {
                    $result = 3;
                }
            } else {
                $result = 2;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function deleteProduct(){
        try{
            if(isset($_POST['codigo'])){
                $buscar = $_POST['codigo'];
                $totalar = count($_SESSION['productos']);
                for($i=0; $i < $totalar; $i++){
                    if($_SESSION['productos'][$i][0] == $buscar){
                        unset($_SESSION['productos'][$i]);
                    }
                }
                $_SESSION['productos'] = array_values($_SESSION['productos']);
                $result = 1;
            } else {
                $result = 2;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function search_by_barcode(){
        try{
            if(isset($_POST['product_barcode'])){
                $product = $this->sell->search_by_barcode($_POST['product_barcode']);
                $result = $product;
                if(empty($result)){
                    $result = 2;
                } else {
                    $result = $result->product_name . '|' . $result->product_unid_type . '|' . $result->product_stock . '|' . $result->id_productforsale . '|' . $result->product_unid . '|' . $result->product_price;
                }
            } else {
                $result = 2;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function revokeSale(){
        try{
            if(isset($_POST['id_saleproduct'])){
                $id_saleproduct = $_POST['id_saleproduct'];
                $revoke = $this->sell->revokeSale($id_saleproduct);
                if($revoke == 1){
                    $productos = $this->sell->listSaledetail($id_saleproduct);
                    foreach ($productos as $p){
                        $id = $this->inventory->getIdProductIdForProductSale($p->id_productforsale);
                        $stock = $p->sale_productstotalselled;
                        $turn = $this->active->getTurnactive();
                        $stocklog_guide = 'INGRESO POR ANULACION DE VENTA';
                        $stocklog_description = 'INGRESO POR ANULACION DE VENTA';
                        $this->inventory->saveProductstock($stock, $id, $turn, $stocklog_guide, $stocklog_description);
                    }
                    $result = 1;
                } else {
                    $result = 2;
                }

            } else {
                $result = 2;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    //Funciones

    //VENDER PRODUCTO----------------------------------------------->
    public function sellProduct(){
        try{
            //Busca si hay un turno activo
            $client = $this->client->listClientbyNumber($_POST['client_number']); //lista un unico cliente segun el numero de dni

            $id_client = $client->id_client; //llama el id_client del cliente listado con su dni
            $id_turn = $this->active->getTurnactive(); //selecciona el turn que tenga 1
            $id_user = $this->crypt->decrypt($_SESSION['id_user'],_PASS_); //descodifica el id_user
       
            $saleproduct_type = $_POST['saleproduct_type'];
            
            $saleproduct_correlative = 1;
            $correlative = $this->correlative->list();
            if($saleproduct_type == "BOLETA"){
                $saleproduct_correlative = "BN° " . $correlative->correlative_b;
            } else {
                $saleproduct_correlative = "FN° " . $correlative->correlative_f;
            }
            $saleproduct_total = $_POST['saleproduct_total'];
            $saleproduct_date = date("Y-m-d H:i:s");
            $saleproduct_cancelled = 1;

            $savesale = $this->sell->insertSale($id_client, $id_user, $id_turn, $saleproduct_type, $saleproduct_correlative, $saleproduct_total, $saleproduct_date, $saleproduct_cancelled);
            $idsale = $savesale->id_saleproduct;

            if($idsale != 2){
                foreach ($_SESSION['productos'] as $p){
                    $subtotal = round($p[3] * $p[4], 2);
                    $id_saleproduct = $savesale->id_saleproduct;
                    $id_productforsale = $p[0];
                    $sale_productname = $p[1];
                    $sale_unid = $p[2];
                    $sale_price= $p[3];
                    $sale_productscant = $p[4];
                    $sale_productstotalselled = $p[2] * $p[4];
                    $sale_productstotalprice = $subtotal;
                    $savedetail = $this->sell->insertSaledetail($id_saleproduct, $id_productforsale, $sale_productname, $sale_unid, $sale_price, $sale_productscant, $sale_productstotalselled, $sale_productstotalprice);
                    if($savedetail == 1){
                        $reduce = $sale_unid * $sale_productscant;
                        $id_product = $this->inventory->listIdproducforproductsale($id_productforsale);
                        $this->sell->saveProductstock($reduce, $id_product);
                        $return = 1;
                    } else {
                        $return = 2;
                    }
                }
            } else {
                $return = 2;
            }

            if($return == 1){
                $return = $savesale->id_saleproduct;

                if($saleproduct_type == "BOLETA"){
                    $this->correlative->updatecorrelativeb();
                } else {
                    $this->correlative->updatecorrelativef();
                }
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $return = 2;
        }
        echo $return;
    }

    //ALQUILER PRODUCTO-------------------------------------------------->
    /*public function sellRent(){
        try{
            $id_turn = $this->active->getTurnactive();
            $id_user = $this->crypt->decrypt($_COOKIE['id_user'],_PASS_) ?? $this->crypt->decrypt($_SESSION['id_user'],_PASS_);
            $id_rent = $_POST['id_rent'];
            $id_person = $_POST['id_person'];
            $minutes_to_rent = $_POST['minutes_to_rent'];
            $totalprice = $_POST['totalprice'];
            $id_location = $_POST['id_location'];
            $type_sell = 'VENDER';
            $cancelled = 'true';

            if(isset($_POST['type_sell'])){
                $type_sell = $_POST['type_sell'];
                $cancelled = 'false';
            }

            if($type_sell == 'REGALAR'){
                $totalprice = 0;
                $cancelled = 'true';
            }

            $saverent = $this->sell->insertRent($id_rent,$id_person,$id_user,$id_turn,$id_location,$totalprice,$cancelled,$minutes_to_rent);
            $updatelocation = $this->sell->updateLocationstatus($id_location,1);

            $savelocationrent = $this->sell->insertLocacionrent($saverent[0]->id_salerent, $saverent[0]->id_location);

            if($updatelocation == 1){
                if($type_sell == 'FIAR'){
                    $this->sell->insertDebtrent($saverent[0]->id_salerent, $totalprice);
                }
                $return = 1;
            } else {
                $return = 2;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'SellController|sellRent');
            $return = 2;
        }
        echo $return;
    }


    public function finishRent(){
        try{
            $id_salerent = $_POST['id_salerent'];
            $id_location = $_POST['id_location'];
            $id_locationrent = $_POST['id_locationrent'];

            $return = $this->sell->updateStatuslocationrent($id_salerent,$id_location,$id_locationrent);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'SellController|finishRent');
            $return = 2;
        }

        echo $return;
    }*/
}
<?php
/**
 * Created by PhpStorm.
 * User: Lucho
 * Date: 03/08/2020
 * Time: 9:29
 */
require 'app/models/Person.php';
require 'app/models/SellGas.php';
require 'app/models/Inventory.php';
require 'app/models/Active.php';
require 'app/models/Client.php';
require 'app/models/Correlative.php';
require 'app/models/User.php';
require 'app/models/Nmletras.php';
require 'app/models/Igv.php';
require 'app/models/TipoNota.php';
require 'app/models/SellGasAnulados.php';
//require 'app/models/simple_html_dom.php';
//require 'app/view/report/fpdf/fpdf.php';
class SellGasController{
    private $crypt;
    private $nav;
    private $log;
    private $inventory;
    private $person;
    private $sell;
    private $active;
    private $client;
    private $correlative;
    private $usuario;
    private $numLetra;
    private $igv_tipo;
    private $tipo_nota;
    private $sell_anulados;
    private $simple_dom; //para buscar por dni
    //private $pdf;

    public function __construct()
    {
        $this->crypt = new Crypt();
        //$this->menu = new Menu();
        $this->log = new Log();
        $this->inventory = new Inventory();
        $this->person = new Person();
        $this->sell = new SellGas();
        $this->active = new Active();
        $this->client = new Client();
        $this->correlative = new Correlative();
        $this->usuario = new User();
        $this->numLetra = new Nmletras();
        $this->igv_tipo = new Igv();
        $this->tipo_nota = new TipoNota();
        //$this->pdf = new FPDF();
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
        $tiponotacredito = $this->tipo_nota->listAllCredito();
        $tiponotadebito = $this->tipo_nota->listAllDebito();

        require _VIEW_PATH_ . 'header.php';
        require _VIEW_PATH_ . 'navbar.php';
        require _VIEW_PATH_ . 'sellGas/SellGas.php';
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
            require _VIEW_PATH_ . 'sellGas/viewhistoryGas.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }
    public function viewhistorypedido(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));

            date_default_timezone_set('America/Lima');
            $fecha = date('Y-m-d');
            $user = $this->usuario->listAllPedidos();

            $pedido = $this->sell->listSales();

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'sellGas/historypedidosGas.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";

        }
    }

    public function pedidospendientes(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));

            //$user = $this->usuario->listAllPedidos();
            $pedido = $this->sell->listPendientes();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'sellGas/pedidospendientes.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";

        }
    }
// ver historia de pedidos con filtros
    public function viewhistorypedidofiltro(){
        try {
            $fecha_i = $_POST['fecha_i'];
            $fecha_f = $_POST['fecha_f']; //aaaa-mm-dd hay 3 filas aaaa[0], mm[1], dd[2]
            /*$explode = explode("-",$fecha_f); //explode divide un string en varios string, devuelve un array de string
            $sum = $explode[2] + 1;
            $fecha_f = $explode[0]."-".$explode[1]."-".$sum;*/
            $estadopedido = $_POST['estadopedido'];
            $usuario = $_POST['usuario'];
            if ($estadopedido=="" && $usuario==""){
                $filtrousuario = $this->sell->listSalesfiltrofechas($fecha_i,$fecha_f);
            } elseif ($usuario == ""){
                $filtrousuario = $this->sell->listSalesfiltroestado($fecha_i,$fecha_f,$estadopedido);
            } elseif ($estadopedido==""){
                $filtrousuario = $this->sell->listSalesfiltrousuario($fecha_i,$fecha_f,$usuario);
            } else{
                $filtrousuario = $this->sell->listSalesfiltro($fecha_i,$fecha_f,$estadopedido,$usuario);
            }
            $estadopedidomostrar = $_POST['estadopedido'];;
            if ($estadopedidomostrar == 2){
                $estadopedidomostrar = "PENDIENTE";
            } elseif ($estadopedidomostrar == 1){
                $estadopedidomostrar = "VENDIDO";
            } elseif($estadopedidomostrar == ""){
                $estadopedidomostrar = "TODO";
            } else{
                $estadopedidomostrar = "CANCELADO";
            }
            $usermostrar = $this->usuario->selectNickname($usuario);
            if ($usermostrar == ""){
                $usermostrar = "TODO";
            }

            $totalusuario = count($filtrousuario);
            $listreturn = "<h4>FILTRO DEL $fecha_i al $fecha_f || Estado de Pedido: $estadopedidomostrar || Usuario: $usermostrar || TOTAL $/ <span id=\"spanTotal\">0</span></h4>";
            $listreturn .= "<table id=\"example2\" class=\"table table-bordered table-hover\">
                    <thead class=\"text-capitalize\">
                    <tr>
                        <th>N°</th>
                        <th>Fecha</th>
                        <th>Usuario Vendedor</th>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Total de Venta</th>
                        <th>Estado de Pedido</th>
                        <th>ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody id=\"tabla_lista_pedidos\">";
            $totaldelfiltro = 0;
            foreach ($filtrousuario as $m) {
                $subtotal = round($m->saleproductgas_total, 2);
                $totaldelfiltro = $totaldelfiltro + $subtotal;

                $estadopedido = "<a class=\"btn btn-xs btn-outline-danger\" style='color: #00ca6d'>PENDIENTE</a>";
                if($m->saleproductgas_estado == 1){
                    $estadopedido = "<a class=\"btn btn-xs btn-outline-success\">VENDIDO</a>";
                }
                if ($m->saleproductgas_estado == 0){
                    $estadopedido = "<a class=\"btn btn-xs btn-outline-success\" style='color: #902b2b'>CANCELADO</a>";
                }
                $show = "<a class=\"btn btn-xs btn-outline-danger\">ANULADO</a>";
                if($m->saleproductgas_cancelled == 1){
                    $show = "<a class=\"btn btn-xs btn-outline-success\">VENDIDO</a>";
                }

                $listreturn .= "<tr>
                    <td>$totalusuario</td>
                        <td>".$m->saleproductgas_date."</td>
                        <td style='color: red;'>".$m->user_nickname."</td>
                        <td>".$m->client_name."</td>
                        <td>".$m->saleproductgas_direccion."</td>
                        <td>".$m->saleproductgas_telefono."</td>
                        <td>s/. ".$m->saleproductgas_total."</td>
                        <td>".$estadopedido."</td>
                        <td><a type=\"button\" class=\"btn btn-xs btn-primary btne\" href=\"viewsale/$m->id_saleproductgas\" target=\"_blank\" >Ver Detalle</a></td>
                    </tr>";
                $totalusuario--;
                //RecordsTotal = Total de registros, antes del filtrado (es decir, el número total de registros en la base de datos)
                //recordsFiltered = Total de registros, después del filtrado (es decir, el número total de registros después de aplicar
                // el filtrado, no solo el número de registros que se devuelven para esta página de datos).
                //$output = array("draw"=>1, "recordsTotal" => 0, "recordsFiltered" => $totalusuario, "data" => $listreturn);
            }
            $listreturn .="</tbody>
                </table>";
            $listreturn .= "<input type=\"hidden\" value=\"$totaldelfiltro\" id=\"montototalfiltro\">";
            echo $listreturn;

        }catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
//cambiar estado a ENTREGADO o CANCELADO en la vista pedidospendientes
    public function estadoentregado(){
        try {
            if(isset($_POST['id_saleproductgas'])){
                $id_saleproductgas = $_POST['id_saleproductgas'];
                $cambiarpedido = $this->sell->CambiarPedido($id_saleproductgas);
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

    public function viewSale(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            //$idroleUser = $this->crypt->decrypt($_SESSION['role'],_PASS_);
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $sale = $this->sell->listSale($id);
            $productssale = $this->sell->listSaledetail($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'sellGas/viewsaleGas.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }

    public function table_productsGas(){

        require _VIEW_PATH_ . 'sellGas/table_productsGas.php';
    }

    //Funciones
    public function addProductGas(){
        try{
            if(isset($_POST['codigo']) && isset($_POST['producto']) && isset($_POST['unids']) && isset($_POST['precio']) && isset($_POST['cantidad']) && isset($_POST['tipo_igv'])){
                $repeat = false;
                foreach($_SESSION['productos'] as $p){
                    if($_POST['codigo'] == $p[0]){
                        $repeat = true;
                    }
                }
                if(!$repeat){
                    array_push($_SESSION['productos'], [$_POST['codigo'], $_POST['producto'], $_POST['unids'], round($_POST['precio'], 2), $_POST['cantidad'], $_POST['tipo_igv']]);
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
                    $result = $result->product_name . '|' . $result->product_unid_type . '|' . $result->product_stock . '|' . $result->id_productforsale . '|' . $result->product_unid . '|' . $result->product_price . '|' . $result->medida_codigo_unidad;
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
            if(isset($_POST['id_saleproductgas'])){
                $id_saleproductgas = $_POST['id_saleproductgas'];
                $revoke = $this->sell->revokeSale($id_saleproductgas);
                if($revoke == 1){
                    $productos = $this->sell->listSaledetail($id_saleproductgas);
                    foreach ($productos as $p){
                        $id = $this->inventory->getIdProductIdForProductSale($p->id_productforsale);
                        $stock = $p->sale_productstotalselledgas;
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

    // consultar con la reniec para el dni o ruc
    /*public function consulta_reniec(){
        $num_doc = $_POST['buscar_cliente'];

        $consulta_documento = file_get_html('https://eldni.com/buscar-por-dni?dni='.$num_doc);
        $datosnombres = array();
        foreach ($consulta_documento->find('td') as $header){
            $datosnombres[] = $header->plaintext;
        }

        //LA LOGICA DE LA PAGINAS ES APELLIDO PATERNO | APELLIDO MATERNO | NOMBRES
        $result = array(
            0 => $num_doc,
            1 => $datosnombres[0],
            2 => $datosnombres[1],
            3 => $datosnombres[2],
        );
        echo $result;
    }*/

    //VENDER PRODUCTO----------------------------------------------->
    public function sellProduct(){
        try{
            //Busca si hay un turno activo
            $client = $this->client->listClientbyNumber($_POST['client_number']); //direcciona al Client Models para seleccionar el cliente

            $id_client = $client->id_client; //mediante el client_number jala el id_client
            $id_turn = $this->active->getTurnactive(); //jala el turn_active que sea 1 de la tabla turn
            $id_user = $this->crypt->decrypt($_SESSION['id_user'],_PASS_);// llama la clase crypt de decrypt para decodificar los 2 parametros

            $saleproductgas_direccion = $_POST['saleproductgas_direccion'];//recibe el valor de direccion del formulario
            $saleproductgas_telefono = $_POST['saleproductgas_telefono'];
            $saleproduct_type = $_POST['saleproduct_type']; //recibe el valor del type
            $saleproductgas_naturaleza = $_POST['saleproduct_naturaleza'];
            if($saleproductgas_naturaleza == "OFICINA"){
                $saleproduct_estado = 1;
            } else{
                $saleproduct_estado = 2;
            }
            $saleproduct_correlative = 1;
            $correlative = $this->correlative->list();
            if($saleproduct_type == "03"){
                $saleproduct_correlative = "BBB1-" . $correlative->correlative_b;
            } else if ($saleproduct_type == "01"){
                $saleproduct_correlative = "FFF1-" . $correlative->correlative_f;
            } else if($saleproduct_type == "07"){
                $saleproduct_correlative = "FFF1-" . $correlative->correlative_nc;
            } else{
                $saleproduct_correlative = "BBB1-" . $correlative->correlative_nd;
            }

            $saleproduct_inafecta = $_POST['saleproduct_inafecta'];
            $saleproduct_exonerada = $_POST['saleproduct_exonerada'];
            $saleproduct_gravada = $_POST['saleproduct_gravada'];
            $saleproduct_icbper = $_POST['saleproduct_icbper'];
            $saleproduct_igv = $_POST['saleproduct_igv'];
            $saleproduct_gratuita = $_POST['saleproduct_gratuita'];
            $saleproduct_total = $_POST['saleproduct_total'];
            $saleproduct_date = date("Y-m-d H:i:s");
            $tipo_nota = $_POST['tipo_nota'];
            $Serie_Numero = $_POST['Serie_Numero'];
            $Tipo_documento_modificar = $_POST['Tipo_documento_modificar'];

            $saleproduct_cancelled = 1;

            $savesale = $this->sell->insertSale($id_client, $id_user, $id_turn, $saleproductgas_direccion, $saleproductgas_telefono, $saleproduct_type, $saleproductgas_naturaleza, $saleproduct_correlative, $saleproduct_gravada, $saleproduct_igv, $saleproduct_total, $saleproduct_date, $saleproduct_estado, $saleproduct_cancelled, $saleproduct_inafecta, $saleproduct_exonerada, $saleproduct_icbper, $tipo_nota, $Serie_Numero, $Tipo_documento_modificar, $saleproduct_gratuita);
            $idsale = $savesale->id_saleproductgas;


            if($idsale != 2){ //despues de registrar la venta se sigue a registrar el detalle
                $fecha_bolsa = date("Y");
                if ($fecha_bolsa == "2020"){
                    $impuesto_icbper = 0.20;
                } else if ($fecha_bolsa == "2021"){
                    $impuesto_icbper = 0.30;
                } else if ($fecha_bolsa == "2022") {
                    $impuesto_icbper = 0.40;
                } else{
                    $impuesto_icbper = 0.50;
                }
                $ICBPER = 0;
                foreach ($_SESSION['productos'] as $p){
                    if ($p[5] == 1 || $p[5] == 10){
                        $subtotal = round($p[3] * $p[4], 2);
                        $id_saleproduct = $savesale->id_saleproductgas;
                        $id_productforsale = $p[0];
                        $sale_productname = $p[1];
                        $sale_unid = $p[2];
                        $sale_price= $p[3];
                        $sale_productscant = $p[4];
                        $sale_productstotalselled = $p[4];

                        $precio_producto = $p[3];
                        $precio_base = round($precio_producto / 1.18 , 2);
                        $subtotal_base = round($subtotal / 1.18 , 2);
                        $igv_total = round($subtotal - $subtotal_base , 2);
                        $tipo_igv = $p[5];
                        if ($p[0] == "11" || $p[0] == "12" ){
                            $ICBPER = $ICBPER + round($p[4] * $impuesto_icbper , 2);
                        } else{
                            $ICBPER = $ICBPER;
                        }
                        $sale_productstotalprice = round($subtotal + $ICBPER , 2);
                        $savedetail = $this->sell->insertSaledetail($id_saleproduct, $id_productforsale, $sale_productname, $sale_unid, $sale_price, $sale_productscant, $sale_productstotalselled, $sale_productstotalprice, $precio_producto, $precio_base, $subtotal_base, $igv_total, $tipo_igv, $ICBPER);
                        if($savedetail == 1){
                            $reduce = $sale_productscant;
                            $id_product = $this->inventory->listIdproducforproductsale($id_productforsale);
                            $this->sell->saveProductstock($reduce, $id_product);
                            $return = 1;
                        } else {
                            $return = 2;
                        }
                    } else if($p[5] == 3){
                        $subtotal = round($p[3] * $p[4], 2);
                        $id_saleproduct = $savesale->id_saleproductgas;
                        $id_productforsale = $p[0];
                        $sale_productname = $p[1];
                        $sale_unid = $p[2];
                        $sale_price= $p[3];
                        $sale_productscant = $p[4];
                        $sale_productstotalselled = $p[4];

                        $precio_producto = $p[3];
                        $precio_base = round($precio_producto , 2);
                        $subtotal_base = round($subtotal , 2);
                        $igv_total = "0.00";
                        $tipo_igv = $p[5];
                        if ($p[0] == "11" || $p[0] == "12" ){
                            $ICBPER = $ICBPER + round($p[4] * $impuesto_icbper , 2);
                        } else{
                            $ICBPER = $ICBPER;
                        }
                        $sale_productstotalprice = round($subtotal + $ICBPER, 2);
                        $savedetail = $this->sell->insertSaledetail($id_saleproduct, $id_productforsale, $sale_productname, $sale_unid, $sale_price, $sale_productscant, $sale_productstotalselled, $sale_productstotalprice, $precio_producto, $precio_base, $subtotal_base, $igv_total, $tipo_igv, $ICBPER);
                        if($savedetail == 1){
                            $reduce = $sale_productscant;
                            $id_product = $this->inventory->listIdproducforproductsale($id_productforsale);
                            $this->sell->saveProductstock($reduce, $id_product);
                            $return = 1;
                        } else {
                            $return = 2;
                        }
                    }else if($p[5] == 4 || $p[5] == 5 || $p[5] == 6 || $p[5] == 7 || $p[5] == 8 || $p[5] == 9 || $p[5] == 11 || $p[5] == 12 || $p[5] == 13 || $p[5] == 14 || $p[5] == 15 || $p[5] == 16 || $p[5] == 17 || $p[5] == 18 || $p[5] == 20){
                        //GRATUITA
                        $subtotal = round($p[3] * $p[4], 2);
                        $id_saleproduct = $savesale->id_saleproductgas;
                        $id_productforsale = $p[0];
                        $sale_productname = $p[1];
                        $sale_unid = $p[2];
                        $sale_price= $p[3];
                        $sale_productscant = $p[4];
                        $sale_productstotalselled = $p[4];

                        $precio_producto = $p[3];
                        $precio_base = round($precio_producto , 2);
                        $subtotal_base = round($subtotal , 2);
                        $igv_total = "0.00";
                        $tipo_igv = $p[5];
                        if ($p[0] == "11" || $p[0] == "12" ){
                            $ICBPER = $ICBPER + round($p[4] * $impuesto_icbper , 2);
                        } else{
                            $ICBPER = $ICBPER;
                        }
                        $sale_productstotalprice = round($subtotal + $ICBPER, 2);
                        $savedetail = $this->sell->insertSaledetail($id_saleproduct, $id_productforsale, $sale_productname, $sale_unid, $sale_price, $sale_productscant, $sale_productstotalselled, $sale_productstotalprice, $precio_producto, $precio_base, $subtotal_base, $igv_total, $tipo_igv, $ICBPER);
                        if($savedetail == 1){
                            $reduce = $sale_productscant;
                            $id_product = $this->inventory->listIdproducforproductsale($id_productforsale);
                            $this->sell->saveProductstock($reduce, $id_product);
                            $return = 1;
                        } else {
                            $return = 2;
                        }
                    }
                    else{
                        $subtotal = round($p[3] * $p[4], 2);
                        $id_saleproduct = $savesale->id_saleproductgas;
                        $id_productforsale = $p[0];
                        $sale_productname = $p[1];
                        $sale_unid = $p[2];
                        $sale_price= $p[3];
                        $sale_productscant = $p[4];
                        $sale_productstotalselled = $p[4];
                        $precio_producto = $p[3];
                        $precio_base = round($precio_producto , 2);
                        $subtotal_base = round($subtotal , 2);
                        $igv_total = "0.00";
                        $tipo_igv = $p[5];
                        if ($p[0] == "11" || $p[0] == "12" ){
                            $ICBPER = $ICBPER + round($p[4] * $impuesto_icbper , 2);
                        } else{
                            $ICBPER = 0;
                        }
                        $sale_productstotalprice = round($subtotal + $ICBPER ,2);
                        $savedetail = $this->sell->insertSaledetail($id_saleproduct, $id_productforsale, $sale_productname, $sale_unid, $sale_price, $sale_productscant, $sale_productstotalselled, $sale_productstotalprice, $precio_producto, $precio_base, $subtotal_base, $igv_total, $tipo_igv, $ICBPER);
                        if($savedetail == 1){
                            $reduce = $sale_productscant;
                            $id_product = $this->inventory->listIdproducforproductsale($id_productforsale);
                            $this->sell->saveProductstock($reduce, $id_product);
                            $return = 1;
                        } else {
                            $return = 2;
                        }
                    }

                }
            } else {
                $return = 2;
            }

            if($return == 1){
                $return = $savesale->id_saleproductgas;

                if($saleproduct_type == "03"){
                    $this->correlative->updatecorrelativeb();
                } else if($saleproduct_type == "01"){
                    $this->correlative->updatecorrelativef();
                } else if($saleproduct_type == "07"){
                    $this->correlative->updatecorrelativenc();
                } else{
                    $this->correlative->updatecorrelativend();
                }
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $return = 2;
        }
        echo $return;
    }
//funcion para imprimir un pdf
    public function historypedidos_pdf(){
        try {
            $fecha_i = $_POST['fecha_i_f'];
            $fecha_f = $_POST['fecha_f_f']; //aaaa-mm-dd hay 3 filas aaaa[0], mm[1], dd[2]
            /*$explode = explode("-",$fecha_f); //explode divide un string en varios string, devuelve un array de string
            $sum = $explode[2] + 1;
            $fecha_f = $explode[0]."-".$explode[1]."-".$sum;*/
            $estadopedido = $_POST['estadopedido_pdf'];
            $usuario = $_POST['usuario_pdf'];
            if ($estadopedido=="" && $usuario==""){
                $filtrousuario = $this->sell->listSalesfiltrofechas($fecha_i,$fecha_f);
            } elseif ($usuario == ""){
                $filtrousuario = $this->sell->listSalesfiltroestado($fecha_i,$fecha_f,$estadopedido);
            } elseif ($estadopedido==""){
                $filtrousuario = $this->sell->listSalesfiltrousuario($fecha_i,$fecha_f,$usuario);
            } else{
                $filtrousuario = $this->sell->listSalesfiltro($fecha_i,$fecha_f,$estadopedido,$usuario);
            }

            if ($estadopedido==1){
                $estadopedido = "VENDIDO";
            } else if ($estadopedido == 2){
                $estadopedido = "PENDIENTE";
            } else if ($estadopedido==""){
                $estadopedido = "TODO";
            } else{
                $estadopedido = "CANCELADO";
            }

            $user = $this->usuario->selectNickname($usuario);
            if ($user == ""){
                $user = "TODO";
            }

            require _VIEW_PATH_ . 'sellGas/historypedidos_pdf.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }

    //funcion para imprimir un pdf
    public function exportarhistorypedidos_excel(){
        try {
            $fecha_i = $_POST['fecha_i_f_e'];
            $fecha_f = $_POST['fecha_f_f_e']; //aaaa-mm-dd hay 3 filas aaaa[0], mm[1], dd[2]
            /*$explode = explode("-",$fecha_f); //explode divide un string en varios string, devuelve un array de string
            $sum = $explode[2] + 1;
            $fecha_f = $explode[0]."-".$explode[1]."-".$sum;*/
            $estadopedido = $_POST['estadopedido_excel'];
            $usuario = $_POST['usuario_excel'];
            if ($estadopedido=="" && $usuario==""){
                $filtrousuario_excel = $this->sell->listSalesfiltrofechas($fecha_i,$fecha_f);
            } elseif ($usuario == ""){
                $filtrousuario_excel = $this->sell->listSalesfiltroestado($fecha_i,$fecha_f,$estadopedido);
            } elseif ($estadopedido==""){
                $filtrousuario_excel = $this->sell->listSalesfiltrousuario($fecha_i,$fecha_f,$usuario);
            } else{
                $filtrousuario_excel = $this->sell->listSalesfiltro($fecha_i,$fecha_f,$estadopedido,$usuario);
            }
            $user = $this->usuario->selectNickname($usuario);


            header('Content-Type: application/vnd.ms-excel; charset=utf-8');
            header('Content-Disposition: attachment; filename="Reporte_filtro_pedidos.xls"');
            require _VIEW_PATH_ . 'sellGas/exportar_filtro_excel.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }

    function imprimir_tabla_filtro(){
        try {
            $fecha_i = $_POST['fecha_i_f_e_i'];
            $fecha_f = $_POST['fecha_f_f_e_i']; //aaaa-mm-dd hay 3 filas aaaa[0], mm[1], dd[2]
            /*$explode = explode("-",$fecha_f); //explode divide un string en varios string, devuelve un array de string
            $sum = $explode[2] + 1;
            $fecha_f = $explode[0]."-".$explode[1]."-".$sum;*/
            $estadopedido = $_POST['estadopedido_imprimir'];
            $usuario = $_POST['usuario_imprimir'];
            if ($estadopedido=="" && $usuario==""){
                $filtrousuario_excel = $this->sell->listSalesfiltrofechas($fecha_i,$fecha_f);
            } elseif ($usuario == ""){
                $filtrousuario_excel = $this->sell->listSalesfiltroestado($fecha_i,$fecha_f,$estadopedido);
            } elseif ($estadopedido==""){
                $filtrousuario_excel = $this->sell->listSalesfiltrousuario($fecha_i,$fecha_f,$usuario);
            } else{
                $filtrousuario_excel = $this->sell->listSalesfiltro($fecha_i,$fecha_f,$estadopedido,$usuario);
            }
            $user = $this->usuario->selectNickname($usuario);

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'sellGas/imprimir_tabla_filtro.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    //funcion para crear los archivos planos, para generar el xml en el facturador Electronico Sunat
    function crear_ArchivosPlanos(){
        try {
            $id_user = $this->crypt->decrypt($_SESSION['id_user'],_PASS_);// llama la clase crypt de decrypt para decodificar los 2 parametros
            $id_productoventa = $_POST['id'];
            $estado_enviado = $_POST['envio_sunat'];
            //$cliente_data = $this->client->listAll();
            $comprobante = $this->sell->datos_comprobante($id_productoventa); //CONSULTA DONDE SE REALACIONA TODO LO QUE SE USA EN SELLPRODUCTGAS
            $comprobante_saleproduct = $this->sell->listSale($id_productoventa);
            $saledetail_data = $this->sell->todos_saledetaill($id_productoventa);
            $fecha_bolsa = date("Y");
            if ($fecha_bolsa == "2020"){
                $impuesto_icbper = 0.20;
            } else if ($fecha_bolsa == "2021"){
                $impuesto_icbper = 0.30;
            } else if ($fecha_bolsa == "2022") {
                $impuesto_icbper = 0.40;
            } else{
                $impuesto_icbper = 0.50;
            }
            $rutaArchivos = "C:/FacturadorBufeo/sunat_archivos/sfs/DATA/";
            if ($estado_enviado == 0) {
                if ($comprobante->saleproductgas_type < 4) {
                    // FACTURA , BOLETA

                    /*nombre archivo*/
                    $fechaHoraEmision = new DateTime($comprobante->fecha_sunat);
                    $fechaVencimiento = new DateTime($comprobante->fecha_de_vencimiento);
                    $sql = $rutaArchivos . $comprobante->empresa_ruc . '-' . $comprobante->saleproductgas_type . '-' . $comprobante->saleproductgas_correlativo . '.CAB';
                    $f = fopen($sql, 'w'); //crea la libreria (con nombre especificado)
//HASTA ACA SE CREA EL ARCHIVO .CAB
                    /*cuerpo documento cabecera*/
                    $linea = "0101|";//tipo operacion
                    $linea .= "{$fechaHoraEmision->format('Y-m-d')}|";//fecha emision
                    $linea .= "{$fechaHoraEmision->format('H:i:s')}|";//hora emision
                    $linea .= "{$fechaVencimiento->format('Y-m-d')}|";//:fecha vencimiento
                    $linea .= "0000|";//codigo domicilio fiscal
                    $linea .= "{$comprobante->tipodocumento_codigo}|";//tipo de documento de identidad
                    $linea .= trim("{$comprobante->client_number}")."|";//:numero de documento identidad || trmi(Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena)
                    if ($comprobante->client_razonsocial == ""){
                        $linea .= "{$comprobante->client_name}|";//apellidos y nombres o razon social
                    } else{
                        $linea .= "{$comprobante->client_razonsocial}|";//apellidos y nombres o razon social
                    }
                    $linea .= "{$comprobante->abrstandar}|";//:tipo de moneda
                    $linea .= "{$comprobante->saleproductgas_totaligv}|";//:sumatoria tributos
                    if($comprobante->saleproductgas_totalgravada == "0.00"){
                        $linea .= "{$comprobante->saleproductgas_total}|";//:total valor venta
                    } else{
                        $linea .= "{$comprobante->saleproductgas_totalgravada}|";//:total valor venta
                    }

                    $linea .= "{$comprobante->saleproductgas_total}|";//total precio venta
                    $linea .= "$comprobante_saleproduct->total_descuentos|";//total descuento
                    $linea .= "0.00|";//sumatoria otros cargos
                    /*buscamos si el comprobante a enviar tiene anticipos*/
                    /*$this->db->from("comprobante_anticipo");
                    $this->db->join("comprobantes", "comprobante_anticipo.comprobante_id=comprobantes.id");
                    $this->db->where("comprobante_id" , $comprobante_id);
                    $query = $this->db->get();
                    $anticipos = $query->result();
                    if(count($anticipos))
                    {
                        $totalAnticipos = 0;
                        foreach($anticipos as $anticipo)
                        {
                            $totalAnticipo += $anticipo->total_a_pagar;
                        }
                        $linea .= "{$totalAnticipo}|";
                    }else{
                        $linea .= "0|";//total anticipo
                    }*/
                    $linea .= "0.00|";//total anticipo
                    $importetotal = $comprobante->saleproductgas_total - $comprobante_saleproduct->total_descuentos + 0 - 0;
                    $linea .= "{$importetotal}|";//Importe total de la venta, cesión en uso o del servicio prestado
                    $linea .= "2.1|";//version UBL
                    $linea .= "2.0|\r\n";//customization

                    fwrite($f, $linea); // Escritura de un archivo en modo binario seguro
                    fclose($f); //CERRAMOS EL FICHERO
                    //empezamos con el archivo .DET
                    $rut = $rutaArchivos . $comprobante->empresa_ruc . '-' . $comprobante->saleproductgas_type . '-' . $comprobante->saleproductgas_correlativo . '.DET';
                    $f = fopen($rut, 'w');
                    foreach ($saledetail_data as $value) {
                        $result = $this->sell->Buscarproduct_detalle($value->id_productforsale);

                        // $precioBaseUnidad = ($value['total']-$value['igv'])/$value['cantidad'];//precio unitario sin igv
                        /*if($comprobante1->comprobante_anticipo == '1')
                        {
                            $precioBaseUnidad = (($value['subtotal']/$value['cantidad'])/1.18);
                        }else{
                            $precioBaseUnidad = ($value['subtotal']/$value['cantidad']);
                        }

                        $precioConIgv = $precioBaseUnidad*1.18;
                        $igvUnitario = $precioConIgv-$precioBaseUnidad ; */

                        // $igvPorUnidad = $precioBaseUnidad;
                        $descripction = $this->sanear_string(utf8_decode($value->sale_productnamegas));

                        $linea = "{$result->medida_codigo_unidad}|";//Código de unidad de medida por ítem
                        $linea .= "{$value->sale_productscantgas}|";//Cantidad de unidades por ítem
                        $linea .= "{$result->product_barcode}|";//Código de producto
                        $linea .= "-|";//Codigo producto SUNAT
                        $linea .= str_replace("&", "Y", trim(utf8_decode($descripction)))."|";//Descripción detallada del servicio prestado, bien vendido o cedido en uso, indicando las características.
                        $linea .= round($value->precio_base, 2)."|";//Valor Unitario (cac:InvoiceLine/cac:Price/cbc:PriceAmount)
                        $linea .= "{$value->igv}|";//Sumatoria Tributos por item
                        //TRIBUTO IGV
                        $linea .= "{$value->igv_codigo}|";//Tributo: Códigos de tipos de tributos IGV(1000 - 1016 - 9995 - 9996 - 9997 - 9998)
                        $linea .= "{$value->igv}|";//Tributo: Monto de IGV por ítem
                        if($value->igv_codigoafectacion == '40')//gratuitas la base es 0
                        {
                            $linea .= "0|";//Tributo: Base Imponible IGV por Item
                        }else
                        {
                            $linea .= "{$value->subtotal}|";//Tributo: Base Imponible IGV por Item
                        }

                        $linea .= "{$value->igv_nombre}|";//Tributo: Nombre de tributo por item
                        //$linea .= $this->tipoCodigoDeTributo($value['tipo_igv_codigo'])."|";//Tributo: Código de tipo de tributo por Item
                        $linea .= "{$value->igv_codigoInternacional}|";//Tributo: Código de tipo de tributo por Item
                        $linea .= "{$value->igv_codigoafectacion}|";//Tributo: Afectación al IGV por ítem
                        if($value->igv == "0.00"){
                            $linea .= "0.00|";//Tributo: Porcentaje de IGV
                        } else{
                            $linea .= "18.00|";//Tributo: Porcentaje de IGV
                        }
                        /*Tributo ISC (2000)*/
                        $linea .= "-|";//Tributo ISC: Códigos de tipos de tributos ISC
                        $linea .= "|";//Tributo ISC: Monto de ISC por ítem
                        $linea .= "|";//Tributo ISC: Base Imponible ISC por Item
                        $linea .= "|";//Tributo ISC: Nombre de tributo por item
                        $linea .= "|";//Tributo ISC: Código de tipo de tributo por Item
                        $linea .= "|";//Tributo ISC: Tipo de sistema ISC
                        $linea .= "|";//Tributo ISC: Porcentaje de ISC
                        /*Tributo Otro 9999*/
                        $linea .= "-|";//Tributo Otro: Códigos de tipos de tributos OTRO
                        $linea .= "|";//Tributo Otro: Monto de tributo OTRO por iItem
                        $linea .= "|";//Tributo Otro: Base Imponible de tributo OTRO por Item
                        $linea .= "|";//Tributo Otro:  Nombre de tributo OTRO por item
                        $linea .= "|";//Tributo Otro: Código de tipo de tributo OTRO por Item
                        $linea .= "|";//Tributo Otro: Porcentaje de tributo OTRO por Item
                        //Tributo ICBPER 7152

                        if ($value->total_icbper > 0){
                            $linea .= "7152|";//Tributo ICBPER: Códigos de tipos de tributos ICBPER
                            $linea .= "{$value->total_icbper}|";//Tributo ICBPER: Monto de tributo ICBPER por iItem
                            $linea .= "{$value->sale_productscantgas}|";//Tributo ICBPER: Cantidad de bolsas plásticas por Item
                            $linea .= "ICBPER|";//Tributo ICBPER:  Nombre de tributo ICBPER por item
                            $linea .= "OTH|";//Tributo ICBPER: Código de tipo de tributo ICBPER por Item
                            $linea .= number_format($impuesto_icbper , 2)."|";//Tributo ICBPER: Monto de tributo ICBPER por Unidad
                        } else {
                            $linea .= "-|";//Tributo ICBPER: Códigos de tipos de tributos ICBPER
                            $linea .= "|";//Tributo ICBPER: Monto de tributo ICBPER por iItem
                            $linea .= "|";//Tributo ICBPER: Cantidad de bolsas plásticas por Item
                            $linea .= "|";//Tributo ICBPER:  Nombre de tributo ICBPER por item
                            $linea .= "|";//Tributo ICBPER: Código de tipo de tributo ICBPER por Item
                            $linea .= "|";//Tributo ICBPER: Monto de tributo ICBPER por Unidad

                        }

                        if($value->igv_tipoigv == 1){
                            $linea .= ($value->precio_base * 1.18)."|";//Precio de venta unitario(base+igv)
                        } else{
                            $linea .= ($value->precio_base)."|";
                        }

                        $linea .= round($value->subtotal, 2)."|";//Valor de venta por Item
                        $linea .= "0.00|\r\n";//Valor REFERENCIAL unitario (gratuitos)*/
                        fwrite($f, $linea);
                    }
                    fclose($f);
                    /*DOCUMENTO TRIBUTO*/
                    $rut_tributo = $rutaArchivos . $comprobante->empresa_ruc . '-' . $comprobante->saleproductgas_type . '-' . $comprobante->saleproductgas_correlativo . '.TRI';
                    $f = fopen($rut_tributo, 'w');
                    //si tributo es igv
                    if($comprobante->saleproductgas_totalgravada > 0)
                    {
                        $linea = "1000|";//Identificador de tributo
                        $linea .= "IGV|";//Nombre de tributo
                        $linea .= "VAT|";//Código de tipo de tributo
                        $linea .= "{$comprobante->saleproductgas_totalgravada}|";//Base imponible
                        $linea .= "{$comprobante->saleproductgas_totaligv}|\r\n";//Monto de Tirbuto por ítem
                        fwrite($f, $linea);
                    }
                    //si tributo es exonerada
                    if($comprobante->saleproductgas_totalexonerada > 0)
                    {
                        $linea = "9997|";//Identificador de tributo
                        $linea .= "EXO|";//Nombre de tributo
                        $linea .= "VAT|";//Código de tipo de tributo
                        $linea .= "{$comprobante->saleproductgas_totalexonerada}|";//Base imponible
                        $linea .= "0|\r\n";//Monto de Tirbuto por ítem
                        fwrite($f, $linea);
                    }
                    //si tributo es inafecto
                    if($comprobante->saleproductgas_totalinafecta > 0)
                    {
                        $linea = "9998|";//Identificador de tributo
                        $linea .= "INA|";//Nombre de tributo
                        $linea .= "FRE|";//Código de tipo de tributo
                        $linea .= "{$comprobante->saleproductgas_totalinafecta}|";//Base imponible
                        $linea .= "0|\r\n";//Monto de Tirbuto por ítem
                        fwrite($f, $linea);
                    }
                    //si tributo es gratuita/exportacion
                    /*if($comprobante['total_gratuita'] > 0)
                    {
                        $linea = "9996|";//Identificador de tributo
                        $linea .= "GRA|";//Nombre de tributo
                        $linea .= "FRE|";//Código de tipo de tributo
                        $linea .= "{$comprobante['total_gratuita']}|";//Base imponible
                        $linea .= "0|\r\n";//Monto de Tirbuto por ítem
                        fwrite($f, $linea);
                    }*/
                    //tributo de bolsa
                    if($comprobante->saleproductgas_icbper > 0)
                    {
                        $linea = "7152|";//Identificador de tributo
                        $linea .= "ICBPER|";//Nombre de tributo
                        $linea .= "OTH|";//Código de tipo de tributo
                        $linea .= "{$comprobante->saleproductgas_total}|";//Base imponible
                        $linea .= "{$comprobante->saleproductgas_icbper}|\r\n";//Monto de Tirbuto por ítem
                        fwrite($f, $linea);
                    }

                    fclose($f);
                    /*DOCUMENTO LEYENDA*/
                    $importe_letra = $this->numLetra->num2letras(intval($comprobante->saleproductgas_total));
                    $arrayImporte = explode(".",$comprobante->saleproductgas_total);
                    $montoLetras = $importe_letra.' con ' .$arrayImporte[1].'/100 '.$comprobante->moneda;
                    $rut_leyenda = $rutaArchivos . $comprobante->empresa_ruc . '-' . $comprobante->saleproductgas_type . '-' . $comprobante->saleproductgas_correlativo . '.LEY';
                    $f = fopen($rut_leyenda, 'w');
                    $linea = "1000|";//Código de leyenda
                    $linea .= "{$montoLetras}|";//Descripción de leyenda
                    fwrite($f, $linea);
                    fclose($f);
                    
                    $cambiar_enviosunat = $this->sell->envio_sunat($id_productoventa);
                    $return = 1;
                } else{
                    //NOTA DE CREDITO , DEBITO
                    /*obtenemos el archivo adjunto a esa nota de credito o debito*/
                    $tipo_docuemnto = $comprobante->saleproductgas_type;
                    if($comprobante->saleproductgas_type == "07"){
                        $rsAdjunto = $this->sell->tipo_nota_credito($id_productoventa,$tipo_docuemnto);
                    } else{
                        $rsAdjunto = $this->sell->tipo_nota_debito($id_productoventa, $tipo_docuemnto);
                    }
                    $fechaHoraEmision = new DateTime($comprobante->fecha_sunat);
                    $linea = "0101|"; //Tipo de Operacion
                    $linea .= "{$fechaHoraEmision->format('Y-m-d')}|";//Fecha de Emision
                    $linea .= "{$fechaHoraEmision->format('H:i:s')}|"; //Hora de Emision
                    $linea .= "0000|"; //Código del domicilio fiscal o de local anexo del emisor
                    $linea .= "{$comprobante->tipodocumento_codigo}|"; //Tipo de documento de identidad del adquirente o usuario
                    $linea .= trim("{$comprobante->client_number}")."|";//:numero de documento identidad || trmi(Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena)
                    if ($comprobante->client_razonsocial == ""){
                        $linea .= "{$comprobante->client_name}|";//apellidos y nombres o razon social
                    } else{
                        $linea .= "{$comprobante->client_razonsocial}|";//apellidos y nombres o razon social
                    }
                    $linea .= "{$comprobante->abrstandar}|";//:tipo de moneda
                    $linea .= "{$rsAdjunto->codigo}|";//Código del tipo de Nota  electrónica
                    $linea .= "{$rsAdjunto->tipo_nota_descripcion}|";//Descripción de motivo o sustento
                    $linea .= " |";//Tipo de documento del documento que modifica
                    $linea .= "-|";//Serie y número del documento que modifica
                    $linea .= "{$comprobante->saleproductgas_totaligv}|";//:sumatoria tributos
                    if($comprobante->saleproductgas_totalgravada == "0.00"){
                        $linea .= "{$comprobante->saleproductgas_total}|";//:total valor venta -
                    } else{
                        $linea .= "{$comprobante->saleproductgas_totalgravada}|";//:total valor venta -
                    }

                    $linea .= "{$comprobante->saleproductgas_total}|";//total precio venta - 15
                    $linea .= "$comprobante_saleproduct->total_descuentos|";//total descuento - 16
                    $linea .= "0.00|";//sumatoria otros cargos - 17
                    $linea .= "0.00|";//Total Anticipos - 18
                    $importetotal = $comprobante->saleproductgas_total - $comprobante_saleproduct->total_descuentos + 0 - 0;
                    $linea .= "{$importetotal}|";//Importe total de la venta, cesión en uso o del servicio prestado
                    $linea .= "2.1|";//version UBL
                    $linea .= "2.0|\r\n";//customization
                    /*creamos archivo nota*/
                    $sql = $rutaArchivos . $comprobante->empresa_ruc . '-' . $comprobante->saleproductgas_type . '-' . $comprobante->saleproductgas_correlativo . '.NOT';
                    $f = fopen($sql, 'w');
                    fwrite($f, $linea);
                    fclose($f);

                    //empezamos con el archivo .DET
                    $rut = $rutaArchivos . $comprobante->empresa_ruc . '-' . $comprobante->saleproductgas_type . '-' . $comprobante->saleproductgas_correlativo . '.DET';
                    $f = fopen($rut, 'w');
                    foreach ($saledetail_data as $value) {
                        $result = $this->sell->Buscarproduct_detalle($value->id_productforsale);

                        // $precioBaseUnidad = ($value['total']-$value['igv'])/$value['cantidad'];//precio unitario sin igv
                        /*if($comprobante1->comprobante_anticipo == '1')
                        {
                            $precioBaseUnidad = (($value['subtotal']/$value['cantidad'])/1.18);
                        }else{
                            $precioBaseUnidad = ($value['subtotal']/$value['cantidad']);
                        }

                        $precioConIgv = $precioBaseUnidad*1.18;
                        $igvUnitario = $precioConIgv-$precioBaseUnidad ; */

                        // $igvPorUnidad = $precioBaseUnidad;
                        $descripction = $this->sanear_string(utf8_decode($value->sale_productnamegas));

                        $linea = "{$result->medida_codigo_unidad}|";//Código de unidad de medida por ítem
                        $linea .= "{$value->sale_productscantgas}|";//Cantidad de unidades por ítem
                        $linea .= "{$result->product_barcode}|";//Código de producto
                        $linea .= "-|";//Codigo producto SUNAT
                        $linea .= str_replace("&", "Y", trim(utf8_decode($descripction)))."|";//Descripción detallada del servicio prestado, bien vendido o cedido en uso, indicando las características.
                        $linea .= round($value->precio_base, 2)."|";//Valor Unitario (cac:InvoiceLine/cac:Price/cbc:PriceAmount)
                        $linea .= "{$value->igv}|";//Sumatoria Tributos por item
                        //TRIBUTO IGV
                        $linea .= "{$value->igv_codigo}|";//Tributo: Códigos de tipos de tributos IGV(1000 - 1016 - 9995 - 9996 - 9997 - 9998)
                        $linea .= "{$value->igv}|";//Tributo: Monto de IGV por ítem
                        if($value->igv_codigoafectacion == '40')//gratuitas la base es 0
                        {
                            $linea .= "0|";//Tributo: Base Imponible IGV por Item
                        }else
                        {
                            $linea .= "{$value->subtotal}|";//Tributo: Base Imponible IGV por Item
                        }

                        $linea .= "{$value->igv_nombre}|";//Tributo: Nombre de tributo por item
                        //$linea .= $this->tipoCodigoDeTributo($value['tipo_igv_codigo'])."|";//Tributo: Código de tipo de tributo por Item
                        $linea .= "{$value->igv_codigoInternacional}|";//Tributo: Código de tipo de tributo por Item
                        $linea .= "{$value->igv_codigoafectacion}|";//Tributo: Afectación al IGV por ítem
                        if($value->igv == "0.00"){
                            $linea .= "0.00|";//Tributo: Porcentaje de IGV
                        } else{
                            $linea .= "18.00|";//Tributo: Porcentaje de IGV
                        }
                        /*Tributo ISC (2000)*/
                        $linea .= "-|";//Tributo ISC: Códigos de tipos de tributos ISC
                        $linea .= "|";//Tributo ISC: Monto de ISC por ítem
                        $linea .= "|";//Tributo ISC: Base Imponible ISC por Item
                        $linea .= "|";//Tributo ISC: Nombre de tributo por item
                        $linea .= "|";//Tributo ISC: Código de tipo de tributo por Item
                        $linea .= "|";//Tributo ISC: Tipo de sistema ISC
                        $linea .= "|";//Tributo ISC: Porcentaje de ISC
                        /*Tributo Otro 9999*/
                        $linea .= "-|";//Tributo Otro: Códigos de tipos de tributos OTRO
                        $linea .= "|";//Tributo Otro: Monto de tributo OTRO por iItem
                        $linea .= "|";//Tributo Otro: Base Imponible de tributo OTRO por Item
                        $linea .= "|";//Tributo Otro:  Nombre de tributo OTRO por item
                        $linea .= "|";//Tributo Otro: Código de tipo de tributo OTRO por Item
                        $linea .= "|";//Tributo Otro: Porcentaje de tributo OTRO por Item
                        //Tributo ICBPER 7152

                        if ($value->total_icbper > 0){
                            $linea .= "7152|";//Tributo ICBPER: Códigos de tipos de tributos ICBPER
                            $linea .= "{$value->total_icbper}|";//Tributo ICBPER: Monto de tributo ICBPER por iItem
                            $linea .= "{$value->sale_productscantgas}|";//Tributo ICBPER: Cantidad de bolsas plásticas por Item
                            $linea .= "ICBPER|";//Tributo ICBPER:  Nombre de tributo ICBPER por item
                            $linea .= "OTH|";//Tributo ICBPER: Código de tipo de tributo ICBPER por Item
                            $linea .= number_format($impuesto_icbper , 2)."|";//Tributo ICBPER: Monto de tributo ICBPER por Unidad
                        } else {
                            $linea .= "-|";//Tributo ICBPER: Códigos de tipos de tributos ICBPER
                            $linea .= "|";//Tributo ICBPER: Monto de tributo ICBPER por iItem
                            $linea .= "|";//Tributo ICBPER: Cantidad de bolsas plásticas por Item
                            $linea .= "|";//Tributo ICBPER:  Nombre de tributo ICBPER por item
                            $linea .= "|";//Tributo ICBPER: Código de tipo de tributo ICBPER por Item
                            $linea .= "|";//Tributo ICBPER: Monto de tributo ICBPER por Unidad

                        }

                        if($value->igv_tipoigv == 1){
                            $linea .= ($value->precio_base * 1.18)."|";//Precio de venta unitario(base+igv)
                        } else{
                            $linea .= ($value->precio_base)."|";
                        }

                        $linea .= round($value->subtotal, 2)."|";//Valor de venta por Item
                        $linea .= "0.00|\r\n";//Valor REFERENCIAL unitario (gratuitos)*/
                        fwrite($f, $linea);
                    }
                    fclose($f);
                    /*DOCUMENTO TRIBUTO*/
                    $rut_tributo = $rutaArchivos . $comprobante->empresa_ruc . '-' . $comprobante->saleproductgas_type . '-' . $comprobante->saleproductgas_correlativo . '.TRI';
                    $f = fopen($rut_tributo, 'w');
                    //si tributo es igv
                    if($comprobante->saleproductgas_totalgravada > 0)
                    {
                        $linea = "1000|";//Identificador de tributo
                        $linea .= "IGV|";//Nombre de tributo
                        $linea .= "VAT|";//Código de tipo de tributo
                        $linea .= "{$comprobante->saleproductgas_totalgravada}|";//Base imponible
                        $linea .= "{$comprobante->saleproductgas_totaligv}|\r\n";//Monto de Tirbuto por ítem
                        fwrite($f, $linea);
                    }
                    //si tributo es exonerada
                    if($comprobante->saleproductgas_totalexonerada > 0)
                    {
                        $linea = "9997|";//Identificador de tributo
                        $linea .= "EXO|";//Nombre de tributo
                        $linea .= "VAT|";//Código de tipo de tributo
                        $linea .= "{$comprobante->saleproductgas_totalexonerada}|";//Base imponible
                        $linea .= "0.00|\r\n";//Monto de Tirbuto por ítem
                        fwrite($f, $linea);
                    }
                    //si tributo es inafecto
                    if($comprobante->saleproductgas_totalinafecta > 0)
                    {
                        $linea = "9998|";//Identificador de tributo
                        $linea .= "INA|";//Nombre de tributo
                        $linea .= "FRE|";//Código de tipo de tributo
                        $linea .= "{$comprobante->saleproductgas_totalinafecta}|";//Base imponible
                        $linea .= "0|\r\n";//Monto de Tirbuto por ítem
                        fwrite($f, $linea);
                    }
                    //si tributo es gratuita/exportacion
                    /*if($comprobante['total_gratuita'] > 0)
                    {
                        $linea = "9996|";//Identificador de tributo
                        $linea .= "GRA|";//Nombre de tributo
                        $linea .= "FRE|";//Código de tipo de tributo
                        $linea .= "{$comprobante['total_gratuita']}|";//Base imponible
                        $linea .= "0|\r\n";//Monto de Tirbuto por ítem
                        fwrite($f, $linea);
                    }*/
                    //tributo de bolsa
                    if($comprobante->saleproductgas_icbper > 0)
                    {
                        $linea = "7152|";//Identificador de tributo
                        $linea .= "ICBPER|";//Nombre de tributo
                        $linea .= "OTH|";//Código de tipo de tributo
                        $linea .= "{$comprobante->saleproductgas_total}|";//Base imponible
                        $linea .= "{$comprobante->saleproductgas_icbper}|\r\n";//Monto de Tirbuto por ítem
                        fwrite($f, $linea);
                    }

                    fclose($f);
                    /*DOCUMENTO LEYENDA*/
                    $importe_letra = $this->numLetra->num2letras(intval($comprobante->saleproductgas_total));
                    $arrayImporte = explode(".",$comprobante->saleproductgas_total);
                    $montoLetras = $importe_letra.' con ' .$arrayImporte[1].'/100 '.$comprobante->moneda;
                    $rut_leyenda = $rutaArchivos . $comprobante->empresa_ruc . '-' . $comprobante->saleproductgas_type . '-' . $comprobante->saleproductgas_correlativo . '.LEY';
                    $f = fopen($rut_leyenda, 'w');
                    $linea = "1000|";//Código de leyenda
                    $linea .= "{$montoLetras}|";//Descripción de leyenda
                    fwrite($f, $linea);
                    fclose($f);

                    $cambiar_enviosunat = $this->sell->envio_sunat($id_productoventa);
                    $return = 1;

                }

            } else{
            // COMUNICACION DE BAJA
                $this->sell_anulados = new SellGasAnulados();
                $fecha1 = date("Ymd"); //fecha que ira en el nombre del archivo
                $fechaanulado = date("Y-m-d"); //fecha que ira a la base de datos
                $resultado_fecha = $this->sell_anulados->seleccionar($fechaanulado);
                if ($resultado_fecha->numero > 0){
                    $numero_correlativo = $resultado_fecha->numero + 1;
                } else{
                    $numero_correlativo = 1;
                }
                $f = fopen($rutaArchivos . $comprobante->empresa_ruc . '-RA-' .  $fecha1 . '-' . $numero_correlativo . '.CBA', 'w');

                $linea = (new DateTime($comprobante_saleproduct->saleproductgas_date))->format('Y-m-d').'|';
                $linea .= (new DateTime())->format('Y-m-d')."|";
                $linea .= $comprobante->saleproductgas_type."|";
                $linea .= $comprobante->saleproductgas_correlativo.'|';
                $linea .= "anulacion|";
                fwrite($f, $linea);
                fclose($f);

                $this->sell_anulados->insertar_anulacion($fechaanulado, $numero_correlativo, $id_productoventa, $id_user);
                $this->sell->anular_sunat($id_productoventa , $fechaanulado);
                $return = 3;
            }
        }catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $return = 2;
        }
        echo $return;

    }

    function xmlSunat(){
        try{
            $id_comprobante = $_GET['id'] ?? 0;
            if($id_comprobante == 0){
                throw new Exception('ID Sin Declarar');
            }
            $comprobante = $this->sell->datos_comprobante($id_comprobante); //CONSULTA DONDE MUESTRA LOS DATOS DEL SALEPRODUCT
            $fichero = 'C:/FacturadorBufeo/sunat_archivos/sfs/FIRMA/' . $comprobante->empresa_ruc . '-' . $comprobante->saleproductgas_type . '-' . $comprobante->saleproductgas_correlativo . '.xml';
            //$fichero = 'C:/FacturadorBufeo/sunat_archivos/sfs/FIRMA/20601898447-01-FFF1-23.xml';
            $f = fopen($fichero, 'r');
            header('Content-type: text/xml; content="text/html; charset=UTF-8"');
            while (!feof($f)){
                $linea = fgets($f);
                echo $linea;
            }

            fclose($f);
            /*$fichero_ = json_decode(file_get_contents($fichero) , true);
            //$fichero_=simplexml_load_file($fichero);
            header('Content-type: text/xml; content="text/html; charset=UTF-8"');
            echo $fichero_;*/

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function cdrSunat(){
        try{
            $id_comprobante = $_GET['id'] ?? 0;
            if($id_comprobante == 0){
                throw new Exception('ID Sin Declarar');
            }
            $comprobante = $this->sell->datos_comprobante($id_comprobante); //CONSULTA DONDE MUESTRA LOS DATOS DEL SALEPRODUCT
            $fichero = 'C:/FacturadorBufeo/sunat_archivos/sfs/RPTA/' . 'R' . $comprobante->empresa_ruc . '-' . $comprobante->saleproductgas_type . '-' . $comprobante->saleproductgas_correlativo . '.zip';
            //$fichero = 'C:/FacturadorBufeo/sunat_archivos/sfs/FIRMA/20601898447-01-FFF1-23.xml';
            $f = fopen($fichero, 'r');
            header('Content-type: text/xml; content="text/html; charset=UTF-8"');
            while (!feof($f)){
                $linea = fgets($f);
                echo $linea;
            }

            fclose($f);
            /*$fichero_ = json_decode(file_get_contents($fichero) , true);
            //$fichero_=simplexml_load_file($fichero);
            header('Content-type: text/xml; content="text/html; charset=UTF-8"');
            echo $fichero_;*/

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    function enviar_facturador_json(){
        try {
            $id_user = $this->crypt->decrypt($_SESSION['id_user'],_PASS_);// llama la clase crypt de decrypt para decodificar los 2 parametros
            $id_productoventa = $_POST['id'];
            $estado_enviado = $_POST['envio_sunat'];
            $comprobante = $this->sell->datos_comprobante($id_productoventa); //CONSULTA DONDE SE REALACIONA TODO LO QUE SE USA EN SELLPRODUCTGAS
            $comprobante_saleproduct = $this->sell->listSale($id_productoventa);
            $saledetail_data = $this->sell->todos_saledetaill($id_productoventa);
            // RUTA para enviar documentos
            $ruta = "https://api.nubefact.com/api/v1/fb1c528e-a350-41f5-b493-8e4f500efedc";
            //TOKEN para enviar documentos
            $token = "6fbd41af33af454a8dcfae87dfcdb72e517a6fe16f0541a4a2a4e018c8e96384";


            //cambiamos el tipo de comprobante
            if($comprobante->saleproductgas_type == "01"){
                $tipo_de_comprobante = 1;
            } else if($comprobante->saleproductgas_type == "03"){
                $tipo_de_comprobante = 2;
            } elseif($comprobante->saleproductgas_type == "07"){
                $tipo_de_comprobante = 3;
            } else{
                $tipo_de_comprobante = 4;
            }
            //convertir en un array el correlativo
            $explode = explode("-", $comprobante->saleproductgas_correlativo);
            $serie = $explode[0];
            $numero_correlativo = $explode[1];
            //nombre o razon social
            if ($comprobante->client_razonsocial == ""){
                $cliente_denominacion = $comprobante->client_name;//apellidos y nombres o razon social
            } else{
                $cliente_denominacion = $comprobante->client_razonsocial;//apellidos y nombres o razon social
            }
            if ($estado_enviado == 0) {
                if ($tipo_de_comprobante < 4) {
                    $tipo_docuemnto = $comprobante->saleproductgas_type;
                    $tipo_nota_credito = "";
                    $tipo_nota_debito = "";
                    if($comprobante->saleproductgas_type == "07"){
                        $rsAdjunto = $this->sell->tipo_nota_credito($id_productoventa,$tipo_docuemnto);
                        $tipo_nota_credito = $rsAdjunto->tipo_nota_id;
                    } else{
                        $rsAdjunto = $this->sell->tipo_nota_debito($id_productoventa, $tipo_docuemnto);
                        $tipo_nota_debito = $rsAdjunto->tipo_nota_id;
                    }
                    $exp = explode("-", $rsAdjunto->correlativo_modificar);
                    $serie_modificar = $exp[0];
                    $numero_modificar = $exp[1];

                    foreach($saledetail_data as $sd){
                        $result = $this->sell->Buscarproduct_detalle($sd->id_productforsale);

                        if($sd->total_icbper > 0){
                            $array_items[] = array(
                                "unidad_de_medida"          => "$result->medida_codigo_unidad",
                                "codigo"                    => "$result->product_barcode",
                                "descripcion"               => "$result->product_name",
                                "cantidad"                  => "$sd->sale_productscantgas",
                                "valor_unitario"            => "$sd->precio_base",
                                "precio_unitario"           => "$sd->precio_producto",
                                "descuento"                 => "$sd->total_descuento",
                                "subtotal"                  => "$sd->subtotal",
                                "tipo_de_igv"               => "$sd->tipo_igv_json",
                                "igv"                       => "$sd->igv",
                                "impuesto_bolsas"           => "$sd->total_icbper",
                                "total"                     => "$sd->sale_productstotalpricegas",
                                "anticipo_regularizacion"   => "false",
                                "anticipo_documento_serie"  => "",
                                "anticipo_documento_numero" => ""
                            );
                        } else{
                            $array_items[] = array(
                                "unidad_de_medida"          => "$result->medida_codigo_unidad",
                                "codigo"                    => "$result->product_barcode",
                                "descripcion"               => "$result->product_name",
                                "cantidad"                  => "$sd->sale_productscantgas",
                                "valor_unitario"            => "$sd->precio_base",
                                "precio_unitario"           => "$sd->precio_producto",
                                "descuento"                 => "$sd->total_descuento",
                                "subtotal"                  => "$sd->subtotal",
                                "tipo_de_igv"               => "$sd->tipo_igv_json",
                                "igv"                       => "$sd->igv",
                                "total"                     => "$sd->sale_productstotalpricegas",
                                "anticipo_regularizacion"   => "false",
                                "anticipo_documento_serie"  => "",
                                "anticipo_documento_numero" => ""
                            );
                        }

                    }

                    $data = array(
                        "operacion"				=> "generar_comprobante",
                        "tipo_de_comprobante"               => "$tipo_de_comprobante",
                        "serie"                             => "$serie",
                        "numero"				            => "$numero_correlativo",
                        "sunat_transaction"			        => "1",
                        "cliente_tipo_de_documento"		    => "$comprobante->tipodocumento_codigo",
                        "cliente_numero_de_documento"	    => "$comprobante->client_number",
                        "cliente_denominacion"              => "$cliente_denominacion",
                        "cliente_direccion"                 => "$comprobante->client_address",
                        "cliente_email"                     => "$comprobante->client_correo",
                        "cliente_email_1"                   => "",
                        "cliente_email_2"                   => "",
                        "fecha_de_emision"                  => date('d-m-Y'),
                        "fecha_de_vencimiento"              => "",
                        "moneda"                            => "$comprobante->id_moneda",
                        "tipo_de_cambio"                    => "",
                        "porcentaje_de_igv"                 => "18.00",
                        "descuento_global"                  => "",
                        "total_descuento"                   => "",
                        "total_anticipo"                    => "",
                        "total_gravada"                     => "$comprobante->saleproductgas_totalgravada",
                        "total_inafecta"                    => "$comprobante->saleproductgas_totalinafecta",
                        "total_exonerada"                   => "$comprobante->saleproductgas_totalexonerada",
                        "total_igv"                         => "$comprobante->saleproductgas_totaligv",
                        "total_gratuita"                    => "$comprobante->saleproductgas_totalgratuita",
                        "total_otros_cargos"                => "",
                        "total"                             => "$comprobante->saleproductgas_total",
                        "percepcion_tipo"                   => "",
                        "percepcion_base_imponible"         => "",
                        "total_percepcion"                  => "",
                        "total_incluido_percepcion"         => "",
                        "total_impuesto_bolsa"              => "$comprobante->saleproductgas_icbper",
                        "detraccion"                        => "false",
                        "observaciones"                     => "",
                        "documento_que_se_modifica_tipo"    => "$rsAdjunto->tipo_documento_modificar",
                        "documento_que_se_modifica_serie"   => "$serie_modificar",
                        "documento_que_se_modifica_numero"  => "$numero_modificar",
                        "tipo_de_nota_de_credito"           => "$tipo_nota_credito",
                        "tipo_de_nota_de_debito"            => "$tipo_nota_debito",
                        "enviar_automaticamente_a_la_sunat" => "true",
                        "enviar_automaticamente_al_cliente" => "false",
                        "codigo_unico"                      => "",
                        "condiciones_de_pago"               => "",
                        "medio_de_pago"                     => "",
                        "placa_vehiculo"                    => "",
                        "orden_compra_servicio"             => "",
                        "tabla_personalizada_codigo"        => "",
                        "formato_de_pdf"                    => "",
                        "items" => $array_items
                    );


                    $data_json = json_encode($data);

                    //Invocamos el servicio de NUBEFACT
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $ruta);
                    curl_setopt(
                        $ch, CURLOPT_HTTPHEADER, array(
                            'Authorization: Token token="'.$token.'"',
                            'Content-Type: application/json',
                        )
                    );
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $respuesta  = curl_exec($ch);
                    curl_close($ch);

                    /*
             #########################################################
            #### PASO 4: LEER RESPUESTA DE NUBEFACT ####
            +++++++++++++++++++++++++++++++++++++++++++++++++++++++
            # Recibirás una respuesta de NUBEFACT inmediatamente lo cual se debe leer, verificando que no haya errores.
            # Debes guardar en la base de datos la respuesta que te devolveremos.
            # Escríbenos a soporte@nubefact.com o llámanos al teléfono: 01 468 3535 (opción 2) o celular (WhatsApp) 955 598762
            # Puedes imprimir el PDF que nosotros generamos como también generar tu propia representación impresa previa coordinación con nosotros.
            # La impresión del documento seguirá haciéndose desde tu sistema. Enviaremos el documento por email a tu cliente si así lo indicas en el archivo JSON o TXT.
            +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
             */

                    $leer_respuesta = json_decode($respuesta, true);
                    if (isset($leer_respuesta['errors'])) {
                        //Mostramos los errores si los hay
                        $resultado_error = $leer_respuesta['errors'];
                        $this->sell->envio_respuesta_error($resultado_error , $id_productoventa);
                        $result = 2;

                    } else {
                        $pdf_comprobante = $leer_respuesta['enlace'] . ".pdf";
                        $respuesta_array = explode("," , $leer_respuesta['sunat_description']);
                        $respuesta_sunat = $respuesta_array[1];

                        $this->sell->envio_sunat($id_productoventa, $pdf_comprobante, $respuesta_sunat);
                        $result = 1;

                        //Mostramos la respuesta
                        /*$linea="";
                        $linea .="<h2>RESPUESTA DE SUNAT</h2>";
                        $linea .="<table border=\"1\" style=\"border-collapse: collapse\">";
                        $linea .="<tbody>";
                        $linea .="<tr><th>tipo:</th><td>".$leer_respuesta['tipo_de_comprobante']."</td></tr>";
                        $linea .="<tr><th>serie:</th><td>".$leer_respuesta['serie']."</td></tr>";
                        $linea .="<tr><th>numero:</th><td>".$leer_respuesta['numero']."</td></tr>";
                        $linea .="<tr><th>enlace:</th><td>".$leer_respuesta['enlace']."</td></tr>";
                        $linea .="<tr><th>aceptada_por_sunat:</th><td>".$leer_respuesta['aceptada_por_sunat']."</td></tr>";
                        $linea .="<tr><th>sunat_description:</th><td>".$leer_respuesta['sunat_description']."</td></tr>";
                        $linea .="<tr><th>sunat_note:</th><td>".$leer_respuesta['sunat_note']."</td></tr>";
                        $linea .="<tr><th>sunat_responsecode:</th><td>".$leer_respuesta['sunat_responsecode']."</td></tr>";
                        $linea .="<tr><th>sunat_soap_error:</th><td>".$leer_respuesta['sunat_soap_error']."</td></tr>";
                        $linea .="<tr><th>pdf_zip_base64:</th><td>".$leer_respuesta['pdf_zip_base64']."</td></tr>";
                        $linea .="<tr><th>xml_zip_base64:</th><td>".$leer_respuesta['xml_zip_base64']."</td></tr>";
                        $linea .="<tr><th>cdr_zip_base64:</th><td>".$leer_respuesta['cdr_zip_base64']."</td></tr>";
                        $linea .="<tr><th>codigo_hash:</th><td>".$leer_respuesta['cadena_para_codigo_qr']."</td></tr>";
                        $linea .="<tr><th>codigo_hash:</th><td>".$leer_respuesta['codigo_hash']."</td></tr>";
                        $linea .="</tbody>";
                        $linea .="</table>";
                        ?>

                        <?php
                        $this->sell->envio_sunat($id_productoventa);*/
                    }

                } else{
                    $result = 2;
                }

            } else{
                // COMUNICACION DE BAJA
                $this->sell_anulados = new SellGasAnulados();
                $fecha1 = date("Ymd"); //fecha que ira en el nombre del archivo
                $fechaanulado = date("Y-m-d"); //fecha que ira a la base de datos
                $numero = $this->sell_anulados->seleccionarnumero();
                if ($numero->numero > 0){
                    $numero_correlativo_anulado = $numero->numero + 1;
                } else{
                    $numero_correlativo_anulado = 1;
                }
                $codigo_unico = $fecha1 . "-" . $numero_correlativo_anulado;

                $data_array = array("operacion"             => "generar_anulacion",
	                                "tipo_de_comprobante"   => $tipo_de_comprobante,
	                                "serie"                 => $serie,
	                                "numero"                => $numero_correlativo,
                                    "motivo"                => "ERROR DEL SISTEMA",
                                    "codigo_unico"          => $codigo_unico
                );

                $data_json = json_encode($data_array);

                //Invocamos el servicio de NUBEFACT
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $ruta);
                curl_setopt(
                    $ch, CURLOPT_HTTPHEADER, array(
                        'Authorization: Token token="'.$token.'"',
                        'Content-Type: application/json',
                    )
                );
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $respuesta  = curl_exec($ch);
                curl_close($ch);

                /*
         #########################################################
        #### PASO 4: LEER RESPUESTA DE NUBEFACT ####
        +++++++++++++++++++++++++++++++++++++++++++++++++++++++
        # Recibirás una respuesta de NUBEFACT inmediatamente lo cual se debe leer, verificando que no haya errores.
        # Debes guardar en la base de datos la respuesta que te devolveremos.
        # Escríbenos a soporte@nubefact.com o llámanos al teléfono: 01 468 3535 (opción 2) o celular (WhatsApp) 955 598762
        # Puedes imprimir el PDF que nosotros generamos como también generar tu propia representación impresa previa coordinación con nosotros.
        # La impresión del documento seguirá haciéndose desde tu sistema. Enviaremos el documento por email a tu cliente si así lo indicas en el archivo JSON o TXT.
        +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
         */

                $leer_respuesta = json_decode($respuesta, true);
                if (isset($leer_respuesta['errors'])) {
                    //Mostramos los errores si los hay
                    $resultado_error = $leer_respuesta['errors'];
                    $this->sell->envio_respuesta_error($resultado_error , $id_productoventa);
                    $result = 2;

                } else {
                    $pdf_comprobante = $leer_respuesta['enlace'] . ".pdf";
                    //$respuesta_array = explode("," , $leer_respuesta['sunat_description']);
                    if($leer_respuesta['sunat_description'] != NULL){
                        $respuesta_sunat = $leer_respuesta['sunat_description'];
                        $this->sell->envio_sunat_anulacion($id_productoventa, $respuesta_sunat);
                    }
                    $ticket_sunat = $leer_respuesta['sunat_ticket_numero'];

                    $this->sell_anulados->insertar_anulacion($fechaanulado, $codigo_unico, $id_productoventa, $id_user, $ticket_sunat, $pdf_comprobante);
                    $this->sell->anular_sunat($id_productoventa , $fechaanulado);
                    $result = 3;

                }

            }
            echo $result;

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }

    public function sanear_string($string) {

        $string = trim(utf8_encode($string));
//        $string = str_replace(
//            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
//            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
//            $string
//        );
        $string = str_replace(
            array('à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string
        );

//        $string = str_replace(
//            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
//            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
//            $string
//        );
        $string = str_replace(
            array('è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'E', 'E', 'E', 'E'), $string
        );

//        $string = str_replace(
//            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
//            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
//            $string
//        );
        $string = str_replace(
            array('ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'I', 'I', 'I', 'I'), $string
        );

//        $string = str_replace(
//            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
//            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
//            $string
//        );
        $string = str_replace(
            array('ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'O', 'O', 'O', 'O'), $string
        );

//        $string = str_replace(
//            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
//            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
//            $string
//        );
        $string = str_replace(
            array('ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'U', 'U', 'U', 'U'), $string
        );

//        $string = str_replace(
//            array('ñ', 'Ñ', 'ç', 'Ç'),
//            array('n', 'N', 'c', 'C',),
//            $string
//        );
        $string = str_replace(
            array('ç', 'Ç'), array('c', 'C',), $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño
//        $string = str_replace(
//            array("\\", "¨", "º", "-", "~",
//                 "#", "@", "|", "!", "\"",
//                 "·", "$", "%", "&", "/",
//                 "(", ")", "?", "'", "¡",
//                 "¿", "[", "^", "`", "]",
//                 "+", "}", "{", "¨", "´",
//                 ">", "< ", ";", ",", ":",
//                 ".", " "),
//            '',
        $string = str_replace(
            array("\\", "¨", "º", "-", "~",
                "|", "!", "\"",
                "·", "&", "/",
                "(", ")", "'", "¡",
                "¿", "[", "^", "`", "]",
                "}", "{", "¨", "´"
            ), '', $string
        );
        $string = str_replace(
            array("\n"
            ), ' ', $string
        );
        return $string;
    }

    //vista de historial de comprobantes electronicos
    public function comprobantes_electronicos(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $sales = $this->sell->listSales();

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'sellGas/comprobantes_electronicos.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";

        }
    }

    public function consultar_comprobante(){
        try {

            // RUTA para enviar documentos
            $ruta = "https://api.nubefact.com/api/v1/fb1c528e-a350-41f5-b493-8e4f500efedc";
            //TOKEN para enviar documentos
            $token = "6fbd41af33af454a8dcfae87dfcdb72e517a6fe16f0541a4a2a4e018c8e96384";

            $estado_comprobante = $_POST['estado_comprobante'];
            $tipo_comprobante = $_POST['tipo_comprobante'];
            $serie = $_POST['serie'];
            $numero = $_POST['numero'];

            if($estado_comprobante == 0){
                $data_array = array("operacion" => "consultar_comprobante",
                    "tipo_de_comprobante" => $tipo_comprobante,
                    "serie" => $serie,
                    "numero" => $numero,
                );

                $data_json = json_encode($data_array);
            } else{
                $data_array = array("operacion" => "consultar_anulacion",
                    "tipo_de_comprobante" => $tipo_comprobante,
                    "serie" => $serie,
                    "numero" => $numero,
                );
                $data_json = json_encode($data_array);
            }


            //Invocamos el servicio de NUBEFACT
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $ruta);
            curl_setopt(
                $ch, CURLOPT_HTTPHEADER, array(
                    'Authorization: Token token="' . $token . '"',
                    'Content-Type: application/json',
                )
            );
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($ch);
            curl_close($ch);

            /*
     #########################################################
    #### PASO 4: LEER RESPUESTA DE NUBEFACT ####
    +++++++++++++++++++++++++++++++++++++++++++++++++++++++
    # Recibirás una respuesta de NUBEFACT inmediatamente lo cual se debe leer, verificando que no haya errores.
    # Debes guardar en la base de datos la respuesta que te devolveremos.
    # Escríbenos a soporte@nubefact.com o llámanos al teléfono: 01 468 3535 (opción 2) o celular (WhatsApp) 955 598762
    # Puedes imprimir el PDF que nosotros generamos como también generar tu propia representación impresa previa coordinación con nosotros.
    # La impresión del documento seguirá haciéndose desde tu sistema. Enviaremos el documento por email a tu cliente si así lo indicas en el archivo JSON o TXT.
    +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     */

            $leer_respuesta = json_decode($respuesta, true);
            if (isset($leer_respuesta['errors'])) {
                //Mostramos los errores si los hay
                $error = $leer_respuesta['errors'];
                $result = "<h5 style='color: red'>$error</h5>";

            } else {
                //Mostramos la respuesta
                if($leer_respuesta['enlace'] != ""){

                    $enlace_pdf = $leer_respuesta['enlace'] . ".pdf";
                    $enlace_cdr = $leer_respuesta['enlace'] . ".cdr";
                    $enlace_link = $leer_respuesta['enlace'];
                    $pdf = "<a type=\"button\" target='_blank' href=\"$enlace_pdf \" style=\"color: green\" ><i class=\"fa fa-file-pdf-o\"></i></a>";
                    $cdr = "<a type=\"button\" target='_blank' href=\"$enlace_cdr \" style=\"color: red\" >CDR</a>";
                    $link_consulta = "<a type=\"button\" target='_blank' href=\"$enlace_link \" style=\"color: blue\" >CONSULTA EN NUBEFACT.COM</a>";

                }
                $result = "<tr>
                    <td>".$leer_respuesta['tipo_de_comprobante']."</td>
                        <td>".$leer_respuesta['serie']."</td>
                        <td>".$leer_respuesta['numero']."</td>
                        <td>".$cdr."</td>
                        <td>".$pdf."</td>
                        <td>".$leer_respuesta['sunat_description']."</td>
                        <td>".$link_consulta."</td>
                       </tr>";

            }
            echo $result;
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
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
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
            if($saleproduct_type == "BOLETA"){
                $saleproduct_correlative = "BN° " . $correlative->correlative_b;
            } else {
                $saleproduct_correlative = "FN° " . $correlative->correlative_f;
            }
            $saleproduct_total = $_POST['saleproduct_total'];
            $saleproduct_date = date("Y-m-d H:i:s");

            $saleproduct_cancelled = 1;

            $savesale = $this->sell->insertSale($id_client, $id_user, $id_turn, $saleproductgas_direccion, $saleproductgas_telefono, $saleproduct_type, $saleproductgas_naturaleza, $saleproduct_correlative, $saleproduct_total, $saleproduct_date, $saleproduct_estado, $saleproduct_cancelled);
            $idsale = $savesale->id_saleproductgas;


            if($idsale != 2){ //despues de registrar la venta se sigue a registrar el detalle
                foreach ($_SESSION['productos'] as $p){
                    $subtotal = round($p[3] * $p[4], 2);
                    $id_saleproduct = $savesale->id_saleproductgas;
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
                $return = $savesale->id_saleproductgas;

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
        $id_productoventa = $_POST['id'];
        $estado_enviado = $_POST['envio_sunat'];
        //$cliente_data = $this->client->listAll();
        $comprobante_data = $this->sell->todoslosdatos_comprobante($id_productoventa); //CONSULTA DONDE SE REALACIONA TODO LO QUE SE USA EN SELLPRODUCTGAS

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
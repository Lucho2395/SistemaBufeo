<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 22/11/2018
 * Time: 18:07
 */

require 'app/models/Report.php';
require 'app/models/Turn.php';
require 'app/models/Active.php';
require 'app/models/Sell.php';
class ReportController{
    private $log;
    private $menu;
    private $crypt;
    private $turn;
    private $report;
    private $active;
    private $nav;
    private $sell;

    public function __construct()
    {
        $this->log = new Log();
        //$this->menu = new Menu();
        $this->crypt = new Crypt();
        $this->turn = new Turn();
        $this->report =  new Report();
        $this->active = new Active();
        $this->sell = new Sell();
    }

    public function day(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $turn = $this->active->getTurnactiveall();
            if($turn == false){
                require _VIEW_PATH_ . 'header.php';
                require _VIEW_PATH_ . 'navbar.php';
                require _VIEW_PATH_ . 'report/noactive.php';
                require _VIEW_PATH_ . 'footer.php';
            } else {
                $products = $this->turn->listP();
                require _VIEW_PATH_ . 'header.php';
                require _VIEW_PATH_ . 'navbar.php';
                require _VIEW_PATH_ . 'report/day.php';
                require _VIEW_PATH_ . 'footer.php';
            }
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function day_PDF(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $turn = $this->active->getTurnactiveall();
            if($turn == false){
                require _VIEW_PATH_ . 'header.php';
                require _VIEW_PATH_ . 'navbar.php';
                require _VIEW_PATH_ . 'report/noactive.php';
                require _VIEW_PATH_ . 'footer.php';
            } else {
                $products = $this->turn->listP();
                require _VIEW_PATH_ . 'report/day_PDF.php';
            }
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function all(){
        try{
            if(isset($_SESSION['turno'])){
                $turn = $this->active->getTurnactiveall_id($_SESSION['turno']);
            } else {
                $turn = $this->active->getTurnactiveall();
            }

            if($turn == false){
                if(isset($_SESSION['turno'])){
                    $fecha = $_SESSION['turno'];
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                } else {
                    $fecha = date("Y-m-d");
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                }

            } else {
                $fecha = $turn->turn_datestart;
                //$info_turns = $this->active->getAllTurns();
                $products = $this->turn->listP();
                $this->nav = new Navbar();
                $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                require _VIEW_PATH_ . 'header.php';
                require _VIEW_PATH_ . 'navbar.php';
                require _VIEW_PATH_ . 'report/all.php';
                require _VIEW_PATH_ . 'footer.php';
            }

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }
    public function all_PDF(){
        try{
            if(isset($_SESSION['turno'])){
                $turn = $this->active->getTurnactiveall_id($_SESSION['turno']);
            } else {
                $turn = $this->active->getTurnactiveall();
            }

            if($turn == false){
                if(isset($_SESSION['turno'])){
                    $fecha = $_SESSION['turno'];
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                } else {
                    $fecha = date("Y-m-d");
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                }

            } else {
                $fecha = $turn->turn_datestart;
                //$info_turns = $this->active->getAllTurns();
                $products = $this->turn->listP();
                $this->nav = new Navbar();
                $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                require _VIEW_PATH_ . 'report/all_PDF.php';
            }

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }
    public function inventory(){
        try{
            if(isset($_SESSION['turno'])){
                $turn = $this->active->getTurnactiveall_id($_SESSION['turno']);
            } else {
                $turn = $this->active->getTurnactiveall();
            }

            if($turn == false){
                if(isset($_SESSION['turno'])){
                    $fecha = $_SESSION['turno'];
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                } else {
                    $fecha = date("Y-m-d");
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                }

            } else {
                $fecha = $turn->turn_datestart;
                //$info_turns = $this->active->getAllTurns();
                $products = $this->turn->listP();
                $this->nav = new Navbar();
                $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                require _VIEW_PATH_ . 'header.php';
                require _VIEW_PATH_ . 'navbar.php';
                require _VIEW_PATH_ . 'report/inventory.php';
                require _VIEW_PATH_ . 'footer.php';
            }

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }
    public function inventary_PDF(){
        try{
            if(isset($_SESSION['turno'])){
                $turn = $this->active->getTurnactiveall_id($_SESSION['turno']);
            } else {
                $turn = $this->active->getTurnactiveall();
            }

            if($turn == false){
                if(isset($_SESSION['turno'])){
                    $fecha = $_SESSION['turno'];
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                } else {
                    $fecha = date("Y-m-d");
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                }

            } else {
                $fecha = $turn->turn_datestart;
                $products = $this->turn->listP();
                require _VIEW_PATH_ . 'report/inventory_PDF.php';
            }

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }
    public function kardex_por_producto_PDF(){
        try{
            if(isset($_SESSION['turno'])){
                $turn = $this->active->getTurnactiveall_id($_SESSION['turno']);
            } else {
                $turn = $this->active->getTurnactiveall();
            }

            if($turn == false){
                if(isset($_SESSION['turno'])){
                    $fecha = $_SESSION['turno'];
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                } else {
                    $fecha = date("Y-m-d");
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                }
            } else {
                $fecha_i = $_POST['fecha_i_f'];
                $fecha_f = $_POST['fecha_f_f'];
                $explode = explode("-",$fecha_f);
                $sum = $explode[2] + 1;
                $fecha_f = $explode[0]."-".$explode[1]."-".$sum;
                $producto = $_POST['id_producto_f'];
                $stock_added = $this->report->stockadded_dates($fecha_i,$fecha_f, $producto);
                $ventas = $this->report->products_selled_dates($fecha_i,$fecha_f,$producto);
                $salidas = $this->report->stockout_dates($fecha_i,$fecha_f,$producto);
                $total_added = 0;
                $total_selled = 0;
                $total_salidas = 0;
                require _VIEW_PATH_ . 'report/kardex_por_producto_PDF.php';
            }

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }
    public function income_expenses(){
        try{
            if(isset($_SESSION['turno'])){
                $turn = $this->active->getTurnactiveall_id($_SESSION['turno']);
            } else {
                $turn = $this->active->getTurnactiveall();
            }

            if($turn == false){
                if(isset($_SESSION['turno'])){
                    $fecha = $_SESSION['turno'];
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                } else {
                    $fecha = date("Y-m-d");
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                }
            } else {
                $fecha = $turn->turn_datestart;
                //$info_turns = $this->active->getAllTurns();
                $sales = $this->report->all_saleproduct($turn);
                $this->nav = new Navbar();
                $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                require _VIEW_PATH_ . 'header.php';
                require _VIEW_PATH_ . 'navbar.php';
                require _VIEW_PATH_ . 'report/income_expenses.php';
                require _VIEW_PATH_ . 'footer.php';
            }

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }
    public function income_expenses_PDF(){
        try{
            if(isset($_SESSION['turno'])){
                $turn = $this->active->getTurnactiveall_id($_SESSION['turno']);
            } else {
                $turn = $this->active->getTurnactiveall();
            }

            if($turn == false){
                if(isset($_SESSION['turno'])){
                    $fecha = $_SESSION['turno'];
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                } else {
                    $fecha = date("Y-m-d");
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                }

            } else {
                $fecha = $turn->turn_datestart;
                //$info_turns = $this->active->getAllTurns();
                $sales = $this->report->all_saleproduct($turn);
                require _VIEW_PATH_ . 'report/income_expenses_PDF.php';

            }

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }
    public function kardex_product(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $turn = $this->active->getTurnactiveall();
            date_default_timezone_set('America/Lima');
            $fecha = date('Y-m-d');
            if($turn == false){
                require _VIEW_PATH_ . 'header.php';
                require _VIEW_PATH_ . 'navbar.php';
                require _VIEW_PATH_ . 'report/noactive.php';
                require _VIEW_PATH_ . 'footer.php';
            } else {
                $products = $this->turn->listP();
                require _VIEW_PATH_ . 'header.php';
                require _VIEW_PATH_ . 'navbar.php';
                require _VIEW_PATH_ . 'report/kardex_product.php';
                require _VIEW_PATH_ . 'footer.php';
            }
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function guias(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $turn = $this->active->getTurnactiveall();
            date_default_timezone_set('America/Lima');
            $fecha = date('Y-m-d');
            if($turn == false){
                require _VIEW_PATH_ . 'header.php';
                require _VIEW_PATH_ . 'navbar.php';
                require _VIEW_PATH_ . 'report/noactive.php';
                require _VIEW_PATH_ . 'footer.php';
            } else {
                $guias_entrada = $this->sell->select_guias_entrada();
                $guias_salida = $this->sell->select_guias_salida();
                require _VIEW_PATH_ . 'header.php';
                require _VIEW_PATH_ . 'navbar.php';
                require _VIEW_PATH_ . 'report/guias.php';
                require _VIEW_PATH_ . 'footer.php';
            }
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function set_turn(){
        $_SESSION['turno'] = $_POST['fecha'];
        echo 1;
    }
    public function kardex_product_table(){
        $fecha_i = $_POST['fecha_i'];
        $fecha_f = $_POST['fecha_f']; //aaaa-mm-dd hay 3 filas aaaa[0], mm[1], dd[2]
        $explode = explode("-",$fecha_f); //explode divide un string en varios string, devuelve un array de string
        $sum = $explode[2] + 1;
        $fecha_f = $explode[0]."-".$explode[1]."-".$sum;
        $producto = $_POST['producto'];
        $list = "";
        $stock_added = $this->report->stockadded_dates($fecha_i,$fecha_f, $producto);
        $ventas = $this->report->products_selled_dates($fecha_i,$fecha_f,$producto);
        $salidas = $this->report->stockout_dates($fecha_i,$fecha_f,$producto);
        $total_added = 0;
        $total_selled = 0;
        $total_salidas = 0;
        foreach ($stock_added as $sa){
            $list.="<tr style='color: blue;'>
                <td>".$sa->stocklog_date."</td>
                <td>".$sa->stocklog_guide."</td>
                <td>".$sa->id_stocklog."</td>
                <td>".$sa->stocklog_added."</td>
                <td></td>
                <td></td>
            </tr>";
            $total_added = $total_added +$sa->stocklog_added;
        }foreach ($ventas as $p){
            $list.="<tr style='color: blue;'>
                <td>".$p->saleproduct_date."</td>
                <td>".$p->saleproduct_type."</td>
                <td>".$p->saleproduct_correlative."</td>
                <td></td>
                <td></td>
                <td>".$p->sale_productstotalselled."</td>
            </tr>";
            $total_selled = $total_selled +$p->sale_productstotalselled;
        }
        foreach ($salidas as $s){
            $list.="<tr style='color: red;'>
                <td>".$s->stockout_date."</td>
                <td>".$s->stockout_guide."</td>
                <td>".$s->id_stockout."</td>
                <td></td>
                <td>".$s->stockout_out."</td>
                <td></td>
            </tr>";
            $total_salidas = $total_salidas +$s->stockout_out;
        }
        $list.= "<tr>
                    <td colspan='3' style='text-align: right'>Total:</td>
                    <td style='color: blue;'><b>". $total_added ."</b></td>
                    <td style='color: red;'><b>". $total_salidas ."</b></td>
                    <td style='color: blue;'><b>". $total_selled ."</b></td>
                </tr>";
        echo $list;
    }
    public function print_sale(){
        try{
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $sale = $this->sell->listSale($id);
            $productssale = $this->sell->listSaledetail($id);
            require _VIEW_PATH_ . 'report/print.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }
    public function guias_pdf(){
        try{
            if(isset($_SESSION['turno'])){
                $turn = $this->active->getTurnactiveall_id($_SESSION['turno']);
            } else {
                $turn = $this->active->getTurnactiveall();
            }
            if($turn == false){
                if(isset($_SESSION['turno'])){
                    $fecha = $_SESSION['turno'];
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                } else {
                    $fecha = date("Y-m-d");
                    $this->nav = new Navbar();
                    $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
                    require _VIEW_PATH_ . 'header.php';
                    require _VIEW_PATH_ . 'navbar.php';
                    require _VIEW_PATH_ . 'report/noturn.php';
                    require _VIEW_PATH_ . 'footer.php';
                }

            } else {
                $id = $_GET['id'];
                $criterio = $_GET['criterio'];
                if($criterio=="entrada"){
                    $guia = $this->sell->stocklog_detail($id);
                }elseif($criterio=="salida"){
                    $guia = $this->sell->stockout_detail($id);
                }
                require _VIEW_PATH_ . 'report/guias_pdf.php';

            }

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }

    }
}
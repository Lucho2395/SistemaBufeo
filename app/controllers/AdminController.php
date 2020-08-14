<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 17/10/2018
 * Time: 10:24
 */
require 'app/models/Admin.php';
require 'app/models/Active.php';
require 'app/models/Report.php';
require 'app/models/Turn.php';
class AdminController{
    private $crypt;
    private $menu;
    private $admin;
    private $active;
    private $report;
    private $nav;
    private $log;
    private $turn;
    public function __construct()
    {
        $this->crypt = new Crypt();
        //$this->menu = new Menu();
        $this->admin = new Admin();
        $this->active = new Active();
        $this->report = new Report();
        $this->log = new Log();
        $this->turn = new Turn();
    }

    public function index(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $users = $this->admin->count_users();
            $turn = $this->active->getTurnactiveall();

            //Saber Ganancia Neta en Productos
            $total_products = $this->report->total_products($turn);

            //$total_rent = $this->report->total_rent($turn);
            //$total_debt = $this->report->total_debt($turn);
            //$total_debtrent = $this->report->total_debtrent($turn);

            //Saber Egresos Totales
            $all_expense = $this->report->all_expense_number($turn);
            
            $open = $this->turn->getOpen($turn);

            //Monto de Apertura de Caja
            $mountopen = $this->turn->cashopenBox($turn->id_turn) ?? 0;

            //$final_report = $total_products + $total_rent + $total_debt + $total_debtrent - $all_expense;
            $final_report = $total_products - $all_expense;

            $open_status = $mountopen + $final_report;

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'admin/index.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    //Funcion Para Apertura de Caja
    public function openBox(){
        try{
            $turn = $this->active->getTurnactiveall();
            $cash = $_POST['turn_inicialcash'];
            $result = $this->turn->openBox($turn->id_turn, $cash);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }
}
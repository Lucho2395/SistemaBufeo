<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 25/11/2018
 * Time: 1:37
 */

require 'app/models/Expense.php';
require 'app/models/Active.php';

require 'app/models/Turn.php';
require 'app/models/Report.php';

class ExpenseController{
    private $crypt;
    private $nav;
    private $log;
    private $expense;
    private $active;

    private $turn;
    private $report;
    public function __construct()
    {
        $this->crypt = new Crypt();
        //$this->menu = new Menu();
        $this->log = new Log();
        $this->expense = new Expense();
        $this->active =  new Active();

        $this->turn =  new Turn();
        $this->report =  new Report();
    }

    //Vistas
    public function all(){

        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $expenses = $this->expense->list();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'expense/all.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function add(){

        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'expense/add.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function edit(){

        try{
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['role'],_PASS_));
            $expense = $this->expense->listExpense($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'expense/edit.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    //Funciones
    public function save(){
        try{
            $turn = $this->active->getTurnactiveall();
            $total_products = $this->report->total_products($turn);
            $all_expense = $this->report->all_expense_number($turn);
            $mountopen = $this->turn->cashopenBox($turn->id_turn) ?? 0;

            $final_report = $total_products - $all_expense;

            //Monto para hacer calculos
            $open_status = $mountopen + $final_report;
            $model = new Expense();
            if(isset($_POST['id_expense'])){
                $expense = $_POST['expense_mont'];
                $model->id_expense = $_POST['id_expense'];
                $model->expense_mont= $expense;
                $model->expense_description = $_POST['expense_description'];
                if($expense > $open_status){
                    $result = 3;
                } else {
                    $result = $this->expense->save($model);
                }
            } else {
                $expense = $_POST['expense_mont'];
                $model->id_turn = $this->active->getTurnactive();
                $model->expense_mont= $_POST['expense_mont'];
                $model->expense_description = $_POST['expense_description'];
                if($expense > $open_status){
                    $result = 3;
                } else {
                    $result = $this->expense->save($model);
                }
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), 'ExpenseController|save');
            $result = 2;
        }

        echo $result;
    }

    //Borrar
    public function delete(){
        try{
            $id = $_POST['id'];
            $result = $this->expense->delete($id);

        } catch (Exception $e){
                $this->log->insert($e->getMessage(), 'ExpenseController|delete');
            $result = 2;
        }

        echo $result;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 24/11/2018
 * Time: 18:28
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--Filtro Turnos-->
    <section class="content-header">
        <h1>Reporte <small>Reporte de Ingresos y Egresos del Turno</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Reporte</a></li>
            <li class="active">Reporte del Dia</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="background-color: white;box-shadow: 2px 2px 2px #888888;border-radius: 5px; padding: 10px; margin: 10px; min-height: 500px">
        <!-- /.row -->
        <div class="row">
            <div class="col-md-3">
                <label for="turno">Seleccionar Turno A Filtrar:</label>
                <input type="date" class="form-control" id="turno" onchange="sendturn()" value="<?php echo $fecha;?>">
            </div>
        </div>
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-12">
                <center><h3>Reporte de Ingresos y Egresos</h3></center>
                <center><h4><i class="fa fa-calendar"></i> Fecha: <?php echo $fecha;?></h4></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <center><h4>Ingresos</h4></center>
                <table class="table table-bordered table-hover" style="border-color: black">
                    <thead>
                    <tr style="background-color: #ebebeb">
                        <th>Fecha</th>
                        <th>Documento</th>
                        <th>Número</th>
                        <th>Nombre</th>
                        <th>Monto</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    //Calculo de Todo lo que es productos
                    $ingresos_productos = 0;
                    foreach ($sales as $p){
                        ?>
                        <tr>
                            <td><?php echo $p->saleproduct_date;?></td>
                            <td><?php echo $p->saleproduct_type;?></td>
                            <td><?php echo $p->saleproduct_correlative;?></td>
                            <td><?php echo $p->client_name;?></td>
                            <td>S/. <?php echo $p->saleproduct_total;?></td>
                        </tr>
                        <?php
                        $ingresos_productos = $ingresos_productos +$p->saleproduct_total;
                    }
                    //Fin de Calculo Todo Lo Que Es Productos
                    ?>
                    <tr><td colspan="4" style="text-align: right">Total Ingresos Ventas Productos:</td><td style="background-color: #f9f17f"><b> S/. <?php echo $ingresos_productos ?? 0;?></b></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" style="display: none;">
            <div class="col-lg-12">
                <center><h2>Reporte General Alquileres</h2></center>
                <?php
                $total_rent = $this->report->total_rent($turn);
                ?>
                <table  class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Descripcion:</th>
                        <th>Ganancia Total Alquileres</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Monto Total</td>
                        <td><bold>S/. <?php echo $total_rent ?? 0;?></bold></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" style="display: none;">
            <div class="col-lg-12">
                <center><h2>Reporte General Pago Deudas</h2></center>
                <?php
                $total_debt = $this->report->total_debt($turn);
                ?>
                <table  class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Descripcion:</th>
                        <th>Ganancia Total Pago Deudas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Monto Total</td>
                        <td><bold>S/. <?php echo $total_debt ?? 0;?></bold></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" style="display: none;">
            <div class="col-lg-12">
                <center><h2>Reporte General Pago Deudas de Alquiler</h2></center>
                <?php
                $total_debtrent = $this->report->total_debtrent($turn);
                ?>
                <table  class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Descripcion:</th>
                        <th>Ganancia Total Alquileres</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Monto Total</td>
                        <td><bold>S/. <?php echo $total_debtrent ?? 0;?></bold></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-5">
                <center><h4>Egresos</h4></center>
                <?php
                $expense = $this->report->all_expense($turn);
                $egresos = 0;
                ?>
                <table class="table table-bordered table-hover" style="border-color: black">
                    <thead>
                    <tr style="background-color: #ebebeb">
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Importe</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($expense as $ex) {
                        ?>
                        <tr>
                            <td><?php echo $fecha;?></td>
                            <td><?php echo $ex->expense_description;?></td>
                            <td>S/. <?php echo $ex->expense_mont;?></td>
                        </tr>
                        <?php
                        $egresos = $egresos + $ex->expense_mont;
                    }?>
                    <tr><td colspan="2" style="text-align: right">Total Egresos:</td><td style="background-color: #f9f17f"><b> S/. <?php echo $egresos ?? 0;?></b></td></tr>
                    </tbody>
                </table>
            </div>

        <br>
        <?php
        $balance_final = $ingresos_productos + $total_rent + $total_debt + $total_debtrent - $egresos;
        ?>
            <div class="col-lg-5">
                <table class="table">
                    <tbody>
                    <tr>
                        <td style="background-color: #ebebeb; font-weight: bold">TOTAL INGRESOS VENTAS:</td>
                        <td>S/. <?php echo $ingresos_productos ?? 0;?></td>
                    </tr>
                    <tr>
                        <td style="background-color: #ebebeb; font-weight: bold">TOTAL EGRESOS:</td>
                        <td>S/. <?php echo $egresos ?? 0;?></td>
                    </tr>
                    <tr style="border-top: 2px solid green;">
                        <td style="background-color: #ebebeb; font-weight: bold">SALDO TOTAL DEL DIA:</td>
                        <td>S/. <?php echo $balance_final ?? 0;?></td>
                    </tr>
                    <tr>
                        <td style="background-color: #ebebeb; font-weight: bold">MONTO DE APERTURA DE CAJA:</td>
                        <td>S/. <?php echo $turn->turn_inicialcash ?? 0;?></td>
                    </tr>
                    <tr style="border-top: 3px solid red;">
                        <td style="background-color: #ebebeb; font-weight: bold">TOTAL EN CAJA:</td>
                        <td style="background-color: #f9f17f; font-weight: bold">S/. <?php echo $balance_final + $turn->turn_inicialcash;?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <center><a href="<?php echo _SERVER_;?>/Report/income_expenses_PDF" target="_blank" class="btn btn-primary">Imprimir Reporte</a></center>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<script>
    $(function () {
        $("#example2").DataTable();
    });
    function sendturn(){
        fecha = $('#turno').val();
        var cadena = "fecha=" + fecha;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Report/set_turn",
            data : cadena,
            success:function (r) {
                if(r==1){
                    location.reload();
                } else {
                    alertify.error('Error Al Mostrar Informacion');
                }
            }
        });
    }
</script>
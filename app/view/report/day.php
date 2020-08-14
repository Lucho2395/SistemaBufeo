<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 22/11/2018
 * Time: 18:15
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Reporte <small>Reporte General del Turno</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Reporte</a></li>
            <li class="active">Reporte del Dia</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="background-color: white;box-shadow: 2px 2px 2px #888888;border-radius: 5px; padding: 10px; margin: 10px; min-height: 500px">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-12">
                <center><h3>Reporte General Diarios</h3></center>
                <center><h4><i class="fa fa-calendar"></i> Fecha: <?php echo $turn->turn_datestart;?></h4></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover" style="border-color: black">
                    <thead>
                    <tr style="background-color: #ebebeb">
                        <th>Producto</th>
                        <th>Inventario Inicial</th>
                        <th>Agregado</th>
                        <th>Cantidad Vendida</th>
                        <th>Cantidad Salida</th>
                        <th>Cantidad Anulada</th>
                        <!--<td>Fiados</td>-->
                        <!--<td>Invitados</td>-->
                        <th>Total Cantidad Saliente</th>
                        <th>Stock Final Del Dia</th>
                        <th>Stock Sistema</th>
                        <th>Total Ganancias Producto</th>
                    </tr>
                    </thead>
                    <tbody>
                <?php

                //Calculo de Todo lo que es productos
                $ingresos_productos = 0;
                foreach ($products as $p){
                    $inventario_inicial = $this->report->initial_inventory($turn, $p->id_product);
                    $stock_added = $this->report->stockadded($turn, $p->id_product);
                    $stock_out = $this->report->stockout($turn, $p->id_product);
                    $products_selled = $this->report->products_selled($turn, $p->id_product);
                    $products_revoke = $this->report->products_revoke($turn, $p->id_product);
                    //$products_free = $this->report->products_free($turn, $p->id_product);
                    //$products_debt = $this->report->products_debt($turn, $p->id_product);
                    $total_products = $products_selled;
                    //Calcular Ganancia Por Producto
                    $total_per_product = $this->report->total_per_product($turn, $p->id_product);

                    $stock_final = $inventario_inicial + $stock_added - $total_products - $stock_out - $products_revoke;
                    $stock_now = $this->report->total_products_now($p->id_product);
                    $ingresos_productos = $ingresos_productos + $total_per_product;
                    ?>
                        <tr>
                            <th><?php echo $p->product_name;?></th>
                            <td><?php echo $inventario_inicial ?? 0;?></td>
                            <td><?php echo $stock_added ?? 0;?></td>
                            <td><?php echo $products_selled ?? 0;?></td>
                            <td><?php echo $stock_out ?? 0;?></td>
                            <td><?php echo $products_revoke ?? 0;?></td>
                            <!--<td><?php echo $products_debt ?? 0;?></td>-->
                            <!--<td><?php echo $products_free ?? 0;?></td>-->
                            <td><?php echo $total_products ?? 0;?></td>
                            <td><?php echo $stock_final ?? 0;?></td>
                            <td><?php echo $stock_now ?? 0;?></td>
                            <td>S/. <?php echo $total_per_product ?? 0;?></td>
                        </tr>
                    <?php
                }
                //Fin de Calculo Todo Lo Que Es Productos
                ?>
                    <tr><td colspan="9" style="text-align: right">Total Ingresos Ventas Productos:</td><td style="background-color: #f9f17f"><b> S/. <?php echo $ingresos_productos ?? 0;?></b></td></tr>
                    </tbody>
                </table>
            </div>
        </div><br><br>
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
            <div class="col-lg-6">
                <center><h3>Egresos Del Turno</h3></center>
                <?php
                $expense = $this->report->all_expense($turn);
                $egresos = 0;
                ?>
                <table class="table table-bordered table-hover" style="border-color: black">
                    <thead>
                    <tr style="background-color: #ebebeb">
                        <th>Descripcion Egreso</th>
                        <th>Monto</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($expense as $ex) {
                        ?>
                        <tr>
                            <td><?php echo $ex->expense_description;?></td>
                            <td>S/. <?php echo $ex->expense_mont;?></td>
                        </tr>
                        <?php
                        $egresos = $egresos + $ex->expense_mont;
                    }?>
                    <tr><td style="text-align: right;">Egresos Totales:</td><td style="background-color: #f9f17f"><b>S/. <?php echo $egresos ?? 0;?></b></td></tr>
                    </tbody>
                </table>
            </div>
            <?php
            $balance_final = $ingresos_productos + $total_rent + $total_debt + $total_debtrent - $egresos;
            ?>
            <div class="col-lg-6"><br><br>
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
        <br>
        <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-lg-3">
                <a class="btn btn-primary" target="_blank" href="<?php echo _SERVER_;?>Report/day_PDF/<?= $id; ?>"><i class="fa fa-print"></i> Imprimir</a>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<script>
    $(function () {
        $("#example2").DataTable();
    });
    function eliminar(id){
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Inventory/deleteProduct",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Producto Eliminado');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar');
                }
            }
        });
    }
</script>

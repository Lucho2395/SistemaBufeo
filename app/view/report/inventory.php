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
        <h1>Reporte <small>Inventario</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Reporte</a></li>
            <li class="active">Inventario</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="background-color: white;box-shadow: 2px 2px 2px #888888;border-radius: 5px; padding: 10px; margin: 10px; min-height: 500px">
        <!-- /.row -->
        <div class="row">
            <div class="col-md-3">
                <label for="turno">Seleccionar Fecha:</label>
                <input type="date" class="form-control" id="turno" onchange="sendturn()" value="<?php echo $fecha;?>">
            </div>
        </div>
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-12">
                <center><h3>Inventario</h3></center>
                <center><h4><i class="fa fa-calendar"></i> Fecha: <?php echo $fecha;?></h4></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover" style="border-color: black">
                    <thead>
                    <tr style="background-color: #ebebeb">
                        <th>Codigo</th>
                        <th>Producto</th>
                        <th>SALDO ANT</th>
                        <th>ENTRADA</th>
                        <th>SALIDA</th>
                        <th>VENDIDO</th>
                        <th>PRECIO UNIT</th>
                        <th>TOTAL S/. </th>
                        <th>SALDO</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    //Calculo de Todo lo que es productos
                    $ingresos_productos = 0;
                    foreach ($products as $p){
                        $inventario_inicial = $this->report->initial_inventory($turn, $p->id_product);
                        $stock_added = $this->report->stockadded($turn, $p->id_product);
                        $products_selled = $this->report->products_selled($turn, $p->id_product);
                        $stock_out = $this->report->stockout($turn, $p->id_product);
                        //Calcular Ganancia Por Producto
                        $total_per_product = $this->report->total_per_product($turn, $p->id_product);
                        $stock_final = $inventario_inicial + $stock_added - $products_selled - $stock_out;
                        $stock_now = $this->report->total_products_now($p->id_product);
                        $ingresos_productos = $ingresos_productos + $total_per_product;
                        ?>
                        <tr style="text-align: right; border-bottom: 2px solid #a3a6a5">
                            <th><?php echo $p->id_product;?></th>
                            <th><?php echo $p->product_name;?></th>
                            <td><?php echo $inventario_inicial ?? 0;?></td>
                            <?php
                            echo ($stock_added!=0) ? "<td style='color: #8b211e'>$stock_added</td>" : "<td></td>" ;
                            echo ($stock_out!=0) ? "<td style='color: #8b211e'>$stock_out</td>" : "<td></td>" ;
                            echo ($products_selled!=0) ? "<td  style=\"color: red;\">$products_selled</td><td style=\"color: green;\">$p->product_price</td><td style=\"color: blue;\">$total_per_product</td>" : "<td></td><td></td><td></td>" ;
                            ?>
                            <td><?php echo $stock_final ?? 0;?></td>
                        </tr>
                        <?php
                    }
                    //Fin de Calculo Todo Lo Que Es Productos
                    ?>
                    <tr style="text-align: right"><td colspan="7">Total Ingresos Ventas Productos:</td><td style="background-color: #f9f17f"><b> S/. <?php echo $ingresos_productos ?? 0;?></b></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <center><a  href="<?php echo _SERVER_;?>/Report/inventary_PDF" target="_blank" class="btn btn-primary">Imprimir Reporte</a></center>
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


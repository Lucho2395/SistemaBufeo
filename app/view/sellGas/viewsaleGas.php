<?php

?>

<div class="content-wrapper">
<!-- contenido de la cabezera -->
    <section class="content-header">
        <h1>
            <?php echo $_SESSION['controlador'];?>
            <small><?php echo $_SESSION['accion'];?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="<?php echo $_SESSION['icono'];?>"></i><?php echo $_SESSION['controlador'];?></a></li>
            <li class="active"><?php echo $_SESSION['accion'];?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="background-color: white;box-shadow: 10px 10px 5px #888888;border-radius: 30px; padding: 15px; margin: 50px 100px 0 100px; min-height: 500px">
        <!-- /.row -->
        <!-- Main row --><br>
        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-4">
                <p><i class="fa fa-calendar"></i> Fecha de Venta: <?php echo $sale->saleproductgas_date;?></p>
                <p><i class="fa fa-user"></i> Nombre Del Cliente: <?php echo $sale->client_name;?></p>
            </div>
            <div class="col-xs-3">
                <p style="color:red;">Código: <?php echo $sale->saleproductgas_correlativo;?></p>
                <p>RUC ó DNI: <?php echo $sale->client_number;?></p>
            </div>
            <div class="col-xs-4">
                <?php
                $id_turn = $this->active->getTurnactive();
                $idroleUser = $this->crypt->decrypt($_SESSION['role'],_PASS_);
                if($sale->saleproductgas_cancelled == 1){
                    ?>
                    <p style="color: green; float: right;"><i class="fa fa-check-circle"></i> Venta Realizada Correctamente</p>
                    <?php
                    if ($idroleUser == 4){
                        if($id_turn == $sale->id_turn){ //si la venta no es del dia actual no se genera la anulacion
                            ?>
                            <a type="button" class="btn btn-xs btn-danger" style="float: right" onclick="preguntarSiNoA(<?php echo $sale->id_saleproductgas;?>)"><i class="fa fa-times-circle"></i> Anular Venta</a>
                            <?php
                        }
                    } else{
                        ?>
                        <a type="button" class="btn btn-xs btn-danger" style="float: right" onclick="preguntarSiNoA(<?php echo $sale->id_saleproductgas;?>)"><i class="fa fa-times-circle"></i> Anular Venta</a>
                        <?php
                    }
                } else {
                    ?>
                    <p style="color: #ff0000; float: right;"><i class="fa fa-times-circle"></i> Esta Venta fue ANULADA</p>
                    <?php
                }
                ?>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-lg-10">
                <table class="table table-bordered table-hover" style="border-color: black">
                    <thead>
                    <tr style="background-color: #ebebeb">
                        <th>Cant</th>
                        <th>Descripción</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $totales = count($productssale);
                    $monto = 0;
                    if($totales == 0){
                        ?>
                        <center><h2>Aún no hay productos</h2></center>
                        <?php
                    } else {
                        foreach ($productssale as $p){
                            $subtotal = 0;
                            $subtotal = $p->sale_productstotalpricegas;
                            $monto = $monto + $subtotal;
                            ?>
                            <tr>
                                <!--<td><?php //echo $p->id_productforsale;?></td>-->
                                <td><?php echo $p->sale_productstotalselledgas;?></td>
                                <td><?php echo $p->sale_productnamegas;?></td>
                                <td>S/. <?php echo $p->sale_pricegas;?></td>
                                <td>S/. <?php echo $subtotal;?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" style="text-align:right;">PRECIO TOTAL</td>
                        <?php $num_ = explode(".",$monto);
                        $dec = round($num_[1],2);
                        if(strlen($dec)==1){
                            $dec = $dec ."0";
                            ($dec==0) ? $monto = $monto.".00": $monto = $monto."0";
                        } ?>
                        <td style="background-color: #f9f17f; font-weight: bold">S/. <?php echo $monto;?></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-lg-3">
                <a class="btn btn-primary" target="_blank" href="<?php echo _SERVER_;?>print.php"><i class="fa fa-print"></i> Imprimir</a>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>sellGas.js"></script>


</div>

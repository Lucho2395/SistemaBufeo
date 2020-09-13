<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 20/04/2019
 * Time: 18:25
 */
?>
<div class="row">
    <div class="col-xs-9"></div>
    <div class="col-xs-3">
        <a class="btn btn-primary btn-xs" type="button"  data-toggle="modal" data-target="#largeModal"><i class="fa fa-search"></i> Buscar Producto</a>
    </div><br><br>
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <table class="table table-bordered table-hover" style="border-color: black">
            <thead>
            <tr style="background-color: #ebebeb">
                <th>COD.</th>
                <th>Descripción</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Accion</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $totales = count($_SESSION['productos']);
            $monto = 0;
            $igv = 0;
            $gravada = 0;
            $inafecta = 0;
            $exonerada = 0;
            $ICBPER = 0;
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

            if($totales != 0){
                foreach ($_SESSION['productos'] as $p){
                    if ($p[5] == 1){
                        $subtotal = round($p[4] * $p[3],2);

                        $inafecta = $inafecta;
                        $exonerada = $exonerada;
                        $gravada = $gravada + round($subtotal / 1.18, 2);
                        $gravadaalmacenada = round($subtotal / 1.18, 2);
                        $igv = $igv +  round($subtotal - $gravadaalmacenada, 2);
                        if ($p[0] == "11" || $p[0] == "12" ){
                            $ICBPER = $ICBPER + round($p[4] * $impuesto_icbper , 2);
                        }
                        $monto = round($monto + $subtotal + $ICBPER , 2);
                        ?>
                        <tr> <!--De esta tapla se jala los valores por la posicion de los arrays-->
                            <td><?php echo $p[0];?></td>
                            <td><?php echo $p[1];?></td>
                            <td>s/. <?php echo $p[3];?></td>
                            <td><?php echo $p[4];?></td>
                            <td>s/. <?php echo $subtotal;?></td>
                            <td><a type="button" class="btn btn-xs btn-warning btne" onclick="quitarProducto(<?php echo $p[0];?>)" ><i class="fa fa-times"></i> Quitar</a></td>
                        </tr>
                        <?php
                    } else if($p[5] == 3){
                        $subtotal = round($p[4] * $p[3],2);

                        $inafecta = $inafecta;
                        $exonerada = round($exonerada + $subtotal , 2);
                        $gravada = round($gravada, 2);
                        $igv =round($igv, 2);
                        if ($p[0] == "11" || $p[0] == "12" ){
                            $ICBPER = $ICBPER + round($p[4] * $impuesto_icbper , 2);
                        }
                        $monto = round($monto + $subtotal + $ICBPER , 2);
                        ?>
                        <tr> <!--De esta tapla se jala los valores por la posicion de los arrays-->
                            <td><?php echo $p[0];?></td>
                            <td><?php echo $p[1];?></td>
                            <td>s/. <?php echo $p[3];?></td>
                            <td><?php echo $p[4];?></td>
                            <td>s/. <?php echo $subtotal;?></td>
                            <td><a type="button" class="btn btn-xs btn-warning btne" onclick="quitarProducto(<?php echo $p[0];?>)" ><i class="fa fa-times"></i> Quitar</a></td>
                        </tr>
                        <?php
                    } else{
                        $subtotal = round($p[4] * $p[3],2);

                        $inafecta = round($inafecta + $subtotal , 2);
                        $exonerada = $exonerada;
                        $gravada = round($gravada, 2);
                        $igv =round($igv, 2);
                        if ($p[0] == "11" || $p[0] == "12" ){
                            $ICBPER = $ICBPER + round($p[4] * $impuesto_icbper , 2);
                        }
                        $monto = round($monto + $subtotal + $ICBPER , 2);
                        ?>
                        <tr> <!--De esta tapla se jala los valores por la posicion de los arrays-->
                            <td><?php echo $p[0];?></td>
                            <td><?php echo $p[1];?></td>
                            <td>s/. <?php echo $p[3];?></td>
                            <td><?php echo $p[4];?></td>
                            <td>s/. <?php echo $subtotal;?></td>
                            <td><a type="button" class="btn btn-xs btn-warning btne" onclick="quitarProducto(<?php echo $p[0];?>)" ><i class="fa fa-times"></i> Quitar</a></td>
                        </tr>
                        <?php
                    }

                }
            }
            ?>
            </tbody>
        </table>
        <div class="row">

            <div id="espacio" class = "col-lg-8">
            </div>

            <div class="col-lg-4">
                <h5>OP. EXONERADA: s/. <?php echo number_format($exonerada ,2);?></h5>
                <input type="hidden" value="<?php echo $exonerada;?>" id="exonerada">
                <h5>OP. INAFECTA: s/. <?php echo number_format($inafecta , 2);?></h5>
                <input type="hidden" value="<?php echo $inafecta;?>" id="inafecta">
                <h5>OP. GRAVADA: s/. <?php echo number_format($gravada , 2);?></h5>
                <input type="hidden" value="<?php echo $gravada;?>" id="gravada">
                <h5>IGV: s/. <?php echo number_format($igv , 2);?></h5>
                <input type="hidden" value="<?php echo $igv;?>" id="igv">
                <?php
                if ($ICBPER > 0){ ?>
                    <h5>ICBPER: s/. <?php echo number_format($ICBPER , 2);?></h5>
                <?php }
                ?>
                <input type="hidden" value="<?php echo $ICBPER;?>" id="icbper">
                <h4>PRECIO TOTAL: s/. <?php echo number_format($monto , 2);?></h4>
                <input type="hidden" value="<?php echo $monto;?>" id="montototal">
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
</script>





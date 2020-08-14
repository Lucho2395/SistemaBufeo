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
            if($totales == 0){

            } else {
                foreach ($_SESSION['productos'] as $p){
                    $subtotal = round($p[4] * $p[3],2);
                    $monto = $monto + $subtotal;
                    ?>
                    <tr>
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
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php if($monto!=0){
   ?>
    <div class="row">
        <div class="col-lg-7"></div>
        <div class="col-lg-4">
            <h4>PRECIO TOTAL: s/. <?php echo $monto;?></h4>
            <a type="button" class="btn btn-danger" onclick="preguntarSiNo(<?php echo $monto;?>)" ><i class="fa fa-money"></i> Generar Venta</a>
        </div>
    </div>

    <?php
} ?>


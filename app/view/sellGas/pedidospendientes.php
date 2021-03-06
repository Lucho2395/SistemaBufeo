<?php
/**
 * Created by PhpStorm
 * User: Lucho
 * Date: 12/08/2020
 * Time: 20:08
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-10">
                <center><h2>Lista de Pedidos Pendientes</h2></center>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10"></div>
            <div class="col-lg-2">
                <a class="btn btn-primary" target="_blank" href="<?php echo _SERVER_;?>SellGas/historypedidos_PDF/<?= $id; ?>"><i class="fa fa-print"></i> Imprimir</a>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <table id="example2" class="table table-bordered table-hover">
                    <thead class="text-capitalize">
                    <tr>
                        <th>N°</th>
                        <th>Fecha</th>
                        <th>Usuario Vendedor</th>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Total de Venta</th>
                        <th>Estado de Pedido</th>
                        <!--<th>Estado de Venta</th>-->
                        <th>ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody id="tabla_lista_pedidos">
                    <?php
                    $totalpedidos = count($pedido);
                    foreach ($pedido as $m){
                        $estadopedido = "<a class=\"btn btn-xs btn-outline-danger\" style='color: #00ca6d'>PENDIENTE</a>";

                        $show = "<a class=\"btn btn-xs btn-outline-danger\">ANULADO</a>";
                        if($m->saleproductgas_cancelled == 1){
                            $show = "<a class=\"btn btn-xs btn-outline-success\">VENDIDO</a>";
                        }
                        ?>
                        <tr>
                            <td><?php echo $totalpedidos;?></td>
                            <td><?php echo $m->saleproductgas_date;?></td>
                            <td><?php echo $m->client_name;?></td>
                            <td><?php echo $m->user_nickname;?></td>
                            <td><?php echo $m->saleproductgas_direccion;?></td>
                            <td><?php echo $m->saleproductgas_telefono;?></td>
                            <td>s/. <?php echo $m->saleproductgas_total;?></td>
                            <td><?php echo $estadopedido; ?></td>
                            <!--<td><?php echo $show;?></td>-->
                            <td><a type="button" class="btn btn-xs btn-warning btne" onclick="preguntarSiNoEntregar(<?php echo $m->id_saleproductgas;?>)" >ENTREGADO</a>
                                <?php
                                $id_turn = $this->active->getTurnactive();
                                $idroleUser = $this->crypt->decrypt($_SESSION['role'],_PASS_);
                                if ($idroleUser == 4){
                                    if($id_turn == $m->id_turn){ //si la venta no es del dia actual no se genera la anulacion
                                    ?>
                                        <a type="button" class="btn btn-xs btn-danger" onclick="preguntarSiNoCancelar(<?php echo $m->id_saleproductgas;?>)">CANCELAR</a>
                                <?php
                                    }
                                }else{
                                ?>
                                    <a type="button" class="btn btn-xs btn-danger" onclick="preguntarSiNoCancelar(<?php echo $m->id_saleproductgas;?>)">CANCELAR</a>
                                <?php
                                }
                                ?>
                                <a type="button" class="btn btn-xs btn-primary btne" href="<?php echo _SERVER_ . 'SellGas/viewsale/' . $m->id_saleproductgas;?>" target="_blank" >Ver Detalle</a>
                            </td>
                        </tr>
                        <?php
                        $totalpedidos--;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>sellGas.js"></script>

<script type="text/javascript">



</script>


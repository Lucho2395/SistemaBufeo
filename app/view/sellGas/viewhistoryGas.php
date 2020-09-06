<?php
/**
 * Created by PhpStorm
 * User: Luis
 * Date: 09/08/2020
 * Time: 12:26
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
            <div class="col-xs-12 col-lg-9">
                <center><h2>Lista de Venta de Gas Registradas</h2></center>
            </div>
            <div class="col-xs-12 col-lg-3">
                <center><a class="btn btn-block btn-info btne" href="http://localhost:9000/#" target="_blank">FACTURADOR SUNAT</a></center> <!--target para abrir una pestaña-->
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <table id="example2" class="table table-bordered table-hover">
                    <thead class="text-capitalize">
                    <tr>
                        <th>N°</th>
                        <th>Fecha</th>
                        <th>COD</th>
                        <th>Usuario Vendedor</th>
                        <th>Cliente</th>
                        <th>DNI ó RUC</th>
                        <th>Total de Venta</th>
                        <th>Naturaleza</th>
                        <th>Estado Venta</th>
                        <th>Detalles</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $totalsales = count($sales);
                    foreach ($sales as $m){
                        $show = "<a class=\"btn btn-xs btn-outline-danger\">ANULADO</a>";
                        if($m->saleproductgas_cancelled == 1){
                            $show = "<a class=\"btn btn-xs btn-outline-success\">VENDIDO</a>";
                        }
                        ?>
                        <tr>
                            <td><?php echo $totalsales;?></td>
                            <td><?php echo $m->saleproductgas_date;?></td>
                            <td><?php echo $m->saleproductgas_correlativo;?></td>
                            <td><?php echo $m->user_nickname;?></td>
                            <td><?php echo $m->client_name;?></td>
                            <td><?php echo $m->client_number;?></td>
                            <td>s/. <?php echo $m->saleproductgas_total;?></td>
                            <td><?php echo $m->saleproductgas_naturaleza;?></td>
                            <td><?php echo $show;?></td>
                            <td><a type="button" class="btn btn-xs btn-primary btne" href="<?php echo _SERVER_ . 'SellGas/viewsale/' . $m->id_saleproductgas;?>" target="_blank" >Ver Detalle</a>
                                <?php
                                if ($m->enviado_sunat == 0){
                                ?>
                                    <a type="button" class="btn btn-xs btn-success btne" onclick="preguntarSiNoEnviarSunat(<?php echo $m->id_saleproductgas;?>,<?php echo $m->enviado_sunat;?>)" target="_blank" >Enviar a Facturador</a></td>
                                <?php
                                } else {
                                    ?>
                                    <a type="button" class="btn btn-xs btn-danger btne" onclick="preguntarSiNoAnular(<?php echo $m->id_saleproductgas;?>,<?php echo $m->enviado_sunat;?>)" target="_blank" >Anular</a></td>
                                <?php
                                }
                                ?>

                        </tr>
                        <?php
                        $totalsales--;
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
    function preguntarSiNoEnviarSunat(id, envio_sunat){
        alertify.confirm('Enviar a Facturador', '¿Esta seguro de Enivar al Facturador de la Sunat?',
            function(){ crear_ArchivosPlanos(id, envio_sunat) }
            , function(){ alertify.error('Operacion Cancelada')});
    }
    function crear_ArchivosPlanos(id, envio_sunat){
        var cadena = "id=" + id +
                    "&envio_sunat=" + envio_sunat;
        $.ajax({
            type:"POST",
            url: urlweb + "api/SellGas/crear_ArchivosPlanos",
            data : cadena,
            success:function (r) {
                alert(r)
                if(r==1){
                    alertify.success('Registro Enviado');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar');
                }
            }
        });
    }
</script>

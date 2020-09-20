<?php
/**
 * Created by PhpStorm
 * User: Lucho
 * Date: 18/09/2020
 * Time: 13:28
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
                <center><h2>COMPROBANTES ELECTRONICOS</h2></center>
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
                        <th>Tipo</th>
                        <th>Serie y numero</th>
                        <th>DNI, RUC.</th>
                        <th>Denominación</th>
                        <th>M</th>
                        <th>Total</th>
                        <th>Imprimir</th>
                        <th>PDF</th>
                        <th>ESTADO SUNAT</th>
                        <th>ACCIÓN</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $totalsales = count($sales);
                    foreach ($sales as $s){
                        $stylee="";
                        if($s->anulado_sunat == 1){
                            $stylee = "style= 'background: lightcoral;'";
                        }
                        if ($s->link_pdf_comprobante == NULL){
                            $comprobante_pdf = "X";
                        } else{
                            $comprobante_pdf = "<a type=\"button\" href=\"$s->link_pdf_comprobante\" style=\"color: red\" ><i class=\"fa fa-file-pdf-o\"></i></a>";
                        }
                        if($s->respuesta_sunat == NULL){
                            $respuesta_sunat = "X";
                        }else{
                            $respuesta_sunat = $s->respuesta_sunat;
                        }
                        ?>
                        <tr <?= $stylee ?>>
                            <td><?= $totalsales; ?></td>
                            <td><?= $s->saleproductgas_date;?></td>
                            <td><?= $s->saleproductgas_type ;?></td>
                            <td><?= $s->saleproductgas_correlativo;?></td>
                            <td><?= $s->client_number; ?></td>
                            <td><?= $s->client_razonsocial . $s->client_name ; ?></td>
                            <td><?= $s->simbolo; ?></td>
                            <td><?= $s->saleproductgas_total; ?></td>
                            <td style="color: green"><center><i class="fa fa-print"></i></center></td>
                            <td><center><?= $comprobante_pdf; ?></center></td>
                            <td><center><?= $respuesta_sunat; ?></center></td>
                            <td>
                                <?php
                                if ($s->enviado_sunat == 0){
                                ?>
                                <a type="button" class="btn btn-xs btn-success btne" onclick="preguntarSiNoEnviarSunat(<?php echo $s->id_saleproductgas;?>,<?php echo $s->enviado_sunat;?>)" target="_blank" >Enviar a Facturador</a></td>
                            <?php
                            } else {
                                if($s->anulado_sunat == 0){
                                    ?>
                                    <a type="button" class="btn btn-xs btn-danger btne" onclick="preguntarSiNoAnular(<?php echo $s->id_saleproductgas;?>,<?php echo $s->enviado_sunat;?>)" target="_blank" >Anular</a></td>
                                    <?php
                                } else { ?>
                                    <a type="button" class="btn btn-xs btn-danger btne" target="_blank" >Anulado</a></td>
                                    <?php
                                }
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
            function(){ enviar_facturador_json(id, envio_sunat) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function enviar_facturador_json(id, envio_sunat) {
        var cadena = "id=" + id +
            "&envio_sunat=" + envio_sunat;
        $.ajax({
            type:"POST",
            url: urlweb + "api/SellGas/enviar_facturador_json",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Comprobante Enviado');
                    location.reload();
                } else if(r==2){
                    alertify.error('error al enviar');
                    location.reload();
                } else{
                    alertify.success('Comprobante Anulado');
                    location.reload();
                }

            }
        });
    }

    function preguntarSiNoAnular(id, envio_sunat){
        alertify.confirm('Anular Factura', '¿Esta seguro de Anular la Factura de la Sunat?',
            function(){ enviar_facturador_json(id, envio_sunat) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

</script>



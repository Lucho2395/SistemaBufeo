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
                        <th>Tipo</th>
                        <th>Serie y numero</th>
                        <th>DNI, RUC.</th>
                        <th>Denominación</th>
                        <th>M</th>
                        <th>Total</th>
                        <th>PDF</th>
                        <th>XML</th>
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
                            $comprobante_pdf = "<a type=\"button\" target='_blank' href=\"$s->link_pdf_comprobante\" style=\"color: red\" ><i class=\"fa fa-file-pdf-o\"></i></a>";
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
                            <td style="color: green"><center><?= $comprobante_pdf; ?></center></td>
                            <td>
                                <?php
                                if($s->enviado_sunat == 1){ ?>
                                    <center><a href="<?php echo _SERVER_ . 'SellGas/xmlSunat/' . $s->id_saleproductgas ;?>" target="_blank"><i class="fa fa-file-code-o"></a></center>
                                <?php
                                }else{
                                    echo "X";
                                }
                                ?>
                            </td>
                            <td><center><a href="<?php echo _SERVER_ . 'SellGas/cdrSunat/' . $s->id_saleproductgas ;?>" target="_blank"><i class="fa fa-file-code-o"></a></center></td>
                            <td><a type="button" class="btn btn-xs btn-primary btne" href="<?php echo _SERVER_ . 'SellGas/viewsale/' . $s->id_saleproductgas;?>" target="_blank" >Ver Detalle</a>
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
        <div class="row">
            <div class="col-lg-12" id="respuesta_json">


            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>sellGas.js"></script>

<script type="text/javascript">

    function xml_sunat(id){
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: urlweb + "api/SellGas/xmlSunat",
            data : cadena,
            success:function (r) {
                if(r!=2){
                    $('#respuesta_json').html(r);
                    alertify.success('Registro Enviado');
                } else{
                    alertify.error('error al enviar');
                }

            }
        });
    }

    function enviar_facturador_json(id, envio_sunat) {
        var cadena = "id=" + id +
            "&envio_sunat=" + envio_sunat;
        $.ajax({
            type:"POST",
            url: urlweb + "api/SellGas/enviar_facturador_json",
            data : cadena,
            success:function (r) {
                if(r!=2){
                    $('#respuesta_json').html(r);
                    alertify.success('Registro Enviado');
                } else{
                    alertify.error('error al enviar');
                }

            }
        });
    }

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
                if(r==1){
                    alertify.success('Registro Enviado');
                    location.reload();
                } else if(r==3){
                    alertify.success('Registro Anulado');
                    location.reload();
                }else{
                    alertify.error('No se pudo realizar');
                }
            }
        });
    }

    function preguntarSiNoAnular(id, envio_sunat){
        alertify.confirm('Anular Factura', '¿Esta seguro de Anular la Factura de la Sunat?',
            function(){ crear_ArchivosPlanos(id, envio_sunat) }
            , function(){ alertify.error('Operacion Cancelada')});
    }
</script>

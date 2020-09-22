<?php
/**
 * Created by PhpStorm
 * User: Lucho
 * Date: 18/09/2020
 * Time: 13:28
 */
?>
<!--Modal para buscar comprobante-->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Buscar Comprobante</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="col-xs-3">
                        <label>Tipo de Venta</label>
                        <select  id="type_comprobante" class="form-control" >
                            <option value="2">BOLETA</option>
                            <option value="1">FACTURA</option>
                            <option value= "3">NOTA DE CREDITO</option>
                            <option value= "4">NOTA DE DEBITO</option>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <label for="client_telefono">Serie:</label>
                        <input class="form-control" type="text" id="comprobante_serie" ">
                    </div>
                    <div class="col-xs-3">
                        <label for="client_telefono">Numero:</label>
                        <input class="form-control" type="text" id="comprobante_numero" ">
                    </div>
                    <br>
                    <div class="col-xs-2">
                        <a class="btn btn-success" type="button" onclick="buscar_comprobante()" ><i class="fa fa-search"></i> Buscar</a>
                    </div>

                </div>
                <br>
                <br>
                <br>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="example3" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Tipo de Venta</th>
                                <th>Serie</th>
                                <th>Numero</th>
                                <th>Estado CDR</th>
                                <th>PDF</th>
                                <th>Respuesta</th>
                                <th>link de consulta</th>
                            </tr>
                            </thead>
                            <tbody id = "respuesta_consulta">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="salir_modal()">Cerrar</button>
            </div>
        </div>
    </div>
</div>

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
            <div class="col-xs-9">
                <center><h2>COMPROBANTES ELECTRONICOS</h2></center>
            </div>
            <div class="col-xs-2">
                <br>
                <a class="btn btn-success" type="button"  data-toggle="modal" data-target="#basicModal"><i class="fa fa-search"></i> Buscar Comprobante</a>
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
            beforeSend: function(){
                $(".loader").show();

            }
            ,
            success:function (r) {
                $('.loader').hide();
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

    function buscar_comprobante(){
        var valor = "correcto";
        var tipo_comprobante = $('#type_comprobante'). val();
        var serie = $('#comprobante_serie'). val();
        var numero = $('#comprobante_numero'). val();

        if(serie == ""){
            alertify.error('El campo Código de Barra está vacío');
            $('#comprobante_serie').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#comprobante_serie').css('border','');
        }

        if(numero == ""){
            alertify.error('El campo Código de Barra está vacío');
            $('#comprobante_numero').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#comprobante_numero').css('border','');
        }

        if(valor == "correcto"){
            var cadena = "tipo_comprobante=" + tipo_comprobante +
                "&serie=" + serie +
                "&numero=" + numero;

            $.ajax({
                type:"POST",
                url: urlweb + "api/SellGas/consultar_comprobante",
                data : cadena,
                beforeSend: function(){
                    $('.loader').show();
                },
                success:function (r) {
                    $('.loader').hide();
                    if(r!=1){
                        $('#respuesta_consulta').html(r);

                    } else{
                        alertify.success('NO ENCONTRADO');
                        location.reload();
                    }

                }
            });
        }
    }
    function salir_modal() {

        location.reload();
    }



</script>



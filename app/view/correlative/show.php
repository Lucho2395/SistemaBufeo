<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 2/05/2019
 * Time: 13:17
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
            <li><a href="#"><?php echo $_SESSION['accion'];?></a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Correlativos del Sistema</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Correlativo Boleta</label>
                                <input type="text" class="form-control" id="correlative_b" placeholder="Ingresar Correlativo Boleta..." value="<?php echo $correlative->correlative_b;?>" onkeypress="return valida(event)">
                            </div>
                            <div class="form-group">
                                <label>Correlativo Factura</label>
                                <input type="text" class="form-control" id="correlative_f" placeholder="Ingresar Correlativo Factura..." value="<?php echo $correlative->correlative_f;?>" onkeypress="return valida(event)">
                            </div>
                            <div class="form-group">
                                <label>Correlativo Guia de Entrada</label>
                                <input type="text" class="form-control" id="correlative_in" placeholder="Ingresar Correlativo Guia de Entrada..." value="<?php echo $correlative->correlative_in;?>" onkeypress="return valida(event)">
                            </div>
                            <div class="form-group">
                                <label>Correlativo Guia de Salida</label>
                                <input type="text" class="form-control" id="correlative_out" placeholder="Ingresar Correlativo Guia de Salida..." value="<?php echo $correlative->correlative_out;?>" onkeypress="return valida(event)">
                            </div>
                            <div class="form-group">
                                <label>Correlativo Pedido</label>
                                <input type="text" class="form-control" id="correlative_p" placeholder="Ingresar Correlativo de Pedido..." value="<?php echo $correlative->correlative_p;?>" onkeypress="return valida(event)">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="edit()">Editar Correlativos</button>
                        </div>
                    </div>
                </div>
                <!-- /.box -->



            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>

<script type="text/javascript">
    function edit() {
        var valor = "correcto";
        var id_correlative = <?php echo $correlative->id_correlative;?>;
        var correlative_b = $('#correlative_b').val();
        var correlative_f = $('#correlative_f').val();
        var correlative_in = $('#correlative_in').val();
        var correlative_out = $('#correlative_out').val();
        var correlative_p = $('#correlative_p').val();

        if(correlative_b == ""){
            alertify.error('El campo Correlativo Boleta está vacío');
            $('#correlative_b').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#correlative_b').css('border','');
        }

        if(correlative_f == ""){
            alertify.error('El campo Correlativo Factura está vacío');
            $('#correlative_f').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#correlative_f').css('border','');
        }

        if(correlative_in == ""){
            alertify.error('El campo Correlativo Guia Entrada está vacío');
            $('#correlative_in').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#correlative_in').css('border','');
        }

        if(correlative_out == ""){
            alertify.error('El campo Correlativo Guia Salida está vacío');
            $('#correlative_out').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#correlative_out').css('border','');
        }

        if(correlative_p == ""){
            alertify.error('El campo Correlativo Pedido está vacío');
            $('#correlative_p').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#correlative_p').css('border','');
        }


        if (valor == "correcto"){
            var cadena = "id_correlative=" + id_correlative +
                "&correlative_b=" + correlative_b +
                "&correlative_f=" + correlative_f +
                "&correlative_in=" + correlative_in +
                "&correlative_out=" + correlative_out +
                "&correlative_p=" + correlative_p;
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/Correlative/save",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.reload();
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }

    }

</script>

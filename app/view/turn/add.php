<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 19/11/2018
 * Time: 11:57
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Turnos
            <small>Agregar Turnos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Aperturar Caja</a></li>
            <li><a href="#">Agregar</a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Turn/seeAll" >Volver</a>
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
                        <h3 class="box-title">Datos de Apertura</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Dia de Hoy</label>
                            </div>
                            <div class="form-group">
                                <label >Monto de Apertura</label>
                                <input type="text" class="form-control" id="turn_inicialcash" >
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="add()">Aperturar Caja</button>
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

<script type="text/javascript">
    function add() {
        var valor = "correcto";
        var turn_inicialcash = $('#turn_inicialcash').val();

        if(turn_inicialcash == ""){
            alertify.error('El campo Monto de Apertura está vacío');
            $('#turn_inicialcash').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#turn_inicialcash').css('border','');
        }

        if (valor == "correcto"){
            var cadena = "turn_inicialcash=" + turn_inicialcash;
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/Turn/save",
                data: cadena,
                success:function (r) {
                    switch (r) {
                        case "1":
                            alertify.success("Se Apertutó La Caja");
                            location.href = '<?php echo _SERVER_;?>Turn/seeAll';
                            break;
                        case "2":
                            alertify.error("Fallo el envio");
                            break;
                        case "3":
                            alertify.error("YA SE ENCUENTRA ABIERTA LA CAJA");
                            break;
                        default:
                            alertify.error("Fallo el envio");
                            break;
                    }
                }
            });
        }

    }
</script>

<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 19/04/2019
 * Time: 19:13
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!--Filtro Turnos-->
    <section class="content-header">
        <center><h4>Seleccionar Turno A Filtrar:</h4></center>
        <center>
            <input type="date" class="form-control" id="turno" onchange="sendturn()" value="<?php echo $fecha;?>">
        </center>
    </section>
    <!--Filtro Turnos-->
    <section class="content-header">
        <h1>
            Reporte
            <small>Reporte General del Turno</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Reporte</a></li>
            <li class="active">Reporte del Dia</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-12">
                <center><h2>Reporte General Diarios</h2></center>
                <center><h3>Dia Turno: <?php echo $fecha;?></h3></center>
            </div>
        </div>
        <br>
        <center><h2>NO EXISTEN REGISTROS</h2></center>
    </section>
    <!-- /.content -->
</div>

<script>
    $(function () {
        $("#example2").DataTable();
    });
    function sendturn(){
        fecha = $('#turno').val();
        var cadena = "fecha=" + fecha;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Report/set_turn",
            data : cadena,
            success:function (r) {
                if(r==1){
                    location.reload();
                } else {
                    alertify.error('Error Al Mostrar Informacion');
                }
            }
        });
    }
</script>



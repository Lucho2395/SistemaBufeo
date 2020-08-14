<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 19/04/2019
 * Time: 18:29
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
                <center><h2>No Existe Un Turno Activo :(</h2></center>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<script>
    $(function () {
        $("#example2").DataTable();
    });
    function eliminar(id){
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Inventory/deleteProduct",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Producto Eliminado');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar');
                }
            }
        });
    }
</script>

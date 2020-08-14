<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 24/11/2018
 * Time: 18:28
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--Filtro Turnos-->
    <section class="content-header">
        <h1>Guias </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Reporte</a></li>
            <li class="active">Guias</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="background-color: white;box-shadow: 2px 2px 2px #888888;border-radius: 5px; padding: 10px; margin: 10px; min-height: 500px">
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <center><h4>Guias de Ingreso</h4></center>
                <table id="guias_entrada" class="table table-bordered table-hover" style="border-color: black">
                    <thead>
                    <tr style="background-color: #ebebeb">
                        <th>Fecha</th>
                        <th>Nro</th>
                        <th>Producto</th>
                        <th>Cant Agregada</th>
                        <th>PDF</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($guias_entrada as $p){
                        ?>
                        <tr>
                            <td><?php echo $p->stocklog_date;?></td>
                            <td><?php echo $p->stocklog_guide;?></td>
                            <td><?php echo $p->product_name;?></td>
                            <td><?php echo $p->stocklog_added;?></td>
                            <td><a class="btn btn-success" href="<?php echo _SERVER_;?>Report/guias_pdf/<?php echo $p->id_stocklog; ?>/entrada" target="_blank"><i class="fa fa-eye"></i> Ver</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <center><h4>Guias de Salida</h4></center>
                <table id="guias_salida" class="table table-bordered table-hover" style="border-color: black">
                    <thead>
                    <tr style="background-color: #ebebeb">
                        <th>Fecha</th>
                        <th>Nro</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Destino</th>
                        <th>PDF</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($guias_salida as $ex) {
                        ?>
                        <tr>
                            <td><?php echo $ex->stockout_date;?></td>
                            <td><?php echo $ex->stockout_guide;?></td>
                            <td><?php echo $ex->product_name;?></td>
                            <td><?php echo $ex->stockout_out;?></td>
                            <td><?php echo $ex->stockout_destiny;?></td>
                            <td><a  class="btn btn-success"  href="<?php echo _SERVER_;?>Report/guias_pdf/<?php echo $ex->id_stockout; ?>/salida" target="_blank"><i class="fa fa-eye"></i> Ver</a></td>
                        </tr>
                        <?php
                    }?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script>
    $(function () {
        $("#guias_entrada").DataTable({
            responsive: true,
            "language": {
                sEmptyTable: "No existen datos en esta tabla",
                sInfo: "Mostrando _START_ de _END_ de _TOTAL_ Entradas",
                sInfoEmpty: "0 de 0 de 0 Entradas",
                sInfoFiltered: "(Filtrado de un total de _MAX_ resultados)",
                sInfoPostFix: "",
                sInfoThousands: ".",
                sLengthMenu: "Mostrar _MENU_ Resultados",
                sLoadingRecords: "Cargando resultados...",
                sProcessing: "Espere por favor..",
                sSearch: "Buscar:",
                sZeroRecords: "No se han encontrado resultados.",
                oPaginate: {
                    sFirst: "Primero",
                    sPrevious: "Anterior",
                    sNext: "Siguiente",
                    sLast: "Último"
                },
                oAria: {
                    sSortAscending: ":Habilitar para ordenar de forma ascendente",
                    sSortDescending: ":Habilitar para ordenar de forma descendente"
                }
            }
        });
        $("#guias_salida").DataTable({
            responsive: true,
            "language": {
                sEmptyTable: "No existen datos en esta tabla",
                sInfo: "Mostrando _START_ de _END_ de _TOTAL_ Entradas",
                sInfoEmpty: "0 de 0 de 0 Entradas",
                sInfoFiltered: "(Filtrado de un total de _MAX_ resultados)",
                sInfoPostFix: "",
                sInfoThousands: ".",
                sLengthMenu: "Mostrar _MENU_ Resultados",
                sLoadingRecords: "Cargando resultados...",
                sProcessing: "Espere por favor..",
                sSearch: "Buscar:",
                sZeroRecords: "No se han encontrado resultados.",
                oPaginate: {
                    sFirst: "Primero",
                    sPrevious: "Anterior",
                    sNext: "Siguiente",
                    sLast: "Último"
                },
                oAria: {
                    sSortAscending: ":Habilitar para ordenar de forma ascendente",
                    sSortDescending: ":Habilitar para ordenar de forma descendente"
                }
            }
        });
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
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
        <h1>Reporte <small>Kardex por producto</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Reporte</a></li>
            <li class="active">Kardex por producto</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content" style="background-color: white;box-shadow: 2px 2px 2px #888888;border-radius: 5px; padding: 10px; margin: 10px; min-height: 500px">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-md-4">
                <label for="fecha_i">Desde:</label>
                <input type="date" class="form-control" id="fecha_i" value="<?php echo $fecha;?>">
            </div>
            <div class="col-md-4">
                <label for="fecha_f">Hasta:</label>
                <input type="date" class="form-control" id="fecha_f" value="<?php echo $fecha;?>">
            </div>
            <div class="col-md-4">
                <label for="productos">Seleccionar Producto:</label>
                <select class="form-control" onchange="kardex_por_producto()" id="productos">
                    <option>Seleccione</option>
                    <?php
                    foreach ($products as $product){
                        echo "<option value='".$product->id_product."'>".$product->product_name."</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <br>
                <table class="table table-bordered table-hover" style="border-color: black">
                    <thead>
                    <tr style="background-color: #ebebeb">
                        <th>Fecha</th>
                        <th>Doc</th>
                        <th>Número</th>
                        <th>ENTRADA</th>
                        <th>SALIDA</th>
                        <th>VENDIDO</th>
                    </tr>
                    </thead>
                    <tbody id="tabla_kardex_producto">
                    <tr><td colspan="6">Seleccione un producto</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form method="post" target="_blank" action="<?php echo _SERVER_;?>Report/kardex_por_producto_PDF">
                    <input type="hidden" name="fecha_i_f" id="fecha_i_f" value="">
                    <input type="hidden" name="fecha_f_f" id="fecha_f_f" value="">
                    <input type="hidden" name="id_producto_f" id="id_producto_f" value="">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-print"></i> Imprimir</button>
                </form>
            </div>
        </div>
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
    function kardex_por_producto() {
        var fecha_i = $("#fecha_i").val();
        var fecha_f = $("#fecha_f").val();
        var producto = $("#productos").val();
        $("#fecha_i_f").val(fecha_i);
        $("#fecha_f_f").val(fecha_f);
        $("#id_producto_f").val(producto);
        $.post("<?php echo _SERVER_;?>Report/kardex_product_table", { fecha_i: fecha_i,fecha_f: fecha_f, producto:producto}, function(data){
            $("#tabla_kardex_producto").html(data);
        });
    }
</script>
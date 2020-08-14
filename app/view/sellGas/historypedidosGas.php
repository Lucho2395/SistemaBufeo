<?php
/**
 * Created by PhpStorm
 * User: Lucho
 * Date: 06/08/2020
 * Time: 19:56
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
                <center><h2>Lista de Pedidos Registradas</h2></center>
            </div>
        </div>
        <br>
        <section class="content" style="background-color: white;box-shadow: 2px 2px 2px #888888;border-radius: 5px; padding: 10px; margin: 10px; min-height: 90px">
            <div class="row">
                <div class="col-md-3">
                    <label for="fecha_i">Desde:</label>
                    <input type="date" class="form-control" id="fecha_ini" value="<?php echo $fecha;?>">
                </div>
                <div class="col-md-3">
                    <label for="fecha_f">Hasta:</label>
                    <input type="date" class="form-control" id="fecha_fin" value="<?php echo $fecha;?>">
                </div>
                <div class="col-md-3">
                    <label for="productos">Seleccione estado de Pedido:</label>
                    <select class="form-control" onchange="filtro_por_estado()" id="filtroestado">
                        <option>Seleccione Estado</option>
                        <option value="0">CANCELADO</option>
                        <option value="1">VENDIDO</option>
                        <option value="2">PENDIENTE</option>

                    </select>
                </div>
                <div class="col-md-3">
                    <label for="fecha_f">Usuario:</label>
                    <select class="form-control" onchange="filtro_por_usuario()" id="filtrousuario">
                        <option>Seleccione Usuario</option>
                        <?php
                        foreach ($user as $u){
                            echo "<option value='".$u->id_user."'>".$u->user_nickname."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

        </section>


        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <table id="example2" class="table table-bordered table-hover">
                    <thead class="text-capitalize">
                    <tr>
                        <th>N°</th>
                        <th>Fecha</th>
                        <th>Usuario Vendedor</th>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Total de Venta</th>
                        <th>Estado de Pedido</th>
                        <th>Estado de Venta</th>
                        <th>ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody id="tabla_lista_pedidos">

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


    $(document).ready(function(){
        var fecha_i = $("#fecha_ini").val();
        var fecha_f = $("#fecha_fin").val();
        var estadopedido = 1;
        $("#tabla_lista_pedidos").html("");
        //alert($("#tabla_lista_pedidos").html());
        //$("#tabla_lista_pedidos").load();
        $.post("<?php echo _SERVER_;?>api/SellGas/viewhistorypedidofiltro",{fecha_i: fecha_i,fecha_f: fecha_f, estadopedido:estadopedido}, function(data){
            $("#tabla_lista_pedidos").html(data);
            //alert($("#tabla_lista_pedidos").html());
        });
    });

    /*function filtro_por_estado(){

        var fecha_i = $("#fecha_ini").val();
        var fecha_f = $("#fecha_fin").val();
        var estadopedido = $("#filtroestado").val();
        $("#tabla_lista_pedidos").html("");
        alert($("#tabla_lista_pedidos").html());
        //$("#tabla_lista_pedidos").load();
        $.post("<?php echo _SERVER_;?>api/SellGas/viewhistorypedidofiltro",{fecha_i: fecha_i,fecha_f: fecha_f, estadopedido:estadopedido}, function(data){
            $("#tabla_lista_pedidos").html(data);
            alert($("#tabla_lista_pedidos").html());
        });
    }*/


    function filtro_por_usuario(){
        var fecha_i = $("#fecha_ini").val();
        var fecha_f = $("#fecha_fin").val();
        var estadopedido = $("#filtroestado").val();
        var usuario = $("#filtrousuario").val();
        $.post("<?php echo _SERVER_;?>SellGas/viewhistorypedidofiltro",{fecha_i: fecha_i,fecha_f: fecha_f, estadopedido:estadopedido, usuario:usuario}, function(data){
            $("#tabla_lista_pedidos").html(data);

        });
    }

</script>


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
                <div class="col-md-2">
                    <label for="fecha_i">Desde:</label>
                    <input type="date" class="form-control" id="fecha_ini" value="<?php echo $fecha;?>">
                </div>
                <div class="col-md-2">
                    <label for="fecha_f">Hasta:</label>
                    <input type="date" class="form-control" id="fecha_fin" value="<?php echo $fecha;?>">
                </div>
                <div class="col-md-3">
                    <label for="productos">Seleccione estado de Pedido:</label>
                    <select class="form-control" onchange="filtro_por_estado()" id="filtroestado">
                        <option value="">Seleccione Estado</option>
                        <option value="0">CANCELADO</option>
                        <option value="1">VENDIDO</option>
                        <option value="2">PENDIENTE</option>

                    </select>
                </div>
                <div class="col-md-3">
                    <label for="fecha_f">Usuario:</label>
                    <select class="form-control" onchange="filtro_por_usuario()" id="filtrousuario">
                        <option value="">Seleccione Usuario</option>
                        <?php
                        foreach ($user as $u){
                            echo "<option value='".$u->id_user."'>".$u->user_nickname."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-success" type="button" onclick="buscar_registro_filtro()"><i class="fa fa-search"></i> Buscar</a>
                </div>
            </div>

        </section>


        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12" id="tabla_con_filtro">



            </div>
        </div>
        <div class="row">
            <div class="col-lg-1">
                <form method="post" target="_blank" action="<?php echo _SERVER_;?>SellGas/historypedidos_pdf">
                    <input type="hidden" name="fecha_i_f" id="fecha_i_f" value="">
                    <input type="hidden" name="fecha_f_f" id="fecha_f_f" value="">
                    <input type="hidden" name="estadopedido_pdf" id="estadopedido_pdf" value="">
                    <input type="hidden" name="usuario_pdf" id="usuario_pdf" value="">
                    <button class="btn btn-danger" type="submit"><i class="fa fa-file-pdf-o"></i> PDF</button>
                </form>
            </div>
            <div class="col-lg-1">
                <form method="post" target="_blank" action="<?php echo _SERVER_;?>SellGas/exportarhistorypedidos_excel">
                    <input type="hidden" name="fecha_i_f_e" id="fecha_i_f_e" value="">
                    <input type="hidden" name="fecha_f_f_e" id="fecha_f_f_e" value="">
                    <input type="hidden" name="estadopedido_excel" id="estadopedido_excel" value="">
                    <input type="hidden" name="usuario_excel" id="usuario_excel" value="">
                    <button class="btn btn-success" id= "boton_exportar_excel" type="submit"><i class="fa fa-file-excel-o"></i> EXCEL</button>
                </form>
            </div>
            <div class="col-lg-1">
                <form method="post" target="_blank" action="<?php echo _SERVER_;?>SellGas/imprimir_tabla_filtro">
                    <input type="hidden" name="fecha_i_f_e_i" id="fecha_i_f_e_i" value="">
                    <input type="hidden" name="fecha_f_f_e_i" id="fecha_f_f_e_i" value="">
                    <input type="hidden" name="estadopedido_imprimir" id="estadopedido_imprimir" value="">
                    <input type="hidden" name="usuario_imprimir" id="usuario_imprimir" value="">
                    <button class="btn btn-primary" onclick="javascript:imprim2();" type="submit" ><i class="fa fa-print"></i> IMPRIMIR</button>
                </form>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>sellGas.js"></script>

<script type="text/javascript">

    function imprim2(){
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');
        mywindow.document.write('<html><head>');
        mywindow.document.write('<style>.tabla{width:100%;border-collapse:collapse;margin:16px 0 16px 0;}.tabla th{border:1px solid #ddd;padding:4px;background-color:#d4eefd;text-align:left;font-size:15px;}.tabla td{border:1px solid #ddd;text-align:left;padding:6px;}</style>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(document.getElementById('muestra').innerHTML);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necesario para IE >= 10
        mywindow.focus(); // necesario para IE >= 10
        mywindow.print();
        mywindow.close();
        return true;
    }

    function buscar_registro_filtro(){
        var fecha_i = $("#fecha_ini").val();
        var fecha_f = $("#fecha_fin").val();
        var estadopedido = $("#filtroestado").val();
        var usuario = $("#filtrousuario").val();
        $("#fecha_i_f").val(fecha_i);
        $("#fecha_f_f").val(fecha_f);
        $("#estadopedido_pdf").val(estadopedido);
        $("#usuario_pdf").val(usuario);
        $("#fecha_i_f_e").val(fecha_i);
        $("#fecha_f_f_e").val(fecha_f);
        $("#estadopedido_excel").val(estadopedido);
        $("#usuario_excel").val(usuario);
        $("#fecha_i_f_e_i").val(fecha_i);
        $("#fecha_f_f_e_i").val(fecha_f);
        $("#estadopedido_imprimir").val(estadopedido);
        $("#usuario_imprimir").val(usuario);
        if (fecha_i != "" && fecha_f != ""){

            $.post("<?php echo _SERVER_;?>SellGas/viewhistorypedidofiltro",{fecha_i: fecha_i,fecha_f: fecha_f, estadopedido:estadopedido, usuario:usuario}, function(data){
                $("#tabla_con_filtro").html(data);
                $("#example2").DataTable({
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
        }else{
            alertify.error('El campo fecha está vacío');
            $('#fecha_ini').css('border','solid red');
            $('#fecha_fin').css('border','solid red');
        }
    }

</script>


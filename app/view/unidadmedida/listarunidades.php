<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 14/05/2019
 * Time: 22:50
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
                <center><h2>Lista de todas la Unidades de Medida</h2></center>
            </div>
            <div class="col-xs-2">
                <center><a class="btn btn-block btn-success btn-sm" href="<?php echo _SERVER_;?>UnidadMedida/add" >Agregar Nuevo</a></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <table id="example2" class="table table-bordered table-hover">
                    <thead class="text-capitalize">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $a = 1;
                    foreach ($unimedida as $um){
                        ?>
                        <tr>
                            <td><?php echo $a;?></td>
                            <td><?php echo $um->medida_nombre;?></td>
                            <td><?php echo $um->medida_codigo_unidad;?></td>
                            <?php
                            if ($um->medida_activo == 0){?>
                                <td><a type="button" class="btn btn-xs btn-success btne" onclick="cambiarestado(<?php echo $um->medida_id ?>, 1)" href="" >ACTIVAR</a></td>
                            <?php
                            } else{ ?>
                                <td><a type="button" class="btn btn-xs btn-danger btne" onclick="cambiarestado(<?php echo $um->medida_id ?>, 0)" href="" >DESACTIVAR</a></td>
                            <?php
                            }
                            ?>
                        </tr>
                        <?php
                        $a++;
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
<script src="<?php echo _SERVER_ . _JS_;?>categoryp.js"></script>
<script>
    function cambiarestado(medida_id, estado){
        var cadena = "medida_id=" + medida_id +
                "&estado=" + estado;
        $.ajax({
            type: "POST",
            url: urlweb + "api/UnidadMedida/Cambiarestado",
            data: cadena,
            success: function (r) {

                if(r==1){
                    alertify.success('Unidad Activada');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar esta función');
                }

            }
        })
    }
</script>
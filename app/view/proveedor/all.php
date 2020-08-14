<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 18/04/2019
 * Time: 21:05
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
                <center><h2>Lista de Proveedores Registrados</h2></center>
            </div>
            <div class="col-xs-2">
                <center><a class="btn btn-block btn-success btn-sm" href="<?php echo _SERVER_;?>Proveedor/add" >Agregar Nuevo</a></center>
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
                        <th>RUC o DNI</th>
                        <th>Proveedor</th>
                        <th>Contacto</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $a = 1;
                    foreach ($proveedor as $m){
                        ?>
                        <tr>
                            <td><?php echo $a;?></td>
                            <td><?php echo $m->proveedor_ruc;?></td>
                            <td><?php echo $m->nombre_provee;?></td>
                            <td><?php echo $m->contacto_provee;?></td>
                            <td><?php echo $m->telefono_provee;?></td>
                            <td><?php echo $m->direccion_provee;?></td>
                            <td><a type="button" class="btn btn-xs btn-warning btne" href="<?php echo _SERVER_ . 'Proveedor/edit/' . $m->id_proveedor;?>" >Editar</a><a type="button" class="btn btn-xs btn-danger" onclick="preguntarSiNo(<?php echo $m->id_proveedor;?>)">Eliminar</a></td>
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
<script src="<?php echo _SERVER_ . _JS_;?>proveedor.js"></script>

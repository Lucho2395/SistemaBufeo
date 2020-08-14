<?php
/**
 * Created by PhpStorm.
 * User: Cesar Jose Ruiz
 * Date: 13/02/2019
 * Time: 1:27
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
                <h5>Opciones del Menú: <?php echo $menuname;?></h5>
            </div>
            <div class="col-xs-2">
                <center><a class="btn btn-block btn-success btn-sm" href="<?php echo _SERVER_ . 'Menu/addf/' . $id_menu;?>" >Agregar Nuevo</a></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <table id="example2" class="table table-bordered table-hover">
                    <thead class="text-capitalize">
                    <tr>
                        <th>Orden</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Función</th>
                        <th>¿Mostrar en Opciones?</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($options as $m){
                        $show = "<a class=\"btn btn-xs btn-outline-danger\">NO</a>";
                        $status = "<a class=\"btn btn-xs btn-outline-danger\">DESHABILITADO</a>";
                        if($m->optionm_show == 1){
                            $show = "<a class=\"btn btn-xs btn-outline-success\">SI</a>";
                        }
                        if($m->optionm_status == 1){
                            $status = "<a class=\"btn btn-xs btn-outline-success\">HABILITADO</a>";
                        }
                        ?>
                        <tr>
                            <td><?php echo $m->optionm_order?></td>
                            <td><?php echo $m->id_optionm?></td>
                            <td><?php echo $m->optionm_name?></td>
                            <td><?php echo $m->optionm_function?></td>
                            <td><?php echo $show?></td>
                            <td><?php echo $status?></td>
                            <td><a type="button" class="btn btn-xs btn-warning btne" href="<?php echo _SERVER_ . 'Menu/editf/' . $m->id_optionm;?>">Editar</a><a type="button" class="btn btn-xs btn-success btne" href="<?php echo _SERVER_ . 'Menu/listp/' . $m->id_optionm;?>">Ver Permisos</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <a type="button" class="btn btn-xs btn-info btne" href="<?php echo _SERVER_ . 'Menu/list'?>" >Volver Al Menú Anterior</a>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>menu.js"></script>


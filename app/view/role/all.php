<?php
/**
 * Created by PhpStorm.
 * User: Cesar Jose Ruiz
 * Date: 10/04/2019
 * Time: 22:06
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
            <div class="col-xs-12">
                <h4 class="header-title">Lista de Roles Resgitrados</h4>
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
                        <th>Descripcion</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($role as $m){
                        ?>
                        <tr>
                            <td><?php echo $m->id_role?></td>
                            <td><?php echo $m->role_name?></td>
                            <td><?php echo $m->role_description?></td>
                            <td><a type="button" class="btn btn-xs btn-warning btne" href="<?php echo _SERVER_ . 'Role/edit/' . $m->id_role;?>" >Editar</a><a type="button" class="btn btn-xs btn-danger btne" onclick="preguntarSiNo(<?php echo $m->id_role;?>)">Eliminar</a><a type="button" class="btn btn-xs btn-success btne" href="<?php echo _SERVER_ . 'Role/options/' . $m->id_role;?>" >Ver Accesos</a></td>
                        </tr>
                        <?php
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
<script src="<?php echo _SERVER_ . _JS_;?>role.js"></script>


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
            <li><a href="#"><?php echo $_SESSION['accion'];?></a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Menu/list" >Volver</a>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4 class="header-title">Agregar Nuevo Rol</h4>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-form-label">Nombre Rol</label>
                                <input class="form-control" type="text" id="role_name" placeholder="Ingrese Nombre del Rol...">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Descripción Rol</label>
                                <input class="form-control" type="text" id="role_description" placeholder="Ingrese Descripción del Rol...">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" onclick="save()"> Agregar Rol</button>
                            </div>
                        </div>
                        <!-- /.box-body -->

                    </div>
                </div>
                <!-- /.box -->



            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>role.js"></script>

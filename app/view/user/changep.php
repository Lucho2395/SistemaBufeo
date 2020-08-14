<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 18/11/2018
 * Time: 14:50
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
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>User/all" >Volver</a>
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
                        <h4 class="header-title">Editar Contraseña Usuario</h4>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="user_password1" placeholder="Ingresar Contraseña...">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Repetir Contraseña</label>
                                <input type="password" class="form-control" id="user_password2" placeholder="Vuelva a Ingresar Contraseña...">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" onclick="savec()"> Editar Usuario</button>
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
<script src="<?php echo _SERVER_ . _JS_;?>user.js"></script>

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
            <li><a href="#"><?php echo $_SESSION['accion'];?></a></li>
            <a class="btn btn-chico btn-default btn-xs" onclick="volverp(<?php echo $id_optionm;?>)" >Volver</a>
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
                        <h4 class="header-title">Editar Permiso</h4>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-form-label">Acción</label>
                                <input class="form-control" type="text" id="permit_action" value="<?php echo $per->permit_action;?>" placeholder="Ingrese Nombre de la Opción...">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Estado</label>
                                <select class="form-control" id="permit_status">
                                    <option <?php echo ($per->permit_status == 1) ? 'selected' : '';?> value="1">HABILITADO</option>
                                    <option <?php echo ($per->permit_status == 0) ? 'selected' : '';?>  value="0">DESHABILITADO</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Contraseña De Usuario Actual</label>
                                <input class="form-control" type="password" id="password"  placeholder="Ingrese su Contraseña...">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" onclick="savep(<?php echo $per->id_optionm;?>)"> Guardar Opción</button>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info" onclick="volverp(<?php echo $per->id_optionm;?>)"> Volver a Listar Funciones</button>
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
<script src="<?php echo _SERVER_ . _JS_;?>menu.js"></script>

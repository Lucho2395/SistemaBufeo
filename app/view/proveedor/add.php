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
            <li><a href="#"><?php echo $_SESSION['accion'];?></a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Proveedor/all" >Volver</a>
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
                        <h4 class="header-title">Agregar Nuevo Proveedor</h4>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-form-label">Numero de RUC o DNI</label>
                                <input type="text" class="form-control" id="ruc_proveedor" placeholder="Ingresar RUC del Proveedor...">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Nombre del Proveedor</label>
                                <input type="text" class="form-control" id="nombre_provee" placeholder="Ingresar Nombre del Proveedor...">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Nombre del Contacto</label>
                                <input type="text" class="form-control" id="contacto_provee" placeholder="Ingresar Nombre del Contacto...">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Telefono del Proveedor</label>
                                <input type="text" class="form-control" id="telefono_provee" placeholder="Ingresar Número..." onkeypress="return valida(event)">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion_provee" placeholder="Ingresar Dirección...">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" onclick="save()"> Agregar Proveedor</button>
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
<script src="<?php echo _SERVER_ . _JS_;?>proveedor.js"></script>

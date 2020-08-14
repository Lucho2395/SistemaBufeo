<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 18/04/2019
 * Time: 19:59
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
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Userg/all"> >Volver</a>
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
                        <h4 class="header-title">Editar Usuario</h4>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-form-label">Nombre Usuario</label>
                                <input type="text" class="form-control" value="<?php echo $user->user_nickname;?>" id="user_nickname" placeholder="Ingresar Nombre Usuario...">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Rol de Usuario</label>
                                <select class="form-control" id="id_role">
                                    <option value="">Seleccione un valor...</option>
                                <?php
                                foreach ($role as $r) {
                                   ?>
                                   <option <?php echo ($r->id_role == $user->id_role) ? 'selected' : '';?> value="<?php echo $r->id_role;?>"><?php echo $r->role_name;?></option>
                                   <?php
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Correo Usuario</label>
                                <input type="text" class="form-control" id="user_email" value="<?php echo $user->user_email;?>" placeholder="Ingresar Correo Usuario...">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Estado</label>
                                <select id="user_status" class="form-control">
                                    <option  <?php echo ($user->user_status == 0) ? 'selected' : '';?> value="0">INHABILITADO</option>
                                    <option <?php echo ($user->user_status == 1) ? 'selected' : '';?> value="1">HABILITADO</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" onclick="saveeu()"> Editar Usuario</button>
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
<script src="<?php echo _SERVER_ . _JS_;?>userg.js"></script>

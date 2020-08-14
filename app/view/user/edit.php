<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 18/11/2018
 * Time: 14:32
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
                                <label class="col-form-label"> Rol Usuario</label>
                                <select id="id_role" class="form-control">
                                    <?php
                                    foreach ($roles as $r){
                                        ?>
                                        <option <?php echo ($user->id_role == $r->id_role) ? 'selected' : '';?> value="<?php echo $r->id_role;?>"><?php echo $r->role_name;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" style="display: none;">Persona a Designar Usuario</label>
                                <select class="form-control" style="display: none;" id="id_person" >
                                    <?php
                                    foreach ($person as $p){
                                        ?>
                                        <option <?php echo ($user->id_person == $p->id_person) ? 'selected' : '';?> value="<?php echo $p->id_person;?>"><?php echo $p->person_name . ' '. $p->person_surname;?></option><?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" onclick="savee()"> Editar Usuario</button>
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

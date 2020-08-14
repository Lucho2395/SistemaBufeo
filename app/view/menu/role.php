<?php
/**
 * Created by PhpStorm.
 * User: Cesar Jose Ruiz
 * Date: 12/02/2019
 * Time: 17:43
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Roles con Acceso a Menú: <bold><?php echo $menuname;?></bold></h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <input class="form-control" type="password" id="password"  placeholder="Ingrese su Contraseña AQUÍ para Permitir Cambios...">
                    </div>
                </div>
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
                        <th>Rol</th>
                        <th>Descripción</th>
                        <th>¿Con Acceso?</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($menusf as $m){
                        $acceso = array_search($m->id_role, array_column($menust, 'id_role'));
                        if($acceso === false){
                            $permiso_vista = "<a type=\"button\" class=\"btn btn-xs btn-outline-danger\">Sin Acceso</a>";
                            $opcion_vista = "<a type=\"button\" class=\"btn btn-xs btn-success\" onclick=\"preguntarSiNoAR(" .$id_menu.",". $m->id_role.")\">Permitir Acceso</a>";
                        } else {
                            $permiso_vista = "<a type=\"button\" class=\"btn btn-xs btn-outline-success\">Con Acceso</a>";
                            $opcion_vista = "<a type=\"button\" class=\"btn btn-xs btn-danger\" onclick=\"preguntarSiNoDR(" .$id_menu.",". $m->id_role.")\">Eliminar Acceso</a>";
                        }
                        ?>
                        <tr>
                            <td><?php echo $m->id_role;?></td>
                            <td><?php echo $m->role_name;?></td>
                            <td><?php echo $m->role_description;?></td>
                            <td><?php echo $permiso_vista;?></td>
                            <td><?php echo $opcion_vista;?></td>
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


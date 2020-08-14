<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 19/11/2018
 * Time: 10:23
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Apertura de Caja
            <small>Panel Principal</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Apertura de Caja</a></li>
            <li class="active">Listar Días</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-10">
                <center><h2>Gestión de Días</h2></center>
            </div>
            <!--<div class="col-xs-2">
                <center><a class="btn btn-block btn-success btn-sm" href="<?php echo _SERVER_;?>Turn/add" >Aperturar Caja</a></center>
            </div>-->
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Dia de Apertura</th>
                        <th>Monto Inicial</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $number = count($turns);
                    foreach ($turns as $m){
                        $boton = "<a class=\"btn btn-final btn-success btn-xs\" >TURNO ABIERTO</a>";

                        if($m->turn_active == 0){
                            $boton = "<a class=\"btn btn-final btn-info btn-xs\" >FINALIZADO</a>";
                            $eliminar = "";
                        }


                        ?>
                        <tr>
                            <td><?php echo $number;?></td>
                            <td><?php echo $m->turn_datestart;?></td>
                            <td>S/. <?php echo $m->turn_inicialcash;?></td>
                            <td><?php echo $eliminar;?><?php echo $boton;?></td>
                        </tr>
                        <?php
                        $number--;
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Turno Inicio</th>
                        <th>Turno Fin</th>
                        <th>Acción</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script>
    function preguntarSiNoH(id){
        alertify.confirm('Finalizar Turno', '¿Esta seguro que desea terminar el turno?',
            function(){ finalizar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    /*function preguntarSiNoD(id){
        alertify.confirm('Eliminar Turno', '¿Esta seguro de eliminar este turno?',
            function(){ eliminar(id) }
            , function(){ alertify.error('Operacion Cancelada')});
    }

    function eliminar(id){
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "api/Turn/delete",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Turno Eliminado');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar');
                }
            }
        });
    }*/

    function finalizar(id){
        var cadena = "id=" + id;
        $.ajax({
            type:"POST",
            url: "<?php echo _SERVER_;?>api/Turn/change",
            data : cadena,
            success:function (r) {
                if(r==1){
                    alertify.success('Turno Habilitado');
                    location.reload();
                } else {
                    alertify.error('No se pudo realizar');
                }
            }
        });
    }
</script>

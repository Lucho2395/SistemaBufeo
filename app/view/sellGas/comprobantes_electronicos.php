<?php
/**
 * Created by PhpStorm
 * User: Lucho
 * Date: 18/09/2020
 * Time: 13:28
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
                <center><h2>COMPROBANTES</h2></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <table id="example2" class="table table-bordered table-hover">
                    <thead class="text-capitalize">
                    <tr>
                        <th>N°</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Serie y numero</th>
                        <th>DNI, RUC.</th>
                        <th>Denominació</th>
                        <th>M</th>
                        <th>Total</th>
                        <th>Imprimir</th>
                        <th>PDF</th>
                        <th>ESTADO SUNAT</th>
                    </tr>
                    </thead>
                    <tbody id="tabla_lista_pedidos">
                        <tr>
                            <th>1</th>
                            <th>18/09/2020</th>
                            <th>03</th>
                            <th>FFF1-1</th>
                            <th>71106432</th>
                            <th>Luis Salazar</th>
                            <th>s/</th>
                            <th>100.00</th>
                            <th>x</th>
                            <th>x</th>
                            <th>Enviado</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>sellGas.js"></script>

<script type="text/javascript">



</script>



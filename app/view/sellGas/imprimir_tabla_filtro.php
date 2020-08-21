<?php
/**
 * Created by PhpStorm.
 * User: Lucho
 * Date: 03/08/2020
 * Time: 9:29
 */
if (isset($_POST['boton_imprimir'])){
    //onclick="window.print()";
}
?>
<div style="background: #e6f1fc; padding: 40px 250px" id="muestra">
<!-- Content Header (Page header) -->
    <section class="content">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <div class="col-xs-10">
                <center><h2>Lista de Pedidos Registradas</h2></center>
            </div>
        </div>
        <br>
        <div>
            <h3>Sistema Bufeo Reporte de Pedidos del <?php echo $fecha_i; ?> al <?php echo $fecha_f; ?></h3>
            <h3>Estado de Pedido:
                <?php
                if ($estadopedido == ""){
                    echo "TODO";
                } elseif($estadopedido == 1){
                    echo "ENTREGADO";
                } elseif ($estadopedido == 2){
                    echo "PENDIENTE";
                } else{
                    echo "CANCELADO";
                }

                ?>
            </h3>
            <h3>Usuario:    <?php
                if ($user == ""){
                    echo "TODO";
                } else{
                    echo $user;
                }?></h3>
            <div class="row">
                <div class="col-lg-12">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="text-capitalize">
                        <tr style="color: #902b2b">
                            <th>Fecha</th>
                            <th>Usuario Vendedor</th>
                            <th>Cliente</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Total de Venta</th>
                            <th>Estado de Pedido</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        foreach ($filtrousuario_excel as $fe){
                            ?>
                            <tr>

                                <td><?php echo $fe->saleproductgas_date; ?></td>
                                <td><?php echo $fe->user_nickname;?></td>
                                <td><?php echo $fe->client_name; ?></td>
                                <td><?php echo $fe->saleproductgas_direccion; ?></td>
                                <td><?php echo $fe->saleproductgas_telefono; ?></td>
                                <td><?php echo $fe->saleproductgas_total; ?></td>
                                <?php
                                if ($fe->saleproductgas_estado == 0){ ?>
                                    <td>CANCELADO</td>
                                <?php } elseif ($fe->saleproductgas_estado == 1){ ?>
                                    <td>ENTREGADO</td>
                                <?php } else { ?>
                                    <td>PENDIENTE</td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>

</div>
<center><button class="btn btn-primary" onclick="javascript:imprim2();" type="submit" ><i class="fa fa-print"></i> IMPRIMIR</button></center>
<script>
    function imprim2(){
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');
        mywindow.document.write('<html><head>');
        mywindow.document.write('<style>.example2{width:100%;border-collapse:collapse;margin:16px 0 16px 0;}.example2 th{border:1px solid #ddd;padding:4px;background-color:#d4eefd;text-align:left;font-size:15px;}.example2 td{border:1px solid #ddd;text-align:left;padding:6px;}</style>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(document.getElementById('muestra').innerHTML);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necesario para IE >= 10
        mywindow.focus(); // necesario para IE >= 10
        mywindow.print();
        mywindow.close();
        return true;}
</script>



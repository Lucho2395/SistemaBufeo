<?php
//nombre del archivo y charset
//header('Content-Type:text/csv; charset-latin1');


/*
 *
 * utf8_decode() para tildes

//Salida del archivo
$salida = fopen('php://output', 'w');
fputcsv( $salida, array('Sistema Bufeo', 'desde', 'hasta'));

fputcsv( $salida, array('', $fecha_i, $fecha_f));
//Encabezados
fputcsv($salida, array('Fecha', 'Usuario Vendedor', 'Cliente', 'Dirección', 'Telefono', 'Total de Venta', 'Estado de Pedido'));

//Salida del archivo
$salida = fopen('php://output', 'w');

foreach ($filtrousuario_excel as $fe){
    fputcsv($salida, array($fe->saleproductgas_date, $fe->user_nickname,
                            $fe->client_name, $fe->saleproductgas_direccion,
                            $fe->saleproductgas_telefono, $fe->saleproductgas_total
                            ));
}
/*while($r=$filtrousuario_excel){
    $salida .= 	"<tr><td>".$r->saleproductgas_date."</td>
			<td>".$r->user_nickname."</td>
			<td>".$r->client_name."</td>
			<td>".$r->saleproductgas_direccion."</td>
			<td>".$r->saleproductgas_telefono."</td>
			<td>".$r->saleproductgas_total."</td></tr>";
}*/
/*if(isset($_POST['boton_exportar_excel'])) {
    if(!empty($filtrousuario_excel)) {
        $filename =;
        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment; filename= “libros_filtro.xls”');
        $mostrar_columnas = false;
        foreach($filtrousuario_excel as $libro) {
            if(!$mostrar_columnas) {
                echo implode('\t', array_keys($libro)) . '\n';
                $mostrar_columnas = true;
            }
            echo implode('\t', array_values($libro)) . '\n';
        }
    }else{
        echo "No hay datos a exportar";
    }
    exit;
}*/
?>
<div>
    <h2>Sistema Bufeo Reporte de Pedidos del <?php echo $fecha_i; ?> al <?php echo $fecha_f; ?></h2>
    <h3>tipo de Estado:
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
    <table >
        <thead >
        <tr style="color: #902b2b">
            <th>Fecha</th>
            <th>Usuario Vendedor</th>
            <th>Cliente</th>
            <th><?php echo utf8_decode("Dirección"); ?></th>
            <th><?php echo utf8_decode("Teléfono"); ?></th>
            <th>Total de Venta</th>
            <th>Estado de Pedido</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $totaldedinero = 0;
        foreach ($filtrousuario_excel as $fe){
            $subtotal = round($fe->saleproductgas_total, 2);
            $totaldedinero = $totaldedinero + $subtotal;
            ?>
            <tr>
                <td><?php echo $fe->saleproductgas_date; ?></td>
                <td><?php echo utf8_decode($fe->user_nickname);?></td>
                <td><?php echo utf8_decode($fe->client_name); ?></td>
                <td><?php echo utf8_decode($fe->saleproductgas_direccion); ?></td>
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
    <div class="col-md-6">
        <center><h4>Total s/ <?php echo $totaldedinero; ?></h4></center>
    </div>
</div>
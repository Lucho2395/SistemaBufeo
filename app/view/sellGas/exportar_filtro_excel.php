<?php
//nombre del archivo y charset
header('Content-Type:text/csv; charset-latin1');
header('Content-Disposition: attachment; filename="Reporte_filtro_pedidos.csv"');

//Salida del archivo
$salida = fopen('php://output', 'w');

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

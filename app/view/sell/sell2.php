<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 19/04/2019
 * Time: 22:16
 */
?>
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Listado de Productos</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <table id="example3" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th style="width: 200px;">Producto</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>SubTotal</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($products as $product){
                            $productnamefull = $product->product_name . ' X ' . $product->product_unid . ' '. $product->product_unid_type;
                            ?>
                            <tr>
                                <td><?php echo $product->id_productforsale;?></td>
                                <td><?php echo $productnamefull;?></td>
                                <td><?php echo $product->product_stock;?></td>
                                <td>S/. <input type="text" class="form-control" onchange="onchangeundprice<?php echo $product->id_productforsale;?>()"  style="width: 80px;" onkeypress="return valida(event)" id="product_price<?php echo $product->id_productforsale;?>" value="<?php echo $product->product_price;?>"> </td>
                                <td><input type="text" class="form-control" onchange="onchangeund<?php echo $product->id_productforsale;?>()" style="width: 70px;" id="total_product<?php echo $product->id_productforsale;?>" onkeypress="return valida(event)" value="1"></td>
                                <td>S/. <input type="text" class="form-control" onchange="onchangetotalprice<?php echo $product->id_productforsale;?>()"  style="width: 80px;" id="total_price<?php echo $product->id_productforsale;?>" onkeypress="return valida(event)" value="<?php echo $product->product_price;?>"></td>
                                <td><a class="btn btn-success btn-xs" type="button" onclick="agregarProducto<?php echo $product->id_productforsale;?>(<?php echo $product->id_productforsale;?>, '<?php echo $productnamefull;?>',<?php echo $product->product_unid;?>,<?php echo $product->product_stock;?>)"><i class="fa fa-check-circle"></i> Elegir Producto</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--Modal para Clientes-->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Clientes Registrados</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <a style="float: right" href="<?php echo _SERVER_;?>Client/add" class="btn btn-danger"><i class="fa fa-pencil"></i> Cliente Nuevo</a>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="text-capitalize">
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>DNI ó RUC </th>
                            <th>Dirección</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $a = 1;
                        foreach ($clients as $m){
                            ?>
                            <tr>
                                <td><?php echo $m->client_name;?></td>
                                <td><?php echo $m->client_type;?></td>
                                <td><?php echo $m->client_number;?></td>
                                <td><?php echo $m->client_address;?></td>
                                <td><a type="button" class="btn btn-xs btn-success btne" onclick="agregarPersona('<?php echo $m->client_name;?>',<?php echo $m->client_number;?>,'<?php echo $m->client_address;?>')" ><i class="fa fa-check-circle"></i> Elegir Cliente</a></td>
                            </tr>
                            <?php
                            $a++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
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
    <section class="content" style="background-color: white;box-shadow: 10px 10px 5px #888888;border-radius: 30px; padding: 15px; margin: 50px; min-height: 500px">
        <div class="row">
            <div class="col-xs-12">
                <center><h3>VENTA DE PRODUCTOS</h3></center>
            </div>
        </div>
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-2">
                    <label for="client_number">DNI ó RUC:</label>
                    <input class="form-control" type="text" id="client_number" readonly value="11111111">
                </div>
                <div class="col-xs-4">
                    <label for="client_name">Nombre:</label>
                    <input class="form-control" type="text" id="client_name" readonly>
                </div>
                <div class="col-xs-2">
                    <label>Tipo de Venta</label>
                    <select id="type_sell" class="form-control">
                        <option value="BOLETA">BOLETA</option>
                        <option value="FACTURA">FACTURA</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-1"></div>
                <div class="col-xs-6">
                    <label for="client_address">Direccion:</label>
                    <input class="form-control" type="text" id="client_address" readonly>
                </div>
                <div class="col-xs-2">
                    <br>
                    <a class="btn btn-success" type="button"  data-toggle="modal" data-target="#basicModal"><i class="fa fa-search"></i> Buscar Cliente</a>
                </div>
            </div>
            <br>
            <!-- /.row (main row) -->
            <div id="table_products">

            </div>
    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#table_products').load('<?php echo _SERVER_;?>Sell/table_products');
    });


    <?php
    foreach ($products as $product){
        ?>
    function agregarProducto<?php echo $product->id_productforsale;?>(cod, producto, unids, stock) {
        var cant = $("#total_product<?php echo $product->id_productforsale;?>").val();
        var precio = $("#product_price<?php echo $product->id_productforsale;?>").val();
        var cadena = "codigo=" + cod +
            "&producto=" + producto +
            "&unids=" + unids +
            "&precio=" + precio +
            "&cantidad=" + cant;
        if(stock >= cant){
            $.ajax({
                type:"POST",
                url: urlweb + "api/Sell/addProduct",
                data : cadena,
                success:function (r) {
                    switch (r) {
                        case "1":
                            alertify.success('Producto Agregado');
                            $('#table_products').load(urlweb + 'Sell/table_products');
                            break;
                        case "2":
                            alertify.error('Hubo Un Error');
                            break;
                        case "3":
                            alertify.error('El Producto YA ESTA AGREGADO');
                            break;
                        default:
                            alertify.error('Hubo Un Error');
                            break;
                    }
                }
            });
        } else {
            alertify.error('NO HAY STOCK DISPONIBLE');
        }

    }

    function onchangeund<?php echo $product->id_productforsale;?>() {
        var cant = $("#total_product<?php echo $product->id_productforsale;?>").val();
        var precio = $("#product_price<?php echo $product->id_productforsale;?>").val();
        var subtotal = cant * precio;
        subtotal.toFixed(2);
        $("#total_price<?php echo $product->id_productforsale;?>").val(subtotal);
    }

    function onchangeundprice<?php echo $product->id_productforsale;?>() {
        var cant = $("#total_product<?php echo $product->id_productforsale;?>").val();
        var precio = $("#product_price<?php echo $product->id_productforsale;?>").val();
        var subtotal = cant * precio;
        subtotal.toFixed(2);
        subtotal = parseFloat(subtotal);
        $("#total_price<?php echo $product->id_productforsale;?>").val(subtotal);
    }

    function onchangetotalprice<?php echo $product->id_productforsale;?>() {
        var subtotal = $("#total_price<?php echo $product->id_productforsale;?>").val();
        var cant = $("#total_product<?php echo $product->id_productforsale;?>").val();
        var precio = subtotal / cant;
        precio.toFixed(2);
        $("#product_price<?php echo $product->id_productforsale;?>").val(precio);
    }
    <?php
    }
    ?>



    function recargar_productos() {
        $('#table_products').load('<?php echo _SERVER_;?>Sell/table_products');
    }
</script>

<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>sell.js"></script>

<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 16/05/2019
 * Time: 22:02
 */
?>
<!--modal producto-->
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
                            <th>Tipo de IGV</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($products as $product){
                            $productnamefull = $product->product_name //. ' ' . $product->medida_codigo_unidad;//' X ' . $product->product_unid . ' '. $product->product_unid_type;
                            ?>
                            <tr>
                                <td><?php echo $product->id_productforsale;?></td>
                                <td><?php echo $productnamefull;?></td>
                                <td><?php echo $product->product_stock;?></td>
                                <td>S/. <input type="text" class="form-control" onchange="onchangeundprice<?php echo $product->id_productforsale;?>()"  style="width: 80px;" onkeypress="return valida(event)" id="product_price<?php echo $product->id_productforsale;?>" value="<?php echo $product->product_price;?>"> </td>
                                <td><input type="text" class="form-control" onchange="onchangeund<?php echo $product->id_productforsale;?>()" style="width: 70px;" id="total_product<?php echo $product->id_productforsale;?>" onkeypress="return valida(event)" value="1"></td>
                                <td>S/. <input type="text" class="form-control" onchange="onchangetotalprice<?php echo $product->id_productforsale;?>()"  style="width: 80px;" id="total_price<?php echo $product->id_productforsale;?>" onkeypress="return valida(event)" value="<?php echo $product->product_price;?>"></td>
                                <td><?php $igv = $this->igv_tipo->listAll(); ?>
                                    <select class="form-control" id="tipo_igv<?php echo $product->id_productforsale;?>" style="background: #C1BDBD; color: #000000" >
                                        <?php
                                        foreach ($igv as $ig){
                                            ?>
                                            <option <?php echo ($ig->id_igv == 2) ? 'selected' : '';?> value="<?php echo $ig->id_igv;?>"><?php echo $ig->tipodeafectacion_igv;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><a class="btn btn-success btn-xs" type="button" onclick="agregarProducto<?php echo $product->id_productforsale;?>(<?php echo $product->id_productforsale;?>, '<?php echo $productnamefull;?>',<?php echo $product->product_unid_type;?>,<?php echo $product->product_stock;?>, tipo_igv)"><i class="fa fa-check-circle"></i> Elegir Producto</a></td>
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
                                <td><a type="button" class="btn btn-xs btn-success btne" onclick="agregarPersona('<?php echo $m->client_name;?>','<?php echo $m->client_number;?>','<?php echo $m->client_telephone;?>','<?php echo $m->client_address;?>')" ><i class="fa fa-check-circle"></i> Elegir Cliente</a></td>
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
                <select  id="type_sell" class="form-control">
                    <option value="BOLETA">BOLETA</option>
                    <option value="FACTURA">FACTURA</option>
                </select>
            </div>
            <div class="col-xs-2">
                <label>Naturaleza</label>
                <select id="naturaleza_sell" class="form-control" onchange="onchangenaturaleza(this.value)" >
                    <option value="OFICINA">OFICINA</option>
                    <option value="PEDIDO">PEDIDO</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-6">
                <label for="client_address">Direccion:</label>
                <input class="form-control" type="text" id="client_address" >
            </div>
            <div class="col-xs-2">
                <br>
                <a class="btn btn-success" type="button"  data-toggle="modal" data-target="#basicModal"><i class="fa fa-search"></i> Buscar Cliente</a>
            </div>
            <div class="col-xs-2">
                <label for="client_telefono">Telefono:</label>
                <input class="form-control" type="text" id="client_telefono" onkeypress="return valida(event);">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-2">
                <label for="client_address">Código de Barra:</label>
                <input class="form-control" type="text" id="product_barcode" onchange="buscar_producto_barcode()">
            </div>
            <div class="col-xs-5">
                <label for="client_address">Nombre Producto:</label>
                <input class="form-control" type="text" id="product_nameb" readonly>
            </div>
            <div class="col-xs-3">
                <br>
                <a class="btn btn-warning" type="button" onclick="buscar_producto_barcode()" ><i class="fa fa-search"></i> Buscar</a> <!--onchange="buscar()" para selecionar el estado-->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-2">
                <label for="client_address">Cód. Producto:</label>
                <input class="form-control" type="text" id="id_productforsaleb" readonly>
            </div>
            <div class="col-xs-1">
                <label for="client_address">Stock:</label>
                <input class="form-control" type="text" id="product_stockb" readonly>
            </div>
            <div class="col-xs-1">
                <label for="client_address">Cantidad:</label>
                <input class="form-control" type="text" id="product_cantb" onchange="onchangeundZ()" value="1" onkeypress="return valida(event);"> <!--solo permite agregar numeros-->
            </div>
            <div class="col-xs-1">
                <label for="client_address">Precio(S/.):</label><br>
                <input class="form-control" type="text"  onchange="onchangeundpriceZ()" id="product_priceb">
            </div>
            <div class="col-xs-1">
                <label for="client_address">Total(S/.):</label><br>
                <input class="form-control" type="text" id="product_totalb" onchange="onchangetotalpriceZ()">
            </div>
            <div class="col-xs-2">
                <label for="tipo_igv">Tipo de IGV</label><br>
                <?php $igv = $this->igv_tipo->listAll(); ?>
                <select class="form-control" id="tipo_igv" style="background: #C1BDBD; color: #000000" >
                    <?php
                    foreach ($igv as $ig){
                        ?>
                        <option <?php echo ($ig->id_igv == 3) ? 'selected' : '';?> value="<?php echo $ig->id_igv;?>"><?php echo $ig->tipodeafectacion_igv;?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-xs-1">
                <br>
                <a class="btn btn-success" type="button" onclick="agregarProductoZ()" ><i class="fa fa-plus"></i> Agregar</a>
            </div>

        </div>
        <br>
        <!-- /.row (main row) -->
        <div id="table_products">

        </div>
        <div class="row"  >
            <div class="col-lg-8"></div>
            <div class="col-lg-4">
                <a type="button" id = "btn_generarventa" class="btn btn-danger" onclick="preguntarSiNo()" >
                    <i class="fa fa-money"></i> Generar Venta</a>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#table_products').load('<?php echo _SERVER_;?>SellGas/table_productsGas');
        $("#product_barcode").focus(); //Con focus el cursor en el elemento indicado
    });
    var productfull = "";
    var unid = "";

    function buscar_producto_barcode() {
        var valor = "correcto";
        var product_barcode = $('#product_barcode').val();
        if(product_barcode == ""){
            alertify.error('El campo Código de Barra está vacío');
            $('#product_barcode').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#product_barcode').css('border','');
        }

        if (valor == "correcto"){
            var cadena = "product_barcode=" + product_barcode;
            $.ajax({
                type:"POST",
                url: urlweb + "api/SellGas/search_by_barcode",
                data: cadena,
                success:function (r) {
                    if(r=="2"){
                        alertify.error("ERROR O PRODUCTO NO REGISTRADO");
                        $('#product_nameb').val('');
                        $('#id_productforsaleb').val('');
                        $('#product_stockb').val('');
                        $('#product_priceb').val('');
                        $('#product_totalb').val('');
                        $('#product_cantb').val(1);
                        productfull = "";
                        unid = "";
                    } else {
                        var productoinfo = r.split('|');
                        var fullproductname = productoinfo[0];
                        productfull = fullproductname;
                        unid =  productoinfo[1];
                        $('#product_nameb').val(fullproductname);
                        $('#id_productforsaleb').val(productoinfo[3]);
                        $('#product_stockb').val(productoinfo[2]);
                        $('#product_priceb').val(productoinfo[5]);
                        $('#product_totalb').val(productoinfo[5]);
                        $('#product_cantb').val(1);
                        alertify.success('PRODUCTO ENCONTRADO');
                    }
                }
            });
        }
    }

    function onchangeundZ() {
        var cant = $("#product_cantb").val();
        var precio = $("#product_priceb").val();
        var subtotal = cant * precio;
        subtotal.toFixed(2);
        $("#product_totalb").val(subtotal);
    }

    function onchangeundpriceZ() {
        var cant = $("#product_cantb").val();
        var precio = $("#product_priceb").val();
        var subtotal = cant * precio;
        subtotal.toFixed(2);
        subtotal = parseFloat(subtotal);
        $("#product_totalb").val(subtotal);
    }

    function onchangetotalpriceZ() {
        var subtotal = $("#product_totalb").val();
        var cant = $("#product_cantb").val();
        var precio = subtotal / cant;
        precio.toFixed(2);
        $("#product_priceb").val(precio);
    }

    function agregarProductoZ() {
        var cod = $('#id_productforsaleb').val();
        var cant = $("#product_cantb").val() * 1;
        var precio = $("#product_priceb").val() * 1;
        var stock = $("#product_stockb").val() * 1;
        var tipo_igv = $("#tipo_igv").val();
        var cadena = "codigo=" + cod +
            "&producto=" + productfull +
            "&unids=" + unid +
            "&precio=" + precio +
            "&cantidad=" + cant +
            "&tipo_igv=" + tipo_igv;

        if(stock >= cant){
            $.ajax({
                type:"POST",
                url: urlweb + "api/SellGas/addProductGas",
                data : cadena,

                success:function (r) {
                    switch (r) {
                        case "1":
                            alertify.success('Producto Agregado');
                            $('#table_products').load(urlweb + 'SellGas/table_productsGas');
                            $('#product_nameb').val('');
                            $('#id_productforsaleb').val('');
                            $('#product_stockb').val('');
                            $('#product_priceb').val('');
                            $('#product_totalb').val('');

                            $('#product_barcode').val('');
                            productfull = "";
                            unid = "";
                            $("#product_barcode").focus();
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


    <?php
    foreach ($products as $product){
    ?>
    function agregarProducto<?php echo $product->id_productforsale;?>(cod, producto, unids, stock) {
        var cant = $("#total_product<?php echo $product->id_productforsale;?>").val() * 1;
        var precio = $("#product_price<?php echo $product->id_productforsale;?>").val() * 1;
        var tipo_igv = $("#tipo_igv<?php echo $product->id_productforsale;?>").val() * 1;
        var cadena = "codigo=" + cod +
            "&producto=" + producto +
            "&unids=" + unids +
            "&precio=" + precio +
            "&tipo_igv=" + tipo_igv +
            "&cantidad=" + cant;
        if(stock >= cant){
            $.ajax({
                type:"POST",
                url: urlweb + "api/SellGas/addProductGas",
                data : cadena,
                success:function (r) {
                    switch (r) {
                        case "1":
                            alertify.success('Producto Agregado');
                            $('#table_products').load(urlweb + 'SellGas/table_productsGas');
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

    function onchangenaturaleza(valor) {
        if(valor == "OFICINA"){
            $("#btn_generarventa").html('<i class="fa fa-money"></i> Generar Venta'); //se muestra este ID
        } else{
            $("#btn_generarventa").html('<i class="fa fa-money"></i> Generar Pedido'); //se muestra este ID
        }
    }


    function recargar_productos() {
        $('#table_products').load('<?php echo _SERVER_;?>SellGas/table_productsGas');
    }
</script>

<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>sellGas.js"></script>


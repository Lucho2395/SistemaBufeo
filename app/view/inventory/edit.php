<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 31/10/2018
 * Time: 7:44
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventario
            <small>Editar Producto</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inventario</a></li>
            <li><a href="#">Editar</a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Inventory/listProducts" >Volver</a>
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
                        <h3 class="box-title">Producto a Editar</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >Nombre Producto</label>
                                <input type="text" class="form-control" id="product_name" placeholder="Ingresar Nombre Producto..." value="<?php echo $product->product_name;?>">
                            </div>
                            <div class="form-group">
                                <label >Código de Barra</label>
                                <input type="text" class="form-control" id="product_barcode" placeholder="Ingresar Código de Barra..." value="<?php echo $product->product_barcode;?>" >
                            </div>
                            <div class="form-group">
                                <label >Categoría Producto</label>
                                <select class="form-control" id="id_categoryp">
                                    <option value="">Seleccione Una Categoría...</option>
                                    <?php
                                    foreach ($categoryp as $ca){
                                        ?>
                                        <option <?php echo ($ca->id_categoryp == $product->id_categoryp) ? 'selected' : '';?> value="<?php echo $ca->id_categoryp;?>"><?php echo $ca->categoryp_name;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Proveedor del Producto</label>
                                <select class="form-control" id="id_proveedor">
                                    <option value="">Seleccione Un Proveedor...</option>
                                    <?php
                                    foreach ($proveedor as $pro){
                                        ?>
                                        <option <?php echo ($pro->id_proveedor == $product->id_proveedor) ? 'selected' : '';?> value="<?php echo $pro->id_proveedor;?>"><?php echo $pro->nombre_provee; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label >Descripcion Producto</label>
                                <input type="text" class="form-control" id="product_description" placeholder="Ingresar Descripción Producto..." value="<?php echo $product->product_description;?>">
                            </div>
                            <div class="form-group">
                                <label >Unidad de Medida</label>
                                <select class="form-control" id="tipo_medida">
                                    <option value="">Seleccione Una unidad de medida...</option>
                                    <?php
                                    foreach ($unimedida as $um){
                                        ?>
                                        <option <?php echo ($um->medida_id == $product->product_unid_type) ? 'selected' : '';?> value="<?php echo $um->medida_id;?>"><?php echo $um->medida_nombre;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Stock Producto</label>
                                <input type="text" class="form-control" onkeypress="return valida(event)"  id="product_stock" placeholder="Ingresar Stock Producto..." value="<?php echo $product->product_stock;?>" readonly>
                            </div>
                            <div class="form-group">
                                <label >Precio Por Unidad</label>
                                <input type="text" class="form-control" id="product_price" placeholder="Ingresar Precio Producto..." value="<?php echo $product->product_price;?>" onkeypress="return valida(event)">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="edit()">Editar Producto</button>
                        </div>
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

<script type="text/javascript">
    function edit() {
        var valor = "correcto";
        var id_product = <?php echo $product->id_product;?>;
        var product_name = $('#product_name').val();
        var id_categoryp = $('#id_categoryp').val();
        var id_proveedor = <?php echo $product->id_proveedor;?>;
        var product_barcode = $('#product_barcode').val();
        var product_description = $('#product_description').val();
        var product_unid_type = $('#tipo_medida').val();
        var product_stock = <?php echo $product->product_stock;?>;
        var product_price = $('#product_price').val();

        if(product_name == ""){
            alertify.error('El campo Nombre Producto está vacío');
            $('#product_name').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#product_name').css('border','');
        }

        if(id_categoryp == ""){
            alertify.error('No ha seleccionado una categoría para el producto.');
            $('#id_categoryp').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#id_categoryp').css('border','');
        }

        if(product_barcode == ""){
            alertify.error('El campo Código de Barra está vacío');
            $('#product_barcode').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#product_barcode').css('border','');
        }

        if(product_description == ""){
            alertify.error('El campo Description Producto está vacío');
            $('#product_description').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#product_description').css('border','');
        }

        if(product_unid_type == ""){
            alertify.error('El campo Tipo de Unidad del Producto está vacío');
            $('#tipo_medida').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#tipo_medida').css('border','');
        }

        if(product_price == ""){
            alertify.error('El campo Precio Por Unidad está vacío');
            $('#product_price').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#product_price').css('border','');
        }

        if (valor == "correcto"){
            var cadena = "id_product=" + id_product +
                "&product_name=" + product_name +
                "&id_proveedor=" + id_proveedor +
                "&id_categoryp=" + id_categoryp +
                "&product_barcode=" + product_barcode +
                "&product_description=" + product_description +
                "&product_unid_type=" + product_unid_type +
                "&product_stock=" + product_stock +
                "&product_price=" + product_price;
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/Inventory/saveProductwithprice",
                data: cadena,
                success:function (r) {
                if(r==1){
                    alertify.success("Se envió chevere");
                    location.href = '<?php echo _SERVER_;?>Inventory/listProducts';
                } else if(r==2){
                    alertify.error("Fallo el envio");
                } else {
                    alertify.error("el codigo del producto ya esta registrado");
                    $('#product_barcode').css('border','solid red');
                }
            }
            });
        }

    }

</script>
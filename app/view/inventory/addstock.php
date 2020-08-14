<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 02/11/2018
 * Time: 0:36
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventario
            <small>Agregar Producto Stock</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inventario</a></li>
            <li><a href="#">Agregar Stock</a></li>
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
                        <h3 class="box-title">Producto a Agregar Stock</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label >Nombre Producto</label>
                                <input type="text" class="form-control" id="product_name" placeholder="Ingresar Nombre Producto..." value="<?php echo $product->product_name;?>" readonly>
                            </div>
                            <div class="form-group">
                                <label >Stock Actual</label>
                                <input type="text" class="form-control" id="product_stockactual"  value="<?php echo $product->product_stock;?>" readonly>
                            </div>
                            <div class="form-group">
                                <label >Stock A Agregar</label>
                                <input type="text" class="form-control" id="product_stock"  onkeypress="return valida(event)" placeholder="Ingresar Stock Producto..." value="0" >
                            </div>
                            <div class="form-group">
                                <label >Guia de Ingreso</label>
                                <input type="text" class="form-control" id="stocklog_guide" readonly value="<?php echo 'GE-'.$fechahoy.'-'.$correlative->correlative_in; ?>" placeholder="Ingresar Guia de Ingreso de Producto..." >
                            </div>
                            <div class="form-group">
                                <label >Descripción</label>
                                <input type="text" class="form-control" value="--" id="stocklog_description" placeholder="Ingresar Descripción..." >
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="edit()">Agregar Stock</button>
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
        var product_stock = $('#product_stock').val();
        var stocklog_guide = $('#stocklog_guide').val();
        var stocklog_description = $('#stocklog_description').val();

        if(product_name == ""){
            alertify.error('El campo Nombre Producto está vacío');
            $('#product_name').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#product_name').css('border','');
        }


        if(product_stock == ""){
            alertify.error('El campo Stock Producto está vacío');
            $('#product_stock').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#product_stock').css('border','');
        }

        if(stocklog_guide == ""){
            alertify.error('El campo Guia de Entrada está vacío');
            $('#stocklog_guide').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#stocklog_guide').css('border','');
        }

        if (valor == "correcto"){
            var cadena = "id_product=" + id_product +
                "&product_stock=" + product_stock +
                "&stocklog_guide=" + stocklog_guide +
                "&stocklog_description=" + stocklog_description;
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/Inventory/saveProductstock",
                data: cadena,
                success:function (r) {
                    if(r==1){
                        alertify.success("Se envió chevere");
                        location.href = '<?php echo _SERVER_;?>Inventory/listProducts';
                    } else {
                        alertify.error("Fallo el envio");
                    }
                }
            });
        }

    }

</script>

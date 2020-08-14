<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 29/04/2019
 * Time: 19:28
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inventario
            <small>Registrar Salida Stock</small>
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
                        <h3 class="box-title">Salida del Producto</h3>
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
                                <label >Stock de Salida</label>
                                <input type="text" class="form-control" id="stockout_out"  onkeypress="return valida(event)" placeholder="Ingresar Stock Producto..." value="0" >
                            </div>
                            <div class="form-group">
                                <label >Guia de Remisión</label>
                                <input type="text" class="form-control" readonly id="stockout_guide" value="<?php echo 'GS-'.$fechahoy.'-'.$correlative->correlative_out; ?>" placeholder="Ingresar Guia de Remisión..." >
                            </div>
                            <div class="form-group">
                                <label >Origen</label>
                                <input type="text" class="form-control" id="stockout_origin" placeholder="Ingresar Origen..." >
                            </div>
                            <div class="form-group">
                                <label >Descripción</label>
                                <input type="text" class="form-control" id="stockout_description" placeholder="Ingresar Descripción..." >
                            </div>
                            <div class="form-group">
                                <label >Destino</label>
                                <input type="text" class="form-control" id="stockout_destiny" placeholder="Ingresar Destino..." >
                            </div>
                            <div class="form-group">
                                <label >RUC</label>
                                <input type="text" class="form-control" id="stockout_ruc" placeholder="Ingresar RUC..." >
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" onclick="edit()">Registrar Salida Stock</button>
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
        var stockout_out = $('#stockout_out').val();
        var stockout_guide = $('#stockout_guide').val();
        var stockout_description = $('#stockout_description').val();
        var stockout_ruc = $('#stockout_ruc').val();
        var stockout_origin = $('#stockout_origin').val();
        var stockout_destiny = $('#stockout_destiny').val();

        if(product_name == ""){
            alertify.error('El campo Nombre Producto está vacío');
            $('#product_name').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#product_name').css('border','');
        }


        if(stockout_out == ""){
            alertify.error('El campo Stock de Salida está vacío');
            $('#stockout_out').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#stockout_out').css('border','');
        }

        if(stockout_guide == ""){
            alertify.error('El campo Guia de Remisión está vacío');
            $('#stockout_guide').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#stockout_guide').css('border','');
        }

        if(stockout_ruc == ""){
            alertify.error('El campo Ruc está vacío');
            $('#stockout_ruc').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#stockout_ruc').css('border','');
        }

        if(stockout_origin == ""){
            alertify.error('El campo Origen está vacío');
            $('#stockout_origin').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#stockout_origin').css('border','');
        }

        if(stockout_destiny == ""){
            alertify.error('El campo Destino está vacío');
            $('#stockout_destiny').css('border','solid red');
            valor = "incorrecto";
        } else {
            $('#stockout_destiny').css('border','');
        }

        if (valor == "correcto"){
            var cadena = "id_product=" + id_product +
                "&product_stock=" + stockout_out +
                "&stockout_guide=" + stockout_guide +
                "&stockout_description=" + stockout_description +
                "&stockout_ruc=" + stockout_ruc +
                "&stockout_destiny=" + stockout_destiny +
                "&stockout_origin=" + stockout_origin;
            $.ajax({
                type:"POST",
                url:"<?php echo _SERVER_;?>api/Inventory/saveoutProductstock",
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

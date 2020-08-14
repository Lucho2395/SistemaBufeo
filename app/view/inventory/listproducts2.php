<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 22/04/2019
 * Time: 22:33
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
                <center><h2>Gestión de Productos</h2></center>
            </div>
            <div class="col-xs-2">
                <center><a class="btn btn-block btn-success btn-sm" href="<?php echo _SERVER_;?>Inventory/addProduct" ><i class="fa fa-plus"></i> Agregar Nuevo</a></center>
            </div>
        </div>
        <br>
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-lg-12">
                <table id="example3" class="table table-bordered table-hover">
                    <thead class="text-capitalize">
                    <tr>
                        <th>Nombre</th>
                        <th>Proveedor</th>
                        <th>Categoría</th>
                        <th>Código de Barras</th>
                        <!--<th>Descripción Producto</th>-->
                        <th>Tipo de Unidad</th>
                        <th>Precio Unitario</th>
                        <th>Stock</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($products as $product){
                        ?>
                        <tr>
                            <td><?php echo $product->product_name;?></td>
                            <td><?php echo $product->nombre_provee;?></td>
                            <td><?php echo $product->categoryp_name;?></td>
                            <td><?php echo $product->product_barcode;?></td>
                            <!--<td><?php echo $product->product_description;?></td>-->
                            <td><?php echo $product->product_unid_type;?></td>
                            <td>S/. <?php echo $product->product_price;?></td>
                            <td><?php echo $product->product_stock;?></td>
                            <td><a class="btn btn-chico btn-warning btn-xs" type="button" href="<?php echo _SERVER_;?>Inventory/editProduct/<?php echo $product->id_product;?>"><i class="fa fa-pencil"></i> Editar</a><a class="btn btn-chico btn-danger btn-xs" onclick="preguntarSiNo(<?php echo $product->id_product;?>)"><i class="fa fa-times"></i> Eliminar</a><a class="btn btn-info btn-xs" href="<?php echo _SERVER_;?>Inventory/addProductstock/<?php echo $product->id_product;?>"><i class="fa fa-sort-numeric-asc"></i> Agregar Stock</a><a class="btn btn-primary btn-xs" href="<?php echo _SERVER_;?>Inventory/outProductstock/<?php echo $product->id_product;?>"><i class="fa fa-eraser"></i>Salida Stock</a>
                            </td>
                        </tr>
                        <!--<a class="btn btn-dropbox btn-xs" href="<?php echo _SERVER_;?>Inventory/productForsale/<?php echo $product->id_product;?>"><i class="fa fa-money"></i>  Ver Costo Venta</a>-->
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Proveedor</th>
                        <th>Categoría</th>
                        <th>Código de Barras</th>
                        <th>Tipo de Unidad</th>
                        <th>Precio Unitario</th>
                        <th>Stock</th>
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
<script src="<?php echo _SERVER_ . _JS_;?>inventory.js"></script>

<?php
/**
 * Created by PhpStorm
 * User: Franz
 * Date: 18/04/2019
 * Time: 21:05
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
            <li><a href="#"><?php echo $_SESSION['accion'];?></a></li>
            <a class="btn btn-chico btn-default btn-xs" href="<?php echo _SERVER_;?>Client/all" >Volver</a>
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
                        <h4 class="header-title">Editar Cliente</h4>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-form-label">Tipo de Documento</label>
                                <select id="tipò_documento" class="form-control">
                                    <option value="">Seleccione el tipo de documento...</option>
                                    <?php
                                    foreach ($tipodocumento as $tipo){
                                        ?>
                                        <option <?php echo ($tipo->id_tipodocumento == $client->id_tipodocumento) ? 'selected' : '';?> value="<?php echo $tipo->id_tipodocumento; ?>"><?php echo $tipo->tipodocumento_identidad; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Nombre del Cliente</label>
                                <input type="text" class="form-control" id="client_name" placeholder="Ingresar Nombre del Cliente..." value="<?php echo $client->client_name;?>">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Tipo de Cliente</label>
                                <input type="text" class="form-control" id="client_type" value="<?php echo $client->client_type;?>" >
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">RUC ó DNI</label>
                                <input type="text" class="form-control" id="client_number" placeholder="Ingresar Número..." value="<?php echo $client->client_number;?>" onkeypress="return valida(event)" >
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Dirección</label>
                                <input type="text" class="form-control" id="client_address" placeholder="Ingresar Dirección..." value="<?php echo $client->client_address;?>">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Teléfono o Celular</label>
                                <input type="text" class="form-control" id="client_telephone" placeholder="Ingresar Teléfono..." value="<?php echo $client->client_telephone;?>" onkeypress="return valida(event)">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" onclick="save()">Editar Cliente</button>
                            </div>
                        </div>
                        <!-- /.box-body -->
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
<script src="<?php echo _SERVER_ . _JS_;?>client.js"></script>

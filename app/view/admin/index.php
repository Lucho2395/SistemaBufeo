
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inicio
        <small>Panel Principal</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $users;?></h3>

              <p>Usuarios Registrados</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">Usuarios del Sistema <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!--<div class="col-lg-4 col-xs-12">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>S/. <?php echo $final_report;?></h3>

              <p>Ganancias Del Dia</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="<?php echo _SERVER_;?>Report/day" class="small-box-footer">Ver Más <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>-->

          <div class="col-lg-6 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-aqua">
                  <div class="inner">
                      <h3>S/. <?php echo $open_status;?></h3>

                      <p>Dinero Total En Caja</p>
                  </div>
                  <div class="icon">
                      <i class="fa fa-line-chart"></i>
                  </div>
                  <a href="<?php echo _SERVER_;?>Report/day" class="small-box-footer">Ver Más <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-lg-12">
            <center><h2>Bienvenido al Sistema de Administracion</h2></center>
            <center><h4>Su rol de Usuario es: <?php echo $this->crypt->decrypt($_COOKIE['role_name'],_PASS_) ?? $this->crypt->decrypt($_SESSION['role_name'],_PASS_);?></h4></center>
        </div>
      </div>
        <?php
        if(!$open){
            ?>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="align-content: center">
                    <!-- general form elements -->
                    <div class="box box-primary" style="align-content: center">
                        <div class="box-header with-border">
                            <h3 class="box-title">Apertura de Caja</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div>
                            <div class="box-body">
                                <div class="form-group" style="align-content: center">
                                    <label>Dia de Hoy</label>
                                </div>
                                <div class="form-group" style="align-content: center">
                                    <label >Monto de Apertura de Caja Para Hoy <?php echo date('Y-m-d');?></label>
                                    <input type="text" class="form-control" id="turn_inicialcash" onkeypress="return valida(event)" >
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer" style="align-content: center">
                                <button class="btn btn-primary" onclick="add()">Aperturar Caja</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <?php
        } else {
            $mountopen = $this->turn->cashopenBox($turn->id_turn);
            ?>
            <br>
            <div class="row" style="text-align: center;">
                <h3>El Monto de Apertura de Caja para Hoy Día es: S/. <?php echo $mountopen;?></h3>
            </div>
            <?php
        }
        ?>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
  <script type="text/javascript">
      function add() {
          var valor = "correcto";
          var turn_inicialcash = $('#turn_inicialcash').val();

          if(turn_inicialcash == ""){
              alertify.error('El campo Monto de Apertura está vacío');
              $('#turn_inicialcash').css('border','solid red');
              valor = "incorrecto";
          } else {
              $('#turn_inicialcash').css('border','');
          }

          if (valor == "correcto"){
              var cadena = "turn_inicialcash=" + turn_inicialcash;
              $.ajax({
                  type:"POST",
                  url:"<?php echo _SERVER_;?>api/Admin/openBox",
                  data: cadena,
                  success:function (r) {
                      switch (r) {
                          case "1":
                              alertify.success("Se Apertutó La Caja");
                              location.href = '<?php echo _SERVER_;?>Admin/index';
                              break;
                          case "2":
                              alertify.error("Fallo el envio");
                              break;
                          default:
                              alertify.error("Fallo el envio");
                              break;
                      }
                  }
              });
          }

      }
  </script>

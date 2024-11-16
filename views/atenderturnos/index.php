
<?php include('includes/header.php');
require_once "config/funciones.php";
$turnosespera = turnos_en_espera();
$turnosatendidos = turnos_atendidos();



?>

<section class="content-header">
      <h1>
      Gestionar Turno
      </h1>
      <ol class="breadcrumb">
        <li><a href="start.php"><i class="fa fa-dashboard"></i>Inicio</a></li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
<!-- SELECT2 EXAMPLE -->

<div class="row">
  <div class="col-md-6">

    <div class="box box-danger">
      <div class="box-header">
        <h3 class="box-title">Datos del Turno</h3>
    <a class="btn btn-danger btn-flat pull-right" href="" title="Agregar" data-toggle="modal" data-target="#verturnosactivosypendientes"><i class="fa fa-eye"></i>Turnos Atendidos</a>
      </div>
      <div class="box-body">
      <?php include("pages/generaturno/turnosatendidos.php");?>
              <!-- /.widget-user-image -->
              MODULO : <span id="modulo" class="bg-green"><?php echo $_SESSION['modulo']; ?></span>
             TRAMITE : <span id="tramite" class="bg-yellow"><?php echo $_SESSION['nombre_servicio']; ?></span>
           USUARIO : <span id="usuario" class="bg-aqua"><?php echo $_SESSION['usuario']; ?></span>
            
 <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@        -->
 <div class="ocultar2">
 <div class="form-group">
        <div class="row">
 <div class="col-xs-12">
          <div class="bg-purple">
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">TURNO : <span id="turno"></span> -- <span id="iddelturno"></span></h3>
            </div>
        </div>
        </div>
        </div>
 <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
        
        <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
        <div class="form-group">
        <div class="row">
                <div class="col-xs-6">
                <label>Estado del Turno</label>
                <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-lightbulb-o"></i>
            </div>
            <input type="text" class="form-control" name="estado_turno" id="estado_turno" readonly>
          </div>
                </div>
                <div class="col-xs-6">
                <label>Tiempo de Ingreso</label>
                <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-hourglass-2"></i>
            </div>
            <input type="text" class="form-control" name="tiempo_ingreso" id="tiempo_ingreso" readonly>
          </div>
                </div>
              </div>
        </div>
        <div class="form-group">
        <div class="row">
                <div class="col-xs-12">
                <label>Nombre del Afiliado</label>
                <div class="input-group">
            <div class="input-group-addon">
              <i class="fa  fa-user"></i>
            </div>
            <input type="text" class="form-control"  name="pnombre" id="pnombre" readonly>
          </div>
                </div>
              </div>
        </div>

        </div>
      <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
        <div class="form-group">
        <div class="row">
        <div class="col-xs-4">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $turnosespera['numero']; ?></h3>

              <p>Turnos en espera</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
              Ver <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-xs-4">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $turnosatendidos['numero']; ?></h3>

              <p>Turnos Atendidos</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
              Ver<i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-xs-4">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $turnosespera['numero'] + $turnosatendidos['numero']; ?></h3>

              <p>Turnos totales</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
              Ver <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
              </div>
        </div>

        
        <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
       

      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->


  </div>
  <!-- /.col (left) -->
  <div class="col-md-6">
    <div class="box box-danger">
      <div class="box-header">
        <h3 class="box-title">Gestionar Turno</h3>
      </div>
      <div class="box-body">
<!-- ----------------------------------------------------------------------------------------------------------         -->


 

<!-- -------------------------------------------------------------------------------------------------------------- -->

        <div class="form-group llamar_turno">
<div class="row">
        <div class="col-md-7 col-sm-6 col-xs-12" style="left: 120px;">
          <button id="llamar_turno_nuevo" class="btn btn-danger">
            <span class="info-box-icon"><i class="fa fa-arrow-circle-right"></i></span>

            <div class="info-box-content">
              <span  class="info-box-number"><h1>LLAMAR</h1></span>
            </div>
          
          </button>
         
        </div>
        </div>
</div>
       
        <div class="form-group atender_turno">
<div class="row">
        <div class="col-md-7 col-sm-6 col-xs-12" style="left: 120px;">
          <button id="atender_turno_nuevo" class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-check-square"></i></span>

            <div class="info-box-content">
              <span class="info-box-number"><h1>ATENDER</h1></span>
            </div>
            <!-- /.info-box-content -->
          </button>
          <!-- /.info-box -->
        </div>
</div>
        </div>
        
        <div class="form-group finalizar_turno">
<div class="row">
        <div class="col-md-7 col-sm-6 col-xs-12" style="left: 120px;">
          <button id="finalizar_turno_nuevo" class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-times-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-number"><h1>Finalizar</h1></span>
            </div>
            <!-- /.info-box-content -->
          </button>
          <!-- /.info-box -->
        </div>
</div>
        </div>
    
        
      </div>
      
    </div>
    <!-- /.box -->
  </div>  
  <!-- /.col (right) -->
</div>


<!-- --------------------------------------------------------------------- -->

</section>
<!-- /.content -->

<?php include('includes/footer.php');?>
<script src="ajax/llamar_turnos/llamar_turnos.js"></script>


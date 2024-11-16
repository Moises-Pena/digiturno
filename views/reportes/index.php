<?php
require "../template/header.php";
?>

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card mb-4">
    <h5 class="card-header">Reporte de Turnos</h5>
    <div class="card-body">

      <div class="row mb-4">
        <div class="col-4">
          <input type="date" id="fechainicio" name="fechainicio" class="form-control"/>
        </div>
        <div class="col-4">
          <input type="date" id="fechafin" name="fechafin" class="form-control"/>
        </div>
        <div class="col-4">
          <button type="button" onclick="Generar_reporte()" class="btn btn-primary float-right">Generar</button>
        </div>
      </div>
      <div id="verdatosreportes">
      <div class="text-center">
         <button class="btn btn-success" onclick="Descargar_Reporte()">Descargar Reporte</button>
        </div>
      <div class="card-datatable table-responsive">
                <table class="datatables-basic table border-top" id="Tablareportes" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th>Estado</th>
                                <th>Turno</th>
                                <th>Servicio</th>
                                <th>Documento</th>
                                <th>Nombre</th>
                                <th>Ingreso</th>
                                <th>Salida</th>
                                <th>Diferencia</th>
                            </tr>
                        </thead>
                    </table>
                </div>
      </div>
    </div>
  </div>
</div>
<?php
require "../template/footer.php";
?>
<script src="../../controllers/reportes_turnos.js"></script>
<?php
require "../template/header.php";
?>

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card mb-4">
    <h5 class="card-header">Generar Turno</h5>
    <div class="card-body">

      <div class="row mb-4">
      <div class="col-4">
          <select id="tipodocumento" name="tipodocumento" class="form-select">
            <option value="" readonly>Seleccionar Tipo Documento</option>
            <option value="CC">Cedula de Ciudadania</option>
            <option value="TI">Tarjeta de Identidad</option>
            <option value="RC">Registro Civil</option>
          </select>
        </div>
        <div class="col-4">
          <input type="text" id="numerodocumento" name="numerodocumento" class="form-control" placeholder="Numero Documento" />
        </div>
        <div class="col-4">
          <button type="button" Onclick="BuscarCliente()" class="btn btn-primary float-right">Buscar</button>
        </div>
      </div>
      <div id="verdatoscliente">
      <div class="row">
        <div class="col-6 mb-2">
          <label class="form-label">Documento</label>
          <select id="documento" name="documento" class="form-select">
            <option value="" disabled>Seleccionar</option>
            <option value="CC">Cedula de Ciudadania</option>
            <option value="TI">Tarjeta de Identidad</option>
            <option value="RC">Registro Civil</option>
          </select>
        </div>
        <div class="col-6 mb-2">
          <label class="form-label">Numero</label>
          <input type="text" id="numero" name="numero" class="form-control" />
        </div>
      </div>
      <div class="row">
        <div class="col-3 mb-2">
          <label class="form-label">Primer Nombre</label>
          <input type="text" id="pnombre" name="pnombre" class="form-control" />
        </div>
        <div class="col-3 mb-2">
          <label class="form-label">Segundo Nombre</label>
          <input type="text" id="snombre" name="snombre" class="form-control" />
        </div>
        <div class="col-3 mb-2">
          <label class="form-label">Primer Apellido</label>
          <input type="text" id="papellido" name="papellido" class="form-control" />
        </div>
        <div class="col-3 mb-2">
          <label class="form-label">Segundo Apellido</label>
          <input type="text" id="sapellido" name="sapellido" class="form-control" />
          <input type="hidden" id="registrarcliente" name="registrarcliente"/>
        </div>
      </div>
        <div id="contedinoservicios" class="row mt-4">
          
        </div>
      </div>
    </div>
  </div>
</div>
<?php
require "../template/footer.php";
?>
<script src="../../controllers/generarturnoController.js"></script>
<?php
require "../template/header.php";
?>

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row mb-5">
    <div class="col-md-6 col-lg-6 mb-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Gestionar Turno</h5>

          <div id="vista_numero">
            <div class="row">
              <div class="col-lg-3 m-sm-auto">
                <div class="card text-center bg-transparent border border-primary bg bg-primary">
                  <h4 class="card-title mt-2 text-white" id="numerodelturno"></h4>
                </div>
              </div>
            </div>

            <div class="row text-center">
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
            <div class="row text-center">
              <div class="col-4 mb-2">
                <label class="form-label">Primer Nombre</label>
                <input type="text" id="pnombre" name="pnombre" class="form-control" />
              </div>
              <div class="col-4 mb-2">
                <label class="form-label">Primer Apellido</label>
                <input type="text" id="papellido" name="papellido" class="form-control" />
              </div>
              <div class="col-4 mb-2">
                <label class="form-label">Segundo Apellido</label>
                <input type="text" id="sapellido" name="sapellido" class="form-control" />
                <input type="hidden" id="registrarcliente" name="registrarcliente" />
              </div>
            </div>
          </div>

          <div id="llamarturno" class="row mt-2">
            <div class="col-lg-4 m-sm-auto">
              <a style="cursor: pointer;" onClick="llamar_Turno()">
                <div class="card text-center bg-transparent border border-success">
                  <div class="card-link">
                    <i style="font-size: 68px;color:#71dd37" class="bx bxs-caret-right-square"></i>
                  </div>
                  <h4 class="card-title">LLAMAR</h4>
                </div>
            </div>
            </a>
          </div>
          <div id="atenderturno" class="row mt-2">
            <div class="col-lg-4 m-sm-auto">
              <a style="cursor: pointer;" onClick="atender_Turno()">
                <div class="card text-center bg-transparent border border-primary">
                  <div class="card-link">
                    <i style="font-size: 68px;color:#696cff" class="bx bxs-caret-right-square"></i>
                  </div>
                  <h4 class="card-title">ATENDER</h4>
                </div>
            </div>
            </a>
          </div>
          <div id="finalizarturno" class="row mt-2">
            <div class="col-lg-4 m-sm-auto">
              <a style="cursor: pointer;" onClick="finalizar_Turno()">
                <div class="card text-center bg-transparent border border-danger">
                  <div class="card-link">
                    <i style="font-size: 68px;color:#ff3e1d" class="bx bx-stop-circle"></i>
                  </div>
                  <h4 class="card-title">FINALIZAR</h4>
                </div>
            </div>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-6 mb-3">
      <div class="card text-center">

        <h5 class="card-header">Datos del Usuario</h5>
        <div class="card-body">
          <div align="center">
            <img src="../../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded mb-2" height="100" width="100" id="uploadedAvatar">
          </div>
          <h5 class="card-title">Servicio : <span class="text-lowercase" id="nombreservicio"></span></h5>
          <h5 class="card-title">Modulo : <span id="nombremodulo"></span></h5>
          <div class="demo-inline-spacing">
            <span class="badge bg-primary">Activos : <span id="en_espera"></span></span>
            <span class="badge bg-danger">Atendidos : <span id="turnos_atendidos"></span></span>
            <span class="badge bg-info">Totales : <span id="total_turnos"></span></span>
          </div>
        </div>
        <button type="button" Onclick="modalverturnos()" class="btn btn-primary">Ver turnos</button>
      </div>
    </div>
  </div>
</div>
<!-- ============================================modal de turnos=========================================================== -->
  <div class="modal fade" id="modalturnos" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Registrar Modulo</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                              <div class="card-datatable table-responsive">
                <table class="datatables-basic table border-top" id="TablaTurnos" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th>Estado</th>
                                <th>Turno</th>
                                <th>Servicio</th>
                                <th>Documento</th>
                                <th>Nombre</th>
                                <th>Ingreso</th>
                                <th>Salida</th>
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
<script src="../../controllers/gestionarturnoController.js"></script>
<?php
require "../template/header.php";
?>
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="card mb-4">
                <h5 class="card-header">Modulos<button type="button" Onclick="modalagregar()" class="btn btn-primary float-right">Agregar Modulo</button></h5>
                <div class="card-body">
                <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table border-top" id="TablaModulos">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre Modulo</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="modalAgregarmodulo" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                              <form id="registrar_modulos" class="registrar_modulos">
                              <div class="row">
                                  <div class="col-12 mb-2">
                                    <label class="form-label">Nombre Modulo</label>
                                    <input
                                      type="text"
                                      id="nombremodulo" name="nombremodulo"
                                      class="form-control"
                                    />
                                  </div>
                                  <div class="col-6">
                                    <input
                                      type="hidden"
                                      id="idunicodelmodulo" name="idunicodelmodulo"
                                      class="form-control"
                                    />
                                  </div>
                                </div>
                              </div>
                              </form>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                  Cancelar
                                </button>
                                <button type="button" id="botondeeditar" class="btn btn-primary"><span id="btnText">Guardar</span></button>
                              </div>
                            </div>
                          </div>
                        </div>
<?php
require "../template/footer.php";
?>
<script src="../../controllers/modulosController.js"></script>
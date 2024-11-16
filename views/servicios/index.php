<?php
require "../template/header.php";
?>
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="card mb-4">
                <h5 class="card-header">Servicios<button type="button" Onclick="modalagregar()" class="btn btn-primary float-right">Agregar Servicio</button></h5>
                <div class="card-body">
                <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table border-top" id="TablaServicios">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre Servicio</th>
                                <th>Color</th>
                                <th>Icono</th>
                                <th>Letra</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="modalAgregarservicios" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Registrar Servicio</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                              <form id="registrar_servicios" class="registrar_servicios">
                              <div class="row">
                                  <div class="col-6 mb-2">
                                    <label class="form-label">Nombre Servicio</label>
                                    <input
                                      type="text"
                                      id="nombreservicio" name="nombreservicio"
                                      class="form-control"
                                    />
                                  </div>
                                  <div class="col-6 mb-2">
                                  <label class="form-label">Color</label>
                                <select id="colorservicio" name="colorservicio" class="form-select select-color">
                                    <option value="" disabled>Seleccionar</option>
                                </select>
                                  </div>
                                </div>
                              <div class="row">
                                  <div class="col-6 mb-2">
                                    <label class="form-label">Icono</label>
                                <select id="iconoservicio" name="iconoservicio" class="select2 form-select">
                                    <option value="bxl-wordpress" data-icon="bx bxl-wordpress">WordPress</option>
                                    <option value="bxl-codepen" data-icon="bx bxl-codepen">Codepen</option>
                                    <option value="bxl-drupal" data-icon="bx bxl-drupal">Drupal</option>
                                    <option value="bxl-css3" data-icon="bx bxl-css3">CSS3</option>
                                    <option value="bxl-html5" data-icon="bx bxl-html5">HTML5</option>
                                    <option value="bxs-file-pdf" data-icon="bx bxs-file-pdf">PDF</option>
                                    <option value="bxs-file-doc" data-icon="bx bxs-file-doc">Word</option>
                                    <option value="bxs-file-json" data-icon="bx bxs-file-json">JSON</option>
                                    <option value="bxl-facebook" data-icon="bx bxl-facebook">Facebook</option>
                                    <option value="bxl-chrome" data-icon="bx bxl-chrome">Chrome</option>
                                    <option value="bxl-firefox" data-icon="bx bxl-firefox">Firefox</option>
                                    <option value="bxl-edge" data-icon="bx bxl-edge">Edge</option>
                                    <option value="bxl-opera" data-icon="bx bxl-opera">Opera</option>
                                    <option value="bxl-internet-explorer" data-icon="bx bxl-internet-explorer">IE</option>
                                </select>
                                  </div>
                                  <div class="col-6 mb-2">
                                    <label class="form-label">Letra</label>
                                    <input
                                      type="text"
                                      id="letraservicio" name="letraservicio"
                                      class="form-control"
                                    />
                                  </div>
                                  <div class="col-6">
                                    <input
                                      type="hidden"
                                      id="idunicodelservicio" name="idunicodelservicio"
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
<script src="../../controllers/serviciosController.js"></script>
<div class="modal fade" id="modalAgregarcliente" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Registrar Cliente</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                              <form id="registrar_cliente" class="registrar_cliente">
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
                                    <input
                                      type="text"
                                      id="numero" name="numero"
                                      class="form-control"
                                    />
                                  </div>
                                </div>
                              <div class="row">
                                  <div class="col-3 mb-2">
                                    <label class="form-label">Primer Nombre</label>
                                    <input
                                      type="text"
                                      id="pnombre" name="pnombre"
                                      class="form-control"
                                    />
                                  </div>
                                  <div class="col-3 mb-2">
                                    <label class="form-label">Segundo Nombre</label>
                                    <input
                                      type="text"
                                      id="snombre" name="snombre"
                                      class="form-control"
                                    />
                                  </div>
                                  <div class="col-3 mb-2">
                                    <label class="form-label">Primer Apellido</label>
                                    <input
                                      type="text"
                                      id="papellido" name="papellido"
                                      class="form-control"
                                    />
                                  </div>
                                  <div class="col-3 mb-2">
                                    <label class="form-label">Segundo Apellido</label>
                                    <input
                                      type="text"
                                      id="sapellido" name="sapellido"
                                      class="form-control"
                                    />
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-6 mb-2">
                                    <label class="form-label">Fecha Nacimiento</label>
                                    <input
                                      type="date"
                                      id="fecha_nacimiento" name="fecha_nacimiento"
                                      class="form-control"
                                    />
                                  </div>
                                  <div class="col-6 mb-2">
                                    <label class="form-label">Sexo</label>
                                    <select id="sexo" name="sexo" class="form-select">
                                    <option value="F">Femenino</option>
                                    <option value="M">Masculino</option>
                                </select>
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
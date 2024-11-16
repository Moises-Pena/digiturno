<div class="modal fade" id="modalAgregarusuario" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Registrar Usuarios</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                              <form id="registrar_usuarios" class="registrar_usuarios">
                              <div class="row">
                                  <div class="col-4 mb-2">
                                    <label class="form-label">Numero Documento</label>
                                    <input
                                      type="text"
                                      id="numero" name="numero"
                                      class="form-control"
                                    />
                                  </div>
                                  <div class="col-4 mb-2">
                                    <label class="form-label">Usuario</label>
                                    <input
                                      type="text"
                                      id="usuario" name="usuario"
                                      class="form-control"
                                    />
                                  </div>
                                  <div class="col-4 mb-2">
                                    <label class="form-label">Contraseña</label>
                                    <input
                                      type="text"
                                      id="password" name="password"
                                      class="form-control"
                                    />
                                  </div>
                                </div>
                              <div class="row">
                                  <div class="col-6 mb-2">
                                    <label class="form-label">Nombres</label>
                                    <input
                                      type="text"
                                      id="nombres" name="nombres"
                                      class="form-control"
                                    />
                                  </div>
                                  <div class="col-6 mb-2">
                                    <label class="form-label">Apellidos</label>
                                    <input
                                      type="text"
                                      id="apellidos" name="apellidos"
                                      class="form-control"
                                    />
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-4 mb-2">
                                    <label class="form-label">Servicio</label>
                                    <select id="servicio" name="servicio" class="form-select">
                                    <option value="" readonly>Seleccionar</option>
                                </select>
                                  </div>
                                  <div class="col-4 mb-2">
                                    <label class="form-label">Modulo</label>
                                    <select id="modulo" name="modulo" class="form-select">
                                    <option value="" readonly>Seleccionar</option>
                                </select>
                                  </div>
                                  <div class="col-4 mb-2">
                                    <label class="form-label">Nivel Acceso</label>
                                    <select id="nivel" name="nivel" class="form-select">
                                    <option value="" readonly>Seleccionar</option>
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
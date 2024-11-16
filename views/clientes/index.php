<?php
require "../template/header.php";
?>
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="card mb-4">
                <h5 class="card-header">Clientes <button type="button" Onclick="modalagregar()" class="btn btn-primary float-right">Agregar Cliente</button></h5>
                <div class="card-body">
                <?php include("agregar_cliente.php"); ?>
                <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table border-top" id="TablaClientes">
                        <thead class="thead-light">
                            <tr>
                                <th>Documento</th>
                                <th>Nombre</th>
                                <th>Sexo</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                </div>
              </div>
            </div>
<?php
require "../template/footer.php";
?>
<script src="../../controllers/clientesController.js"></script>
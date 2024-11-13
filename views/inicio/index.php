<?php
require "../template/header.php";
?>

<div class="container-xxl flex-grow-1 container-p-y">
              <div class="card mb-4">
                <h5 class="card-header">INICIO</h5>
                <div class="card-body">
                  
                 <div class="row">
                 <div class="col-md-4 col-lg-4">
                 <div class="card text-center bg-transparent border border-primary">
                        <div class="card-body">
                          <div class="card-link badge bg-primary">
                           <i style="font-size: 68px;" class="bx bx-time-five"></i>
                          </div>
                          <h3 class="card-title mb-2 mt-4">GENERADOS</h3>
                        </div>
                      </div>
                      </div>
                 <div class="col-md-4 col-lg-4">
                 <div class="card text-center bg-transparent border border-success">
                        <div class="card-body">
                          <div class="card-link badge bg-success">
                           <i style="font-size: 68px;" class="bx bx-time-five"></i>
                          </div>
                          <h3 class="card-title mb-2 mt-4">ACTIVOS</h3>
                        </div>
                      </div>
                      </div>
                 <div class="col-md-4 col-lg-4">
                 <div class="card text-center bg-transparent border border-info">
                        <div class="card-body">
                          <div class="card-link badge bg-info">
                           <i style="font-size: 68px;" class="bx bx-time-five"></i>
                          </div>
                          <h3 class="card-title mb-2 mt-4">FINALIZADOS</h3>
                        </div>
                      </div>
                      </div>
                 </div>

                </div>
              </div>
            </div>
<?php
require "../template/footer.php";
?>

<script src="../../controllers/InicioController.js"></script>
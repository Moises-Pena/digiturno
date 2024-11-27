
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                 Moises Peña
                </div>
              </div>
            </footer>

            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>

      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="<?= BASE_URL ?>assets/js/sweetalert2.all.min.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/libs/select2/select2.js"></script>
    <script src="<?= BASE_URL ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?= BASE_URL ?>assets/js/datatables-bootstrap5.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= BASE_URL ?>assets/vendor/js/menu.js"></script>
    <script src="<?= BASE_URL ?>assets/js/main.js"></script>
    <script>
$(function(){
  var url = window.location;
  $('ul.menu-inner a').filter(function() {
     return this.href == url;
  }).parent().addClass('active');
  
});
</script>
  </body>
</html>

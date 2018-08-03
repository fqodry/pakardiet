        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <?php 
                    $flash_message = $this->session->flashdata('handler_msg');
                    if( ! empty($flash_message) ) {
                    echo '<p class="alert alert-'. $flash_message['type'] .'" id="flash_message"><b>'. $flash_message['msg'] .'</b></p>';
                    }
                ?>

                <h1>Tambah Bahan Makanan</h1>
                <hr>
                <form class="form-horizontal form-label-left" action="<?php echo $formEdit ?>" method="post">
                    <div class="form-group">
                        <label for="bahanCode" class="control-label col-md-3">Kode Bahan <span class="required">*</span></label>
                        <div class="col-md-3"> 
                            <input type="text" class="form-control" id="bahanCode" name="bahanCode" placeholder="Kode Bahan" value="<?php echo set_value('bahanCode',$bahan_detail->bahan_code) ?>" required readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bahanName" class="control-label col-md-3">Nama Bahan <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="bahanName" name="bahanName" placeholder="Nama Bahan" value="<?php echo set_value('bahanName',$bahan_detail->bahan_name) ?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bahanUrt" class="control-label col-md-3">URT <span class="required">*</span></label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="bahanUrt" name="bahanUrt" placeholder="URT" value="<?php echo set_value('bahanUrt',$bahan_detail->urt) ?>" required />
                        </div>
                        <div class="col-md-6">
                            <small><em>*satuan sesuai bahan (misal: 1 sdm / 1 potong / 1 piring / dll.)</em></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bahanWeight" class="control-label col-md-3">Berat <span class="required">*</span></label>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="bahanWeight" name="bahanWeight" placeholder="Berat Bahan" value="<?php echo set_value('bahanWeight',$bahan_detail->weight) ?>" required />
                        </div>
                        <div class="col-md-3">
                            <small><em>*satuan dalam gram (gr)</em></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bahanCalories" class="control-label col-md-3">Kalori <span class="required">*</span></label>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="bahanCalories" name="bahanCalories" placeholder="Kalori Bahan" value="<?php echo set_value('bahanCalories',$bahan_detail->calories) ?>" required />
                        </div>
                        <div class="col-md-3">
                            <small><em>*satuan dalam kilo-kalori (kkal)</em></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bahanProtein" class="control-label col-md-3">Protein</label>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="bahanProtein" name="bahanProtein" placeholder="Protein Bahan" value="<?php echo set_value('bahanProtein',$bahan_detail->protein) ?>" />
                        </div>
                        <div class="col-md-3">
                            <small><em>*satuan dalam gram (gr)</em></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bahanFat" class="control-label col-md-3">Lemak</label>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="bahanFat" name="bahanFat" placeholder="Lemak Bahan" value="<?php echo set_value('bahanFat',$bahan_detail->fat) ?>" />
                        </div>
                        <div class="col-md-3">
                            <small><em>*satuan dalam gram (gr)</em></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bahanCarbo" class="control-label col-md-3">Karbohidrat</label>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="bahanCarbo" name="bahanCarbo" placeholder="Karbohidrat Bahan" value="<?php echo set_value('bahanCarbo',$bahan_detail->carbo) ?>" />
                        </div>
                        <div class="col-md-3">
                            <small><em>*satuan dalam gram (gr)</em></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="btnSubmit" class="control-label col-md-3">&nbsp;</label>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>&nbsp;Submit</button>
                            <button type="button" class="btn btn-default" onclick="history.go(-1);"><i class="fa fa-undo"></i>&nbsp;Back</button>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            &copy; <?php echo date('Y'); ?> Sistem Pakar Diet
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="assets/vendors/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/vendors/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="assets/vendors/js/fastclick.js"></script>
    <!-- NProgress -->
    <script src="assets/vendors/js/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="assets/vendors/js/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="assets/vendors/js/jquery.sparkline.min.js"></script>
    <!-- morris.js -->
    <script src="assets/vendors/js/raphael.min.js"></script>
    <script src="assets/vendors/js/morris.min.js"></script>
    <!-- gauge.js -->
    <script src="assets/vendors/js/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="assets/vendors/js/bootstrap-progressbar.min.js"></script>
    <!-- Skycons -->
    <script src="assets/vendors/js/skycons.js"></script>
    <!-- Flot -->
    <script src="assets/vendors/js/jquery.flot.js"></script>
    <script src="assets/vendors/js/jquery.flot.pie.js"></script>
    <script src="assets/vendors/js/jquery.flot.time.js"></script>
    <script src="assets/vendors/js/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="assets/vendors/js/jquery.flot.orderBars.js"></script>
    <script src="assets/vendors/js/jquery.flot.spline.min.js"></script>
    <script src="assets/vendors/js/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="assets/vendors/js/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="assets/vendors/js/moment.min.js"></script>
    <script src="assets/vendors/js/daterangepicker.js"></script>
    <!-- DataTables -->
    <script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="assets/js/custom.js"></script>
    <script>
    $(document).ready( function () {
        $('.dataTable').DataTable();
    });
    </script>
  </body>
</html>
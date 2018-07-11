        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <?php 
                    $flash_message = $this->session->flashdata('handler_msg');
                    if( ! empty($flash_message) ) {
                    echo '<p class="alert alert-'. $flash_message['type'] .'" id="flash_message"><b>'. $flash_message['msg'] .'</b></p>';
                    }
                ?>
                <h3>Result Data</h3><br/>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th colspan="3" class="text-center">RESULT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Nama:</strong></td>
                                <td colspan="2" class="text-center"><?php echo $first_name." ".$last_name ?></td>
                            </tr>
                            <tr>
                                <td><strong>Umur:</strong></td>
                                <td colspan="2" class="text-center"><?php echo $usia." thn" ?></td>
                            </tr>
                            <tr>
                                <td><strong>Berat Badan:</strong></td>
                                <td colspan="2" class="text-center"><?php echo number_format($beratbadan,0,",",".")." kg (".number_format($beratbadan_lbs,1,",",".")." lbs)" ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tinggi Badan:</strong></td>
                                <td colspan="2" class="text-center"><?php echo number_format($tinggibadan,0,",",".")." cm" ?></td>
                            </tr>
                            <tr>
                                <td><strong>Aktifitas:</strong></td>
                                <td colspan="2" class="text-center"><?php echo $aktifitas->act_name . " (".$aktifitas->description.")"; ?></td>
                            </tr>
                            <tr>
                                <td><strong>BB Ideal:</strong></td>
                                <td><?php echo number_format($bbideal,1,",",".")." kg (".number_format($bbideal_lbs,2,",",".")." lbs)" ?></td>
                                <td rowspan="3" style="vertical-align: middle; text-align: center;"><strong><?php echo $bb_ket; ?></strong></td>
                            </tr>
                            <tr>
                                <td><strong>Indeks Masa Tubuh:</strong></td>
                                <td><?php echo number_format($imt,2,",",".") ?></td>
                            </tr>
                            <tr>
                                <td><strong>Kebutuhan Kalori:</strong></td>
                                <td><?php echo number_format($kebutuhan_kalori,2,",",".")." cal" ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: right;">
                        <small><em>*data input on: <?php echo $hist_formpakar->created_date; ?></em></small>
                    </div>
                </div>

                <h3>Menu Anjuran</h3><br/>
                <?php echo $menuAnjuran ?>
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

    <!-- Custom Theme Scripts -->
    <script src="assets/js/custom.min.js"></script>

  </body>
</html>
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
                
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center;">My Profile</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>User ID</strong></td>
                                <td><?php echo $user->user_id ?></td>
                            </tr>
                            <tr>
                                <td><strong>Username</strong></td>
                                <td><?php echo $user->username ?></td>
                            </tr>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td><?php echo ucwords(strtolower($user->first_name)) . " " . ucwords(strtolower($user->last_name)) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
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
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-6 col-xs-8 col-md-offset-3 col-xs-offset-2">
                <?php 
                    $flash_message = $this->session->flashdata('handler_msg');
                    if( ! empty($flash_message) ) {
                    echo '<p class="alert alert-'. $flash_message['type'] .'" id="flash_message"><b>'. $flash_message['msg'] .'</b></p>';
                    }
                ?>
                <h3>Update My Profile</h3><br/>
                <form action="<?php echo $formEditProfile; ?>" id="formUserQuestion" method="post">
                    <div class="form-group">
                        <label for="userID">User ID</label>
                        <input type="text" class="form-control" name="userID" id="userID" value="<?php echo set_value('userID', $user->user_id) ?>" readonly required />
                    </div>
                    <div class="form-group">
                        <label for="userNAME">Username</label>
                        <input type="text" class="form-control" name="userNAME" id="userNAME" value="<?php echo set_value('userNAME', $user->username) ?>" readonly required />
                    </div>
                    <div class="form-group">
                        <label for="userFIRSTNAME">First Name</label>
                        <input type="text" class="form-control" name="userFIRSTNAME" id="userFIRSTNAME" value="<?php echo set_value('userFIRSTNAME', $user->first_name) ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="userLASTNAME">Last Name</label>
                        <input type="text" class="form-control" name="userLASTNAME" id="userLASTNAME" value="<?php echo set_value('userLASTNAME', $user->last_name) ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="userAGE">Usia <small style="color: red;">(thn)</small></label>
                        <input type="number" class="form-control" name="userAGE" id="userAGE" value="<?php echo set_value('userAGE', $user_detail->age) ?>" min="0" required />
                    </div>
                    <div class="form-group">
                        <label for="userWEIGHT">Berat Badan <small style="color: red;">(kg)</small></label>
                        <input type="number" class="form-control" name="userWEIGHT" id="userWEIGHT" value="<?php echo set_value('userWEIGHT', $user_detail->weight) ?>" min="0" required />
                    </div>
                    <div class="form-group">
                        <label for="userHEIGHT">Tinggi Badan <small style="color: red;">(cm)</small></label>
                        <input type="number" class="form-control" name="userHEIGHT" id="userHEIGHT" value="<?php echo set_value('userHEIGHT', $user_detail->height) ?>" min="0" required />
                    </div>
                    <div class="form-group">
                        <label for="userGENDER">Jenis Kelamin</label>
                        <div class="radio">
                            <label>
                              <input type="radio" class="flat" name="userGENDER" value="M" <?php echo ($user_detail->gender == "M") ? 'checked' : '' ?> /> Laki-laki
                            </label>
                            <label>
                              <input type="radio" class="flat" name="userGENDER" value="F" <?php echo ($user_detail->gender == "F") ? 'checked' : '' ?> /> Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="text-align: right;">
                        <a href="myprofile" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-success" id="btnFlow">Submit</button>
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
    <!-- iCheck -->
    <script src="assets/vendors/iCheck/icheck.min.js"></script>
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
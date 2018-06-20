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

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
                    <li><a data-toggle="tab" href="#userhist">History</a></li>
                </ul>
                <div class="tab-content">
                    <div id="profile" class="tab-pane fade in active">
                        <br>
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
                                    <tr>
                                        <td><strong>Joined Date</strong></td>
                                        <td><?php echo $user->created_date ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="userhist" class="tab-pane fade in">
                        <h1>History Data</h1>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <!-- <th>Username</th> -->
                                        <th>Berat Badan</th>
                                        <th>Tinggi Badan</th>
                                        <th>Usia</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Aktifitas</th>
                                        <th>Input Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(!empty($hist_formpakar)){
                                            $num=1; 
                                            foreach($hist_formpakar as $hist): 
                                            $user = $this->Default_md->getSingle("tb_user",array("user_id"=>$hist->user_id));
                                            $aktifitas = $this->Default_md->getSingle("m_pekerjaan",array("job_id"=>$hist->job));
                                    ?>
                                    <tr>
                                        <td><?php echo $num ?></td>
                                        <!-- <td><?php //echo $user->username ?></td> -->
                                        <td><?php echo $hist->berat_badan." kg" ?></td>
                                        <td><?php echo $hist->tinggi_badan. " cm" ?></td>
                                        <td><?php echo $hist->usia. " thn" ?></td>
                                        <td><?php echo ($hist->jenis_kelamin == "M") ? "Laki-laki" : "Perempuan" ?></td>
                                        <td><?php echo $aktifitas->job_name ?></td>
                                        <td><?php echo $hist->created_date ?></td>
                                    </tr>
                                    <?php $num++; endforeach; 
                                        } else {
                                            echo '<tr><td colspan="7">no history data.</td></tr>';
                                        } ?>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <h1>History Grafik</h1>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_content">
                                    <canvas id="lineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="assets/js/custom.js"></script>

    <?php echo $line_chart; ?>
  </body>
</html>
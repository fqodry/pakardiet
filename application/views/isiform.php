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
                <h3>Form Hitung Kebutuhan Kalori</h3><br/>
                <p class="col-md-12">Hai <strong><?php echo ucwords(strtolower($first_name." ".$last_name)); ?></strong>! Silahkan isi form berikut untuk mengetahui IMT (Indeks Masa Tubuh), Berat Badan Ideal, dan menu anjuran dari Pakar Gizi terkemuka <strong>Bp. Ujang Marujang, S.Tr.Gz</strong>. Silahkan mencoba!</p>
                <form action="<?php echo $form_pakar; ?>" method="post">
                    <div class="form-group">
                        <label for="">Berat Badan <small style="color: red;">(kg)</small></label>
                        <input type="number" class="form-control" id="beratbadan" name="beratbadan" placeholder="Berat Badan" min="0" required /> <code></code>
                    </div>
                    <div class="form-group">
                        <label for="">Tinggi Badan <small style="color: red;">(cm)</small></label>
                        <input type="number" class="form-control" id="tinggibadan" name="tinggibadan" placeholder="Tinggi Badan" min="0" required />
                    </div>
                    <div class="form-group">
                        <label for="">Usia <small style="color: red;">(thn)</small></label>
                        <input type="number" class="form-control" id="usia" name="usia" placeholder="Usia" min="0" required />
                    </div>
                    <div class="radio">
                        <p><strong>Jenis Kelamin</strong></p>
                        <label>
                            <input type="radio" name="jeniskelamin" id="jkCowok" value="M" required> Laki-laki
                        </label>
                        &emsp;
                        <label>
                            <input type="radio" name="jeniskelamin" id="jkCewek" value="F" required> Perempuan
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="">Aktifitas</label>
                        <select name="aktifitas" id="aktifitas" class="form-control" required>
                            <option value="none">-Pilih-</option>
                            <?php foreach($jobs as $job): ?>
                            <option value="<?php echo $job->job_id ?>"><?php echo $job->job_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
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

    <!-- Custom Theme Scripts -->
    <script src="assets/js/custom.min.js"></script>

  </body>
</html>
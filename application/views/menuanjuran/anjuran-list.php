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

                    <h1>Daftar Menu Anjuran Pakar</h1>
                    <div id="kaloriKategori">
                        <?php if(empty($kalori_kategori)): ?>
                            <h3>Oops, Kategori kalori tidak ada.</h3>
                        <?php else: foreach($kalori_kategori as $key=>$kategori): ?>

                            <?php $menuAnjuran = $this->Default_md->getAll("tb_ref_menu_anjuran", array('kalori_code'=>$kategori->kalori_code)); ?>
                            <h3><?php echo $kategori->kalori_name ?></h3>
                            <div>
                                <p>
                                    <?php if(empty($menuAnjuran)){ ?>
                                        <span>Oops, menu anjuran untuk <?php echo $kategori->kalori_name ?> belum di atur.</span>
                                    <?php } else { ?>
                                        <h2>Senin</h2>
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Waktu</th>
                                                    <th>Menu</th>
                                                    <th>Porsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($menuAnjuran as $anjuran){
                                                    if(strtolower($anjuran->hari) == 'senin'){
                                                        $menuWaktu = $this->Default_md->getSingle("m_menu_waktu",array('waktu_code'=>$anjuran->waktu_code));
                                                        $bahan = $this->Default_md->getSingle("tb_bahan",array('bahan_code'=>$anjuran->bahan_code));
                                                        echo '<tr>';
                                                            echo '<td>'.$menuWaktu->waktu_name.'</td>';
                                                            echo '<td>'.$bahan->bahan_name.'</td>
                                                            <td>'.$bahan->urt.'</td>
                                                        </tr>';
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>

                                        <h2>Selasa</h2>
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Waktu</th>
                                                    <th>Menu</th>
                                                    <th>Porsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($menuAnjuran as $anjuran){
                                                    if(strtolower($anjuran->hari) == 'selasa'){
                                                        $menuWaktu = $this->Default_md->getSingle("m_menu_waktu",array('waktu_code'=>$anjuran->waktu_code));
                                                        $bahan = $this->Default_md->getSingle("tb_bahan",array('bahan_code'=>$anjuran->bahan_code));
                                                        echo '<tr>';
                                                            echo '<td>'.$menuWaktu->waktu_name.'</td>';
                                                            echo '<td>'.$bahan->bahan_name.'</td>
                                                            <td>'.$bahan->urt.'</td>
                                                        </tr>';
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>

                                        <h2>Rabu</h2>
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Waktu</th>
                                                    <th>Menu</th>
                                                    <th>Porsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($menuAnjuran as $anjuran){
                                                    if(strtolower($anjuran->hari) == 'rabu'){
                                                        $menuWaktu = $this->Default_md->getSingle("m_menu_waktu",array('waktu_code'=>$anjuran->waktu_code));
                                                        $bahan = $this->Default_md->getSingle("tb_bahan",array('bahan_code'=>$anjuran->bahan_code));
                                                        echo '<tr>';
                                                            echo '<td>'.$menuWaktu->waktu_name.'</td>';
                                                            echo '<td>'.$bahan->bahan_name.'</td>
                                                            <td>'.$bahan->urt.'</td>
                                                        </tr>';
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>

                                        <h2>Kamis</h2>
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Waktu</th>
                                                    <th>Menu</th>
                                                    <th>Porsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($menuAnjuran as $anjuran){
                                                    if(strtolower($anjuran->hari) == 'kamis'){
                                                        $menuWaktu = $this->Default_md->getSingle("m_menu_waktu",array('waktu_code'=>$anjuran->waktu_code));
                                                        $bahan = $this->Default_md->getSingle("tb_bahan",array('bahan_code'=>$anjuran->bahan_code));
                                                        echo '<tr>';
                                                            echo '<td>'.$menuWaktu->waktu_name.'</td>';
                                                            echo '<td>'.$bahan->bahan_name.'</td>
                                                            <td>'.$bahan->urt.'</td>
                                                        </tr>';
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>

                                        <h2>Jumat</h2>
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Waktu</th>
                                                    <th>Menu</th>
                                                    <th>Porsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($menuAnjuran as $anjuran){
                                                    if(strtolower($anjuran->hari) == 'jumat'){
                                                        $menuWaktu = $this->Default_md->getSingle("m_menu_waktu",array('waktu_code'=>$anjuran->waktu_code));
                                                        $bahan = $this->Default_md->getSingle("tb_bahan",array('bahan_code'=>$anjuran->bahan_code));
                                                        echo '<tr>';
                                                            echo '<td>'.$menuWaktu->waktu_name.'</td>';
                                                            echo '<td>'.$bahan->bahan_name.'</td>
                                                            <td>'.$bahan->urt.'</td>
                                                        </tr>';
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>

                                        <h2>Sabtu</h2>
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Waktu</th>
                                                    <th>Menu</th>
                                                    <th>Porsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($menuAnjuran as $anjuran){
                                                    if(strtolower($anjuran->hari) == 'sabtu'){
                                                        $menuWaktu = $this->Default_md->getSingle("m_menu_waktu",array('waktu_code'=>$anjuran->waktu_code));
                                                        $bahan = $this->Default_md->getSingle("tb_bahan",array('bahan_code'=>$anjuran->bahan_code));
                                                        echo '<tr>';
                                                            echo '<td>'.$menuWaktu->waktu_name.'</td>';
                                                            echo '<td>'.$bahan->bahan_name.'</td>
                                                            <td>'.$bahan->urt.'</td>
                                                        </tr>';
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>

                                        <h2>Minggu</h2>
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Waktu</th>
                                                    <th>Menu</th>
                                                    <th>Porsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($menuAnjuran as $anjuran){
                                                    if(strtolower($anjuran->hari) == 'ahad'){
                                                        $menuWaktu = $this->Default_md->getSingle("m_menu_waktu",array('waktu_code'=>$anjuran->waktu_code));
                                                        $bahan = $this->Default_md->getSingle("tb_bahan",array('bahan_code'=>$anjuran->bahan_code));
                                                        echo '<tr>';
                                                            echo '<td>'.$menuWaktu->waktu_name.'</td>';
                                                            echo '<td>'.$bahan->bahan_name.'</td>
                                                            <td>'.$bahan->urt.'</td>
                                                        </tr>';
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </p>
                            </div>

                        <?php endforeach; endif; ?>
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
    <!-- jQuery UI -->
    <script src="assets/vendors/js/jquery-ui.js"></script>
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

    <script>
        $(document).ready(function(){
            $("#kaloriKategori").accordion({
                collapsible: true
            });
        });
    </script>
  </body>
</html>
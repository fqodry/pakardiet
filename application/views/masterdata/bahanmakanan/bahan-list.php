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

                <h1>List Bahan Makanan</h1>
                <hr>
                <a class="btn btn-primary" href="Masterdata/bahanMakananAdd"><i class="fa fa-plus"></i>&nbsp;Add</a>
                <br><br>
                <?php if(empty($bahan_olahan)){
                    echo "Oops, tidak ada data bahan nih.";
                }else{ ?>
                    <table class="table table-condensed table-hover table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Bahan</th>
                                <th>Nama Bahan</th>
                                <th>URT</th>
                                <th>Berat</th>
                                <th>Kalori</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $num = 1;
                        foreach($bahan_olahan as $bahan): ?>
                            <tr>
                                <td><?php echo $num; ?></td>
                                <td><?php echo $bahan->bahan_code ?></td>
                                <td><?php echo $bahan->bahan_name ?></td>
                                <td><?php echo $bahan->urt ?></td>
                                <td><?php echo $bahan->weight." gr" ?></td>
                                <td><?php echo $bahan->calories." kal" ?></td>
                                <td align="center">
                                    <a class="btn btn-warning btn-xs" href="Masterdata/bahanMakananEdit/<?php echo $bahan->id ?>"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
                                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" onclick="confirmDelete(<?php echo $bahan->id ?>)"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                </td>
                            </tr>
                        <?php $num++; endforeach; ?>
                        </tbody>
                    </table>
                <?php } ?>
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
    var base_url = '<?php echo base_url() ?>';
    $(document).ready( function () {
        $('.dataTable').DataTable();
    });

    function confirmDelete(id) {
        if(confirm("Apa Anda yakin ingin delete record ini?")){
            $.ajax({
                url: base_url + "Masterdata/bahanMakananDeleteHandler/" + id,
                method: 'post',
                dataType: 'json',
                success: function(data, textStatus, jqXHR){
                    if(data.result){
                        window.location = base_url + "Masterdata/bahanMakanan";
                    }else{
                        return false;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log("Error: Ajax Request Failed!");
                }
            });
        }else{
            return false;
        }
    }
    </script>
  </body>
</html>
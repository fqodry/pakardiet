        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-8 col-xs-10 col-md-offset-2 col-xs-offset-1">
                <?php 
                    $flash_message = $this->session->flashdata('handler_msg');
                    if( ! empty($flash_message) ) {
                    echo '<p class="alert alert-'. $flash_message['type'] .'" id="flash_message"><b>'. $flash_message['msg'] .'</b></p>';
                    }
                ?>
					<!-- <h3>Form Pertanyaan User</h3> --><br/>
					<p class="col-md-12 formPertanyaanHelper"><em>*Hai <strong><?php echo ucwords(strtolower($first_name." ".$last_name)) ?></strong>! Silahkan pilih beberapa menu sesuai keinginan Anda untuk mendapatkan jumlah kalorinya.</em></p>
               <form class="form-horizontal form-label-left" action="" id="formCalorieCounter" method="post">
               	<h1><em>Penghitung Kalori</em></h1>
               	<hr>
               	<div class="form-group">
               		<label for="pilBahan" class="control-label col-md-2">Pilih Menu</label>
               		<div class="col-md-7">
               			<select class="form-control pilih-bahan" name="pilBahan[]" id="pilBahan">
               				<option value="">- Pilih -</option>
               				<?php foreach($bahans as $bahan){ ?>
               				<option data-kalori="<?php echo $bahan->calories ?>" data-berat="<?php echo $bahan->weight ?>" data-protein="<?php echo $bahan->protein ?>" data-lemak="<?php echo $bahan->fat ?>" data-karbo="<?php echo $bahan->carbo ?>" value="<?php echo $bahan->bahan_code ?>"><?php echo $bahan->bahan_name ?></option>
               				<?php } ?>
               			</select>
               		</div>
               		<div class="col-md-1">
               			<button class="btn btn-default" type="button" onclick="appendMenu()"><i class="fa fa-plus"></i></button>
               		</div>
               	</div>

               </form>
               <hr>
               <h1><em>Total Perhitungan</em></h1>
               <table class="table table-bordered table-condensed">
               	<thead>
               		<tr>
               			<th>Berat (gr)</th>
               			<th>Kalori (kal)</th>
               			<th>Protein (gr)</th>
               			<th>Lemak (gr)</th>
               			<th>Karbohidrat</th>
               		</tr>
               	</thead>
               	<tbody>
               		<tr>
               			<td id="beratVal">0 gr</td>
               			<td id="kaloriVal">0 kal</td>
               			<td id="proteinVal">0 gr</td>
               			<td id="lemakVal">0 gr</td>
               			<td id="karboVal">0 gr</td>
               		</tr>
               	</tbody>
               </table>
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

    <script>
			var base_url = '<?php echo base_url() ?>';
			var totalBerat = 0;
			var totalKalori = 0;
			var totalProtein = 0;
			var totalLemak = 0;
			var totalKarbo = 0;

			$(document).ready(function(){
				onChangePilBahan();
			});

			function appendMenu(){
				$('#formCalorieCounter').append('<div class="form-group"><label for="pilBahan" class="control-label col-md-2">&nbsp;</label><div class="col-md-7"><select class="form-control pilih-bahan" name="pilBahan[]" id="pilBahan"><option value="">- Pilih -</option><?php foreach($bahans as $bahan){ ?><option data-kalori="<?php echo $bahan->calories ?>" data-berat="<?php echo $bahan->weight ?>" data-protein="<?php echo $bahan->protein ?>" data-lemak="<?php echo $bahan->fat ?>" data-karbo="<?php echo $bahan->carbo ?>" value="<?php echo $bahan->bahan_code ?>"><?php echo $bahan->bahan_name ?></option><?php } ?></select></div><div class="col-md-1"><button class="btn btn-default" type="button" onclick="removeMenu(this)"><i class="fa fa-minus"></i></button></div></div>');

				onChangePilBahan();
			}

			function removeMenu(elem){
				$(elem).parent().parent().remove();
			}

			function onChangePilBahan(){
				$('.pilih-bahan').change(function(elem){
			   	var selBerat = $(this).find(':selected').data('berat');
			   	var selKalori = $(this).find(':selected').data('kalori');
			   	var selProtein = $(this).find(':selected').data('protein');
			   	var selLemak = $(this).find(':selected').data('lemak');
			   	var selKarbo = $(this).find(':selected').data('karbo');

			   	totalBerat += selBerat;
			   	totalKalori += selKalori;
			   	totalProtein += selProtein;
			   	totalLemak += selLemak;
			   	totalKarbo += selKarbo;

			   	setTimeout(function(){
			   		$('#beratVal').html(totalBerat+" gr");
			   		$('#kaloriVal').html(totalKalori+" kal");
			   		$('#proteinVal').html(totalProtein+" gr");
			   		$('#lemakVal').html(totalLemak+" gr");
			   		$('#karboVal').html(totalKarbo+" gr");
			   	},600);
			   });
			}
    </script>
  </body>
</html>
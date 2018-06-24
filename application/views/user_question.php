        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">
                <?php 
                    $flash_message = $this->session->flashdata('handler_msg');
                    if( ! empty($flash_message) ) {
                    echo '<p class="alert alert-'. $flash_message['type'] .'" id="flash_message"><b>'. $flash_message['msg'] .'</b></p>';
                    }
                ?>
                <!-- <h3>Form Pertanyaan User</h3> --><br/>
                <p class="col-md-12 formPertanyaanHelper"><em>*Hai <strong><?php echo ucwords(strtolower($first_name." ".$last_name)); ?></strong>! Silahkan jawab seluruh pertanyaan yang tampil sesuai dengan aktifitas fisik Anda setiap hari.</em></p>
                <form action="<?php echo $form_user_question; ?>" id="formUserQuestion" method="post">
                    <div class="form-group">
                        <label for="">Pertanyaan</label>
                        <h4 id="userQuestion"><em><?php echo $the_question->question ?></em></h4>
                    </div>
                    <div class="form-group hidden">
                        <label for="">Kode In</label>
                        <input type="text" class="form-control" id="kodeIn" name="kodeIn" placeholder="Kode In" value="<?php echo $the_question->code ?>" readonly required /> <code></code>
                    </div>
                    <div class="form-group hidden">
                        <label for="">Kode From</label>
                        <input type="text" class="form-control" id="kodeFrom" name="kodeFrom" placeholder="Kode From" value="" readonly required /> <code></code>
                    </div>
                    <div class="form-group">
                        <div class="radio">
                            <label>
                              <input type="radio" class="flat" checked name="userResponse" value="true" /> Ya
                            </label>
                            <label>
                              <input type="radio" class="flat" name="userResponse" value="false" /> Tidak
                            </label>
                        </div>
                    </div><br/>
                    <div class="form-group" style="text-align: right;">
                        <button type="button" class="btn btn-warning" id="btnFlow"><span id="btnDecision">Next</span></button>
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

    <script>
        var base_url = '<?php echo base_url() ?>';

        function getFinalRule(k_in, k_from, userResp){
            $.ajax({
                url: base_url + 'UserQuestion/jxGetFinalRule',
                method: 'POST',
                dataType: 'json',
                data: { kodeIn: k_in, kodeFrom: k_from, userResponse: userResp },
                success: function(data){
                    console.log(data);
                    window.location = base_url + 'UserQuestion/userBaseQuestionHandler/'+data['userWeight']+'/'+data['userHeight']+'/'+data['userAge']+'/'+data['userGender']+'/'+data['userActivity'];
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log("Ajax Request Failed!");
                    console.log(jqXHR + ": " + textStatus + " - " + errorThrown);
                }
            });
        }
        
        $(document).ready(function(){
            $('button#btnFlow').on("click",function(){
                var kodeIn = $('input#kodeIn').val();
                var kodeFrom = $('input#kodeFrom').val();
                var userResponse = $('input[name="userResponse"]:checked', '#formUserQuestion').val();

                console.log(kodeIn + " - " + kodeFrom + " - " + userResponse);

                $.ajax({
                    url: base_url + 'UserQuestion/userAnswerResponseHandler',
                    method: 'POST',
                    dataType: 'json',
                    data: { kodeIn: kodeIn, kodeFrom: kodeFrom, userResponse: userResponse },
                    success: function(data, textStatus, jqXHR){
                        console.log(data);
                        if(data == false){
                            getFinalRule(kodeIn, kodeFrom, userResponse);
                        }else{
                            $('#userQuestion').html('<em>'+data['k_out_question']+'</em>');
                            $('input#kodeIn').val(data['k_out']);
                            $('input#kodeFrom').val(data['k_in']);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        console.log("Ajax Request Failed!");
                        console.log(jqXHR + ": " + textStatus + " - " + errorThrown);
                    }
                });
            });
        });
    </script>
  </body>
</html>
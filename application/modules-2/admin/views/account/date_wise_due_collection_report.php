<!-- <script type="text/javascript">
   setTimeout(function() { 
        window.print();
        self.close();
   }, 1000);
 </script> -->
 <?php 
  $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
$hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];];
  ?>

  <div id="app" style="color:#000;font-weight:bold;">


    <div class="section-wrapper">
      <div class="card my-3 no-b">
        <div class="card-body">
          <div class="container">
            <div class="invoice white shadow">
             <div class="row pl-5 pr-5">
               <div class="col-md-3">
                <img style="height: 130px;width: 150px;" src="back_assets/img/dummy/<?=$hos_logo?>" alt="">  
              </div>      
              <div class="col-md-9">

               <?=$hos_head_report?>
             </div> 
             
             <div class="col-md-12" style="border-bottom:#000 solid 1px">
             </div>

             
           </div>
            <!-- Table row -->
            <div class="row pl-5 pr-5 my-3">
              <div class="col-12 table-responsive">
                <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report of OPD Collection Between <?php echo $from_date?> to <?php echo $end_date?> </p>


                <!--  <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report Type: <?=$doc_id?> </p> -->



                <h1 align="center">Due Balance Sheet</h1><br>



                <?php   

                $total_due=0;



                $total_n_i=0;
                $due=0;

                $total_n_i+=$outdoor_total_amount[0]['total_amount']+$outdoor_vat_income[0]['vat']-$outdoor_discount_expense[0]['discount']-$outdoor_commission_expense[0]['paid_com'];

                $due=$total_n_i-$outdoor_net_income[0]['paid_due'];

                $total_due+=$due;

                ?>



                <!-- Outdoor Balance Sheet -->

                <h3 align="center">Due Balance Sheet</h3><br>



                <table id="test_table" class="table table-bordered table-hover table-striped test_table_report"
                >
                <thead>
                  <tr>
                    <th><h5>SL</h5></th>
                    <th><h5>Head Name</h5></th>
                    <th><h5>Amount</h5></th>      

                    <!-- <th style="width:10%;">Details</th> -->
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td align="left">1</td>
                    <td align="left">Outdoor Total Due</td>
                    <td align="right"><?=number_format($due, 2, '.', '');?></td>

                  </tr>


                  <?php


                  $total_n_i=0;
                  $due=0;

                  $total_n_i+=$indoor_total_amount[0]['total_amount']+$indoor_vat_income[0]['vat']-$indoor_discount_expense[0]['discount'];

                  $due=$total_n_i-$indoor_net_income[0]['paid_due'];


                  $total_n_i1=0;
                  $due1=0;

                  $total_n_i1+=$indoor_diag_total_amount[0]['total_amount']+$indoor_diag_vat_income[0]['vat']-$indoor_diag_discount_expense[0]['discount'];

                  $due1=$total_n_i1-$indoor_diag_net_income[0]['paid_due'];

                  $total_due+=$due+$due1;

                  ?>

                  <tr>
                    <td align="left">2</td>
                    <td align="left">Indoor Total Due</td>
                    <td align="right"><?=number_format($due+$due1, 2, '.', '');?></td>

                  </tr> 


                  <?php


                  $total_n_i=0;
                  $due=0;

                  $total_n_i+=$pharmacy_total_amount[0]['credit']+$pharmacy_vat_income[0]['vat']-$pharmacy_discount_expense[0]['discount']-$pharmacy_supplier_expense[0]['debit'];

                  $due=$total_n_i-$pharmacy_net_income[0]['debit'];

                  $total_due+=$due;

                  ?>


                  <tr>
                    <td align="left">3</td>
                    <td align="left">Pharmacy Total Due</td>
                    <td align="right"><?=number_format($due, 2, '.', '');?></td>

                  </tr> 


                </tbody>

                <tfoot>
                  <tr>
                    <td colspan="2">Total Due</td>
                    <td align="right"><?=number_format($total_due, 2, '.', '');?></td>
                  </tr>
                </tfoot>

              </table>
              <!-- <h3 align="center">Total Amount: <?=number_format($total_amount+$total_others_inc, 2, '.', '');?></h3> -->



              <!-- <h3 align="center">Total Expense: <?=number_format(($total_amount+$total_others_inc)-($total_income+$total_others_inc-$total_others_exp), 2, '.', '');?></h3> -->

              <!-- <h3 align="center">Total Income: <?=number_format($total_income+$total_others_inc-$total_others_exp, 2, '.', '');?></h3> -->

              <!-- <h3 align="center">Total Collection: <?=number_format($total_collection+$total_others_inc, 2, '.', '');?></h3> -->

              <!-- <h3 align="center">Total Due: <?=number_format(($total_income+$total_others_inc-$total_others_exp)-($total_collection+$total_others_inc), 2, '.', '');?></h3> -->

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->


          <!-- /.row -->

          <!-- this row will not appear when printing -->
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!-- /.right-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
     <div class="control-sidebar-bg shadow white fixed"></div>
   </div>

   <?php $this->load->view('back/footer_link');?>




 </body>
 </html>













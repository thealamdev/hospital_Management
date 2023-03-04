<?php $this->load->view('back/header_link'); ?>
<body class="light">
  <!-- Pre loader -->
  <?php $this->load->view('back/loader'); ?>

  <?php 
  $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
  $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];
  ?>

  <div align="center"><button id="btn_print" onclick="print_page('app')" style="width: 80px;height: 50px;background-color: #759ddd; margin:0px">Print</button></div>

  <div id="app" style="color:#000;font-weight:bold;">


    <div class="section-wrapper">
      <div class="card my-3 no-b">
        <div class="card-body">
          <div class="container">
            <div class="">
             <div class="row pl-5 pr-5">
               <div class="col-md-2">
                 <img style="height: 110px;width: 110px; margin-top:10px;" src="uploads/hospital_logo/<?=$hos_logo?>" alt=""> 
               </div>       
               <div class="col-md-8">

                 <?=$hos_head_report?> 
               </div> 


               <hr style="width: 100%; border:0.5px solid #000"/>



             </div>
          <!-- Table row -->
          <div class="row pl-5 pr-5 my-3">
            <div class="col-12 table-responsive">
             <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report of IPD Collection Between <?php echo $from_date?> to <?php echo $end_date?> </p>


             <!-- <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report of IPD Collection Between <?php echo $from_date?> to <?php echo $end_date?> </p> -->


             <table class="table table-bordered table-striped">					  
              <thead>
                <th style="color:#000;font-weight:bold;font-size:16px;border:#000 solid 1px">SL NO</th>                        
                <th style="color:#000;font-weight:bold;font-size:16px;border:#000 solid 1px">Service Name</th>
                <th style="color:#000;font-weight:bold;font-size:16px;border:#000 solid 1px">Total Service</th>
                <th style="color:#000;font-weight:bold;font-size:16px;border:#000 solid 1px">Unit Price</th>
                <th style="color:#000;font-weight:bold;font-size:16px;border:#000 solid 1px">Total Collection</th>
                         <!-- <th style="color:#000;font-weight:bold;font-size:16px;border:#000 solid 1px">Q/C Commission</th>                       
                           <th style="color:#000;font-weight:bold;font-size:16px;border:#000 solid 1px">Total Q/C Commission</th> -->
                         </thead>
                         <tbody>


                          <?php
                          $i=1;
                          $test_total=0;
                          $total_test_price=0;
                          $amnt_col=0;
                          $total_test_comi=0;
                          foreach ($total_service as $key => $value1) 
                          { 

                            $value1['total_price']=$value1['qty']*$value1['service_price'];

                            ?>
                            <tr> 
                              <td align="center"><?=$i++?></td>                                         
                              <td align="center"><?=$value1['service_name']?></td>
                              <td align="center"><?=$value1['qty']?></td>
                              <td align="right"><?=number_format($value1['service_price'],2,'.','')?> &#x9f3 </td>

                              <td align="right"><?=number_format( $value1['total_price'],2,'.','')?> &#x9f3 </td>


										  <!-- <td align="right"><?=number_format($value1['quk_ref_com'],2,'.','')?> &#x9f3 </td>
                        <td align="right"><?=number_format($value1['total_price_qc'],2,'.','')?> &#x9f3 </td>  -->

                      </tr>
                      <?php 
                      $test_total+=$value1['qty'];
                      $total_test_price+=number_format($value1['total_price'],2,'.','');
								   // $total_test_comi+=number_format($value1['total_price_qc'],2,'.','');
                    }

                    ?>
                    <tfoot>
                      <th style="color:#000;font-weight:bold;font-size:16px;border:#000 solid 1px"></th>                        
                      <th style="color:#000;font-weight:bold;font-size:16px;border:#000 solid 1px">Total Test: </th>
                      <th style="color:#000;font-weight:bold;font-size:16px;border:#000 solid 1px;"><?php echo $test_total?></th>
                      <th style="color:#000;font-weight:bold;font-size:16px;border:#000 solid 1px">Total Collection</th>
                      <th style="color:#000;font-weight:bold;font-size:16px;border:#000 solid 1px;text-align:right"><?php echo $total_test_price?> &#x9f3</th>
                      <!-- <th style="color:#000;font-weight:bold;font-size:16px;border:#000 solid 1px">Total Commission</th>                        -->
                      <!-- <th style="color:#000;font-weight:bold;font-size:16px;border:#000 solid 1px;text-align:right"><?php echo $total_test_comi?> &#x9f3</th> -->
                    </tfoot>



                  </tbody>
                </table>
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













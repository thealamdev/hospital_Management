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
                <table class="table table-bordered table-striped test_table_report">            
                  <thead>
                    <tr>
                      <th>SL NO</th>
                      <th>Patient Name</th>
                      <th>Patient ID</th>
                      <th>Mobile No</th>
                      <th>Total Amount</th>
                      <th>Net Total</th>
                      <th>Paid</th>
                      <th>Due</th>
                      <th>Discount</th>
                      <th>VAT</th>
                      <th>Operator</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;
                    $toatl=0;
                    $toatlp=0;
                    $total_discount=0;
                    $total_vat=0;
                    $total_vat=0;
                    $due=0;
                    $net_total=0;

                    foreach ($ipd_collection_info as $key => $value) {


                      $value['net_total']=$value['total_amount']-$value['total_discount']+$value['total_vat'];

                      $value['due']=$value['net_total']-$value['total_paid'];
                      ?>
                      <tr>
                       <td><?=$i?></td>
                       <td><?=$value['patient_name']?></td>
                       <td><?=$value['patient_info_id']?></td>
                       <td><?=$value['mobile_no']?></td>
                       <td align="right"><?php echo number_format($value['total_amount'],2,'.','')?></td>
                       <td align="right"><?php echo number_format($value['net_total'],2,'.','')?></td>
                       <td align="right"><?php echo number_format($value['total_paid'],2,'.','')?></td>
                       <td align="right"><?php echo number_format($value['due'],2,'.','')?></td>
                       <td align="right"><?php echo number_format($value['total_discount'],2,'.','')?></td>
                       <td align="right"><?php echo number_format($value['total_vat'],2,'.','')?></td>                 
                       <td align="right"><?=$value['operator_name']?></td>                 
                       <td><?=date('d-M-Y h:i:s a',strtotime($value['created_at']))?></td>


                     </tr>

                     <?php $i++;

                     $toatl+=$value['total_amount'];
                     $toatlp+=$value['total_paid'];
                     $total_discount+=$value['total_discount'];  
                     $total_vat+=$value['total_vat'];  
                     $due+=$value['due'];

                     $net_total+=$value['net_total']; 
                   }?>


                 </tbody>

                 <tfoot>

                 </style>
                 <tr>
                  <td colspan="4"></td>
                  <td align="right">Total Amount: <?php echo number_format($toatl,2,'.','')?> </td>
                  <td align="right">Net Total: <?php echo number_format($net_total,2,'.','')?> </td>

                  <td align="right">Total Paid: <?php echo number_format($toatlp,2,'.','')?> </td>
                  <td align="right">Total Due: <?php echo number_format($due,2,'.','')?> </td>
                  <td align="right">Total Discount: <?php echo number_format($total_discount,2,'.','')?> </td>
                  <td align="right">Total VAT: <?php echo number_format($total_vat,2,'.','')?> </td>
                  <td></td>
                  <td></td>


                </tr>
              </tfoot>

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









 




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
                <img style="height: 110px;width: 110px;" src="uploads/hospital_logo/<?=$hos_logo?>" alt="">  
              </div>      
              <div class="col-md-8">

               <?=$hos_head_report?>
             </div> 

             <div class="col-md-12" style="border-bottom:#000 solid 1px">
             </div>


           </div>

           <!-- Table row -->
           <div class="row pl-5 pr-5 my-3">
            <div class="col-12 table-responsive">
              <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report From <?php echo $from_date?> to <?php echo $end_date?> </p>


              <table id="test_table" class="table table-bordered table-hover table-striped test_table_report">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Patient ID</th>
                    <th>Bill No</th>
                    <th>Patient Name</th>
                    <th>Total Amount</th>
                    <th>Paid Due</th>
                    <th>Discount</th>
                    <th>Permitted By</th>
                    <th>Test Details</th>
                    <th>Date & Time</th>
                    <th>Operator Name</th>



                    <!-- <th>Date</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;
                  $total_discount=0;
                  $total_paid=0;

                  foreach ($discount_summary as $key => $value) {

                    $total_discount+=$value['discount'];
                    $total_paid+=$value['paid_due'];

                    ?>
                    <tr>
                     <td><?=$i?></td>
                     <td><?=$value['patient_info_id']?></td>
                     <td><?=$value['order_id']?></td>
                     <td><?=$value['patient_name']?></td>
                     <td align="right"><?=$value['total_amount']?></td>
                     <td align="right"><?=$value['paid_due']?></td>
                     <td align="right"><?=$value['discount']?></td>
                     <td align="right"><?=$value['discount_ref']?></td>
                     <td align="center"><a target="_blank" class="btn-sm btn-primary" href="admin/opd_each_billing_details/<?=$value['o_id']?>/<?=$value['op_id']?>">Details</a></td>
                     <td align="right"><?=date('d-M-Y h:i a',strtotime($value['created_at']))?></td>
                     <td align="right"><?=$this->session->userdata['logged_in']['username']?></td>

                   </tr>

                   <?php $i++;
                 }?>


               </tbody>
               <tfoot>

                 <tr>
                  <td align="right" colspan="6">Total Paid: <?=$total_paid?></td>
                  <td align="right">Total Discount: <?=$total_discount?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>


                </tr>
              </tfoot>
            </table>

          </div>

        </div>


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

   <style type="text/css">
    .card-body
    {
      padding-top: 5px !important;
      padding-bottom:5px !important;
      padding-left: 5px !important;
      padding-right:5px !important;

    }
  </style>

  <?php $this->load->view('back/footer_link');?>




</body>
</html>



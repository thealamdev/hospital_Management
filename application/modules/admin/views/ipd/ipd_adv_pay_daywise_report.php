
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
                    <th>Invoice No</th>
                    <th>Patient Name</th>
                    <th>Advance Amount</th>
                    <th>Date</th>
                    <th>Operator</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;
                  $total_adv=0;

                  foreach ($ipd_adv_pay as $key => $value) {

                    $total_adv+=$value['advance_payment'];

                    ?>
                    <tr>
                     <td><?=$i?></td>
                     <td><?=$value['patient_info_id']?></td>
                     <td><?=$value['invoice_order_id']?></td>
                     <td><?=$value['patient_name']?></td>
                     <td align="right"><?=$value['advance_payment']?></td>
                     <td align="right"><?=date('d-M-Y h:i a',strtotime($value['created_at']))?></td>
                     <td align="right"><?=$value['operator_name']?></td>

                   </tr>

                   <?php $i++;
                 }?>

               </tbody>
               <tfoot>

                 <tr>
                  <td align="right" colspan="4">Total</td>
                  <td align="right"><?=$total_adv?></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
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



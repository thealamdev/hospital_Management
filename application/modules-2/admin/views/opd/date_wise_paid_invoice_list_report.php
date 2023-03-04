
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


              <!-- <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report Type: <?=$paid_status?> </p> -->


              <table id="test_table" class="table table-bordered table-hover table-striped test_table_report">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Bill No</th>
                    <th>Patient ID</th>
                    <th>Patient Name</th>
                    <th>Age</th>
                    <th>Sex</th>
                    <th>Total Test Price</th>
                    <th>Total Discount</th>
                    <th>Total Vat</th>
                    <th>Net Amount</th>
                    <th>Paid</th>
                    <th>Date</th>
                    <th>operator</th>



                    <!-- <th>Date</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;
                  $total_a=0;
                  $total_d=0;
                  $total_v=0;
                  $total_p=0;
                  $total_n=0;
                  $total_n1=0;


                  foreach ($paid_invoice_info as $key => $value) {

                    $total_n=$value['total_amount']+$value['vat']-$value['total_discount'];
                    $total_n1+=$total_n;
                    $total_p+=$value['paid_amount'];
                    $total_d+=$value['total_discount'];
                    $total_v+=$value['vat'];
                    $total_a+=$value['total_amount'];


                    ?>
                    <tr>
                     <td><?=$i?></td>
                     <td><?=$value['test_order_id']?></td>
                     <td><?=$value['patient_info_id']?></td>
                     <td><?=$value['patient_name']?></td>
                     <td><?=$value['age']?></td>

                     <td><?=$value['gender']?></td>
                     <td align="right"><?=$value['total_amount']?></td>
                     <td align="right"><?=$value['total_discount']?></td>
                     <td align="right"><?=$value['vat']?></td>
                     <td align="right"><?=$total_n?></td>
                     <td align="right"><?=$value['paid_amount']?></td>

                     <td align="right"><?=date('d M,Y h:i a',strtotime($value['created_at']))?></td>
                     <td align="right"><?=$this->session->userdata['logged_in']['username']?></td>




                     <!-- <td><?=date('d M,Y h:i a',strtotime($value['created_at']))?></td> -->


                   </tr>

                   <?php $i++;

// $toatl+=$value['total_amount'];
// $toatlp+=$value['paid_amount'];
// $total_discount+=$value['total_discount']; 
// $total_vat+=$value['total_vat']; 
// $due+=$toatl-($toatlp+$total_discount);  
                 }?>


               </tbody>
               <tfoot>

                 <tr>
                  <td align="right" colspan="6">Total</td>
                  <td align="right"><?=$total_a?></td>
                  <td align="right"><?=$total_d?></td>
                  <td align="right"><?=$total_v?></td>
                  <td align="right"><?=$total_n1?></td>
                  <td align="right"><?=$total_p?></td>
                  <td></td>
                  <td></td>



                </tr>
              </tfoot>
            </table>


            <!-- <p style="font-weight:bold">Total Commission : <?php echo $total_com?></p> -->
            <!-- <p style="font-weight:bold">Paid Commission : <?php echo $paid_com?></p> -->



         <!--   <p style="font-weight:bold">Total Amount : <?php echo $toatl?></p>
          
            <p style="font-weight:bold">Total Paid : <?php echo $toatlp?></p>

            <p style="font-weight:bold">Total Due : <?php echo $toatl-$toatlp ?></p> -->


            
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



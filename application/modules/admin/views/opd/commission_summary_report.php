<!-- <script type="text/javascript">
   setTimeout(function() { 
        window.print();
        self.close();
   }, 1000);
 </script> -->
 <?php $this->load->view('back/header_link'); ?>
 <body class="light">
  <!-- Pre loader -->
  <?php $this->load->view('back/loader'); ?>

  <?php 
  $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
  $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];
  ?>

  <div id="app" style="color:#000;font-weight:bold;">


    <div class="section-wrapper">
      <div class="card my-3 no-b">
        <div class="card-body">
          <div class="container">
            <div class="invoice white shadow">
             <div class="row pl-5 pr-5">
               <div class="col-md-3">
                <img style="height: 130px;width: 150px;" src="uploads/hospital_logo/<?=$hos_logo?>" alt="">  
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


              <!-- <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report Type: <?=$paid_status?> </p> -->


              <table id="test_table" class="table table-bordered table-hover table-striped test_table_report">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Doctor Name</th>
                    <th>Patient Name</th>
                    <th>Patient ID</th>
                    <th>Invoice ID</th>
                    <th>Total Commission</th>
                    <th>Total Commission Paid</th>
                    <th>Operator</th>



                    <!-- <th>Date</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;
                  $total_paid_com=0;
                  $total=0;
                  $total_discount=0;
                  $total_vat=0;
                  $total_vat=0;
                  $due=0;
                  foreach ($com_info as $key => $value) {
// $value['due']=$value['total_amount']-($value['paid_amount']+$value['total_discount']);

                    $total_paid_com+=$value['paid_com'];

                          // $total_discount+=$value['discount'];

                    ?>
                    <tr>
                     <td><?=$i?></td>
                     <td><?=$value['doctor_title']?></td>
                     <td><?=$value['patient_name']?></td>
                     <td><?=$value['patient_info_id']?></td>
                     <td><?=$value['order_id']?></td>

                     <td align="right"><?=$value['total_commission']?></td>
                     <td align="right"><?=$value['paid_com']?></td>
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
               <tfoot style="background:#ccc;font-weight: bold;">


                 <tr>
                  <td colspan="6"></td>
                  <td>Paid Com: <?php echo number_format($total_paid_com,2,'.','')?> </td>

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

   <?php $this->load->view('back/footer_link');?>




 </body>
 </html>












